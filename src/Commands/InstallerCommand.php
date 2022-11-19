<?php

namespace Hotash\Installer\Commands;

use Illuminate\Console\Command;

class InstallerCommand extends Command
{
    public $signature = 'installer:setup';

    public $description = 'Setup UI Installer';

    public function handle(): int
    {
        $this->call('vendor:publish', ['--tag' => 'installer-config']);
        $this->call('vendor:publish', ['--tag' => 'installer-views']);
        $this->comment('All done');

        return self::SUCCESS;
    }
}
