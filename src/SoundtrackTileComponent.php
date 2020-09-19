<?php

namespace Solitweb\SoundtrackTile;

use Livewire\Component;

class SoundtrackTileComponent extends Component
{
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        $soundtrackStore = SoundtrackStore::make();

        return view('dashboard-soundtrack-tile::tile', [
            'refreshIntervalInSeconds' => config('dashboard.tiles.soundtrack.refresh_interval_in_seconds') ?? 60,
            'isPlaying' => $soundtrackStore->getIsPlaying(),
            'trackName' => $soundtrackStore->getTrackName(),
            'trackArtists' => $soundtrackStore->getArtists(),
            'albumImage' => $soundtrackStore->getAlbumImage(),
        ]);
    }
}
