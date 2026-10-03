@extends('admin.layout')

@section('page-title', 'Pengaturan Undangan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-lg font-bold text-gray-700">Form Pengaturan</h2>
        <p class="text-sm text-gray-500">Ubah detail undangan Aqiqah di sini.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Data Bayi -->
            <div class="space-y-4">
                <h3 class="font-bold text-blue-800 border-b pb-2 mb-4">Data Bayi</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Bayi</label>
                    <input type="text" name="baby_name" value="{{ old('baby_name', $setting->baby_name) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Panggilan</label>
                    <input type="text" name="baby_nickname" value="{{ old('baby_nickname', $setting->baby_nickname) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place', $setting->birth_place) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $setting->birth_date) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Anak Ke-</label>
                        <input type="number" name="birth_order" value="{{ old('birth_order', $setting->birth_order) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Berat (kg)</label>
                        <input type="number" step="0.01" name="weight" value="{{ old('weight', $setting->weight) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Panjang (cm)</label>
                        <input type="number" step="0.01" name="height" value="{{ old('height', $setting->height) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                    <input type="text" name="father_name" value="{{ old('father_name', $setting->father_name) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                    <input type="text" name="mother_name" value="{{ old('mother_name', $setting->mother_name) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
            </div>

            <!-- Data Acara & Media -->
            <div class="space-y-4">
                <h3 class="font-bold text-blue-800 border-b pb-2 mb-4">Data Acara & Media</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Acara</label>
                        <input type="date" name="event_date" value="{{ old('event_date', $setting->event_date) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Acara</label>
                        <input type="time" name="event_time" value="{{ old('event_time', $setting->event_time ? date('H:i', strtotime($setting->event_time)) : '') }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tempat</label>
                    <input type="text" name="venue" value="{{ old('venue', $setting->venue) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">{{ old('address', $setting->address) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Google Maps URL</label>
                    <input type="url" name="maps_url" value="{{ old('maps_url', $setting->maps_url) }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Countdown</label>
                    <input type="datetime-local" name="countdown_datetime" value="{{ old('countdown_datetime', $setting->countdown_datetime ? date('Y-m-d\TH:i', strtotime($setting->countdown_datetime)) : '') }}" class="w-full px-4 py-2 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 bg-gray-50">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 border-t pt-6">
            <!-- Media Uploads -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Cover</label>
                @if($setting->cover_image)
                    <img src="{{ asset('storage/' . $setting->cover_image) }}" class="h-32 object-cover rounded-xl mb-2">
                @endif
                <input type="file" name="cover_image" accept="image/*" class="w-full text-sm">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Bayi</label>
                @if($setting->baby_photo)
                    <img src="{{ asset('storage/' . $setting->baby_photo) }}" class="h-32 object-cover rounded-xl mb-2">
                @endif
                <input type="file" name="baby_photo" accept="image/*" class="w-full text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Musik Latar (MP3)</label>
                @if($setting->music_file)
                    <audio controls class="w-full h-10 mb-2"><source src="{{ asset('storage/' . $setting->music_file) }}" type="audio/mpeg"></audio>
                @endif
                <input type="file" name="music_file" accept="audio/mpeg" class="w-full text-sm">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl shadow-md transition-colors flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
