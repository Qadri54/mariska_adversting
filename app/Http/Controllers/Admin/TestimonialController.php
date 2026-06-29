<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        // Pastikan folder view nanti sesuai dengan ini: admin.testimonials.index
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Buat inisial otomatis (misal: Budi Santoso -> BS)
        $initial = '';
        $words = explode(' ', $request->name);
        if (count($words) >= 1) {
            $initial .= strtoupper(substr($words[0], 0, 1));
        }
        if (count($words) >= 2) {
            $initial .= strtoupper(substr($words[1], 0, 1));
        }

        Testimonial::create([
            'name' => $request->name,
            'role' => $request->role,
            'content' => $request->content,
            'rating' => $request->rating,
            'initial' => $initial
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $initial = '';
        $words = explode(' ', $request->name);
        if (count($words) >= 1) {
            $initial .= strtoupper(substr($words[0], 0, 1));
        }
        if (count($words) >= 2) {
            $initial .= strtoupper(substr($words[1], 0, 1));
        }

        $testimonial->update([
            'name' => $request->name,
            'role' => $request->role,
            'content' => $request->content,
            'rating' => $request->rating,
            'initial' => $initial
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diupdate!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni dihapus!');
    }
}