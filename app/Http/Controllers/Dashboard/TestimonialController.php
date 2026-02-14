<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',
            'testimonial_text' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'show_on_frontend' => 'boolean',
        ]);

        $testimonial = new Testimonial();
        $testimonial->user_id = auth()->id();
        $testimonial->customer_name = $request->customer_name;
        $testimonial->customer_company = $request->customer_company;
        $testimonial->project_type = $request->project_type;
        $testimonial->testimonial_text = $request->testimonial_text;
        $testimonial->rating = $request->rating;
        $testimonial->show_on_frontend = $request->boolean('show_on_frontend', true);
        $testimonial->is_approved = false; // Requires admin approval

        // Handle customer image upload
        if ($request->hasFile('customer_image')) {
            $image = $request->file('customer_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('testimonials', $imageName, 'public');
            $testimonial->customer_image = $imagePath;
        }

        $testimonial->save();

        return redirect()
            ->route('dashboard')
            ->with('status', 'testimonial-created');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        // Check if user owns this testimonial
        if ($testimonial->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',
            'testimonial_text' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'show_on_frontend' => 'boolean',
        ]);

        $testimonial->customer_name = $request->customer_name;
        $testimonial->customer_company = $request->customer_company;
        $testimonial->project_type = $request->project_type;
        $testimonial->testimonial_text = $request->testimonial_text;
        $testimonial->rating = $request->rating;
        $testimonial->show_on_frontend = $request->boolean('show_on_frontend', true);

        // Handle customer image upload
        if ($request->hasFile('customer_image')) {
            // Delete old image if exists
            if ($testimonial->customer_image) {
                Storage::disk('public')->delete($testimonial->customer_image);
            }
            
            $image = $request->file('customer_image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('testimonials', $imageName, 'public');
            $testimonial->customer_image = $imagePath;
        }

        $testimonial->save();

        return redirect()
            ->route('dashboard')
            ->with('status', 'testimonial-updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Check if user owns this testimonial
        if ($testimonial->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($testimonial->customer_image) {
            Storage::disk('public')->delete($testimonial->customer_image);
        }

        $testimonial->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'testimonial-deleted');
    }
}
