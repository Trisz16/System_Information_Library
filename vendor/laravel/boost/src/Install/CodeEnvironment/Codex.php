<?php

declare(strict_types=1);

namespace Laravel\Boost\Install\CodeEnvironment;

use Laravel\Boost\Contracts\Agent;
<<<<<<< HEAD
use Laravel\Boost\Contracts\McpClient;
use Laravel\Boost\Install\Enums\McpInstallationStrategy;
use Laravel\Boost\Install\Enums\Platform;

class Codex extends CodeEnvironment implements Agent, McpClient
=======
use Laravel\Boost\Install\Enums\Platform;

class Codex extends CodeEnvironment implements Agent
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
{
    public function name(): string
    {
        return 'codex';
    }

    public function displayName(): string
    {
        return 'Codex';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin, Platform::Linux => [
                'command' => 'which codex',
            ],
            Platform::Windows => [
                'command' => 'where codex 2>nul',
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.codex'],
            'files' => ['AGENTS.md'],
        ];
    }

    public function guidelinesPath(): string
    {
        return 'AGENTS.md';
    }
<<<<<<< HEAD

    public function mcpInstallationStrategy(): McpInstallationStrategy
    {
        return McpInstallationStrategy::SHELL;
    }

    public function shellMcpCommand(): string
    {
        return 'codex mcp add {key} -- {command} {args}';
    }
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
