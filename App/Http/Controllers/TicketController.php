<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Libraries\Request\Request;

class TicketController extends Controller
{

    public function verify(Request $request, $id)
    {
        $ticket = (new Ticket)->find($id);
        if ($ticket === null) {
            [$status, $message] = [false, 'Not found ticket'];
        } else {
            $ticket = (new Ticket)->raw("
                SELECT tickets.*, users.name as `customer_name`, movies.name as `movie_name`, schedules.ended_at
                FROM tickets
                    LEFT JOIN order_detail ON order_detail.ticket_id = tickets.id
                    LEFT JOIN orders ON orders.id = order_detail.order_id
                    LEFT JOIN users ON users.id = orders.customer_id
                    LEFT JOIN schedules ON schedules.id = tickets.schedule_id
                    LEFT JOIN movies ON movies.id = schedules.movie_id
                WHERE tickets.id = $id
            ")[0];
            if (empty($ticket->customer_name)) {
                [$status, $message] = [false, 'Ticket is not buy'];
            } elseif ($ticket->is_used) {
                [$status, $message] = [false, 'Ticket is already used'];
            } elseif (Carbon::make($ticket->ended_at)->lt(now())) {
                [$status, $message] = [false, 'Film is ended'];
            } else {
                $ticket->update(['is_used' => 1]);
                [$status, $message] = [true, 'Ticket is valid'];
            }
        }

        return view('admin.ticket.verify', [
            'status' => $status,
            'ticket' => $ticket,
            'message' => $message,
        ]);
    }

}