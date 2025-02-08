<div class="glass-card">
    <!-- Gradient border container -->
    <div class="absolute inset-0 rounded-2xl">
        <div class="glow-border"></div>
        <div class="inner-card"></div>
    </div>

    <!-- Card content -->
    <div class="relative z-10">
        {{ $slot }}
    </div>
</div>
