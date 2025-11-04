<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatTicket;
use Illuminate\Support\Facades\Storage;

class ChatMessageController extends Controller
{
    public function KirimPesan(Request $request)
    {
        // 1️⃣ Validasi pesan dan lampiran
        $this->ValidasiPesan($request);
        if ($request->hasFile('lampiran')) {
            $this->ValidasiLampiran($request);
        }

        // 2️⃣ Simpan pesan ke database
        $pesan = $this->SimpanPesan($request);

        // 3️⃣ Teruskan pesan ke admin / sistem notifikasi
        $this->TeruskanPesan($pesan);

        return response()->json([
            'message' => 'Pesan berhasil dikirim',
            'data' => $pesan
        ], 201);
    }

    protected function ValidasiPesan($request)
    {
        $request->validate([
            'ticket_id' => 'required|integer|exists:chat_tickets,id',
            'pesan' => 'required|string'
        ]);
    }

    protected function ValidasiLampiran($request)
    {
        $request->validate([
            'lampiran' => 'file|max:2048|mimes:jpg,jpeg,png,pdf,docx'
        ]);
    }

    protected function SimpanPesan($request)
    {
        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_chat', 'public');
        }

        return ChatMessage::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => $request->user_id,
            'pesan' => $request->pesan,
            'lampiran' => $lampiranPath,
        ]);
    }

    protected function TeruskanPesan($pesan)
    {
        // Bisa diarahkan ke notifikasi admin, misalnya
        \Log::info('Pesan diteruskan ke admin', ['pesan_id' => $pesan->id]);
    }
}
