@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16 text-center">
            <div class="mask-reveal-container mb-6 relative">
                <h1 class="mask-reveal observe-element delay-100 text-4xl md:text-6xl font-bold tracking-[0.2em] uppercase relative">
                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 text-6xl md:text-8xl text-white/5 whitespace-nowrap -z-10 tracking-[0.1em]">GALERI</span>
                    Portofolio
                </h1>
            </div>
            <p class="text-[#cccccc] max-w-2xl mx-auto observe-element delay-200">Eksplorasi cahaya, bentuk, dan emosi dalam nuansa monokromatik.</p>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap justify-center gap-4 mb-12 animate-fade-in-up" style="animation-delay: 0.2s; animation-fill-mode: backwards;">
            @php
                // Merge 'all' with dynamic categories from DB
                $filterCategories = ['all' => 'Semua'];
                foreach($categories as $cat) {
                    if($cat) {
                        $filterCategories[$cat] = \Illuminate\Support\Str::title($cat);
                    }
                }
            @endphp
            
            @foreach($filterCategories as $key => $label)
                <button 
                    class="magnetic-btn filter-btn px-6 py-2 border border-[#444444] text-xs font-medium tracking-widest uppercase transition-all duration-300 {{ $key === 'all' ? 'bg-white text-black border-white' : 'text-[#cccccc] hover:border-white hover:text-white' }}"
                    data-category="{{ $key }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Grid -->
        <div id="works-grid" class="columns-2 md:columns-3 lg:columns-4 gap-3 md:gap-6 space-y-3 md:space-y-6">
            @include('works.partials.grid')
        </div>

        @if($works->hasMorePages())
            <div class="mt-16 text-center" id="load-more-container">
                <button id="load-more-btn" data-next-page="{{ $works->currentPage() + 1 }}" class="magnetic-btn inline-flex items-center justify-center border border-white px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-white hover:text-black transition-colors duration-300">
                    <span class="btn-text">Muat Lebih Banyak</span>
                    <span class="spinner hidden ml-3 w-4 h-4 border-2 border-current border-t-transparent rounded-full animate-spin"></span>
                </button>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    let currentCategory = 'all';

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-white', 'text-black', 'border-white');
                b.classList.add('text-[#cccccc]', 'border-[#444444]');
            });
            this.classList.remove('text-[#cccccc]', 'border-[#444444]');
            this.classList.add('bg-white', 'text-black', 'border-white');

            currentCategory = this.dataset.category;
            fetchWorks(currentCategory, 1, true);
        });
    });

    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const nextPage = this.dataset.nextPage;
            this.querySelector('.btn-text').classList.add('opacity-0');
            this.querySelector('.spinner').classList.remove('hidden');
            fetchWorks(currentCategory, nextPage, false);
        });
    }

    function fetchWorks(category, page, replace) {
        const grid = document.getElementById('works-grid');
        if (replace) {
            grid.style.opacity = '0.5';
        }

        fetch(`/works?category=${category}&page=${page}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            if (replace) {
                grid.innerHTML = html;
                grid.style.opacity = '1';
                // Reset pagination button if needed (simplified for now)
            } else {
                grid.insertAdjacentHTML('beforeend', html);
                const btn = document.getElementById('load-more-btn');
                if (btn) {
                    btn.dataset.nextPage = parseInt(page) + 1;
                    btn.querySelector('.btn-text').classList.remove('opacity-0');
                    btn.querySelector('.spinner').classList.add('hidden');
                }
            }
            
            // Re-init observer for new elements
            initObserver();
        });
    }
</script>
@endpush
@endsection
