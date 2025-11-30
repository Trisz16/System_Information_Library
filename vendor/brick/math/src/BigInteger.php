<?php

declare(strict_types=1);

namespace Brick\Math;

use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\IntegerOverflowException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NegativeNumberException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Internal\Calculator;
use Brick\Math\Internal\CalculatorRegistry;
<<<<<<< HEAD
use InvalidArgumentException;
use LogicException;
use Override;

use function assert;
use function bin2hex;
use function chr;
use function filter_var;
use function hex2bin;
use function in_array;
use function intdiv;
use function ltrim;
use function ord;
use function preg_match;
use function preg_quote;
use function random_bytes;
use function sprintf;
use function str_repeat;
use function strlen;
use function strtolower;
use function substr;

use const FILTER_VALIDATE_INT;

=======
use Override;

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * An arbitrary-size integer.
 *
 * All methods accepting a number as a parameter accept either a BigInteger instance,
 * an integer, or a string representing an arbitrary size integer.
 */
final readonly class BigInteger extends BigNumber
{
    /**
     * The value, as a string of digits with optional leading minus sign.
     *
     * No leading zeros must be present.
     * No leading minus sign must be present if the number is zero.
     */
    private string $value;

    /**
     * Protected constructor. Use a factory method to obtain an instance.
     *
     * @param string $value A string of digits, with optional leading minus sign.
     *
     * @pure
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

<<<<<<< HEAD
=======
    #[Override]
    protected static function from(BigNumber $number): static
    {
        return $number->toBigInteger();
    }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    /**
     * Creates a number from a string in a given base.
     *
     * The string can optionally be prefixed with the `+` or `-` sign.
     *
     * Bases greater than 36 are not supported by this method, as there is no clear consensus on which of the lowercase
     * or uppercase characters should come first. Instead, this method accepts any base up to 36, and does not
     * differentiate lowercase and uppercase characters, which are considered equal.
     *
     * For bases greater than 36, and/or custom alphabets, use the fromArbitraryBase() method.
     *
     * @param string $number The number to convert, in the given base.
     * @param int    $base   The base of the number, between 2 and 36.
     *
<<<<<<< HEAD
     * @throws NumberFormatException    If the number is empty, or contains invalid chars for the given base.
     * @throws InvalidArgumentException If the base is out of range.
     *
     * @pure
     */
    public static function fromBase(string $number, int $base): BigInteger
=======
     * @throws NumberFormatException     If the number is empty, or contains invalid chars for the given base.
     * @throws \InvalidArgumentException If the base is out of range.
     *
     * @pure
     */
    public static function fromBase(string $number, int $base) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($number === '') {
            throw new NumberFormatException('The number cannot be empty.');
        }

        if ($base < 2 || $base > 36) {
<<<<<<< HEAD
            throw new InvalidArgumentException(sprintf('Base %d is not in range 2 to 36.', $base));
=======
            throw new \InvalidArgumentException(\sprintf('Base %d is not in range 2 to 36.', $base));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if ($number[0] === '-') {
            $sign = '-';
<<<<<<< HEAD
            $number = substr($number, 1);
        } elseif ($number[0] === '+') {
            $sign = '';
            $number = substr($number, 1);
=======
            $number = \substr($number, 1);
        } elseif ($number[0] === '+') {
            $sign = '';
            $number = \substr($number, 1);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        } else {
            $sign = '';
        }

        if ($number === '') {
            throw new NumberFormatException('The number cannot be empty.');
        }

<<<<<<< HEAD
        $number = ltrim($number, '0');
=======
        $number = \ltrim($number, '0');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($number === '') {
            // The result will be the same in any base, avoid further calculation.
            return BigInteger::zero();
        }

        if ($number === '1') {
            // The result will be the same in any base, avoid further calculation.
            return new BigInteger($sign . '1');
        }

<<<<<<< HEAD
        $pattern = '/[^' . substr(Calculator::ALPHABET, 0, $base) . ']/';

        if (preg_match($pattern, strtolower($number), $matches) === 1) {
            throw new NumberFormatException(sprintf('"%s" is not a valid character in base %d.', $matches[0], $base));
=======
        $pattern = '/[^' . \substr(Calculator::ALPHABET, 0, $base) . ']/';

        if (\preg_match($pattern, \strtolower($number), $matches) === 1) {
            throw new NumberFormatException(\sprintf('"%s" is not a valid character in base %d.', $matches[0], $base));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if ($base === 10) {
            // The number is usable as is, avoid further calculation.
            return new BigInteger($sign . $number);
        }

        $result = CalculatorRegistry::get()->fromBase($number, $base);

        return new BigInteger($sign . $result);
    }

    /**
     * Parses a string containing an integer in an arbitrary base, using a custom alphabet.
     *
     * Because this method accepts an alphabet with any character, including dash, it does not handle negative numbers.
     *
     * @param string $number   The number to parse.
     * @param string $alphabet The alphabet, for example '01' for base 2, or '01234567' for base 8.
     *
<<<<<<< HEAD
     * @throws NumberFormatException    If the given number is empty or contains invalid chars for the given alphabet.
     * @throws InvalidArgumentException If the alphabet does not contain at least 2 chars.
     *
     * @pure
     */
    public static function fromArbitraryBase(string $number, string $alphabet): BigInteger
=======
     * @throws NumberFormatException     If the given number is empty or contains invalid chars for the given alphabet.
     * @throws \InvalidArgumentException If the alphabet does not contain at least 2 chars.
     *
     * @pure
     */
    public static function fromArbitraryBase(string $number, string $alphabet) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($number === '') {
            throw new NumberFormatException('The number cannot be empty.');
        }

<<<<<<< HEAD
        $base = strlen($alphabet);

        if ($base < 2) {
            throw new InvalidArgumentException('The alphabet must contain at least 2 chars.');
        }

        $pattern = '/[^' . preg_quote($alphabet, '/') . ']/';

        if (preg_match($pattern, $number, $matches) === 1) {
=======
        $base = \strlen($alphabet);

        if ($base < 2) {
            throw new \InvalidArgumentException('The alphabet must contain at least 2 chars.');
        }

        $pattern = '/[^' . \preg_quote($alphabet, '/') . ']/';

        if (\preg_match($pattern, $number, $matches) === 1) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            throw NumberFormatException::charNotInAlphabet($matches[0]);
        }

        $number = CalculatorRegistry::get()->fromArbitraryBase($number, $alphabet, $base);

        return new BigInteger($number);
    }

    /**
     * Translates a string of bytes containing the binary representation of a BigInteger into a BigInteger.
     *
     * The input string is assumed to be in big-endian byte-order: the most significant byte is in the zeroth element.
     *
     * If `$signed` is true, the input is assumed to be in two's-complement representation, and the leading bit is
     * interpreted as a sign bit. If `$signed` is false, the input is interpreted as an unsigned number, and the
     * resulting BigInteger will always be positive or zero.
     *
     * This method can be used to retrieve a number exported by `toBytes()`, as long as the `$signed` flags match.
     *
     * @param string $value  The byte string.
     * @param bool   $signed Whether to interpret as a signed number in two's-complement representation with a leading
     *                       sign bit.
     *
     * @throws NumberFormatException If the string is empty.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function fromBytes(string $value, bool $signed = true): BigInteger
=======
    public static function fromBytes(string $value, bool $signed = true) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($value === '') {
            throw new NumberFormatException('The byte string must not be empty.');
        }

        $twosComplement = false;

        if ($signed) {
<<<<<<< HEAD
            $x = ord($value[0]);
=======
            $x = \ord($value[0]);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            if (($twosComplement = ($x >= 0x80))) {
                $value = ~$value;
            }
        }

<<<<<<< HEAD
        $number = self::fromBase(bin2hex($value), 16);
=======
        $number = self::fromBase(\bin2hex($value), 16);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($twosComplement) {
            return $number->plus(1)->negated();
        }

        return $number;
    }

    /**
     * Generates a pseudo-random number in the range 0 to 2^numBits - 1.
     *
     * Using the default random bytes generator, this method is suitable for cryptographic use.
     *
     * @param int                          $numBits              The number of bits.
     * @param (callable(int): string)|null $randomBytesGenerator A function that accepts a number of bytes, and returns
     *                                                           a string of random bytes of the given length. Defaults
     *                                                           to the `random_bytes()` function.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException If $numBits is negative.
     */
    public static function randomBits(int $numBits, ?callable $randomBytesGenerator = null): BigInteger
    {
        if ($numBits < 0) {
            throw new InvalidArgumentException('The number of bits cannot be negative.');
=======
     * @throws \InvalidArgumentException If $numBits is negative.
     */
    public static function randomBits(int $numBits, ?callable $randomBytesGenerator = null) : BigInteger
    {
        if ($numBits < 0) {
            throw new \InvalidArgumentException('The number of bits cannot be negative.');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if ($numBits === 0) {
            return BigInteger::zero();
        }

        if ($randomBytesGenerator === null) {
            $randomBytesGenerator = random_bytes(...);
        }

        /** @var int<1, max> $byteLength */
<<<<<<< HEAD
        $byteLength = intdiv($numBits - 1, 8) + 1;

        $extraBits = ($byteLength * 8 - $numBits);
        $bitmask = chr(0xFF >> $extraBits);

        $randomBytes = $randomBytesGenerator($byteLength);
=======
        $byteLength = \intdiv($numBits - 1, 8) + 1;

        $extraBits = ($byteLength * 8 - $numBits);
        $bitmask   = \chr(0xFF >> $extraBits);

        $randomBytes    = $randomBytesGenerator($byteLength);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $randomBytes[0] = $randomBytes[0] & $bitmask;

        return self::fromBytes($randomBytes, false);
    }

    /**
     * Generates a pseudo-random number between `$min` and `$max`.
     *
     * Using the default random bytes generator, this method is suitable for cryptographic use.
     *
     * @param BigNumber|int|float|string   $min                  The lower bound. Must be convertible to a BigInteger.
     * @param BigNumber|int|float|string   $max                  The upper bound. Must be convertible to a BigInteger.
     * @param (callable(int): string)|null $randomBytesGenerator A function that accepts a number of bytes, and returns
     *                                                           a string of random bytes of the given length. Defaults
     *                                                           to the `random_bytes()` function.
     *
     * @throws MathException If one of the parameters cannot be converted to a BigInteger,
     *                       or `$min` is greater than `$max`.
     */
    public static function randomRange(
        BigNumber|int|float|string $min,
        BigNumber|int|float|string $max,
<<<<<<< HEAD
        ?callable $randomBytesGenerator = null,
    ): BigInteger {
=======
        ?callable $randomBytesGenerator = null
    ) : BigInteger {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $min = BigInteger::of($min);
        $max = BigInteger::of($max);

        if ($min->isGreaterThan($max)) {
            throw new MathException('$min cannot be greater than $max.');
        }

        if ($min->isEqualTo($max)) {
            return $min;
        }

<<<<<<< HEAD
        $diff = $max->minus($min);
=======
        $diff      = $max->minus($min);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $bitLength = $diff->getBitLength();

        // try until the number is in range (50% to 100% chance of success)
        do {
            $randomNumber = self::randomBits($bitLength, $randomBytesGenerator);
        } while ($randomNumber->isGreaterThan($diff));

        return $randomNumber->plus($min);
    }

    /**
     * Returns a BigInteger representing zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function zero(): BigInteger
=======
    public static function zero() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigInteger|null $zero */
        static $zero;

        if ($zero === null) {
            $zero = new BigInteger('0');
        }

        return $zero;
    }

    /**
     * Returns a BigInteger representing one.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function one(): BigInteger
=======
    public static function one() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigInteger|null $one */
        static $one;

        if ($one === null) {
            $one = new BigInteger('1');
        }

        return $one;
    }

    /**
     * Returns a BigInteger representing ten.
     *
     * @pure
     */
<<<<<<< HEAD
    public static function ten(): BigInteger
=======
    public static function ten() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var BigInteger|null $ten */
        static $ten;

        if ($ten === null) {
            $ten = new BigInteger('10');
        }

        return $ten;
    }

    /**
     * @pure
     */
    public static function gcdMultiple(BigInteger $a, BigInteger ...$n): BigInteger
    {
        $result = $a;

        foreach ($n as $next) {
            $result = $result->gcd($next);

            if ($result->isEqualTo(1)) {
                return $result;
            }
        }

        return $result;
    }

    /**
     * Returns the sum of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to add. Must be convertible to a BigInteger.
     *
     * @throws MathException If the number is not valid, or is not convertible to a BigInteger.
     *
     * @pure
     */
<<<<<<< HEAD
    public function plus(BigNumber|int|float|string $that): BigInteger
=======
    public function plus(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '0') {
            return $this;
        }

        if ($this->value === '0') {
            return $that;
        }

        $value = CalculatorRegistry::get()->add($this->value, $that->value);

        return new BigInteger($value);
    }

    /**
     * Returns the difference of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The number to subtract. Must be convertible to a BigInteger.
     *
     * @throws MathException If the number is not valid, or is not convertible to a BigInteger.
     *
     * @pure
     */
<<<<<<< HEAD
    public function minus(BigNumber|int|float|string $that): BigInteger
=======
    public function minus(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '0') {
            return $this;
        }

        $value = CalculatorRegistry::get()->sub($this->value, $that->value);

        return new BigInteger($value);
    }

    /**
     * Returns the product of this number and the given one.
     *
     * @param BigNumber|int|float|string $that The multiplier. Must be convertible to a BigInteger.
     *
     * @throws MathException If the multiplier is not a valid number, or is not convertible to a BigInteger.
     *
     * @pure
     */
<<<<<<< HEAD
    public function multipliedBy(BigNumber|int|float|string $that): BigInteger
=======
    public function multipliedBy(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '1') {
            return $this;
        }

        if ($this->value === '1') {
            return $that;
        }

        $value = CalculatorRegistry::get()->mul($this->value, $that->value);

        return new BigInteger($value);
    }

    /**
     * Returns the result of the division of this number by the given one.
     *
     * @param BigNumber|int|float|string $that         The divisor. Must be convertible to a BigInteger.
     * @param RoundingMode               $roundingMode An optional rounding mode, defaults to UNNECESSARY.
     *
     * @throws MathException If the divisor is not a valid number, is not convertible to a BigInteger, is zero,
     *                       or RoundingMode::UNNECESSARY is used and the remainder is not zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function dividedBy(BigNumber|int|float|string $that, RoundingMode $roundingMode = RoundingMode::UNNECESSARY): BigInteger
=======
    public function dividedBy(BigNumber|int|float|string $that, RoundingMode $roundingMode = RoundingMode::UNNECESSARY) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '1') {
            return $this;
        }

        if ($that->value === '0') {
            throw DivisionByZeroException::divisionByZero();
        }

        $result = CalculatorRegistry::get()->divRound($this->value, $that->value, $roundingMode);

        return new BigInteger($result);
    }

    /**
     * Limits (clamps) this number between the given minimum and maximum values.
     *
     * If the number is lower than $min, returns a copy of $min.
     * If the number is greater than $max, returns a copy of $max.
     * Otherwise, returns this number unchanged.
     *
     * @param BigNumber|int|float|string $min The minimum. Must be convertible to a BigInteger.
     * @param BigNumber|int|float|string $max The maximum. Must be convertible to a BigInteger.
     *
     * @throws MathException If min/max are not convertible to a BigInteger.
     */
<<<<<<< HEAD
    public function clamp(BigNumber|int|float|string $min, BigNumber|int|float|string $max): BigInteger
=======
    public function clamp(BigNumber|int|float|string $min, BigNumber|int|float|string $max) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($this->isLessThan($min)) {
            return BigInteger::of($min);
        } elseif ($this->isGreaterThan($max)) {
            return BigInteger::of($max);
        }
<<<<<<< HEAD

        return $this;
    }

    /**
     * Returns this number exponentiated to the given value.
     *
     * @throws InvalidArgumentException If the exponent is not in the range 0 to 1,000,000.
     *
     * @pure
     */
    public function power(int $exponent): BigInteger
=======
        return $this;
    }


    /**
     * Returns this number exponentiated to the given value.
     *
     * @throws \InvalidArgumentException If the exponent is not in the range 0 to 1,000,000.
     *
     * @pure
     */
    public function power(int $exponent) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($exponent === 0) {
            return BigInteger::one();
        }

        if ($exponent === 1) {
            return $this;
        }

        if ($exponent < 0 || $exponent > Calculator::MAX_POWER) {
<<<<<<< HEAD
            throw new InvalidArgumentException(sprintf(
                'The exponent %d is not in the range 0 to %d.',
                $exponent,
                Calculator::MAX_POWER,
=======
            throw new \InvalidArgumentException(\sprintf(
                'The exponent %d is not in the range 0 to %d.',
                $exponent,
                Calculator::MAX_POWER
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            ));
        }

        return new BigInteger(CalculatorRegistry::get()->pow($this->value, $exponent));
    }

    /**
     * Returns the quotient of the division of this number by the given one.
     *
     * @param BigNumber|int|float|string $that The divisor. Must be convertible to a BigInteger.
     *
     * @throws DivisionByZeroException If the divisor is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function quotient(BigNumber|int|float|string $that): BigInteger
=======
    public function quotient(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '1') {
            return $this;
        }

        if ($that->value === '0') {
            throw DivisionByZeroException::divisionByZero();
        }

        $quotient = CalculatorRegistry::get()->divQ($this->value, $that->value);

        return new BigInteger($quotient);
    }

    /**
     * Returns the remainder of the division of this number by the given one.
     *
     * The remainder, when non-zero, has the same sign as the dividend.
     *
     * @param BigNumber|int|float|string $that The divisor. Must be convertible to a BigInteger.
     *
     * @throws DivisionByZeroException If the divisor is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function remainder(BigNumber|int|float|string $that): BigInteger
=======
    public function remainder(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '1') {
            return BigInteger::zero();
        }

        if ($that->value === '0') {
            throw DivisionByZeroException::divisionByZero();
        }

        $remainder = CalculatorRegistry::get()->divR($this->value, $that->value);

        return new BigInteger($remainder);
    }

    /**
     * Returns the quotient and remainder of the division of this number by the given one.
     *
     * @param BigNumber|int|float|string $that The divisor. Must be convertible to a BigInteger.
     *
     * @return array{BigInteger, BigInteger} An array containing the quotient and the remainder.
     *
     * @throws DivisionByZeroException If the divisor is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function quotientAndRemainder(BigNumber|int|float|string $that): array
=======
    public function quotientAndRemainder(BigNumber|int|float|string $that) : array
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '0') {
            throw DivisionByZeroException::divisionByZero();
        }

        [$quotient, $remainder] = CalculatorRegistry::get()->divQR($this->value, $that->value);

        return [
            new BigInteger($quotient),
<<<<<<< HEAD
            new BigInteger($remainder),
=======
            new BigInteger($remainder)
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        ];
    }

    /**
     * Returns the modulo of this number and the given one.
     *
     * The modulo operation yields the same result as the remainder operation when both operands are of the same sign,
     * and may differ when signs are different.
     *
     * The result of the modulo operation, when non-zero, has the same sign as the divisor.
     *
     * @param BigNumber|int|float|string $that The divisor. Must be convertible to a BigInteger.
     *
     * @throws DivisionByZeroException If the divisor is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function mod(BigNumber|int|float|string $that): BigInteger
=======
    public function mod(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '0') {
            throw DivisionByZeroException::modulusMustNotBeZero();
        }

        $value = CalculatorRegistry::get()->mod($this->value, $that->value);

        return new BigInteger($value);
    }

    /**
     * Returns the modular multiplicative inverse of this BigInteger modulo $m.
     *
     * @throws DivisionByZeroException If $m is zero.
     * @throws NegativeNumberException If $m is negative.
     * @throws MathException           If this BigInteger has no multiplicative inverse mod m (that is, this BigInteger
     *                                 is not relatively prime to m).
     *
     * @pure
     */
<<<<<<< HEAD
    public function modInverse(BigInteger $m): BigInteger
=======
    public function modInverse(BigInteger $m) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($m->value === '0') {
            throw DivisionByZeroException::modulusMustNotBeZero();
        }

        if ($m->isNegative()) {
            throw new NegativeNumberException('Modulus must not be negative.');
        }

        if ($m->value === '1') {
            return BigInteger::zero();
        }

        $value = CalculatorRegistry::get()->modInverse($this->value, $m->value);

        if ($value === null) {
            throw new MathException('Unable to compute the modInverse for the given modulus.');
        }

        return new BigInteger($value);
    }

    /**
     * Returns this number raised into power with modulo.
     *
     * This operation only works on positive numbers.
     *
     * @param BigNumber|int|float|string $exp The exponent. Must be positive or zero.
     * @param BigNumber|int|float|string $mod The modulus. Must be strictly positive.
     *
     * @throws NegativeNumberException If any of the operands is negative.
     * @throws DivisionByZeroException If the modulus is zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function modPow(BigNumber|int|float|string $exp, BigNumber|int|float|string $mod): BigInteger
=======
    public function modPow(BigNumber|int|float|string $exp, BigNumber|int|float|string $mod) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $exp = BigInteger::of($exp);
        $mod = BigInteger::of($mod);

        if ($this->isNegative() || $exp->isNegative() || $mod->isNegative()) {
            throw new NegativeNumberException('The operands cannot be negative.');
        }

        if ($mod->isZero()) {
            throw DivisionByZeroException::modulusMustNotBeZero();
        }

        $result = CalculatorRegistry::get()->modPow($this->value, $exp->value, $mod->value);

        return new BigInteger($result);
    }

    /**
     * Returns the greatest common divisor of this number and the given one.
     *
     * The GCD is always positive, unless both operands are zero, in which case it is zero.
     *
     * @param BigNumber|int|float|string $that The operand. Must be convertible to an integer number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function gcd(BigNumber|int|float|string $that): BigInteger
=======
    public function gcd(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        if ($that->value === '0' && $this->value[0] !== '-') {
            return $this;
        }

        if ($this->value === '0' && $that->value[0] !== '-') {
            return $that;
        }

        $value = CalculatorRegistry::get()->gcd($this->value, $that->value);

        return new BigInteger($value);
    }

    /**
     * Returns the integer square root number of this number, rounded down.
     *
     * The result is the largest x such that x² ≤ n.
     *
     * @throws NegativeNumberException If this number is negative.
     *
     * @pure
     */
<<<<<<< HEAD
    public function sqrt(): BigInteger
=======
    public function sqrt() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($this->value[0] === '-') {
            throw new NegativeNumberException('Cannot calculate the square root of a negative number.');
        }

        $value = CalculatorRegistry::get()->sqrt($this->value);

        return new BigInteger($value);
    }

    /**
     * Returns the absolute value of this number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function abs(): BigInteger
=======
    public function abs() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->isNegative() ? $this->negated() : $this;
    }

    /**
     * Returns the inverse of this number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function negated(): BigInteger
=======
    public function negated() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return new BigInteger(CalculatorRegistry::get()->neg($this->value));
    }

    /**
     * Returns the integer bitwise-and combined with another integer.
     *
     * This method returns a negative BigInteger if and only if both operands are negative.
     *
     * @param BigNumber|int|float|string $that The operand. Must be convertible to an integer number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function and(BigNumber|int|float|string $that): BigInteger
=======
    public function and(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        return new BigInteger(CalculatorRegistry::get()->and($this->value, $that->value));
    }

    /**
     * Returns the integer bitwise-or combined with another integer.
     *
     * This method returns a negative BigInteger if and only if either of the operands is negative.
     *
     * @param BigNumber|int|float|string $that The operand. Must be convertible to an integer number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function or(BigNumber|int|float|string $that): BigInteger
=======
    public function or(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        return new BigInteger(CalculatorRegistry::get()->or($this->value, $that->value));
    }

    /**
     * Returns the integer bitwise-xor combined with another integer.
     *
     * This method returns a negative BigInteger if and only if exactly one of the operands is negative.
     *
     * @param BigNumber|int|float|string $that The operand. Must be convertible to an integer number.
     *
     * @pure
     */
<<<<<<< HEAD
    public function xor(BigNumber|int|float|string $that): BigInteger
=======
    public function xor(BigNumber|int|float|string $that) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigInteger::of($that);

        return new BigInteger(CalculatorRegistry::get()->xor($this->value, $that->value));
    }

    /**
     * Returns the bitwise-not of this BigInteger.
     *
     * @pure
     */
<<<<<<< HEAD
    public function not(): BigInteger
=======
    public function not() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->negated()->minus(1);
    }

    /**
     * Returns the integer left shifted by a given number of bits.
     *
     * @pure
     */
<<<<<<< HEAD
    public function shiftedLeft(int $distance): BigInteger
=======
    public function shiftedLeft(int $distance) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($distance === 0) {
            return $this;
        }

        if ($distance < 0) {
<<<<<<< HEAD
            return $this->shiftedRight(-$distance);
=======
            return $this->shiftedRight(- $distance);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        return $this->multipliedBy(BigInteger::of(2)->power($distance));
    }

    /**
     * Returns the integer right shifted by a given number of bits.
     *
     * @pure
     */
<<<<<<< HEAD
    public function shiftedRight(int $distance): BigInteger
=======
    public function shiftedRight(int $distance) : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($distance === 0) {
            return $this;
        }

        if ($distance < 0) {
<<<<<<< HEAD
            return $this->shiftedLeft(-$distance);
=======
            return $this->shiftedLeft(- $distance);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        $operand = BigInteger::of(2)->power($distance);

        if ($this->isPositiveOrZero()) {
            return $this->quotient($operand);
        }

        return $this->dividedBy($operand, RoundingMode::UP);
    }

    /**
     * Returns the number of bits in the minimal two's-complement representation of this BigInteger, excluding a sign bit.
     *
     * For positive BigIntegers, this is equivalent to the number of bits in the ordinary binary representation.
     * Computes (ceil(log2(this < 0 ? -this : this+1))).
     *
     * @pure
     */
<<<<<<< HEAD
    public function getBitLength(): int
=======
    public function getBitLength() : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($this->value === '0') {
            return 0;
        }

        if ($this->isNegative()) {
            return $this->abs()->minus(1)->getBitLength();
        }

<<<<<<< HEAD
        return strlen($this->toBase(2));
=======
        return \strlen($this->toBase(2));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Returns the index of the rightmost (lowest-order) one bit in this BigInteger.
     *
     * Returns -1 if this BigInteger contains no one bits.
     *
     * @pure
     */
<<<<<<< HEAD
    public function getLowestSetBit(): int
=======
    public function getLowestSetBit() : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $n = $this;
        $bitLength = $this->getBitLength();

        for ($i = 0; $i <= $bitLength; $i++) {
            if ($n->isOdd()) {
                return $i;
            }

            $n = $n->shiftedRight(1);
        }

        return -1;
    }

    /**
     * Returns whether this number is even.
     *
     * @pure
     */
<<<<<<< HEAD
    public function isEven(): bool
    {
        return in_array($this->value[-1], ['0', '2', '4', '6', '8'], true);
=======
    public function isEven() : bool
    {
        return \in_array($this->value[-1], ['0', '2', '4', '6', '8'], true);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Returns whether this number is odd.
     *
     * @pure
     */
<<<<<<< HEAD
    public function isOdd(): bool
    {
        return in_array($this->value[-1], ['1', '3', '5', '7', '9'], true);
=======
    public function isOdd() : bool
    {
        return \in_array($this->value[-1], ['1', '3', '5', '7', '9'], true);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Returns true if and only if the designated bit is set.
     *
     * Computes ((this & (1<<n)) != 0).
     *
     * @param int $n The bit to test, 0-based.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException If the bit to test is negative.
     *
     * @pure
     */
    public function testBit(int $n): bool
    {
        if ($n < 0) {
            throw new InvalidArgumentException('The bit to test cannot be negative.');
=======
     * @throws \InvalidArgumentException If the bit to test is negative.
     *
     * @pure
     */
    public function testBit(int $n) : bool
    {
        if ($n < 0) {
            throw new \InvalidArgumentException('The bit to test cannot be negative.');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        return $this->shiftedRight($n)->isOdd();
    }

    #[Override]
<<<<<<< HEAD
    public function compareTo(BigNumber|int|float|string $that): int
=======
    public function compareTo(BigNumber|int|float|string $that) : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $that = BigNumber::of($that);

        if ($that instanceof BigInteger) {
            return CalculatorRegistry::get()->cmp($this->value, $that->value);
        }

<<<<<<< HEAD
        return -$that->compareTo($this);
    }

    #[Override]
    public function getSign(): int
=======
        return - $that->compareTo($this);
    }

    #[Override]
    public function getSign() : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return ($this->value === '0') ? 0 : (($this->value[0] === '-') ? -1 : 1);
    }

    #[Override]
<<<<<<< HEAD
    public function toBigInteger(): BigInteger
=======
    public function toBigInteger() : BigInteger
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this;
    }

    #[Override]
<<<<<<< HEAD
    public function toBigDecimal(): BigDecimal
=======
    public function toBigDecimal() : BigDecimal
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return self::newBigDecimal($this->value);
    }

    #[Override]
<<<<<<< HEAD
    public function toBigRational(): BigRational
=======
    public function toBigRational() : BigRational
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return self::newBigRational($this, BigInteger::one(), false);
    }

    #[Override]
<<<<<<< HEAD
    public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY): BigDecimal
=======
    public function toScale(int $scale, RoundingMode $roundingMode = RoundingMode::UNNECESSARY) : BigDecimal
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->toBigDecimal()->toScale($scale, $roundingMode);
    }

    #[Override]
<<<<<<< HEAD
    public function toInt(): int
    {
        $intValue = filter_var($this->value, FILTER_VALIDATE_INT);

        if ($intValue === false) {
=======
    public function toInt() : int
    {
        $intValue = (int) $this->value;

        if ($this->value !== (string) $intValue) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            throw IntegerOverflowException::toIntOverflow($this);
        }

        return $intValue;
    }

    #[Override]
<<<<<<< HEAD
    public function toFloat(): float
=======
    public function toFloat() : float
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return (float) $this->value;
    }

    /**
     * Returns a string representation of this number in the given base.
     *
     * The output will always be lowercase for bases greater than 10.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException If the base is out of range.
     *
     * @pure
     */
    public function toBase(int $base): string
=======
     * @throws \InvalidArgumentException If the base is out of range.
     *
     * @pure
     */
    public function toBase(int $base) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($base === 10) {
            return $this->value;
        }

        if ($base < 2 || $base > 36) {
<<<<<<< HEAD
            throw new InvalidArgumentException(sprintf('Base %d is out of range [2, 36]', $base));
=======
            throw new \InvalidArgumentException(\sprintf('Base %d is out of range [2, 36]', $base));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        return CalculatorRegistry::get()->toBase($this->value, $base);
    }

    /**
     * Returns a string representation of this number in an arbitrary base with a custom alphabet.
     *
     * Because this method accepts an alphabet with any character, including dash, it does not handle negative numbers;
     * a NegativeNumberException will be thrown when attempting to call this method on a negative number.
     *
     * @param string $alphabet The alphabet, for example '01' for base 2, or '01234567' for base 8.
     *
<<<<<<< HEAD
     * @throws NegativeNumberException  If this number is negative.
     * @throws InvalidArgumentException If the given alphabet does not contain at least 2 chars.
     *
     * @pure
     */
    public function toArbitraryBase(string $alphabet): string
    {
        $base = strlen($alphabet);

        if ($base < 2) {
            throw new InvalidArgumentException('The alphabet must contain at least 2 chars.');
=======
     * @throws NegativeNumberException   If this number is negative.
     * @throws \InvalidArgumentException If the given alphabet does not contain at least 2 chars.
     *
     * @pure
     */
    public function toArbitraryBase(string $alphabet) : string
    {
        $base = \strlen($alphabet);

        if ($base < 2) {
            throw new \InvalidArgumentException('The alphabet must contain at least 2 chars.');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if ($this->value[0] === '-') {
            throw new NegativeNumberException(__FUNCTION__ . '() does not support negative numbers.');
        }

        return CalculatorRegistry::get()->toArbitraryBase($this->value, $alphabet, $base);
    }

    /**
     * Returns a string of bytes containing the binary representation of this BigInteger.
     *
     * The string is in big-endian byte-order: the most significant byte is in the zeroth element.
     *
     * If `$signed` is true, the output will be in two's-complement representation, and a sign bit will be prepended to
     * the output. If `$signed` is false, no sign bit will be prepended, and this method will throw an exception if the
     * number is negative.
     *
     * The string will contain the minimum number of bytes required to represent this BigInteger, including a sign bit
     * if `$signed` is true.
     *
     * This representation is compatible with the `fromBytes()` factory method, as long as the `$signed` flags match.
     *
     * @param bool $signed Whether to output a signed number in two's-complement representation with a leading sign bit.
     *
     * @throws NegativeNumberException If $signed is false, and the number is negative.
     *
     * @pure
     */
<<<<<<< HEAD
    public function toBytes(bool $signed = true): string
=======
    public function toBytes(bool $signed = true) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if (! $signed && $this->isNegative()) {
            throw new NegativeNumberException('Cannot convert a negative number to a byte string when $signed is false.');
        }

        $hex = $this->abs()->toBase(16);

<<<<<<< HEAD
        if (strlen($hex) % 2 !== 0) {
            $hex = '0' . $hex;
        }

        $baseHexLength = strlen($hex);

        if ($signed) {
            if ($this->isNegative()) {
                $bin = hex2bin($hex);
                assert($bin !== false);

                $hex = bin2hex(~$bin);
                $hex = self::fromBase($hex, 16)->plus(1)->toBase(16);

                $hexLength = strlen($hex);

                if ($hexLength < $baseHexLength) {
                    $hex = str_repeat('0', $baseHexLength - $hexLength) . $hex;
=======
        if (\strlen($hex) % 2 !== 0) {
            $hex = '0' . $hex;
        }

        $baseHexLength = \strlen($hex);

        if ($signed) {
            if ($this->isNegative()) {
                $bin = \hex2bin($hex);
                assert($bin !== false);

                $hex = \bin2hex(~$bin);
                $hex = self::fromBase($hex, 16)->plus(1)->toBase(16);

                $hexLength = \strlen($hex);

                if ($hexLength < $baseHexLength) {
                    $hex = \str_repeat('0', $baseHexLength - $hexLength) . $hex;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                }

                if ($hex[0] < '8') {
                    $hex = 'FF' . $hex;
                }
            } else {
                if ($hex[0] >= '8') {
                    $hex = '00' . $hex;
                }
            }
        }

<<<<<<< HEAD
        $result = hex2bin($hex);
=======
        $result = \hex2bin($hex);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        assert($result !== false);

        return $result;
    }

    /**
     * @return numeric-string
     */
    #[Override]
<<<<<<< HEAD
    public function __toString(): string
=======
    public function __toString() : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /** @var numeric-string */
        return $this->value;
    }

    /**
     * This method is required for serializing the object and SHOULD NOT be accessed directly.
     *
     * @internal
     *
     * @return array{value: string}
     */
    public function __serialize(): array
    {
        return ['value' => $this->value];
    }

    /**
     * This method is only here to allow unserializing the object and cannot be accessed directly.
     *
     * @internal
     *
     * @param array{value: string} $data
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
        if (isset($this->value)) {
<<<<<<< HEAD
            throw new LogicException('__unserialize() is an internal function, it must not be called directly.');
=======
            throw new \LogicException('__unserialize() is an internal function, it must not be called directly.');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        /** @phpstan-ignore deadCode.unreachable */
        $this->value = $data['value'];
    }
<<<<<<< HEAD

    #[Override]
    protected static function from(BigNumber $number): static
    {
        return $number->toBigInteger();
    }
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
}
