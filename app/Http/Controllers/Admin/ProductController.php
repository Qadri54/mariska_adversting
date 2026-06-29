<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Service;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;



class ProductController extends Controller

{

    public function index(Request $request)

    {

        $query = Product::with('service')->orderBy('product_id', 'desc');



        if ($request->has('service_id') && $request->service_id != 'all') {

            $query->where('service_id', $request->service_id);

        }



        if ($request->has('search')) {

            $search = $request->search;

            $query->where('nama_produk', 'like', "%{$search}%");

        }



        $products = $query->paginate(20);

        $services = Service::all();



        return view('admin.products.index', compact('products', 'services'));

    }



    public function create()

    {

        $services = Service::all();

        return view('admin.products.create', compact('services'));

    }



    public function store(Request $request)

    {

        $validated = $request->validate([

            'service_id' => 'required|exists:services,service_id',

            'nama_produk' => 'required|string|max:255',

            'base_price' => 'required|numeric|min:0',

            'unit_type' => 'required|in:m2,box,pcs,unit,jasa',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

        ]);



        $imagePath = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = Str::slug($request->nama_produk) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $imagePath = $image->storeAs('products', $imageName, 'public');

        }



        Product::create([

            'service_id' => $request->service_id,

            'nama_produk' => $request->nama_produk,

            'base_price' => $request->base_price,

            'unit_type' => $request->unit_type,

            'description' => $request->description,

            'image_url' => $imagePath,

        ]);



        return redirect()

            ->route('admin.products.index')

            ->with('success', 'Produk berhasil ditambahkan!');

    }



    public function edit($id)

    {

        $product = Product::findOrFail($id);

        $services = Service::all();

        return view('admin.products.edit', compact('product', 'services'));

    }



    /**

     * Update produk - FIXED VERSION

     */

    public function update(Request $request, $id)

    {

        $product = Product::findOrFail($id);



        $validated = $request->validate([

            'service_id' => 'required|exists:services,service_id',

            'nama_produk' => 'required|string|max:255',

            'base_price' => 'required|numeric|min:0',

            'unit_type' => 'required|in:m2,box,pcs,unit,jasa',

            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

        ]);



        // Siapkan data untuk update

        $updateData = [

            'service_id' => $request->service_id,

            'nama_produk' => $request->nama_produk,

            'base_price' => $request->base_price,

            'unit_type' => $request->unit_type,

            'description' => $request->description,

        ];



        // Handle upload gambar baru

        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada

            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {

                Storage::disk('public')->delete($product->image_url);

            }



            $image = $request->file('image');

            $imageName = Str::slug($request->nama_produk) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $imagePath = $image->storeAs('products', $imageName, 'public');



            // TAMBAHKAN image_url ke array update

            $updateData['image_url'] = $imagePath;

        }



        // Update dengan semua data termasuk image_url

        $product->update($updateData);



        return redirect()

            ->route('admin.products.index')

            ->with('success', 'Produk berhasil diupdate!');

    }



    public function destroy($id)

    {

        $product = Product::findOrFail($id);



        $orderItemsCount = $product->orderItems()->count();



        if ($orderItemsCount > 0) {

            return back()->with('error',

                "Tidak dapat menghapus produk ini karena sudah ada {$orderItemsCount} pesanan terkait. Produk hanya bisa di-nonaktifkan, bukan dihapus."

            );

        }



        // Hapus gambar jika ada

        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {

            Storage::disk('public')->delete($product->image_url);

        }



        $product->delete();



        return redirect()

            ->route('admin.products.index')

            ->with('success', 'Produk berhasil dihapus!');

    }

}

