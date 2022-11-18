<?php

namespace Hotash\Installer\Commands;

use Illuminate\Console\Command;

class InstallerCommand extends Command
{
    public $signature = 'laravel-installer';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
