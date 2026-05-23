@props([
    'judul',
    'nilai' => 0,
    'ikon' => 'help-circle',
    'warna' => 'blue',
    'id' => null,
])

@php
    $colorClasses = [
        'blue' => 'bg-blue-50 text-blue-600',
        'orange' => 'bg-orange-50 text-orange-600',
        'red' => 'bg-red-50 text-red-600',
        'emerald' => 'bg-emerald-50 text-emerald-600',
    ];

    $selectedColor = $colorClasses[$warna] ?? $colorClasses['blue'];
@endphp

<div
    {{ $attributes->merge(['class' => 'bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4']) }}>
    <div class="p-3 {{ $selectedColor }} rounded-xl">
        <i data-lucide="{{ $ikon }}" class="w-6 h-6"></i>
    </div>
    <div>
        <p class="text-sm text-slate-500 font-medium">
            {{ $judul }}
        </p>
        <p class="text-2xl font-bold text-slate-900" id="{{ $id }}">
            {{ $nilai }}
        </p>
    </div>
</div>
