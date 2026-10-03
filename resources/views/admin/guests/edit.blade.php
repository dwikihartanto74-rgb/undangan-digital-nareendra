@extends('admin.layout')

@section('page-title', 'Edit Tamu')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-xl mx-auto">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-700">Form Edit Tamu</h2>
        <a href="{{ route('admin.guests.index') }}" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.guests.update', $guest->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tamu Undangan</label>
            <input type="text" name="name" value="{{ old('name', $guest->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all bg-gray-50">
            <p class="text-xs text-gray-500 mt-2"><i class="fas fa-info-circle"></i> URL akan diperbarui secara otomatis ketika nama diubah.</p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-colors flex items-center gap-2">
                <i class="fas fa-save"></i> Update Data
            </button>
        </div>
    </form>
</div>
@endsection
