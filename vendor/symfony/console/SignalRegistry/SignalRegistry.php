<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\SignalRegistry;

final class SignalRegistry
{
<<<<<<< HEAD
    /**
     * @var array<int, array<callable>>
     */
    private array $signalHandlers = [];

    /**
     * @var array<array<int, array<callable>>>
     */
    private array $stack = [];

    /**
     * @var array<int, callable|int|string>
     */
    private array $originalHandlers = [];

=======
    private array $signalHandlers = [];

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function __construct()
    {
        if (\function_exists('pcntl_async_signals')) {
            pcntl_async_signals(true);
        }
    }

    public function register(int $signal, callable $signalHandler): void
    {
<<<<<<< HEAD
        $previous = pcntl_signal_get_handler($signal);

        if (!isset($this->originalHandlers[$signal])) {
            $this->originalHandlers[$signal] = $previous;
        }

        if (!isset($this->signalHandlers[$signal])) {
            if (\is_callable($previous) && [$this, 'handle'] !== $previous) {
                $this->signalHandlers[$signal][] = $previous;
=======
        if (!isset($this->signalHandlers[$signal])) {
            $previousCallback = pcntl_signal_get_handler($signal);

            if (\is_callable($previousCallback)) {
                $this->signalHandlers[$signal][] = $previousCallback;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            }
        }

        $this->signalHandlers[$signal][] = $signalHandler;

<<<<<<< HEAD
        pcntl_signal($signal, [$this, 'handle']);
=======
        pcntl_signal($signal, $this->handle(...));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    public static function isSupported(): bool
    {
        return \function_exists('pcntl_signal');
    }

    /**
     * @internal
     */
    public function handle(int $signal): void
    {
        $count = \count($this->signalHandlers[$signal]);

        foreach ($this->signalHandlers[$signal] as $i => $signalHandler) {
            $hasNext = $i !== $count - 1;
            $signalHandler($signal, $hasNext);
        }
    }

    /**
<<<<<<< HEAD
     * Pushes the current active handlers onto the stack and clears the active list.
     *
     * This prepares the registry for a new set of handlers within a specific scope.
     *
     * @internal
     */
    public function pushCurrentHandlers(): void
    {
        $this->stack[] = $this->signalHandlers;
        $this->signalHandlers = [];
    }

    /**
     * Restores the previous handlers from the stack, making them active.
     *
     * This also restores the original OS-level signal handler if no
     * more handlers are registered for a signal that was just popped.
     *
     * @internal
     */
    public function popPreviousHandlers(): void
    {
        $popped = $this->signalHandlers;
        $this->signalHandlers = array_pop($this->stack) ?? [];

        // Restore OS handler if no more Symfony handlers for this signal
        foreach ($popped as $signal => $handlers) {
            if (!($this->signalHandlers[$signal] ?? false) && isset($this->originalHandlers[$signal])) {
                pcntl_signal($signal, $this->originalHandlers[$signal]);
            }
        }
    }

    /**
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * @internal
     */
    public function scheduleAlarm(int $seconds): void
    {
        pcntl_alarm($seconds);
    }
}
