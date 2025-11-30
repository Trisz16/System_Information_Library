<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server;

use Illuminate\Support\Str;

abstract class Resource extends Primitive
{
    protected string $uri = '';

    protected string $mimeType = '';

    public function uri(): string
    {
        return $this->uri !== ''
            ? $this->uri
            : 'file://resources/'.Str::kebab(class_basename($this));
    }

    public function mimeType(): string
    {
        return $this->mimeType !== ''
            ? $this->mimeType
            : 'text/plain';
    }

    /**
     * @return array<string, mixed>
     */
    public function toMethodCall(): array
    {
        return ['uri' => $this->uri()];
    }

<<<<<<< HEAD
    /**
     * @return array{
     *     name: string,
     *     title: string,
     *     description: string,
     *     uri: string,
     *     mimeType: string,
     *     _meta?: array<string, mixed>
     * }
     */
    public function toArray(): array
    {
        // @phpstan-ignore return.type
        return $this->mergeMeta([
=======
    public function toArray(): array
    {
        return [
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'name' => $this->name(),
            'title' => $this->title(),
            'description' => $this->description(),
            'uri' => $this->uri(),
            'mimeType' => $this->mimeType(),
<<<<<<< HEAD
        ]);
=======
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
