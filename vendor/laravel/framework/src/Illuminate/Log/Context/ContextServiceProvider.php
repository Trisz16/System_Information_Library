<?php

namespace Illuminate\Log\Context;

use Illuminate\Contracts\Log\ContextLogProcessor as ContextLogProcessorContract;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Queue;
<<<<<<< HEAD
use Illuminate\Support\Env;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Illuminate\Support\Facades\Context;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->scoped(Repository::class);

<<<<<<< HEAD
        if ($this->app->runningInConsole()) {
            $this->app->resolving(Repository::class, function (Repository $repository) {
                $context = Env::get('__LARAVEL_CONTEXT');

                if ($context && $context = json_decode($context, associative: true)) {
                    $repository->hydrate($context);
                }
            });
        }

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $this->app->bind(ContextLogProcessorContract::class, fn () => new ContextLogProcessor());
    }

    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::createPayloadUsing(function ($connection, $queue, $payload) {
            /** @phpstan-ignore staticMethod.notFound */
            $context = Context::dehydrate();

            return $context === null ? $payload : [
                ...$payload,
                'illuminate:log:context' => $context,
            ];
        });

        $this->app['events']->listen(function (JobProcessing $event) {
            /** @phpstan-ignore staticMethod.notFound */
            Context::hydrate($event->job->payload()['illuminate:log:context'] ?? null);
        });
    }
}
