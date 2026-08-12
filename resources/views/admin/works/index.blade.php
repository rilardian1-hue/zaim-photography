@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-10 observe-element delay-100">
    <h1 class="text-3xl font-bold tracking-widest uppercase">Kelola Karya (Foto)</h1>
    <a href="{{ route('admin.works.create') }}" class="bg-white text-black px-6 py-2 text-xs font-bold tracking-widest uppercase hover:bg-[#cccccc] transition-colors cursor-hover">
        Tambah Karya
    </a>
</div>

<div class="bg-[#1c1c1c] border border-[#444444] overflow-x-auto observe-element delay-200">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-[#444444] text-[10px] tracking-[0.2em] uppercase text-[#cccccc]">
                <th class="p-4 font-normal">Foto</th>
                <th class="p-4 font-normal">Judul & Album</th>
                <th class="p-4 font-normal">Kategori</th>
                <th class="p-4 font-normal">Featured</th>
                <th class="p-4 font-normal text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($works as $work)
                <tr class="border-b border-[#444444] hover:bg-[#2a2a2a] transition-colors">
                    <td class="p-4">
                        <img src="{{ $work->image_path }}" alt="thumb" class="w-16 h-16 object-cover border border-[#444444]">
                    </td>
                    <td class="p-4">
                        <div class="font-medium tracking-widest uppercase">{{ $work->title }}</div>
                        <div class="text-[#cccccc] text-xs mt-1">{{ $work->album ? $work->album->title : 'Tanpa Album' }}</div>
                    </td>
                    <td class="p-4 uppercase text-[10px] tracking-widest text-[#cccccc]">{{ $work->category }}</td>
                    <td class="p-4">
                        @if($work->is_featured)
                            <span class="border border-white px-2 py-1 text-[10px] uppercase tracking-widest text-white">Ya</span>
                        @else
                            <span class="text-[#444444] text-[10px] uppercase tracking-widest">Tidak</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.works.edit', $work->id) }}" class="text-xs tracking-widest uppercase text-white hover:text-[#cccccc] transition-colors">Edit</a>
                            <form action="{{ route('admin.works.destroy', $work->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs tracking-widest uppercase text-red-500 hover:text-red-400 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-[#cccccc] text-xs uppercase tracking-widest">Belum ada karya</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $works->links() }}
</div>
@endsection
