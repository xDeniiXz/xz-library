<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kategori::withCount('buku');

        if ($request->filled('search')) {
            $search = $request->get('search');

            $query->where('nama_kategori', 'like', "%$search%");
        }

        if ($request->filled('filter_buku')) {
            if ($request->get('filter_buku') === 'memiliki_buku') {
                $query->has('buku');
            } elseif ($request->get('filter_buku') === 'tanpa_buku') {
                $query->doesntHave('buku');
            }
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');
        $sortColumn = in_array($criteria, ['nama_kategori', 'id']) ? $criteria : 'id';

        $kategori = $query->orderBy($sortColumn, $sort)->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        Kategori::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => 'Kategori yang dipilih berhasil dihapus.']);
    }
}
