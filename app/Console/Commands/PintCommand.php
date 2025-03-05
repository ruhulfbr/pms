<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PintCommand extends Command
{
    protected $signature = 'pint {branch?} {--dirty}';

    protected $description = 'Format code using pint';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $command = './vendor/bin/pint --dirty';
        $branch = $this->argument('branch');

        if ($branch) {
            $command = "./vendor/bin/pint --diff=$branch";
        }

        echo shell_exec($command);

        return 0;
    }
}
