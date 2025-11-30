<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server\Content;

use InvalidArgumentException;
<<<<<<< HEAD
use Laravel\Mcp\Server\Concerns\HasMeta;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Laravel\Mcp\Server\Contracts\Content;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\Resource;
use Laravel\Mcp\Server\Tool;

class Blob implements Content
{
<<<<<<< HEAD
    use HasMeta;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function __construct(protected string $content)
    {
        //
    }

    /**
     * @return array<string, mixed>
     */
    public function toTool(Tool $tool): array
    {
        throw new InvalidArgumentException(
            'Blob content may not be used in tools.',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toPrompt(Prompt $prompt): array
    {
        throw new InvalidArgumentException(
            'Blob content may not be used in prompts.',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toResource(Resource $resource): array
    {
<<<<<<< HEAD
        return $this->mergeMeta([
            'blob' => base64_encode($this->content),
            'uri' => $resource->uri(),
            'mimeType' => $resource->mimeType(),
        ]);
=======
        return [
            'blob' => base64_encode($this->content),
            'uri' => $resource->uri(),
            'name' => $resource->name(),
            'title' => $resource->title(),
            'mimeType' => $resource->mimeType(),
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public function __toString(): string
    {
        return $this->content;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
<<<<<<< HEAD
        return $this->mergeMeta([
            'type' => 'blob',
            'blob' => $this->content,
        ]);
=======
        return [
            'type' => 'blob',
            'blob' => $this->content,
        ];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
