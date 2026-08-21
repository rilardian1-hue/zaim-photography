@extends('admin.layouts.app')

@section('content')
<div class="mb-10">
    <a href="{{ route('admin.albums.index') }}" class="text-xs tracking-widest uppercase text-[#cccccc] hover:text-white transition-colors border-b border-transparent hover:border-white pb-1">&larr; Kembali ke Daftar Album</a>
</div>

<h1 class="text-3xl font-bold tracking-widest uppercase mb-10">Tambah Album Baru</h1>

<form action="{{ route('admin.albums.store') }}" method="POST" class="max-w-2xl bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
    @csrf
    
    <div>
        <label for="title" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Nama Album *</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
        @error('title') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <div class="flex justify-between items-center mb-2">
            <label for="description" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc]">Deskripsi Album</label>
            <button type="button" id="btn-generate-ai" class="text-[10px] tracking-[0.1em] uppercase text-[#FFA800] border border-[#FFA800] px-3 py-1 hover:bg-[#FFA800] hover:text-black transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>
                Generate with AI
            </button>
        </div>
        <textarea id="description" name="description" rows="4" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm resize-none">{{ old('description') }}</textarea>
        @error('description') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="pt-4">
        <button type="submit" class="border border-white bg-white text-black px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300">
            Simpan Album
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnGenerate = document.getElementById('btn-generate-ai');
    
    btnGenerate.addEventListener('click', async function() {
        const title = document.getElementById('title').value;
        if (!title) {
            alert('Tulis nama album dulu ya bro!');
            document.getElementById('title').focus();
            return;
        }
        
        const originalContent = this.innerHTML;
        this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="animate-spin"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg> Generating...';
        this.disabled = true;
        this.classList.add('opacity-50', 'cursor-not-allowed');
        
        try {
            const response = await fetch('{{ route("admin.albums.generate-description") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ title: title })
            });
            
            const data = await response.json();
            if (data.success) {
                document.getElementById('description').value = data.description;
            } else {
                alert('Gagal: ' + data.message);
            }
        } catch (e) {
            alert('Terjadi kesalahan koneksi saat menghubungi server.');
        } finally {
            this.innerHTML = originalContent;
            this.disabled = false;
            this.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    });
});
</script>
@endsection
