<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Jobs\SendMailJob;
use App\Models\User;

class SendEmailController extends Controller
{
    public function index()
    {
        return view('emails.kirim-email');
    }

    public function store(Request $request)
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Menambahkan data user ke dalam array data
        $data = [
            'subject' => 'Selamat Datang di Aplikasi Kami',
            'body' => 'Terima kasih telah bergabung, ' . $user->name . '. Berikut adalah detail akun Anda:',
            'user' => $user,
        ];

        dispatch(new SendMailJob($data));
        return redirect()->route('kirim-email')->with('success', 'Email berhasil dikirim');
    }
}