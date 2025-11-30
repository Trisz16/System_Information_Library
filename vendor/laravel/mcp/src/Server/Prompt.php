<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server;

use Laravel\Mcp\Server\Prompts\Argument;
use Laravel\Mcp\Server\Prompts\Arguments;

abstract class Prompt extends Primitive
{
    /**
     * @return array<int, Argument>
     */
    public function arguments(): array
    {
        return [
            //
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toMethodCall(): array
    {
        return ['name' => $this->name()];
    }

    /**
<<<<<<< HEAD
     * @return array{name: string, title: string, description: string, arguments: array<int, array{name: string, description: string, required: bool, _meta?: array<string, mixed>}>}
     */
    public function toArray(): array
    {
        // @phpstan-ignore return.type
        return $this->mergeMeta([
=======
     * @return array{name: string, title: string, description: string, arguments: array<int, array{name: string, description: string, required: bool}>}
     */
    public function toArray(): array
    {
        return [
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'name' => $this->name(),
            'title' => $this->title(),
            'description' => $this->description(),
            'arguments' => array_map(
                fn (Argument $argument): array => $argument->toArray(),
                $this->arguments(),
            ),
<<<<<<< HEAD
        ]);
=======
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
