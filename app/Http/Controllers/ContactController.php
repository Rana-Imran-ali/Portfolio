<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberVerification;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    /**
     * Handle a contact form submission.
     * (Production: queue a contact email to admin)
     */
    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // TODO: dispatch a ContactMailJob or Mail::to(admin)->send(new ContactMessage(...))

        return back()->with('success', 'Your message has been sent successfully!');
    }

    /**
     * Handle a new subscription request.
     * Generates a unique token and sends a verification email.
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email|max:255',
        ]);

        // Generate a secure token
        $token = Str::random(64);

        Subscriber::create([
            'email'              => $request->email,
            'verification_token' => $token,
            'is_verified'        => false,
        ]);

        // Build verification URL and queue the email
        $verificationUrl = route('subscribe.verify', ['token' => $token]);
        Mail::to($request->email)->queue(new SubscriberVerification($verificationUrl));

        return back()->with('success', 'Thank you! Please check your email to confirm your subscription.');
    }

    /**
     * Verify a subscriber using the token from the link in the email.
     */
    public function verify(string $token)
    {
        $subscriber = Subscriber::where('verification_token', $token)->firstOrFail();

        if ($subscriber->is_verified) {
            return redirect()->route('contact')->with('success', 'Your email is already verified.');
        }

        $subscriber->update([
            'is_verified'        => true,
            'email_verified_at'  => now(),
            'verification_token' => null, // invalidate token after use
        ]);

        return redirect()->route('contact')->with('success', 'Email verified! You are now subscribed.');
    }
}
