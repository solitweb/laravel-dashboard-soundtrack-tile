<?php

namespace Solitweb\SoundtrackTile;

use Spatie\Dashboard\Models\Tile;

class SoundtrackStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('soundtrack');
    }

    public function setData(array $data): self
    {
        $this->tile->putData('soundtrack', $data);

        return $this;
    }

    public function getData(): array
    {
        return $this->tile->getData('soundtrack') ?? [];
    }

    public function getIsPlaying(): ?bool
    {
        return $this->tile->getData('soundtrack.isPlaying');
    }

    public function getTrackName(): ?string
    {
        return $this->tile->getData('soundtrack.trackName');
    }

    public function getArtists(): ?array
    {
        return $this->tile->getData('soundtrack.trackArtists');
    }

    public function getAlbumImage(): ?string
    {
        return $this->tile->getData('soundtrack.albumImage');
    }
}
