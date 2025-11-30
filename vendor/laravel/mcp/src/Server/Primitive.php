<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server;

use Illuminate\Container\Container;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Laravel\Mcp\Server\Concerns\HasMeta;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

/**
 * @implements Arrayable<string, mixed>
 */
abstract class Primitive implements Arrayable
{
<<<<<<< HEAD
    use HasMeta;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    protected string $name = '';

    protected string $title = '';

    protected string $description = '';

    public function name(): string
    {
        return $this->name === ''
            ? Str::kebab(class_basename($this))
            : $this->name;
    }

    public function title(): string
    {
        return $this->title === ''
            ? Str::headline(class_basename($this))
            : $this->title;
    }

    public function description(): string
    {
        return $this->description === ''
            ? Str::headline(class_basename($this))
            : $this->description;
    }

<<<<<<< HEAD
    /**
     * @return array<string, mixed>|null
     */
    public function meta(): ?array
    {
        return $this->meta;
    }

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function eligibleForRegistration(): bool
    {
        if (method_exists($this, 'shouldRegister')) {
            return Container::getInstance()->call([$this, 'shouldRegister']);
        }

        return true;
    }

    /**
     * @return array<string, mixed>
     */
    abstract public function toMethodCall(): array;

    /**
     * @return array<string, mixed>
     */
    abstract public function toArray(): array;
}
