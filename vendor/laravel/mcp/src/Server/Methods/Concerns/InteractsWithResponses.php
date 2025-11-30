<?php

declare(strict_types=1);

namespace Laravel\Mcp\Server\Methods\Concerns;

use Generator;
<<<<<<< HEAD
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Laravel\Mcp\Response;
use Laravel\Mcp\ResponseFactory;
=======
use Illuminate\Validation\ValidationException;
use Laravel\Mcp\Response;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Laravel\Mcp\Server\Content\Notification;
use Laravel\Mcp\Server\Contracts\Errable;
use Laravel\Mcp\Server\Exceptions\JsonRpcException;
use Laravel\Mcp\Server\Transport\JsonRpcRequest;
use Laravel\Mcp\Server\Transport\JsonRpcResponse;

trait InteractsWithResponses
{
    /**
<<<<<<< HEAD
     * @param  array<int, Response|ResponseFactory|string>|Response|ResponseFactory|string  $response
     */
    protected function toJsonRpcResponse(JsonRpcRequest $request, Response|ResponseFactory|array|string $response, callable $serializable): JsonRpcResponse
    {
        $responseFactory = $this->toResponseFactory($response);

        $responseFactory->responses()->each(function (Response $response) use ($request): void {
            if (! $this instanceof Errable && $response->isError()) {
                throw new JsonRpcException(
                    $response->content()->__toString(), // @phpstan-ignore-line
=======
     * @param  array<int, Response|string>|Response|string  $response
     */
    protected function toJsonRpcResponse(JsonRpcRequest $request, array|Response|string $response, callable $serializable): JsonRpcResponse
    {
        $responses = collect(
            is_array($response) ? $response : [$response]
        )->map(fn (Response|string $response): Response => $response instanceof Response
            ? $response
            : ($this->isBinary($response) ? Response::blob($response) : Response::text($response))
        );

        $responses->each(function (Response $response) use ($request): void {
            if (! $this instanceof Errable && $response->isError()) {
                throw new JsonRpcException(
                    // @phpstan-ignore-next-line
                    $response->content()->__toString(),
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                    -32603,
                    $request->id,
                );
            }
        });

<<<<<<< HEAD
        return JsonRpcResponse::result($request->id, $serializable($responseFactory));
    }

    /**
     * @param  iterable<Response|ResponseFactory|string>  $responses
=======
        return JsonRpcResponse::result($request->id, $serializable($responses));
    }

    /**
     * @param  iterable<Response|string>  $responses
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * @return Generator<JsonRpcResponse>
     */
    protected function toJsonRpcStreamedResponse(JsonRpcRequest $request, iterable $responses, callable $serializable): Generator
    {
<<<<<<< HEAD
        /** @var array<int, Response|ResponseFactory|string> $pendingResponses */
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $pendingResponses = [];

        try {
            foreach ($responses as $response) {
                if ($response instanceof Response && $response->isNotification()) {
                    /** @var Notification $content */
                    $content = $response->content();

                    yield JsonRpcResponse::notification(
                        ...$content->toArray(),
                    );

                    continue;
                }

                $pendingResponses[] = $response;
            }
        } catch (ValidationException $validationException) {
            yield $this->toJsonRpcResponse(
                $request,
                Response::error($validationException->getMessage()),
                $serializable,
            );
        }

        yield $this->toJsonRpcResponse($request, $pendingResponses, $serializable);
    }

    protected function isBinary(string $content): bool
    {
        return str_contains($content, "\0");
    }
<<<<<<< HEAD

    /**
     * @param  array<int, Response|ResponseFactory|string>|Response|ResponseFactory|string  $response
     */
    private function toResponseFactory(Response|ResponseFactory|array|string $response): ResponseFactory
    {
        $responseFactory = is_array($response) && count($response) === 1
            ? Arr::first($response)
            : $response;

        if ($responseFactory instanceof ResponseFactory) {
            return $responseFactory;
        }

        $responses = collect(Arr::wrap($responseFactory))
            ->map(function ($item): mixed {
                if ($item instanceof Response) {
                    return $item;
                }

                return $this->isBinary($item)
                    ? Response::blob($item)
                    : Response::text($item);
            });

        return new ResponseFactory($responses->all());
    }
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
