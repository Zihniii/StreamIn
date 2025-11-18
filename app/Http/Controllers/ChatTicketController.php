<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatTicket;

class ChatTicketController extends Controller
{
    // ======================================
    //  CARI TIKET OPEN ATAU BUAT BARU
    // ======================================
    public function getOrCreateTicket($userID, $issueCategory = null, $issueSubCategory = null)
    {
        // Cari tiket open milik user
        $ticket = ChatTicket::where('userID', $userID)
            ->where('status', 'open')
            ->orderBy('createdAt', 'desc') // GANTI created_at → createdAt
            ->first();


        // Kalau tidak ada tiket open = buat baru
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

    // ======================================
    //  TUTUP TIKET
    // ======================================
    public function close($id)
    {
        $ticket = ChatTicket::findOrFail($id);

        if ($ticket->status !== 'closed') {
            $ticket->update(['status' => 'closed']);
        }

        return redirect()->back()->with('success', 'Tiket berhasil ditutup.');
    }
}
