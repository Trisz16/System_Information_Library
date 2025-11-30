<?php

declare(strict_types=1);

namespace Laravel\Boost\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('boost:update', 'Update the Laravel Boost guidelines to the latest guidance')]
class UpdateCommand extends Command
{
    public function handle(): void
    {
        $this->callSilently(InstallCommand::class, [
            '--no-interaction' => true,
<<<<<<< HEAD
            '--ignore-mcp' => true,
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        ]);

        $this->components->info('Boost guidelines updated successfully.');
    }
}
