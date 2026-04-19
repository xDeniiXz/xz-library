<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;
use Maatwebsite\Excel\Facades\Excel;

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
            $criteria = $request->get('criteria', 'nama_kategori');

            if ($criteria === 'nama_kategori') {
                $query->where('nama_kategori', 'like', "%$search%");
            } elseif ($criteria === 'id') {
                $query->where('id', $search);
            } else {
                $query->where('nama_kategori', 'like', "%$search%")
                    ->orWhere('id', $search);
            }
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

        $kategori = $query->orderBy($sortColumn, $sort)->paginate(10)->appends(request()->query());
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

    public function export(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_string($ids)) {
            $ids = explode(',', $ids);
        }
        return Excel::download(new KategoriExport($ids), 'data_kategori_' . date('Ymd_His') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new KategoriImport, $request->file('file'));
            return back()->with('success', 'Data kategori berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
