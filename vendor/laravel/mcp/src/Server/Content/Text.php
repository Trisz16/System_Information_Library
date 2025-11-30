<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server\Content;

<<<<<<< HEAD
use Laravel\Mcp\Server\Concerns\HasMeta;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Laravel\Mcp\Server\Contracts\Content;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\Resource;
use Laravel\Mcp\Server\Tool;

class Text implements Content
{
<<<<<<< HEAD
    use HasMeta;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function __construct(protected string $text)
    {
        //
    }

    /**
     * @return array<string, mixed>
     */
    public function toTool(Tool $tool): array
    {
        return $this->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    public function toPrompt(Prompt $prompt): array
    {
        return $this->toArray();
    }

    /**
     * @return array<string, mixed>
     */
    public function toResource(Resource $resource): array
    {
<<<<<<< HEAD
        return $this->mergeMeta([
            'text' => $this->text,
            'uri' => $resource->uri(),
            'mimeType' => $resource->mimeType(),
        ]);
=======
        return [
            'text' => $this->text,
            'uri' => $resource->uri(),
            'name' => $resource->name(),
            'title' => $resource->title(),
            'mimeType' => $resource->mimeType(),
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function __toString(): string
    {
        return $this->text;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
<<<<<<< HEAD
        return $this->mergeMeta([
            'type' => 'text',
            'text' => $this->text,
        ]);
=======
        return [
            'type' => 'text',
            'text' => $this->text,
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
