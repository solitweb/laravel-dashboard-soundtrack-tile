<x-dashboard-tile :position="$position">
    <div 
        wire:poll.{{ $refreshIntervalInSeconds }}s
        class="grid gap-2 justify-items-center h-full text-center"
    >
        <h1 class="font-medium text-dimmed text-sm uppercase tracking-wide">Currently Playing</h1>
        @if($isPlaying)
            <div class="flex items-center justify-center">
                <img class="w-32 h-32 rounded" src="{{ $albumImage }}" alt="Album image">
            </div>
            <div class="self-center font-bold text-xl tracking-wide leading-none">
                {{ $trackName }}
            </div>
            <div>
                <div class="flex w-full justify-center space-x-4 items-center">
                    <span class="text-xs text-dimmed">
                        {{ implode(', ', array_column($trackArtists ?? [], 'name')) }}
                    </span>
                </div>
            </div>
        @else
            <div class="self-center font-bold text-xl tracking-wide leading-none">
                No music playing.
            </div>
        @endif
    </div>
</x-dashboard-tile>
