@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-10 observe-element delay-100">
    <h1 class="text-3xl font-bold tracking-widest uppercase">Kelola Album</h1>
    <a href="{{ route('admin.albums.create') }}" class="bg-white text-black px-6 py-2 text-xs font-bold tracking-widest uppercase hover:bg-[#cccccc] transition-colors cursor-hover">
        Tambah Album
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($albums as $album)
        <div class="bg-[#1c1c1c] border border-[#444444] p-6 flex flex-col justify-between observe-element delay-{{ ($loop->index % 5 + 1) * 100 }}">
            <div>
                <h3 class="text-xl font-medium tracking-widest uppercase mb-2">{{ $album->title }}</h3>
                <p class="text-sm text-[#cccccc] mb-6 line-clamp-2">{{ $album->description }}</p>
            </div>
            
            <div class="flex space-x-4 border-t border-[#444444] pt-4 mt-4">
                <a href="{{ route('admin.albums.edit', $album->id) }}" class="text-xs tracking-widest uppercase text-white hover:text-[#cccccc] transition-colors">Edit</a>
                <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs tracking-widest uppercase text-red-500 hover:text-red-400 transition-colors">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-[#cccccc] border border-[#444444] border-dashed">
            <p class="text-sm tracking-widest uppercase">Belum ada album</p>
        </div>
    @endforelse
</div>
@endsection
