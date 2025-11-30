<?php

declare(strict_types=1);

namespace Brick\Math;

use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
<<<<<<< HEAD
use InvalidArgumentException;
use LogicException;
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Override;

/**
 * An arbitrarily large rational number.
 *
 * This class is immutable.
 */
final readonly class BigRational extends BigNumber
{
    /**
     * The numerator.
     */
    private BigInteger $numerator;

    /**
     * The denominator. Always strictly positive.
     */
    private BigInteger $denominator;

    /**
     * Protected constructor. Use a factory method to obtain an instance.
     *
     * @param BigInteger $numerator        The numerator.
     * @param BigInteger $denominator      The denominator.
     * @param bool       $checkDenominator Whether to check the denominator for negative and zero.
     *
     * @throws DivisionByZeroException If the denominator is zero.
     *
     * @pure
     */
    protected function __construct(BigInteger $numerator, BigInteger $denominator, bool $checkDenominator)
    {
        if ($checkDenominator) {
            if ($denominator->isZero()) {
                throw DivisionByZeroException::denominatorMustNotBeZero();
            }

            if ($denominator->isNegative()) {
<<<<<<< HEAD
                $numerator = $numerator->negated();
=======
                $numerator   = $numerator->negated();
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                $denominator = $denominator->negated();
            }
        }

<<<<<<< HEAD
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

=======
        $this->numerator   = $numerator;
        $this->denominator = $denominator;
    }

    #[Override]
    protected static function from(BigNumber $number): static
    {
        return $number->toBigRational();
    }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    /**
     * Creates a BigRational out of a numerator and a denominator.
     *
     * If the denominator is negative, the signs of both the numerator and the denominator
     * will be inverted to ensure that the denominator is always positive.
     *
     * @param BigNumber|int|float|string $numerator   The numerator. Must be convertible to a BigInteger.
     * @param BigNumber|int|float|string $denominator The denominator. Must be convertible to a BigInteger.
     *
     * @throws NumberFormatException      If an argument does not represent a valid number.
     * @throws RoundingNecessaryException If an argument represents a non-integer number.
     * @throws DivisionByZeroException    If the denominator is zero.
     *
     * @pure
     */
    public static function nd(
        BigNumber|int|float|string $numerator,
        BigNumber|int|float|string $denominator,
<<<<<<< HEAD
    ): BigRational {
        $numerator = BigInteger::of($numerator);
=======
    ) : BigRational {
        $numerator   = BigInteger::of($numerator);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = BigInteger::of($denominator);

        return new BigRational($numerator, $denominator, true);
    }

    /**
     * Returns a BigRational representing zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function zero(): BigRational
=======
    public static function zero() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigRational|null $zero */
        static $zero;

        if ($zero === null) {
            $zero = new BigRational(BigInteger::zero(), BigInteger::one(), false);
        }

        return $zero;
    }

    /**
     * Returns a BigRational representing one.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function one(): BigRational
=======
    public static function one() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigRational|null $one */
        static $one;

        if ($one === null) {
            $one = new BigRational(BigInteger::one(), BigInteger::one(), false);
        }

        return $one;
    }

    /**
     * Returns a BigRational representing ten.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function ten(): BigRational
=======
    public static function ten() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigRational|null $ten */
        static $ten;

        if ($ten === null) {
            $ten = new BigRational(BigInteger::ten(), BigInteger::one(), false);
        }

        return $ten;
    }

    /**
     * @pure
     */
<<<<<<< HEAD
    public function getNumerator(): BigInteger
=======
    public function getNumerator() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator;
    }

    /**
     * @pure
     */
<<<<<<< HEAD
    public function getDenominator(): BigInteger
=======
    public function getDenominator() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->denominator;
    }

    /**
     * Returns the quotient of the division of the numerator by the denominator.
     *
     * @pure
     */
<<<<<<< HEAD
    public function quotient(): BigInteger
=======
    public function quotient() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->quotient($this->denominator);
    }

    /**
     * Returns the remainder of the division of the numerator by the denominator.
     *
     * @pure
     */
<<<<<<< HEAD
    public function remainder(): BigInteger
=======
    public function remainder() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->remainder($this->denominator);
    }

    /**
     * Returns the quotient and remainder of the division of the numerator by the denominator.
     *
     * @return array{BigInteger, BigInteger}
     *
     * @pure
     */
<<<<<<< HEAD
    public function quotientAndRemainder(): array
=======
    public function quotientAndRemainder() : array
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->quotientAndRemainder($this->denominator);
    }

    /**
     * Returns the sum of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to add.
     *
     * @throws MathException If the number is not valid.
     *
     * @pure
     */
<<<<<<< HEAD
    public function plus(BigNumber|int|float|string $that): BigRational
    {
        $that = BigRational::of($that);

        $numerator = $this->numerator->multipliedBy($that->denominator);
        $numerator = $numerator->plus($that->numerator->multipliedBy($this->denominator));
=======
    public function plus(BigNumber|int|float|string $that) : BigRational
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
        $numerator   = $numerator->plus($that->numerator->multipliedBy($this->denominator));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the difference of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to subtract.
     *
     * @throws MathException If the number is not valid.
     *
     * @pure
     */
<<<<<<< HEAD
    public function minus(BigNumber|int|float|string $that): BigRational
    {
        $that = BigRational::of($that);

        $numerator = $this->numerator->multipliedBy($that->denominator);
        $numerator = $numerator->minus($that->numerator->multipliedBy($this->denominator));
=======
    public function minus(BigNumber|int|float|string $that) : BigRational
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
        $numerator   = $numerator->minus($that->numerator->multipliedBy($this->denominator));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the product of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The multiplier.
     *
     * @throws MathException If the multiplier is not a valid number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function multipliedBy(BigNumber|int|float|string $that): BigRational
    {
        $that = BigRational::of($that);

        $numerator = $this->numerator->multipliedBy($that->numerator);
=======
    public function multipliedBy(BigNumber|int|float|string $that) : BigRational
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->numerator);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = $this->denominator->multipliedBy($that->denominator);

        return new BigRational($numerator, $denominator, false);
    }

    /**
     * Returns the result of the division of this number by the given one.
     *
     * @param BigNumber|int|float|string $that The divisor.
     *
     * @throws MathException If the divisor is not a valid number, or is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function dividedBy(BigNumber|int|float|string $that): BigRational
    {
        $that = BigRational::of($that);

        $numerator = $this->numerator->multipliedBy($that->denominator);
=======
    public function dividedBy(BigNumber|int|float|string $that) : BigRational
    {
        $that = BigRational::of($that);

        $numerator   = $this->numerator->multipliedBy($that->denominator);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = $this->denominator->multipliedBy($that->numerator);

        return new BigRational($numerator, $denominator, true);
    }

    /**
     * Returns this number exponentiated to the given value.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException If the exponent is not in the range 0 to 1,000,000.
     *
     * @pure
     */
    public function power(int $exponent): BigRational
=======
     * @throws \InvalidArgumentException If the exponent is not in the range 0 to 1,000,000.
     *
     * @pure
     */
    public function power(int $exponent) : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($exponent === 0) {
            $one = BigInteger::one();

            return new BigRational($one, $one, false);
        }

        if ($exponent === 1) {
            return $this;
        }

        return new BigRational(
            $this->numerator->power($exponent),
            $this->denominator->power($exponent),
<<<<<<< HEAD
            false,
=======
            false
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        );
    }

    /**
     * Returns the reciprocal of this BigRational.
     *
     * The reciprocal has the numerator and denominator swapped.
     *
     * @throws DivisionByZeroException If the numerator is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function reciprocal(): BigRational
=======
    public function reciprocal() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new BigRational($this->denominator, $this->numerator, true);
    }

    /**
     * Returns the absolute value of this BigRational.
     *
     * @pure
     */
<<<<<<< HEAD
    public function abs(): BigRational
=======
    public function abs() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new BigRational($this->numerator->abs(), $this->denominator, false);
    }

    /**
     * Returns the negated value of this BigRational.
     *
     * @pure
     */
<<<<<<< HEAD
    public function negated(): BigRational
=======
    public function negated() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new BigRational($this->numerator->negated(), $this->denominator, false);
    }

    /**
     * Returns the simplified value of this BigRational.
     *
     * @pure
     */
<<<<<<< HEAD
    public function simplified(): BigRational
=======
    public function simplified() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $gcd = $this->numerator->gcd($this->denominator);

        $numerator = $this->numerator->quotient($gcd);
        $denominator = $this->denominator->quotient($gcd);

        return new BigRational($numerator, $denominator, false);
    }

    #[Override]
<<<<<<< HEAD
    public function compareTo(BigNumber|int|float|string $that): int
=======
    public function compareTo(BigNumber|int|float|string $that) : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->minus($that)->getSign();
    }

    #[Override]
<<<<<<< HEAD
    public function getSign(): int
=======
    public function getSign() : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->getSign();
    }

    #[Override]
<<<<<<< HEAD
    public function toBigInteger(): BigInteger
=======
    public function toBigInteger() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $simplified = $this->simplified();

        if (! $simplified->denominator->isEqualTo(1)) {
            throw new RoundingNecessaryException('This rational number cannot be represented as an integer value without rounding.');
        }

        return $simplified->numerator;
    }

    #[Override]
<<<<<<< HEAD
    public function toBigDecimal(): BigDecimal
=======
    public function toBigDecimal() : BigDecimal
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->toBigDecimal()->exactlyDividedBy($this->denominator);
    }

    #[Override]
<<<<<<< HEAD
    public function toBigRational(): BigRational
=======
    public function toBigRational() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this;
    }

    #[Override]
<<<<<<< HEAD
    public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY): BigDecimal
=======
    public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->numerator->toBigDecimal()->dividedBy($this->denominator, $scale, $roundingMode);
    }

    #[Override]
<<<<<<< HEAD
    public function toInt(): int
=======
    public function toInt() : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->toBigInteger()->toInt();
    }

    #[Override]
<<<<<<< HEAD
    public function toFloat(): float
    {
        $simplified = $this->simplified();

=======
    public function toFloat() : float
    {
        $simplified = $this->simplified();
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        return $simplified->numerator->toFloat() / $simplified->denominator->toFloat();
    }

    #[Override]
<<<<<<< HEAD
    public function __toString(): string
    {
        $numerator = (string) $this->numerator;
=======
    public function __toString() : string
    {
        $numerator   = (string) $this->numerator;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $denominator = (string) $this->denominator;

        if ($denominator === '1') {
            return $numerator;
        }

        return $numerator . '/' . $denominator;
    }

    /**
     * This method is required for serializing the object and SHOULD NOT be accessed directly.
     *
     * @internal
     *
     * @return array{numerator: BigInteger, denominator: BigInteger}
     */
    public function __serialize(): array
    {
        return ['numerator' => $this->numerator, 'denominator' => $this->denominator];
    }

    /**
     * This method is only here to allow unserializing the object and cannot be accessed directly.
     *
     * @internal
     *
     * @param array{numerator: BigInteger, denominator: BigInteger} $data
     *
<<<<<<< HEAD
     * @throws LogicException
=======
     * @throws \LogicException
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     */
    public function __unserialize(array $data): void
    {
        /** @phpstan-ignore isset.initializedProperty */
        if (isset($this->numerator)) {
<<<<<<< HEAD
            throw new LogicException('__unserialize() is an internal function, it must not be called directly.');
=======
            throw new \LogicException('__unserialize() is an internal function, it must not be called directly.');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        /** @phpstan-ignore deadCode.unreachable */
        $this->numerator = $data['numerator'];
        $this->denominator = $data['denominator'];
    }
<<<<<<< HEAD

    #[Override]
    protected static function from(BigNumber $number): static
    {
        return $number->toBigRational();
    }
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
