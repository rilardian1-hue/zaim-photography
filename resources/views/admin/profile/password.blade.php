@extends('admin.layouts.app')

@section('content')
<h1 class="text-3xl font-bold tracking-widest uppercase mb-10">Ubah Password</h1>

<form action="{{ route('admin.password.update') }}" method="POST" class="max-w-xl bg-[#1c1c1c] border border-[#444444] p-8 space-y-6">
    @csrf
    @method('PUT')

    @if (session('status') === 'password-updated')
        <div class="bg-green-900/50 border border-green-500 text-green-400 px-4 py-3 text-sm">
            Password berhasil diperbarui.
        </div>
    @endif
    
    @if (!session('secret_key_reset'))
    <div>
        <label for="current_password" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Password Saat Ini *</label>
        <input type="password" id="current_password" name="current_password" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
        @error('current_password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    @else
    <div class="bg-blue-900/50 border border-blue-500 text-blue-400 px-4 py-3 text-sm mb-4">
        Anda masuk melalui Kunci Rahasia. Anda dapat langsung mengubah password.
    </div>
    @endif

    <div>
        <label for="password" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Password Baru *</label>
        <input type="password" id="password" name="password" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
        @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Konfirmasi Password Baru *</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
    </div>

    <div class="pt-4">
        <button type="submit" class="border border-white bg-white text-black px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300">
            Simpan Password
        </button>
    </div>
</form>
@endsection
