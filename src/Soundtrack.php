<?php

namespace Solitweb\SoundtrackTile;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class Soundtrack
{
    public const SOUNDTRACK_ENDPOINT = 'https://api.soundtrackyourbrand.com/v2';

    public $token;

    public function __construct($email, $password)
    {
        $this->token = $this->getApiToken($email, $password);
    }

    private function getApiToken(string $email, string $password): string
    {
        return Cache::remember('soundtrack_api_token', 3600, function() use($email, $password) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post(self::SOUNDTRACK_ENDPOINT, [
                'query' => 'mutation($email: String!, $password: String!) { loginUser(input: { email: $email, password: $password }) { token, refreshToken } }',
                'variables' => [
                    'email' => $email,
                    'password' => $password
                ]
            ]);

            if($response->ok()) {
                return $response->json()['data']['loginUser']['token'];
            }

            throw new Exception('Could not get API token');
        });
    }

    public function getSoundtrackData(): array
    {
        $response = Http::withToken($this->token)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])->post(self::SOUNDTRACK_ENDPOINT, [
            'query' => 'query($id: ID!) { nowPlaying(soundZone: $id) { track { name, artists { name }, album { image { url } } } } }',
            'variables' => [
                'id' => config('dashboard.tiles.soundtrack.sound_zone')
            ]
        ]);

        if($response->ok()) {
            $data = $response->json()['data']['nowPlaying'];

            return [
                'isPlaying' => ! is_null($data) ? true : false,
                'trackName' => Arr::get($data, 'track.name') ?? null,
                'trackArtists' => Arr::get($data, 'track.artists') ?? null,
                'albumImage' => Arr::get($data, 'track.album.image.url') ?? null,
            ];
        }

        return [];
    }
}