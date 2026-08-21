@extends('admin.layouts.app')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.works.index') }}" class="text-xs tracking-widest uppercase text-[#cccccc] hover:text-white transition-colors border-b border-transparent hover:border-white pb-1">&larr; Kembali ke Daftar Karya</a>
</div>

<h1 class="text-3xl font-bold tracking-widest uppercase mb-10">Unggah Karya Baru</h1>

<form action="{{ route('admin.works.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="title" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Judul Foto *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
            @error('title') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="category" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Kategori / Tag *</label>
            <input type="text" id="category" name="category" list="category-list" value="{{ old('category') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm uppercase tracking-widest" placeholder="Ketik atau pilih tag...">
            <datalist id="category-list">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}"></option>
                @endforeach
            </datalist>
            @error('category') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="album_id" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Pilih Album (Opsional)</label>
            <select id="album_id" name="album_id" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm uppercase tracking-widest">
                <option value="">-- Tanpa Album --</option>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->title }}</option>
                @endforeach
            </select>
            @error('album_id') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shooting_date" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Tanggal Pemotretan</label>
            <input type="date" id="shooting_date" name="shooting_date" value="{{ old('shooting_date') }}" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm [color-scheme:dark]">
            @error('shooting_date') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label for="image" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Unggah File Foto (JPG/PNG/WEBP, Max 10MB)</label>
        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm mb-3">
        
        <div class="text-center text-xs text-[#888888] font-bold uppercase tracking-widest my-2">- ATAU -</div>

        <label for="image_url" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Tempel Link / URL Direct Gambar (Opsional)</label>
        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://..." class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm mb-4">
        
        @error('image') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
        @error('image_url') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror

        <div id="preview-container" class="hidden">
            <div class="text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Pratinjau Foto:</div>
            <img id="image-preview" src="" class="w-32 h-32 object-cover border border-[#444444]">
        </div>
    </div>

    <div>
        <label for="description" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Keterangan / Cerita Foto</label>
        <textarea id="description" name="description" rows="3" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm resize-none">{{ old('description') }}</textarea>
        @error('description') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center space-x-3 pt-2">
        <input type="checkbox" id="is_featured" name="is_featured" value="1" class="w-4 h-4 bg-[#0a0a0a] border-[#444444]">
        <label for="is_featured" class="text-sm tracking-widest uppercase text-[#cccccc]">Jadikan Featured (Tampil di Home)</label>
    </div>

    <div class="pt-6 border-t border-[#444444]">
        <button type="submit" class="border border-white bg-white text-black px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300">
            Unggah Karya
        </button>
    </div>
</form>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('image_url').value = '';
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview-container').classList.add('hidden');
        }
    });

    document.getElementById('image_url').addEventListener('input', function(e) {
        if (e.target.value.trim() !== '') {
            document.getElementById('image').value = '';
            document.getElementById('image-preview').src = e.target.value;
            document.getElementById('preview-container').classList.remove('hidden');
        }
    });
</script>
@endsection
