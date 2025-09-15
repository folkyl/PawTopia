<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FeedbackController extends Controller
{
    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log incoming request data for debugging
            \Log::info('Feedback submission attempt:', [
                'data' => $request->all(),
                'method' => $request->method(),
                'ajax' => $request->ajax()
            ]);

            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'message' => 'required|string|max:1000'
            ]);

            $feedback = Feedback::create([
                'rating' => $request->rating,
                'message' => $request->message
            ]);

            \Log::info('Feedback created successfully:', ['id' => $feedback->id]);

            // Return JSON response for AJAX requests
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Thank you for your feedback!']);
            }

            return redirect()->back()->with('success', 'Thank you for your feedback!');
            
        } catch (\Exception $e) {
            \Log::error('Feedback submission error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display all feedbacks for admin.
     */
    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    /**
     * Update the specified feedback.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
                'rating' => 'required|integer|min:1|max:5'
            ]);

            $feedback = Feedback::findOrFail($id);
            $feedback->update([
                'message' => $request->message,
                'rating' => $request->rating
            ]);

            return response()->json(['success' => true, 'message' => 'Feedback updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified feedback.
     */
    public function destroy($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();

            return response()->json(['success' => true, 'message' => 'Feedback deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
}
