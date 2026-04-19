<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use Maatwebsite\Excel\Facades\Excel;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $criteria = $request->get('criteria', 'name');

            $query->where(function ($q) use ($search, $criteria) {
                if ($criteria === 'name') {
                    $q->where('name', 'like', "%$search%");
                } elseif ($criteria === 'username') {
                    $q->where('username', 'like', "%$search%");
                } elseif ($criteria === 'email') {
                    $q->where('email', 'like', "%$search%");
                } elseif ($criteria === 'phone_number') {
                    $q->where('phone_number', 'like', "%$search%");
                } elseif ($criteria === 'address') {
                    $q->where('address', 'like', "%$search%");
                } else {
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('username', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone_number', 'like', "%$search%")
                        ->orWhere('address', 'like', "%$search%");
                }
            });
        }

        if ($request->filled('profil')) {
            if ($request->get('profil') === 'lengkap') {
                $query->whereNotNull('phone_number')
                    ->where('phone_number', '!=', '')
                    ->whereNotNull('address')
                    ->where('address', '!=', '');
            } elseif ($request->get('profil') === 'belum_lengkap') {
                $query->where(function ($q) {
                    $q->whereNull('phone_number')
                        ->orWhere('phone_number', '')
                        ->orWhereNull('address')
                        ->orWhere('address', '');
                });
            }
        }

        $sort = $request->get('sort', 'asc') === 'desc' ? 'desc' : 'asc';
        $criteria = $request->get('criteria', 'id');
        $allowedSortColumns = ['name', 'username', 'email', 'phone_number', 'address', 'id'];
        $sortColumn = in_array($criteria, $allowedSortColumns) ? $criteria : 'id';

        $anggota = $query->orderBy($sortColumn, $sort)->paginate(10)->appends(request()->query());
        return view('admin.anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'role' => 'student',
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $anggota)
    {
        if ($anggota->role !== 'student') {
            abort(403, 'Anda hanya dapat mengedit data siswa.');
        }
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $anggota)
    {
        if ($anggota->role !== 'student') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $anggota->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $anggota->id],
            'address' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string', 'max:20'],
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $anggota->update($data);

        return redirect()->route('admin.anggota.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $anggota)
    {
        if ($anggota->role !== 'student') {
            abort(403);
        }

        $anggota->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Siswa berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!$ids) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dipilih.']);
        }

        User::whereIn('id', $ids)->where('role', 'student')->delete();

        return response()->json(['success' => true, 'message' => 'Siswa yang dipilih berhasil dihapus.']);
    }

    public function export(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_string($ids)) {
            $ids = explode(',', $ids);
        }
        return Excel::download(new AnggotaExport($ids), 'data_anggota_' . date('Ymd_His') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new AnggotaImport, $request->file('file'));
            return back()->with('success', 'Data anggota berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
