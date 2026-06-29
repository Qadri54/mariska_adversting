<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SphHeader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// Menggunakan pemanggilan Facade PDF yang direkomendasikan DomPDF terbaru
use Barryvdh\DomPDF\Facade\Pdf; 

class SPHController extends Controller
{
    public function index(Request $request)
    {
        $query = SphHeader::with('user')->orderBy('sph_date', 'desc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('sph_number', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%");
            });
        }

        if ($request->has('month') && $request->has('year')) {
            $query->whereMonth('sph_date', $request->month)
                  ->whereYear('sph_date', $request->year);
        }

        $sphList = $query->paginate(15);
        return view('admin.sph.index', compact('sphList'));
    }

    public function create()
    {
        $lastSph = SphHeader::whereYear('sph_date', now()->year)->orderBy('sph_id', 'desc')->first();

        if ($lastSph) {
            $lastNumber = intval(substr($lastSph->sph_number, -3));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        $sphNumber = 'SPH/' . now()->year . '/' . $newNumber;
        return view('admin.sph.create', compact('sphNumber'));
    }

    // METHOD STORE (SIMPAN)
    public function store(Request $request)
    {
        $request->validate([
            'sph_number' => 'required|unique:sph_headers,sph_number',
            'sph_date' => 'required|date',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'rincian_image' => 'required|image|max:2048',
            'design_image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $imagePath = $request->file('rincian_image')->store('sph_images', 'public');

            $designPath = null;
            if ($request->hasFile('design_image')) {
                $designPath = $request->file('design_image')->store('sph_images', 'public');
            }

            $sph = SphHeader::create([
                'sph_number' => $request->sph_number,
                'sph_date' => $request->sph_date,
                'client_name' => $request->client_name,
                'client_up' => $request->client_up,
                'job_title' => $request->job_title,
                'user_id' => Auth::id(),
                'rincian_image' => $imagePath,
                'design_image' => $designPath,

                'total_modal' => 0,
                'unit_multiplier' => 1,
                'total_biaya' => 0,
                'ppn_amount' => 0,
                'pph_amount' => 0,
                'grand_total' => 0,

                'terms_waktu' => $request->terms_waktu,
                'terms_pembayaran' => $request->terms_pembayaran,
            ]);

            DB::commit();

            return redirect()->route('admin.sph.show', $sph->sph_id)->with('success', 'SPH berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $sph = SphHeader::with('user')->findOrFail($id);
        return view('admin.sph.show', compact('sph'));
    }

    public function edit($id)
    {
        $sph = SphHeader::findOrFail($id);
        return view('admin.sph.edit', compact('sph'));
    }

    // METHOD UPDATE (EDIT)
    public function update(Request $request, $id)
    {
        $sph = SphHeader::findOrFail($id);

        $request->validate([
            'sph_date' => 'required|date',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'rincian_image' => 'nullable|image|max:2048',
            'design_image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Cek upload gambar baru (jika ada, timpa yang lama)
            $imagePath = $sph->rincian_image;
            if ($request->hasFile('rincian_image')) {
                $imagePath = $request->file('rincian_image')->store('sph_images', 'public');
            }

            $designPath = $sph->design_image;
            if ($request->hasFile('design_image')) {
                $designPath = $request->file('design_image')->store('sph_images', 'public');
            }

            $sph->update([
                'sph_date' => $request->sph_date,
                'client_name' => $request->client_name,
                'client_up' => $request->client_up,
                'job_title' => $request->job_title,
                'rincian_image' => $imagePath,
                'design_image' => $designPath,

                // Tetap 0
                'grand_total' => 0,

                'terms_waktu' => $request->terms_waktu,
                'terms_pembayaran' => $request->terms_pembayaran,
            ]);

            DB::commit();
            return redirect()->route('admin.sph.show', $sph->sph_id)->with('success', 'SPH berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $sph = SphHeader::findOrFail($id);
        try {
            $sph->delete();
            return redirect()->route('admin.sph.index')->with('success', 'SPH berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    // METHOD CETAK PDF 
    public function print($id)
    {
        $sph = SphHeader::with('user')->findOrFail($id);
        
        // Memastikan isHtml5ParserEnabled dan isRemoteEnabled aktif agar gambar/desain terbaca
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                  ->loadView('admin.sph.print', compact('sph'))
                  ->setPaper('a4', 'portrait');
                  
        // Mencegah error nama file dengan mengganti tanda '/' menjadi '-'
        $fileName = str_replace('/', '-', $sph->sph_number);
        
        return $pdf->download('SPH-' . $fileName . '.pdf');
    }

    public function duplicate($id)
    {
        $oldSph = SphHeader::findOrFail($id);
        $lastSph = SphHeader::whereYear('sph_date', now()->year)->orderBy('sph_id', 'desc')->first();

        $lastNumber = $lastSph ? intval(substr($lastSph->sph_number, -3)) : 0;
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $sphNumber = 'SPH/' . now()->year . '/' . $newNumber;

        return view('admin.sph.create', [
            'sphNumber' => $sphNumber,
            'oldSph' => $oldSph
        ]);
    }
}