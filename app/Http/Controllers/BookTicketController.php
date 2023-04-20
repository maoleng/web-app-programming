<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Ticket;
use Libraries\Request\Request;

class BookTicketController extends Controller
{

    public function chooseSchedule(Request $request)
    {
        $data = $request->all();
        session()->put('order', $data);
    }

    public function chooseSeat()
    {
        $order = session()->get('order');
        if (empty($order)) {
            redirect()->back();
        }
        $order_info = $this->getOrderInformation($order);

        return view('customer.order.choose_seat', $order_info);
    }

    public function processChooseSeat(Request $request, $id): void
    {
        $id = (int) $id;
        $order = session()->get('order');
        $type = $request->get('type');

        $key = array_search($id, $order['chosen_tickets'] ?? [], true);
        if ($type === 'choose' && $key === false) {
            $order['chosen_tickets'][] = $id;
        } else {
            unset($order['chosen_tickets'][$key]);
        }
        session()->put('order', $order);

        redirect()->back();
    }

    public function chooseCombo()
    {
        $order = session()->get('order');
        if (empty($order['chosen_tickets'])) {
            redirect()->back();
        }
        $order_info = $this->getOrderInformation($order);

        $combo_ids = array_keys($order['combos'] ?? []);
        $combos = (new Combo)->get();
        $combos_with_amount = [];
        foreach ($combos as $combo) {
            $combo->amount = in_array($combo->id, $combo_ids, false) ? $order['combos'][$combo->id] : 0;
            $combos_with_amount[] = $combo;
        }

        $order_info['combos'] = $combos_with_amount;

        return view('customer.order.choose_combo', $order_info);
    }

    public function processChooseCombo(Request $request): void
    {
        $data = $request->all();

        $order = session()->get('order');

        $combos = $order['combos'] ?? [];
        $amount = $combos[$data['combo_id']] ?? null;
        if ($data['type'] === 'increase') {
            $combos[$data['combo_id']] = $amount === null ? 1 : $amount + 1;
        } elseif ($amount <= 1) {
            unset($combos[$data['combo_id']]);
        } else {
            $combos[$data['combo_id']] = $amount - 1;
        }
        $order['combos'] = $combos;
        session()->put('order', $order);
    }

    public function pay(Request $request): void
    {
        $bank_code = $request->get('bank_code');
        $amount = $this->getOrderInformation(session()->get('order'))['total'];
        $return_url = url('/');

        $payment_url = $this->createPaymentUrl($amount, $bank_code, $return_url);

        redirect()->to($payment_url);
    }

    public function callback(Request $request): void
    {
        $order = session()->get('order');
        if (empty($order)) {
            return;
        }

        $data = $request->all();
        $order_info = $this->getOrderInformation($order);

        $order = (new Order)->create([
            'total' => $order_info['total'],
            'bank_code' => $data['bank_code'],
            'transaction_code' => $data['transaction_code'],
            'customer_id' => authed()->id,
            'ordered_at' => now()->format('Y-m-d H:i:s'),
        ]);

        $tickets = (new Ticket)->whereIn('id', $order_info['chosen_tickets'])->get();
        foreach ($tickets as $ticket) {
            (new OrderDetail)->create([
                'order_id' => $order->id,
                'ticket_id' => $ticket->id,
                'combo_id' => null,
                'amount' => 1,
                'price' => $ticket->price,
            ]);
        }
        (new Ticket)->whereIn('id', $order_info['chosen_tickets'])->update(['is_used' => 1]);

        $combos = (new Combo)->whereIn('id', array_keys($order_info['chosen_combos']))->get();
        foreach ($combos as $combo) {
            (new OrderDetail)->create([
                'order_id' => $order->id,
                'ticket_id' => null,
                'combo_id' => $combo->id,
                'amount' => $order_info['chosen_combos'][$combo->id],
                'price' => $combo->price,
            ]);
        }

        session()->forget('order');
    }

    private function getOrderInformation($order): array
    {
        $tickets = (new Ticket)->raw("
            SELECT tickets.*,
                   order_detail.order_id as `is_bought`,
                   schedules.started_at,
                   movies.name, movies.banner, movies.description
            FROM tickets
            LEFT JOIN order_detail ON order_detail.ticket_id = tickets.id
            LEFT JOIN schedules ON schedules.id = tickets.schedule_id
            LEFT JOIN movies ON movies.id = schedules.movie_id
            WHERE type = {$order['type']} AND schedules.id = {$order['schedule_id']}
        ");

        $tickets_price = 0;
        $seats = [];
        foreach ($tickets as $ticket) {
            if (in_array((int) $ticket->id, $order['chosen_tickets'] ?? [], true)) {
                $tickets_price += $ticket->price;
                $seats[] = $ticket->seatName();
            }
        }

        $order_combos = $order['combos'] ?? [];
        $combos = (new Combo)->whereIn('id', array_keys($order_combos))->get();
        $combos_price = 0;
        foreach ($combos as $combo) {
            $combos_price += $combo->price * $order_combos[$combo->id];
        }

        return [
            'tickets' => $tickets,
            'chosen_tickets' => $order['chosen_tickets'] ?? [],
            'chosen_combos' => $order_combos,
            'tickets_price' => $tickets_price,
            'combos_price' => $combos_price,
            'total' => $tickets_price + $combos_price,
            'str_seats' => implode(', ', $seats),
        ];
    }

    private function createPaymentUrl($amount, $bank_code, $return_url): string
    {
        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_ReturnUrl = $return_url;
        $startTime = date('YmdHis');
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = random_int(1,10000);
        $vnp_Amount = $amount;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount * 100,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => 'Thanh toan GDnh toan GDnh toan GDnh toan GD:' . $vnp_TxnRef,
            'vnp_OrderType' => 'other',
            'vnp_ReturnUrl' => $vnp_ReturnUrl,
            'vnp_TxnRef' => $vnp_TxnRef,
            'vnp_ExpireDate'=>$expire
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode !== '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = '';
        $i = 0;
        $hash_data = '';
        foreach ($inputData as $key => $value) {
            if ($i === 1) {
                $hash_data .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hash_data .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url .= '?'.$query;
        $vnpSecureHash =   hash_hmac('sha512', $hash_data, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnp_Url;
    }

}