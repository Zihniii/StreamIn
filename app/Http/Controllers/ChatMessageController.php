<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Http\Controllers\ChatTicketController;
use App\Models\ChatTicket;

class ChatMessageController extends Controller
{

    // ==========================
    //   TEXT MESSAGE - auliya 16/11/2025
    // ==========================
    public function sendTextMessage(Request $request)
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

        // Setelah simpan pesan user
        ChatMessage::create([
            'sender' => 'cs',
            'messageText' => 'I understand. Could you please provide detail information about your problems?',
            'ticketID' => $ticket->ticketID,
            'sentAt' => now(),
        ]);


        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    // ==========================
    //   PAGE CHAT - auliya 16/11/2025
    // ==========================
    // 🔹 Menampilkan halaman chat beserta semua pesan di tiket aktif
    public function showChatPage(Request $request)
    {
        $userID = 1; // contoh hardcode user sementara
        $ticket = ChatTicket::where('userID', $userID)
                    ->where('status', 'open')
                    ->orderBy('createdAt', 'desc')
                    ->first();

        if (!$ticket) {
            return redirect()->route('chat.ticket.create');
        }

        // Ambil pesan2
        $messages = ChatMessage::where('ticketID', $ticket->ticketID)->get();

        // Jika tidak ada pesan → kirim auto message dari CS
        if ($messages->count() == 0) {

            ChatMessage::create([
                'sender' => 'cs',
                'messageText' => 'How can I help you?',
                'attachment' => null,
                'sentAt' => now(),
                'ticketID' => $ticket->ticketID
            ]);

            // reload supaya pesan muncul
            return redirect()->route('chat.index');
        }

        return view('chatcs.chat', compact('messages', 'userID', 'ticket'));
    }


    // ==========================
    //   PAGE FOTO - auliya 16/11/2025
    // ==========================
    public function photoPage()
    {
        $userID = auth()->id() ?? 1;

        return view('chatcs.chatphoto', compact('userID'));
    }


    // ==========================
    //   SEND FOTO - auliya 16/11/2025
    // ==========================
    public function sendPhoto(Request $request)
    {
        $request->validate([
            'attachment' => 'required|image|max:2048',
            'userID' => 'required|integer'
        ]);

        $ticketController = new ChatTicketController();
        $ticket = $ticketController->getOrCreateTicket(
            $request->userID,
            null,
            null
        );

        $filename = time().'_'.$request->attachment->getClientOriginalName();
        $request->attachment->move(public_path('uploads'), $filename);

        ChatMessage::create([
            'sender' => 'user',
            'messageText' => '',
            'attachment' => $filename,
            'ticketID' => $ticket->ticketID,
            'sentAt' => now(),
        ]);

        return redirect()->route('chat.index');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'attachment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'userID' => 'required|integer'
        ]);

        // Ambil / buat tiket
        $ticketController = new ChatTicketController();
        $ticket = $ticketController->getOrCreateTicket(
            $request->userID,
            $request->input('issueCategory'),
            $request->input('issueSubCategory')
        );

        // Simpan file
        $filename = time() . '_' . $request->file('attachment')->getClientOriginalName();
        $request->file('attachment')->move(public_path('uploads'), $filename);

        // Simpan pesan berupa gambar
        ChatMessage::create([
            'sender' => 'user',
            'messageText' => null,
            'attachment' => $filename,
            'ticketID' => $ticket->ticketID,
            'sentAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil dikirim!');
    }

}
