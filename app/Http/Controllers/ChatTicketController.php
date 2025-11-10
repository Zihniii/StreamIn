<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatTicket;

class ChatTicketController extends Controller
{
    // Cari tiket aktif atau buat baru kalau belum ada
    public function getOrCreateTicket($userID, $issueCategory = null, $issueSubCategory = null)
    {
        // Cek apakah user punya tiket dengan status open
        $ticket = ChatTicket::where('userID', $userID)
            ->where('status', 'open')
            ->latest()
            ->first();

        // Kalau tidak ada tiket aktif, buat baru
        if (!$ticket) {
            $ticket = ChatTicket::create([
                'userID' => $userID,
                'issueCategory' => $issueCategory ?? 'General',
                'issueSubCategory' => $issueSubCategory ?? 'Other',
                'status' => 'open',
                'createdAt' => now(),
            ]);
        }

        return $ticket;
    }

    // ✅ Menutup tiket secara manual (misalnya saat kasus sudah selesai)
    public function close($id)
    {
        $ticket = ChatTicket::findOrFail($id);

        // Cek dulu biar gak error kalau udah closed
        if ($ticket->status !== 'closed') {
            $ticket->update(['status' => 'closed']);
        }

        return redirect()->back()->with('success', 'Tiket berhasil ditutup.');
    }
}
