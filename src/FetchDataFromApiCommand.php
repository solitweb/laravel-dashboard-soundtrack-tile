<?php

namespace Solitweb\SoundtrackTile;

use Illuminate\Console\Command;

class FetchDataFromApiCommand extends Command
{
    protected $signature = 'dashboard:fetch-data-from-soundtrack-api';

    protected $description = 'Fetch data for tile';

    public function handle(Soundtrack $soundtrack)
    {
        $this->info('Fetching Soundtrack data...');

        $data = $soundtrack->getSoundtrackData();

        SoundtrackStore::make()->setData($data);

        $this->info('All done!');
    }
}
