@extends('admin.layout')

@section('page-title', 'Konfirmasi Kehadiran')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-lg font-bold text-gray-700">Daftar Konfirmasi Hadir (RSVP)</h2>
        <p class="text-sm text-gray-500">Data tamu yang mengonfirmasi kehadiran.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Tamu</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Jumlah Orang</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                <tr class="border-b border-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $attendance->guest_name }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-bold text-xs">{{ $attendance->people_count }} Orang</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($attendance->status == 'Hadir')
                            <span class="text-green-600 font-semibold"><i class="fas fa-check-circle"></i> Hadir</span>
                        @elseif($attendance->status == 'Tidak Hadir')
                            <span class="text-red-600 font-semibold"><i class="fas fa-times-circle"></i> Tidak Hadir</span>
                        @else
                            <span class="text-yellow-500 font-semibold"><i class="fas fa-question-circle"></i> Masih Ragu</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Hapus konfirmasi ini?')">
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
                            <i class="fas fa-clipboard-list text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada konfirmasi kehadiran.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
