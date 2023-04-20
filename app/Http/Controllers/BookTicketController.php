<?php

namespace App\Http\Controllers;

use App\Models\Combo;
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
        if (empty($order)) {
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

        $combos = $order['combos'];
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
            if (in_array((int) $ticket->id, $order['chosen_tickets'], true)) {
                $tickets_price += $ticket->price;
                $seats[] = $ticket->seatName();
            }
        }

        $combo_ids = array_keys($order['combos'] ?? []);
        $combos = (new Combo)->whereIn('id', $combo_ids)->get();
        $combos_price = 0;
        foreach ($combos as $combo) {
            $combos_price += $combo->price;
        }

        return [
            'tickets' => $tickets,
            'chosen_tickets' => $order['chosen_tickets'] ?? [],
            'tickets_price' => $tickets_price,
            'combos_price' => $combos_price,
            'total' => $tickets_price + $combos_price,
            'str_seats' => implode(', ', $seats),
        ];
    }

}