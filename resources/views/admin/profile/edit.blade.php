@extends('admin.layouts.app')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-4">
    <div>
        <h1 class="text-3xl font-bold tracking-widest uppercase mb-2">Edit Profil Fotografer</h1>
        <p class="text-sm text-[#cccccc] tracking-wider">Kelola data identitas, biografi, pengalaman, dan foto profil yang tampil di website.</p>
    </div>
    <div>
        <a href="{{ route('about.index') }}" target="_blank" class="inline-flex items-center space-x-2 border border-[#444444] px-4 py-2 text-xs font-semibold tracking-widest uppercase hover:border-white hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            <span>Lihat Halaman Tentang</span>
        </a>
    </div>
</div>

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- Section 1: Foto Profil -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-8">
        <h2 class="text-lg font-bold tracking-[0.2em] uppercase mb-6 text-white flex items-center space-x-3 border-b border-[#333333] pb-4">
            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>1. Foto Profil Fotografer</span>
        </h2>

        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Current / Live Preview Circle -->
            <div class="flex flex-col items-center flex-shrink-0">
                <div class="w-36 h-36 md:w-44 md:h-44 rounded-full border-2 border-white/40 p-1 relative overflow-hidden group shadow-xl">
                    <img id="avatar-preview" src="{{ $about->profile_image ?? 'https://picsum.photos/seed/zaim/400/400' }}" alt="{{ $about->full_name }}" class="w-full h-full object-cover rounded-full">
                </div>
                <span class="text-[10px] tracking-widest uppercase text-[#cccccc] mt-3">Pratinjau Foto</span>
            </div>

            <!-- Upload Inputs -->
            <div class="flex-1 w-full space-y-5">
                <div>
                    <label for="image" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Unggah Foto Baru (JPG, PNG, WEBP - Maks. 10MB)</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                    @error('image') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="text-center text-xs text-[#706f6c] font-bold uppercase tracking-widest my-1">- ATAU -</div>

                <div>
                    <label for="image_url" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Gunakan Link / Direct URL Foto</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://contoh.com/foto-zaim.jpg" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm placeholder-[#444444]">
                    @error('image_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <p class="text-xs text-[#888888] leading-relaxed">
                    Tips: Foto akan ditampilkan dalam format lingkaran di halaman Tentang Saya dan Avatar Navbar. Gunakan foto dengan rasio 1:1 (persegi) untuk hasil terbaik.
                </p>
            </div>
        </div>
    </div>

    <!-- Section 2: Identitas & Judul Header -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
        <h2 class="text-lg font-bold tracking-[0.2em] uppercase text-white flex items-center space-x-3 border-b border-[#333333] pb-4">
            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span>2. Identitas & Judul Tampilan</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="title" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Judul Utama Halaman (Cth: SANG FOTOGRAFER) *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $about->title ?? 'Sang Fotografer') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="badge_text" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Teks Latar / Watermark (Cth: TENTANG)</label>
                <input type="text" id="badge_text" name="badge_text" value="{{ old('badge_text', $about->badge_text ?? 'TENTANG') }}" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm uppercase">
                @error('badge_text') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="full_name" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Nama Fotografer (Cth: ZAIM) *</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $about->full_name) }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                @error('full_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="school" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Asal Sekolah / Profesi / Subjudul (Cth: SMK KARTINI BATAM) *</label>
                <input type="text" id="school" name="school" value="{{ old('school', $about->school) }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                @error('school') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Section 3: Deskripsi & Pengalaman -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
        <h2 class="text-lg font-bold tracking-[0.2em] uppercase text-white flex items-center space-x-3 border-b border-[#333333] pb-4">
            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            <span>3. Biografi & Pengalaman / Prestasi</span>
        </h2>

        <div>
            <label for="bio" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Biografi / Cerita Lengkap *</label>
            <textarea id="bio" name="bio" rows="5" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm leading-relaxed">{{ old('bio', $about->bio) }}</textarea>
            <p class="text-xs text-[#706f6c] mt-1">Teks narasi utama yang menceritakan latar belakang, ketertarikan pada fotografi, dll.</p>
            @error('bio') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="experience" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Kutipan Pengalaman / Prestasi</label>
            <textarea id="experience" name="experience" rows="3" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm leading-relaxed" placeholder="Cth: Menjadi fotografer resmi acara tahunan SMK Kartini Batam, Juara 2 Lomba Fotografi Pelajar Kepri 2024.">{{ old('experience', $about->experience) }}</textarea>
            <p class="text-xs text-[#706f6c] mt-1">Kutipan khusus yang ditampilkan dengan garis vertikal beraksen di samping teks.</p>
            @error('experience') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <!-- Section 4: Media Sosial -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
        <h2 class="text-lg font-bold tracking-[0.2em] uppercase text-white flex items-center space-x-3 border-b border-[#333333] pb-4">
            <svg class="w-5 h-5 text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            <span>4. Tautan Media Sosial</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="instagram_url" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Instagram URL</label>
                <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $about->instagram_url) }}" placeholder="https://instagram.com/zaim" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm placeholder-[#444444]">
                @error('instagram_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tiktok_url" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">TikTok URL</label>
                <input type="url" id="tiktok_url" name="tiktok_url" value="{{ old('tiktok_url', $about->tiktok_url) }}" placeholder="https://tiktok.com/@zaim" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm placeholder-[#444444]">
                @error('tiktok_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="flickr_url" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Flickr / Website Portofolio</label>
                <input type="url" id="flickr_url" name="flickr_url" value="{{ old('flickr_url', $about->flickr_url) }}" placeholder="https://flickr.com/zaim" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm placeholder-[#444444]">
                @error('flickr_url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="pt-4 flex items-center space-x-6">
        <button type="submit" class="border border-white bg-white text-black px-10 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300 shadow-lg">
            Simpan Perubahan Profil
        </button>
        <a href="{{ route('admin.dashboard') }}" class="text-xs text-[#888888] hover:text-white tracking-widest uppercase transition-colors">
            Batal
        </a>
    </div>
</form>

<script>
    const imageInput = document.getElementById('image');
    const imageUrlInput = document.getElementById('image_url');
    const avatarPreview = document.getElementById('avatar-preview');
    const originalAvatar = avatarPreview.src;

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (imageUrlInput) imageUrlInput.value = '';
                const reader = new FileReader();
                reader.onload = function(ev) {
                    avatarPreview.src = ev.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    if (imageUrlInput) {
        imageUrlInput.addEventListener('input', function(e) {
            const url = e.target.value.trim();
            if (url !== '') {
                if (imageInput) imageInput.value = '';
                avatarPreview.src = url;
            } else if (!imageInput || !imageInput.files[0]) {
                avatarPreview.src = originalAvatar;
            }
        });
    }
</script>
@endsection
