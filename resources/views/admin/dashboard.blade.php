@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Guests Card -->
    <a href="{{ route('admin.guests.index') }}" class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow border border-gray-100">
        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-users text-blue-500 text-2xl"></i>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['guests'] }}</p>
            <p class="text-sm text-gray-500 font-medium">Tamu Undangan</p>
        </div>
    </a>

    <!-- Wishes Card -->
    <a href="{{ route('admin.wishes.index') }}" class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow border border-gray-100">
        <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-heart text-pink-500 text-2xl"></i>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['wishes'] }}</p>
            <p class="text-sm text-gray-500 font-medium">Ucapan & Doa</p>
        </div>
    </a>

    <!-- Attendances Card -->
    <a href="{{ route('admin.attendances.index') }}" class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow border border-gray-100">
        <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['attendances'] }}</p>
            <p class="text-sm text-gray-500 font-medium">Konfirmasi Hadir</p>
        </div>
    </a>

    <!-- Gallery Card -->
    <a href="{{ route('admin.gallery.index') }}" class="bg-white rounded-2xl shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition-shadow border border-gray-100">
        <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-images text-yellow-500 text-2xl"></i>
        </div>
        <div>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['galleries'] }}</p>
            <p class="text-sm text-gray-500 font-medium">Foto Galeri</p>
        </div>
    </a>
</div>

<!-- Quick Links -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-yellow-400"></i> Aksi Cepat
        </h3>
        <div class="space-y-3">
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors text-blue-700 text-sm font-medium">
                <i class="fas fa-edit"></i> Edit Data Undangan
            </a>
            <a href="{{ route('admin.guests.create') }}" class="flex items-center gap-3 p-3 bg-green-50 hover:bg-green-100 rounded-xl transition-colors text-green-700 text-sm font-medium">
                <i class="fas fa-user-plus"></i> Tambah Tamu Baru
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 p-3 bg-yellow-50 hover:bg-yellow-100 rounded-xl transition-colors text-yellow-700 text-sm font-medium">
                <i class="fas fa-upload"></i> Upload Foto Galeri
            </a>
            <a href="{{ route('frontend.show', 'tamu') }}" target="_blank" class="flex items-center gap-3 p-3 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors text-purple-700 text-sm font-medium">
                <i class="fas fa-eye"></i> Pratinjau Undangan
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fas fa-link text-blue-400"></i> Contoh URL Undangan
        </h3>
        <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-600 font-mono break-all mb-3">
            {{ url('/undangan/{slug-tamu}') }}
        </div>
        <p class="text-xs text-gray-500">Ganti <code class="bg-gray-100 px-1 rounded">{slug-tamu}</code> dengan slug dari daftar tamu.</p>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-400">Contoh:</p>
            <a href="{{ url('/undangan/budi-santoso') }}" target="_blank" class="text-blue-500 text-sm hover:underline font-mono">{{ url('/undangan/budi-santoso') }}</a>
        </div>
    </div>
</div>
@endsection
