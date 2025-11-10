<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Http\Controllers\ChatTicketController;
use App\Models\ChatTicket;

class ChatMessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'userID' => 'required|integer',
        ], [
            'message.required' => 'Pesan tidak boleh kosong.',
        ]);

        // 🔹 Panggil fungsi getOrCreateTicket() dari ChatTicketController
        $ticketController = new ChatTicketController();
        $ticket = $ticketController->getOrCreateTicket(
            $request->userID,
            $request->input('issueCategory'),
            $request->input('issueSubCategory')
        );

        // 🔹 Simpan pesan user ke tabel ChatMessage
        ChatMessage::create([
            'sender' => 'user',
            'messageText' => $request->message,
            'ticketID' => $ticket->ticketID, // ✅ ubah ke ticketID (bukan chatTicketID)
            'sentAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    // 🔹 Menampilkan halaman chat beserta semua pesan di tiket aktif
    public function index(Request $request)
    {
        $userID = auth()->id() ?? 1; // sementara pakai ID 1 jika belum login

        $ticket = ChatTicket::where('userID', $userID)
            ->where('status', 'open')
            ->latest()
            ->first();

        $messages = [];

        if ($ticket) {
            $messages = ChatMessage::where('ticketID', $ticket->ticketID)
                ->orderBy('sentAt', 'asc')
                ->get();
        }

        return view('chat', compact('messages', 'ticket', 'userID'));
    }
}
