@extends('admin.layout')

@section('page-title', 'Data Tamu Undangan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-gray-700">Daftar Tamu</h2>
            <p class="text-sm text-gray-500">Kelola daftar tamu undangan dan dapatkan URL khusus.</p>
        </div>
        <a href="{{ route('admin.guests.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl shadow transition-colors flex items-center gap-2 text-sm">
            <i class="fas fa-plus"></i> Tambah Tamu
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Tamu</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">URL Undangan</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guests as $guest)
                <tr class="border-b border-gray-50 hover:bg-blue-50/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $guest->name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <input type="text" readonly value="{{ url('/undangan/' . $guest->slug) }}" class="bg-gray-100 px-3 py-1.5 rounded-lg border border-gray-200 text-xs w-64 text-gray-500 focus:outline-none" id="url-{{ $guest->id }}">
                            <a href="{{ url('/undangan/' . $guest->slug) }}" target="_blank" class="text-blue-500 hover:text-blue-700" title="Buka"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.guests.edit', $guest->id) }}" class="w-8 h-8 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-200 transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tamu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-200 transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-users-slash text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada data tamu.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
