<?php

declare(strict_types=1);

namespace Brick\Math\Internal;

use function extension_loaded;

/**
 * Stores the current Calculator instance used by BigNumber classes.
 *
 * @internal
 */
final class CalculatorRegistry
{
    /**
     * The Calculator instance in use.
     */
    private static ?Calculator $instance = null;

    /**
     * Sets the Calculator instance to use.
     *
     * An instance is typically set only in unit tests: autodetect is usually the best option.
     *
     * @param Calculator|null $calculator The calculator instance, or null to revert to autodetect.
     */
<<<<<<< HEAD
    final public static function set(?Calculator $calculator): void
=======
    final public static function set(?Calculator $calculator) : void
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        self::$instance = $calculator;
    }

    /**
     * Returns the Calculator instance to use.
     *
     * If none has been explicitly set, the fastest available implementation will be returned.
     *
     * Note: even though this method is not technically pure, it is considered pure when used in a normal context, when
     * only relying on autodetect.
     *
     * @pure
     */
<<<<<<< HEAD
    final public static function get(): Calculator
=======
    final public static function get() : Calculator
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @phpstan-ignore impure.staticPropertyAccess */
        if (self::$instance === null) {
            /** @phpstan-ignore impure.propertyAssign */
            self::$instance = self::detect();
        }

        /** @phpstan-ignore impure.staticPropertyAccess */
        return self::$instance;
    }

    /**
     * Returns the fastest available Calculator implementation.
     *
     * @pure
<<<<<<< HEAD
     *
     * @codeCoverageIgnore
     */
    private static function detect(): Calculator
=======
     * @codeCoverageIgnore
     */
    private static function detect() : Calculator
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if (extension_loaded('gmp')) {
            return new Calculator\GmpCalculator();
        }

        if (extension_loaded('bcmath')) {
            return new Calculator\BcMathCalculator();
        }

        return new Calculator\NativeCalculator();
    }
}
