@extends('admin.layout')

@section('page-title', 'Ucapan & Doa')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-lg font-bold text-gray-700">Daftar Ucapan</h2>
        <p class="text-sm text-gray-500">Ucapan dan doa dari para tamu undangan.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Tamu</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Ucapan / Doa</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Waktu</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($wishes as $wish)
                <tr class="border-b border-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $wish->guest_name }}</td>
                    <td class="px-6 py-4">
                        <p class="bg-gray-50 p-3 rounded-xl italic border border-gray-100">"{{ $wish->message }}"</p>
                    </td>
                    <td class="px-6 py-4 text-xs">{{ $wish->created_at->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.wishes.destroy', $wish->id) }}" method="POST" onsubmit="return confirm('Hapus ucapan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-200 transition-colors ml-auto">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-comment-slash text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada ucapan yang masuk.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
