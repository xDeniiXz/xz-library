<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\BukuExport;
use App\Imports\BukuImport;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'judul');

            $query->where(function ($q) use ($search, $criteria) {
                if ($criteria === 'judul') {
                    $q->where('judul', 'like', "%$search%");
                } elseif ($criteria === 'penulis') {
                    $q->where('penulis', 'like', "%$search%");
                } elseif ($criteria === 'penerbit') {
                    $q->where('penerbit', 'like', "%$search%");
                } elseif ($criteria === 'isbn') {
                    $q->where('isbn', 'like', "%$search%");
                } elseif ($criteria === 'tahun_terbit') {
                    $q->where('tahun_terbit', $search);
                } else {
                    $q->where('judul', 'like', "%$search%")
                        ->orWhere('penulis', 'like', "%$search%")
                        ->orWhere('penerbit', 'like', "%$search%")
                        ->orWhere('isbn', 'like', "%$search%");
                }
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->get('kategori_id'));
        }

        if ($request->filled('stok')) {
            if ($request->get('stok') === 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->get('stok') === 'habis') {
                $query->where('stok', '<=', 0);
            }
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');
        $allowedSortColumns = ['judul', 'penulis', 'penerbit', 'isbn', 'tahun_terbit', 'id'];
        $sortColumn = in_array($criteria, $allowedSortColumns) ? $criteria : 'id';

        $buku = $query->orderBy($sortColumn, $sort)->paginate(10)->appends(request()->query());
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();

        return view('admin.buku.index', compact('buku', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('admin.buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:buku,judul',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:buku,isbn',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ], [
            'judul.unique' => 'Judul buku sudah terdaftar dalam sistem.',
            'isbn.unique' => 'ISBN buku sudah terdaftar dalam sistem.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'cover.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('buku/cover', 'public');
        }

        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('admin.buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:buku,judul,' . $buku->id,
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:buku,isbn,' . $buku->id,
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ], [
            'judul.unique' => 'Judul buku sudah terdaftar dalam sistem.',
            'isbn.unique' => 'ISBN buku sudah terdaftar dalam sistem.',
            'cover.image' => 'File harus berupa gambar.',
            'cover.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'cover.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('buku/cover', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }
        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        $buku = Buku::whereIn('id', $ids)->get();
        foreach ($buku as $item) {
            if ($item->cover) {
                Storage::disk('public')->delete($item->cover);
            }
            $item->delete();
        }

        return response()->json(['success' => true, 'message' => 'Buku yang dipilih berhasil dihapus.']);
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_string($ids)) {
            $ids = explode(',', $ids);
        }
        return Excel::download(new BukuExport($ids), 'data_buku_' . date('Ymd_His') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new BukuImport, $request->file('file'));
            return back()->with('success', 'Data buku berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
