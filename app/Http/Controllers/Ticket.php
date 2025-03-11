<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['orderDetail.ticketCategory', 'orderDetail.order'])->paginate(10);
        
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderDetails = OrderDetail::with(['ticketCategory.event', 'order.user'])->get();
        
        return view('tickets.create', compact('orderDetails'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_detail_id' => 'required|exists:order_details,id',
            'status' => 'required|in:active,used,canceled',
        ]);

        $ticket = new Ticket();
        $ticket->order_detail_id = $request->order_detail_id;
        $ticket->ticket_code = 'TIX-' . Str::upper(Str::random(8));
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with(['orderDetail.ticketCategory.event', 'orderDetail.order.user'])->findOrFail($id);
        
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $orderDetails = OrderDetail::with(['ticketCategory.event', 'order.user'])->get();
        
        return view('tickets.edit', compact('ticket', 'orderDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_detail_id' => 'required|exists:order_details,id',
            'status' => 'required|in:active,used,canceled',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->order_detail_id = $request->order_detail_id;
        $ticket->status = $request->status;
        $ticket->save();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus.');
    }

    /**
     * Check-in a ticket.
     */
    public function checkIn(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        
        if ($ticket->status === 'active') {
            $ticket->status = 'used';
            $ticket->check_in_time = now();
            $ticket->save();
            
            return redirect()->route('tickets.show', $ticket->id)
                ->with('success', 'Check-in berhasil.');
        }
        
        return redirect()->route('tickets.show', $ticket->id)
            ->with('error', 'Tiket tidak dapat di-check-in karena statusnya bukan active.');
    }

    /**
     * Verify ticket by code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string',
        ]);

        $ticket = Ticket::where('ticket_code', $request->ticket_code)->first();
        
        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'Tiket tidak ditemukan.']);
        }
        
        return response()->json([
            'status' => 'success',
            'ticket' => $ticket->load(['orderDetail.ticketCategory.event', 'orderDetail.order.user'])
        ]);
    }
}