@props(['judul' => null])

<div class="border border-slate-200 rounded-xl p-6 bg-white shadow-sm hover:shadow-md transition-shadow">
    @if ($judul)
        <h3 class="font-bold text-xl text-slate-800 mb-2 border-b border-slate-100 pb-2">
            {{ $judul }}
        </h3>
    @endif
    <div class="mt-2 text-slate-600">
        {{ $slot }}
    </div>
</div>
