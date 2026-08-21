<div id="profile-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden opacity-0 transition-opacity duration-300 pointer-events-none">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-md" onclick="toggleModal()"></div>
    
    <!-- Modal Content -->
    <div id="profile-modal-content" class="relative bg-[#0a0a0a] border border-[#1c1c1c] p-8 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300 ease-[cubic-bezier(0.16,1,0.3,1)]">
        <button onclick="toggleModal()" class="absolute top-4 right-4 text-[#cccccc] hover:text-white" aria-label="Close Modal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <div class="flex flex-col items-center mt-4">
            <div class="w-24 h-24 rounded-full border-2 border-white overflow-hidden mb-6">
                <img src="{{ $aboutProfile->profile_image ?? 'https://picsum.photos/seed/zaim/200/200' }}" alt="{{ $aboutProfile->full_name ?? 'Zaim' }}" class="w-full h-full object-cover">
            </div>
            
            <h3 class="text-xl font-bold tracking-widest uppercase mb-1">{{ $aboutProfile->full_name ?? 'ZAIM' }}</h3>
            <p class="text-sm text-[#cccccc] tracking-wider uppercase mb-6 text-center">Fotografer | {{ $aboutProfile->school ?? 'SMK Kartini Batam' }}</p>
            
            <div class="w-full h-px bg-[#1c1c1c] mb-6"></div>
            
            <p class="text-xs text-[#444444] tracking-widest uppercase mb-6">Mode Tamu</p>
            
            <a href="{{ route('about.index') }}" class="w-full text-center py-3 border border-white text-white text-sm font-medium tracking-widest uppercase hover:bg-white hover:text-black transition-colors duration-300">
                Lihat Profil Lengkap
            </a>
        </div>
    </div>
</div>

<script>
    function toggleModal() {
        const modal = document.getElementById('profile-modal');
        const content = document.getElementById('profile-modal-content');
        
        if (modal.classList.contains('hidden')) {
            // Show modal
            modal.classList.remove('hidden');
            // Allow display block to apply before animating opacity
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        } else {
            // Hide modal
            modal.classList.add('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }
</script>
