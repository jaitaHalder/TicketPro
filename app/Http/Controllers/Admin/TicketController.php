<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $tickets = Ticket::with(['trip', 'subRoute', 'seats', 'payment'])
            ->orderByDesc('id')
            ->get();

        return view("admin.tickets.index", compact("tickets"));
    }

    /**
     * @return View
     */
    public function trashes(): View
    {
        $tickets = Ticket::onlyTrashed()->with(['trip', 'subRoute', 'seats', 'payment'])
            ->orderByDesc('id')
            ->get();

        return view("admin.tickets.trashes", compact("tickets"));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $ticket = Ticket::withTrashed()->find($id);

        if ($ticket) {
            $ticket->restore();
            return redirect()
                ->back()
                ->with('success', 'The ticket has been restored successfully.');
        }

        return redirect()
            ->back()
            ->with('error', 'Ticket not found.');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function forceDelete($id): RedirectResponse
    {
        $ticket = Ticket::withTrashed()->find($id);

        if ($ticket) {
            $ticket->forceDelete();
            return redirect()->back()->with('success', 'The ticket has been permanently deleted.');
        }

        return redirect()->back()->with('error', 'Ticket not found.');
    }




    public function show(int $ticket_id): View
    {
        $ticket = Ticket::with(['trip', 'subRoute', 'seats', 'payment', 'user'])
            ->where('id', '=', $ticket_id)
            ->firstOrFail();

        return view("admin.tickets.show", compact('ticket'));
    }

    /**
     * @param Request $request
     * @param int $ticket_id
     * @return RedirectResponse
     */
    public function update(Request $request, int $ticket_id): RedirectResponse
    {
        Ticket::query()
            ->where('id', '=', $ticket_id)
            ->firstOrFail();

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('error', 'Please choose payment status.');
        }

        Payment::query()
            ->where('ticket_id', '=', $ticket_id)
            ->update([
                'status' => $request->input('status'),
            ]);

        return redirect()
            ->back()
            ->with('success', 'Payment status updated successfully.');
    }

    /**
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();

        return redirect()
            ->back()
            ->with('success', 'Ticket deleted successfully.');
    }

    /**
     * @param $ticket_id
     * @return View
     */
    public function print($ticket_id): View
    {
        $ticket = Ticket::with(['trip', 'subRoute', 'seats', 'payment', 'user'])
            ->where('id', '=', $ticket_id)
            ->firstOrFail();

        $print = true;

        return view('user.ticket_print', compact('ticket', 'print'));
    }
}
