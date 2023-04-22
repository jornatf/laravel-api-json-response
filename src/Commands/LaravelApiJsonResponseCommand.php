<?php

namespace Jornatf\LaravelApiJsonResponse\Commands;

use Illuminate\Console\Command;

class LaravelApiJsonResponseCommand extends Command
{
    public $signature = 'laravelapijsonresponse';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
