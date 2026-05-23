<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferensiController extends Controller
{
    public function index(Request $request)
    {
        $currentTheme = $request->cookie('libmate_theme', 'system');
        $currentFontSize = $request->cookie('libmate_font', 'medium');

        return view('preferensi', compact('currentTheme', 'currentFontSize'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark,system',
            'font_size' => 'required|in:small,medium,large',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil disimpan! '
        ]);
    }
}
