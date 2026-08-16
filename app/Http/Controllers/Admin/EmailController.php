<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class EmailController extends Controller
{
    public function create()
    {
        $usuarios = User::orderBy('name')->get(['id', 'name', 'email']);

        return view('admin.emails.create', compact('usuarios'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        $destinatario = User::findOrFail($validated['user_id']);

        Mail::to($destinatario->email)->send(
            new AdminUserMail($validated['subject'], $validated['body'])
        );

        return redirect()
            ->route('admin.emails.create')
            ->with('success', "E-mail enviado para {$destinatario->name}.");
    }
}