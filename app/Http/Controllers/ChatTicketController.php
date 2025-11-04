<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatTicket;

class ChatTicketController extends Controller
{
    public function BuatTicket(Request $request)
    {
        // ✅ 1. Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'subject' => 'nullable|string|max:255'
        ]);

        // ✅ 2. Buat record ticket baru
        $ticket = ChatTicket::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject ?? 'Chat Baru',
            'status' => 'open',
        ]);

        // ✅ 3. Return response sukses
        return response()->json([
            'message' => 'Ticket chat berhasil dibuat',
            'ticket_id' => $ticket->id
        ], 201);
    }
}
