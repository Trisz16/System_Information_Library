<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server;

use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Server\Contracts\Tools\Annotation;
use ReflectionAttribute;
use ReflectionClass;

abstract class Tool extends Primitive
{
    /**
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    public function annotations(): array
    {
        $reflection = new ReflectionClass($this);

        // @phpstan-ignore-next-line
        return collect($reflection->getAttributes())
            ->map(fn (ReflectionAttribute $attributeReflection): object => $attributeReflection->newInstance())
            ->filter(fn (object $attribute): bool => $attribute instanceof Annotation)
            // @phpstan-ignore-next-line
            ->mapWithKeys(fn (Annotation $attribute): array => [$attribute->key() => $attribute->value])
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    public function toMethodCall(): array
    {
        return ['name' => $this->name()];
    }

    /**
     * Get the tool's array representation.
     *
     * @return array{
     *     name: string,
     *     title?: string|null,
     *     description?: string|null,
     *     inputSchema?: array<string, mixed>,
<<<<<<< HEAD
     *     annotations?: array<string, mixed>|object,
     *     _meta?: array<string, mixed>
=======
     *     annotations?: array<string, mixed>|object
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * }
     */
    public function toArray(): array
    {
        $annotations = $this->annotations();
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $schema = JsonSchema::object(
            $this->schema(...),
        )->toArray();

        $schema['properties'] ??= (object) [];

<<<<<<< HEAD
        // @phpstan-ignore return.type
        return $this->mergeMeta([
=======
        return [
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            'name' => $this->name(),
            'title' => $this->title(),
            'description' => $this->description(),
            'inputSchema' => $schema,
            'annotations' => $annotations === [] ? (object) [] : $annotations,
<<<<<<< HEAD
        ]);

=======
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
