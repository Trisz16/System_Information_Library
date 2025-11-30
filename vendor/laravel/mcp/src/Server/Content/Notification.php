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

class Notification implements Content
{
<<<<<<< HEAD
    use HasMeta;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    /**
     * @param  array<string, mixed>  $params
     */
    public function __construct(protected string $method, protected array $params)
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
        return $this->toArray();
    }

    public function __toString(): string
    {
        return $this->method;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
<<<<<<< HEAD
        $params = $this->params;

        if ($this->meta !== null && $this->meta !== [] && ! isset($params['_meta'])) {
            $params['_meta'] = $this->meta;
        }

        return [
            'method' => $this->method,
            'params' => $params,
=======
        return [
            'method' => $this->method,
            'params' => $this->params,
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        ];
    }
}
