<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class ManajemenKontakController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $kontaks = Kontak::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })->paginate(10);

        $kontaks->appends(['search' => $search]);
        return view('dashboard.manajemen-kontak.index', compact('kontaks', 'search'));
    }
}
