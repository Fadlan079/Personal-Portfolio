<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 1. Validate incoming data
        $validatedData = $request->validate([
            'method'  => 'required|in:email,wa',
            'type'    => 'required|string|in:project,collab,inquiry',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10',
            'sender'  => [
                'required',
                $request->method === 'wa' ? 'string' : 'email|max:255',
            ]
        ], [
            'sender.email' => 'The sender must be a valid email address.',
            'sender.required' => 'Please provide your email or WhatsApp number.'
        ]);

        // 2. Save directly to Database
        \App\Models\Contact::create($validatedData);

        // 3. Process action based on method
        if ($validatedData['method'] === 'email') {
            
            // Format data backward compatibility for the Mail class
            $mailData = $validatedData;
            $mailData['email'] = $validatedData['sender']; 

            Mail::to('fadlanfirdaus220@gmail.com')
                ->send(new ContactMail($mailData));

            return back()->with('success', 'Pesan berhasil dikirim via Email! Saya akan membalas sesegera mungkin.');

        } elseif ($validatedData['method'] === 'wa') {
            
            // Format WhatsApp Message
            $waNumber = '6282210732928';
            $text = "*New Request from Portfolio*\n\n"
                  . "*Type:* " . ucfirst($validatedData['type']) . "\n"
                  . "*Sender:* " . $validatedData['sender'] . "\n"
                  . "*Subject:* " . $validatedData['subject'] . "\n\n"
                  . "*Message:*\n" . $validatedData['message'];

            $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($text);

            return back()->with('success', 'Pesan siap dikirim! Membuka WhatsApp...')
                         ->with('wa_url', $waUrl);
        }
    }
}
