@extends('admin.layouts.app')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.albums.index') }}" class="text-xs tracking-widest uppercase text-[#cccccc] hover:text-white transition-colors border-b border-transparent hover:border-white pb-1">&larr; Kembali ke Daftar Album</a>
</div>

<h1 class="text-3xl font-bold tracking-widest uppercase mb-10">Edit Album</h1>

<form action="{{ route('admin.albums.update', $album->id) }}" method="POST" class="max-w-2xl bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
    @csrf
    @method('PUT')
    
    <div>
        <label for="title" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Nama Album *</label>
        <input type="text" id="title" name="title" value="{{ old('title', $album->title) }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
        @error('title') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="description" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Deskripsi Album</label>
        <textarea id="description" name="description" rows="4" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm resize-none">{{ old('description', $album->description) }}</textarea>
        @error('description') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="border-t border-[#444444] pt-6">
        <label class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-4">Pilih Foto untuk Album Ini</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
            @foreach($works as $work)
                <label class="relative group cursor-pointer border border-[#444444] overflow-hidden {{ $work->album_id == $album->id ? 'ring-2 ring-white' : '' }}">
                    <input type="checkbox" name="works[]" value="{{ $work->id }}" class="peer sr-only" {{ $work->album_id == $album->id ? 'checked' : '' }} onchange="this.parentElement.classList.toggle('ring-2'); this.parentElement.classList.toggle('ring-white');">
                    <img src="{{ $work->image_path }}" class="w-full h-24 object-cover opacity-60 peer-checked:opacity-100 transition-opacity">
                    <div class="absolute bottom-0 inset-x-0 bg-black/70 p-2 text-[9px] uppercase tracking-wider truncate">
                        {{ $work->title }}
                    </div>
                </label>
            @endforeach
        </div>
        @error('works') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="pt-4">
        <button type="submit" class="border border-white bg-white text-black px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300">
            Perbarui Album
        </button>
    </div>
</form>
@endsection
