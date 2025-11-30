<?php

declare(strict_types=1);

namespace Brick\Math\Internal;

use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Math\RoundingMode;

<<<<<<< HEAD
use function chr;
use function ltrim;
use function ord;
use function str_repeat;
use function strlen;
use function strpos;
use function strrev;
use function strtolower;
use function substr;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * Performs basic operations on arbitrary size integers.
 *
 * Unless otherwise specified, all parameters must be validated as non-empty strings of digits,
 * without leading zero, and with an optional leading minus sign if the number is not zero.
 *
 * Any other parameter format will lead to undefined behaviour.
 * All methods must return strings respecting this format, unless specified otherwise.
 *
 * @internal
 */
abstract readonly class Calculator
{
    /**
     * The maximum exponent value allowed for the pow() method.
     */
    public const MAX_POWER = 1_000_000;

    /**
     * The alphabet for converting from and to base 2 to 36, lowercase.
     */
    public const ALPHABET = '0123456789abcdefghijklmnopqrstuvwxyz';

    /**
<<<<<<< HEAD
=======
     * Extracts the sign & digits of the operands.
     *
     * @return array{bool, bool, string, string} Whether $a and $b are negative, followed by their digits.
     *
     * @pure
     */
    final protected function init(string $a, string $b) : array
    {
        return [
            $aNeg = ($a[0] === '-'),
            $bNeg = ($b[0] === '-'),

            $aNeg ? \substr($a, 1) : $a,
            $bNeg ? \substr($b, 1) : $b,
        ];
    }

    /**
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * Returns the absolute value of a number.
     *
     * @pure
     */
<<<<<<< HEAD
    final public function abs(string $n): string
    {
        return ($n[0] === '-') ? substr($n, 1) : $n;
=======
    final public function abs(string $n) : string
    {
        return ($n[0] === '-') ? \substr($n, 1) : $n;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Negates a number.
     *
     * @pure
     */
<<<<<<< HEAD
    final public function neg(string $n): string
=======
    final public function neg(string $n) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($n === '0') {
            return '0';
        }

        if ($n[0] === '-') {
<<<<<<< HEAD
            return substr($n, 1);
=======
            return \substr($n, 1);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        return '-' . $n;
    }

    /**
     * Compares two numbers.
     *
     * Returns -1 if the first number is less than, 0 if equal to, 1 if greater than the second number.
     *
     * @return -1|0|1
     *
     * @pure
     */
<<<<<<< HEAD
    final public function cmp(string $a, string $b): int
=======
    final public function cmp(string $a, string $b) : int
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        [$aNeg, $bNeg, $aDig, $bDig] = $this->init($a, $b);

        if ($aNeg && ! $bNeg) {
            return -1;
        }

        if ($bNeg && ! $aNeg) {
            return 1;
        }

<<<<<<< HEAD
        $aLen = strlen($aDig);
        $bLen = strlen($bDig);
=======
        $aLen = \strlen($aDig);
        $bLen = \strlen($bDig);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($aLen < $bLen) {
            $result = -1;
        } elseif ($aLen > $bLen) {
            $result = 1;
        } else {
            $result = $aDig <=> $bDig;
        }

        return $aNeg ? -$result : $result;
    }

    /**
     * Adds two numbers.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function add(string $a, string $b): string;
=======
    abstract public function add(string $a, string $b) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Subtracts two numbers.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function sub(string $a, string $b): string;
=======
    abstract public function sub(string $a, string $b) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Multiplies two numbers.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function mul(string $a, string $b): string;
=======
    abstract public function mul(string $a, string $b) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Returns the quotient of the division of two numbers.
     *
     * @param string $a The dividend.
     * @param string $b The divisor, must not be zero.
     *
     * @return string The quotient.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function divQ(string $a, string $b): string;
=======
    abstract public function divQ(string $a, string $b) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Returns the remainder of the division of two numbers.
     *
     * @param string $a The dividend.
     * @param string $b The divisor, must not be zero.
     *
     * @return string The remainder.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function divR(string $a, string $b): string;
=======
    abstract public function divR(string $a, string $b) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Returns the quotient and remainder of the division of two numbers.
     *
     * @param string $a The dividend.
     * @param string $b The divisor, must not be zero.
     *
     * @return array{string, string} An array containing the quotient and remainder.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function divQR(string $a, string $b): array;
=======
    abstract public function divQR(string $a, string $b) : array;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Exponentiates a number.
     *
     * @param string $a The base number.
     * @param int    $e The exponent, validated as an integer between 0 and MAX_POWER.
     *
     * @return string The power.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function pow(string $a, int $e): string;
=======
    abstract public function pow(string $a, int $e) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * @param string $b The modulus; must not be zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function mod(string $a, string $b): string
=======
    public function mod(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->divR($this->add($this->divR($a, $b), $b), $b);
    }

    /**
     * Returns the modular multiplicative inverse of $x modulo $m.
     *
     * If $x has no multiplicative inverse mod m, this method must return null.
     *
     * This method can be overridden by the concrete implementation if the underlying library has built-in support.
     *
     * @param string $m The modulus; must not be negative or zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function modInverse(string $x, string $m): ?string
=======
    public function modInverse(string $x, string $m) : ?string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($m === '1') {
            return '0';
        }

        $modVal = $x;

        if ($x[0] === '-' || ($this->cmp($this->abs($x), $m) >= 0)) {
            $modVal = $this->mod($x, $m);
        }

        [$g, $x] = $this->gcdExtended($modVal, $m);

        if ($g !== '1') {
            return null;
        }

        return $this->mod($this->add($this->mod($x, $m), $m), $m);
    }

    /**
     * Raises a number into power with modulo.
     *
     * @param string $base The base number; must be positive or zero.
     * @param string $exp  The exponent; must be positive or zero.
     * @param string $mod  The modulus; must be strictly positive.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function modPow(string $base, string $exp, string $mod): string;
=======
    abstract public function modPow(string $base, string $exp, string $mod) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Returns the greatest common divisor of the two numbers.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for GCD calculations.
     *
     * @return string The GCD, always positive, or zero if both arguments are zero.
     *
     * @pure
     */
<<<<<<< HEAD
    public function gcd(string $a, string $b): string
=======
    public function gcd(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($a === '0') {
            return $this->abs($b);
        }

        if ($b === '0') {
            return $this->abs($a);
        }

        return $this->gcd($b, $this->divR($a, $b));
    }

    /**
<<<<<<< HEAD
=======
     * @return array{string, string, string} GCD, X, Y
     *
     * @pure
     */
    private function gcdExtended(string $a, string $b) : array
    {
        if ($a === '0') {
            return [$b, '0', '1'];
        }

        [$gcd, $x1, $y1] = $this->gcdExtended($this->mod($b, $a), $a);

        $x = $this->sub($y1, $this->mul($this->divQ($b, $a), $x1));
        $y = $x1;

        return [$gcd, $x, $y];
    }

    /**
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * Returns the square root of the given number, rounded down.
     *
     * The result is the largest x such that x² ≤ n.
     * The input MUST NOT be negative.
     *
     * @pure
     */
<<<<<<< HEAD
    abstract public function sqrt(string $n): string;
=======
    abstract public function sqrt(string $n) : string;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Converts a number from an arbitrary base.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for base conversion.
     *
     * @param string $number The number, positive or zero, non-empty, case-insensitively validated for the given base.
     * @param int    $base   The base of the number, validated from 2 to 36.
     *
     * @return string The converted number, following the Calculator conventions.
     *
     * @pure
     */
<<<<<<< HEAD
    public function fromBase(string $number, int $base): string
    {
        return $this->fromArbitraryBase(strtolower($number), self::ALPHABET, $base);
=======
    public function fromBase(string $number, int $base) : string
    {
        return $this->fromArbitraryBase(\strtolower($number), self::ALPHABET, $base);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Converts a number to an arbitrary base.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for base conversion.
     *
     * @param string $number The number to convert, following the Calculator conventions.
     * @param int    $base   The base to convert to, validated from 2 to 36.
     *
     * @return string The converted number, lowercase.
     *
     * @pure
     */
<<<<<<< HEAD
    public function toBase(string $number, int $base): string
=======
    public function toBase(string $number, int $base) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $negative = ($number[0] === '-');

        if ($negative) {
<<<<<<< HEAD
            $number = substr($number, 1);
=======
            $number = \substr($number, 1);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        $number = $this->toArbitraryBase($number, self::ALPHABET, $base);

        if ($negative) {
            return '-' . $number;
        }

        return $number;
    }

    /**
     * Converts a non-negative number in an arbitrary base using a custom alphabet, to base 10.
     *
     * @param string $number   The number to convert, validated as a non-empty string,
     *                         containing only chars in the given alphabet/base.
     * @param string $alphabet The alphabet that contains every digit, validated as 2 chars minimum.
     * @param int    $base     The base of the number, validated from 2 to alphabet length.
     *
     * @return string The number in base 10, following the Calculator conventions.
     *
     * @pure
     */
<<<<<<< HEAD
    final public function fromArbitraryBase(string $number, string $alphabet, int $base): string
    {
        // remove leading "zeros"
        $number = ltrim($number, $alphabet[0]);
=======
    final public function fromArbitraryBase(string $number, string $alphabet, int $base) : string
    {
        // remove leading "zeros"
        $number = \ltrim($number, $alphabet[0]);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($number === '') {
            return '0';
        }

        // optimize for "one"
        if ($number === $alphabet[1]) {
            return '1';
        }

        $result = '0';
        $power = '1';

        $base = (string) $base;

<<<<<<< HEAD
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $index = strpos($alphabet, $number[$i]);

            if ($index !== 0) {
                $result = $this->add(
                    $result,
                    ($index === 1) ? $power : $this->mul($power, (string) $index),
=======
        for ($i = \strlen($number) - 1; $i >= 0; $i--) {
            $index = \strpos($alphabet, $number[$i]);

            if ($index !== 0) {
                $result = $this->add($result, ($index === 1)
                    ? $power
                    : $this->mul($power, (string) $index)
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                );
            }

            if ($i !== 0) {
                $power = $this->mul($power, $base);
            }
        }

        return $result;
    }

    /**
     * Converts a non-negative number to an arbitrary base using a custom alphabet.
     *
     * @param string $number   The number to convert, positive or zero, following the Calculator conventions.
     * @param string $alphabet The alphabet that contains every digit, validated as 2 chars minimum.
     * @param int    $base     The base to convert to, validated from 2 to alphabet length.
     *
     * @return string The converted number in the given alphabet.
     *
     * @pure
     */
<<<<<<< HEAD
    final public function toArbitraryBase(string $number, string $alphabet, int $base): string
=======
    final public function toArbitraryBase(string $number, string $alphabet, int $base) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($number === '0') {
            return $alphabet[0];
        }

        $base = (string) $base;
        $result = '';

        while ($number !== '0') {
            [$number, $remainder] = $this->divQR($number, $base);
            $remainder = (int) $remainder;

            $result .= $alphabet[$remainder];
        }

<<<<<<< HEAD
        return strrev($result);
=======
        return \strrev($result);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Performs a rounded division.
     *
     * Rounding is performed when the remainder of the division is not zero.
     *
     * @param string       $a            The dividend.
     * @param string       $b            The divisor, must not be zero.
     * @param RoundingMode $roundingMode The rounding mode.
     *
     * @throws RoundingNecessaryException If RoundingMode::UNNECESSARY is provided but rounding is necessary.
     *
     * @pure
     */
<<<<<<< HEAD
    final public function divRound(string $a, string $b, RoundingMode $roundingMode): string
=======
    final public function divRound(string $a, string $b, RoundingMode $roundingMode) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        [$quotient, $remainder] = $this->divQR($a, $b);

        $hasDiscardedFraction = ($remainder !== '0');
        $isPositiveOrZero = ($a[0] === '-') === ($b[0] === '-');

<<<<<<< HEAD
        $discardedFractionSign = function () use ($remainder, $b): int {
=======
        $discardedFractionSign = function() use ($remainder, $b) : int {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $r = $this->abs($this->mul($remainder, '2'));
            $b = $this->abs($b);

            return $this->cmp($r, $b);
        };

        $increment = false;

        switch ($roundingMode) {
            case RoundingMode::UNNECESSARY:
                if ($hasDiscardedFraction) {
                    throw RoundingNecessaryException::roundingNecessary();
                }
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::UP:
                $increment = $hasDiscardedFraction;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::DOWN:
                break;

            case RoundingMode::CEILING:
                $increment = $hasDiscardedFraction && $isPositiveOrZero;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::FLOOR:
                $increment = $hasDiscardedFraction && ! $isPositiveOrZero;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::HALF_UP:
                $increment = $discardedFractionSign() >= 0;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::HALF_DOWN:
                $increment = $discardedFractionSign() > 0;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::HALF_CEILING:
                $increment = $isPositiveOrZero ? $discardedFractionSign() >= 0 : $discardedFractionSign() > 0;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::HALF_FLOOR:
                $increment = $isPositiveOrZero ? $discardedFractionSign() > 0 : $discardedFractionSign() >= 0;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;

            case RoundingMode::HALF_EVEN:
                $lastDigit = (int) $quotient[-1];
                $lastDigitIsEven = ($lastDigit % 2 === 0);
                $increment = $lastDigitIsEven ? $discardedFractionSign() > 0 : $discardedFractionSign() >= 0;
<<<<<<< HEAD

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;
        }

        if ($increment) {
            return $this->add($quotient, $isPositiveOrZero ? '1' : '-1');
        }

        return $quotient;
    }

    /**
     * Calculates bitwise AND of two numbers.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for bitwise operations.
     *
     * @pure
     */
<<<<<<< HEAD
    public function and(string $a, string $b): string
=======
    public function and(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->bitwise('and', $a, $b);
    }

    /**
     * Calculates bitwise OR of two numbers.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for bitwise operations.
     *
     * @pure
     */
<<<<<<< HEAD
    public function or(string $a, string $b): string
=======
    public function or(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->bitwise('or', $a, $b);
    }

    /**
     * Calculates bitwise XOR of two numbers.
     *
     * This method can be overridden by the concrete implementation if the underlying library
     * has built-in support for bitwise operations.
     *
     * @pure
     */
<<<<<<< HEAD
    public function xor(string $a, string $b): string
=======
    public function xor(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->bitwise('xor', $a, $b);
    }

    /**
<<<<<<< HEAD
     * Extracts the sign & digits of the operands.
     *
     * @return array{bool, bool, string, string} Whether $a and $b are negative, followed by their digits.
     *
     * @pure
     */
    final protected function init(string $a, string $b): array
    {
        return [
            $aNeg = ($a[0] === '-'),
            $bNeg = ($b[0] === '-'),

            $aNeg ? substr($a, 1) : $a,
            $bNeg ? substr($b, 1) : $b,
        ];
    }

    /**
     * @return array{string, string, string} GCD, X, Y
     *
     * @pure
     */
    private function gcdExtended(string $a, string $b): array
    {
        if ($a === '0') {
            return [$b, '0', '1'];
        }

        [$gcd, $x1, $y1] = $this->gcdExtended($this->mod($b, $a), $a);

        $x = $this->sub($y1, $this->mul($this->divQ($b, $a), $x1));
        $y = $x1;

        return [$gcd, $x, $y];
    }

    /**
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * Performs a bitwise operation on a decimal number.
     *
     * @param 'and'|'or'|'xor' $operator The operator to use.
     * @param string           $a        The left operand.
     * @param string           $b        The right operand.
     *
     * @pure
     */
<<<<<<< HEAD
    private function bitwise(string $operator, string $a, string $b): string
=======
    private function bitwise(string $operator, string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        [$aNeg, $bNeg, $aDig, $bDig] = $this->init($a, $b);

        $aBin = $this->toBinary($aDig);
        $bBin = $this->toBinary($bDig);

<<<<<<< HEAD
        $aLen = strlen($aBin);
        $bLen = strlen($bBin);

        if ($aLen > $bLen) {
            $bBin = str_repeat("\x00", $aLen - $bLen) . $bBin;
        } elseif ($bLen > $aLen) {
            $aBin = str_repeat("\x00", $bLen - $aLen) . $aBin;
=======
        $aLen = \strlen($aBin);
        $bLen = \strlen($bBin);

        if ($aLen > $bLen) {
            $bBin = \str_repeat("\x00", $aLen - $bLen) . $bBin;
        } elseif ($bLen > $aLen) {
            $aBin = \str_repeat("\x00", $bLen - $aLen) . $aBin;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if ($aNeg) {
            $aBin = $this->twosComplement($aBin);
        }
        if ($bNeg) {
            $bBin = $this->twosComplement($bBin);
        }

        $value = match ($operator) {
            'and' => $aBin & $bBin,
            'or' => $aBin | $bBin,
            'xor' => $aBin ^ $bBin,
        };

        $negative = match ($operator) {
            'and' => $aNeg and $bNeg,
            'or' => $aNeg or $bNeg,
            'xor' => $aNeg xor $bNeg,
        };

        if ($negative) {
            $value = $this->twosComplement($value);
        }

        $result = $this->toDecimal($value);

        return $negative ? $this->neg($result) : $result;
    }

    /**
     * @param string $number A positive, binary number.
     *
     * @pure
     */
<<<<<<< HEAD
    private function twosComplement(string $number): string
    {
        $xor = str_repeat("\xff", strlen($number));

        $number ^= $xor;

        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $byte = ord($number[$i]);

            if (++$byte !== 256) {
                $number[$i] = chr($byte);

=======
    private function twosComplement(string $number) : string
    {
        $xor = \str_repeat("\xff", \strlen($number));

        $number ^= $xor;

        for ($i = \strlen($number) - 1; $i >= 0; $i--) {
            $byte = \ord($number[$i]);

            if (++$byte !== 256) {
                $number[$i] = \chr($byte);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                break;
            }

            $number[$i] = "\x00";

            if ($i === 0) {
                $number = "\x01" . $number;
            }
        }

        return $number;
    }

    /**
     * Converts a decimal number to a binary string.
     *
     * @param string $number The number to convert, positive or zero, only digits.
     *
     * @pure
     */
<<<<<<< HEAD
    private function toBinary(string $number): string
=======
    private function toBinary(string $number) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $result = '';

        while ($number !== '0') {
            [$number, $remainder] = $this->divQR($number, '256');
<<<<<<< HEAD
            $result .= chr((int) $remainder);
        }

        return strrev($result);
=======
            $result .= \chr((int) $remainder);
        }

        return \strrev($result);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Returns the positive decimal representation of a binary number.
     *
     * @param string $bytes The bytes representing the number.
     *
     * @pure
     */
<<<<<<< HEAD
    private function toDecimal(string $bytes): string
=======
    private function toDecimal(string $bytes) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $result = '0';
        $power = '1';

<<<<<<< HEAD
        for ($i = strlen($bytes) - 1; $i >= 0; $i--) {
            $index = ord($bytes[$i]);

            if ($index !== 0) {
                $result = $this->add(
                    $result,
                    ($index === 1) ? $power : $this->mul($power, (string) $index),
=======
        for ($i = \strlen($bytes) - 1; $i >= 0; $i--) {
            $index = \ord($bytes[$i]);

            if ($index !== 0) {
                $result = $this->add($result, ($index === 1)
                    ? $power
                    : $this->mul($power, (string) $index)
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                );
            }

            if ($i !== 0) {
                $power = $this->mul($power, '256');
            }
        }

        return $result;
    }
}
