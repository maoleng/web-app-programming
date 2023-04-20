<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
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

        return view('customer.order.choose_seat', [
            'tickets' => $tickets,
            'chosen_tickets' => $order['chosen_tickets'] ?? [],
            'tickets_price' => $tickets_price,
            'str_seats' => implode(', ', $seats),
        ]);
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
}