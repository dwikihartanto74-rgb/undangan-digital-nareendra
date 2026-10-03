@extends('admin.layout')

@section('page-title', 'Galeri Foto')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Upload -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-700">Upload Foto Baru</h2>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Foto (Max 2MB)</label>
                    <input type="file" name="image" accept="image/*" required class="w-full text-sm border p-2 rounded-xl">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Caption (Opsional)</label>
                    <input type="text" name="caption" class="w-full px-4 py-2 rounded-xl border border-gray-200 bg-gray-50">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-colors flex justify-center items-center gap-2">
                    <i class="fas fa-upload"></i> Upload Foto
                </button>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Daftar Foto Galeri</h2>
            
            @if($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($galleries as $photo)
                        <div class="relative group rounded-xl overflow-hidden shadow-sm border border-gray-100 aspect-square">
                            <img src="{{ asset('storage/' . $photo->image) }}" class="w-full h-full object-cover">
                            
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2">
                                @if($photo->caption)
                                    <p class="text-white text-xs font-semibold px-2 text-center">{{ $photo->caption }}</p>
                                @endif
                                <form action="{{ route('admin.gallery.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-images text-4xl mb-3 text-gray-300"></i>
                    <p>Belum ada foto galeri yang diupload.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
