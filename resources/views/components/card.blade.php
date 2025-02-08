<div class="glass-card">
    <!-- Gradient border container -->
    <div class="absolute inset-0 rounded-2xl">
        <div class="glow-border"></div>
        <div class="inner-card"></div>
    </div>

    <!-- Card content -->
    <div class="relative z-10">
        <div class="mb-4 flex items-center gap-4">
            <div class="rounded-xl bg-blue-500/20 p-3">
                {!! $icon !!}
            </div>
            <h2 class="text-xl font-semibold">{{ $title }}</h2>
        </div>
        <p>{{ $content }}</p>
        <a href="{{ $link }}" class="inline-flex items-center text-blue-400 transition-colors hover:text-blue-300">
            {{ $linkTitle }}
            <svg class="ml-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
