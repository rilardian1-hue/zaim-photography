@foreach($works as $work)
                <div class="break-inside-avoid mb-4 group observe-element delay-{{ ($loop->index % 5) * 100 }} opacity-0 transition-all duration-700 ease-out">
                    <a href="{{ $work->image_path }}" data-title="{{ $work->title }}" data-description="{{ $work->description ?? '' }}" class="lightbox-trigger block relative rounded-xl md:rounded-2xl overflow-hidden cursor-zoom-in tilt-effect">
        <img src="{{ $work->image_path }}" alt="{{ $work->title }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-105">
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
    </a>
    <div class="flex justify-between items-center mt-2 md:mt-3 px-1">
        <div class="flex-1 min-w-0">
            <h3 class="text-xs md:text-sm font-medium font-satoshi tracking-wide text-white truncate">{{ $work->title }}</h3>
            <p class="text-[10px] md:text-xs text-[#888888] truncate capitalize">{{ str_replace('-', ' ', $work->category) }}</p>
        </div>
        <button class="ml-2 text-[#888888] hover:bg-[#1c1c1c] hover:text-white rounded-full p-1.5 transition-colors" aria-label="Options">
            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
        </button>
    </div>
</div>
@endforeach
