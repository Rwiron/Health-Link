<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\FeedbackReply;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(10);
        return view('superadmin.feedback.index', compact('feedbacks'));
    }

    public function show($id)
    {
        $feedback = Feedback::with('replies')->findOrFail($id);
        return view('superadmin.feedback.show', compact('feedback'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create($request->all());
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function reply(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Store reply
        FeedbackReply::create([
            'feedback_id' => $feedback->id,
            'sender' => 'admin',
            'message' => $request->message,
        ]);

        // Mark feedback as inactive until the user responds again
        $feedback->update(['is_active' => false]);

        // Send email notification
        Mail::raw($request->message, function ($mail) use ($feedback) {
            $mail->to($feedback->email)
                ->subject("Reply to Your Feedback")
                ->from('admin@healthlink.com');
        });

        return redirect()->back()->with('success', 'Reply sent successfully.');
    }

    public function userReply(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Store user's reply
        FeedbackReply::create([
            'feedback_id' => $feedback->id,
            'sender' => 'user',
            'message' => $request->message,
        ]);

        // Reactivate feedback so admin can reply again
        $feedback->update(['is_active' => true]);

        return redirect()->back()->with('success', 'Your reply has been sent.');
    }
}