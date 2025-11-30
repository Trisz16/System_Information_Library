<?php

declare(strict_types=1);

namespace Brick\Math\Internal\Calculator;

use Brick\Math\Internal\Calculator;
use Override;

<<<<<<< HEAD
use function assert;
use function in_array;
use function intdiv;
use function is_int;
use function ltrim;
use function str_pad;
use function str_repeat;
use function strcmp;
use function strlen;
use function substr;

use const PHP_INT_SIZE;
use const STR_PAD_LEFT;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * Calculator implementation using only native PHP code.
 *
 * @internal
 */
final readonly class NativeCalculator extends Calculator
{
    /**
     * The max number of digits the platform can natively add, subtract, multiply or divide without overflow.
     * For multiplication, this represents the max sum of the lengths of both operands.
     *
     * In addition, it is assumed that an extra digit can hold a carry (1) without overflowing.
     * Example: 32-bit: max number 1,999,999,999 (9 digits + carry)
     *          64-bit: max number 1,999,999,999,999,999,999 (18 digits + carry)
     */
    private int $maxDigits;

    /**
     * @pure
<<<<<<< HEAD
     *
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->maxDigits = match (PHP_INT_SIZE) {
            4 => 9,
            8 => 18,
        };
    }

    #[Override]
<<<<<<< HEAD
    public function add(string $a, string $b): string
=======
    public function add(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /**
         * @var numeric-string $a
         * @var numeric-string $b
         */
        $result = $a + $b;

        if (is_int($result)) {
            return (string) $result;
        }

        if ($a === '0') {
            return $b;
        }

        if ($b === '0') {
            return $a;
        }

        [$aNeg, $bNeg, $aDig, $bDig] = $this->init($a, $b);

        $result = $aNeg === $bNeg ? $this->doAdd($aDig, $bDig) : $this->doSub($aDig, $bDig);

        if ($aNeg) {
            $result = $this->neg($result);
        }

        return $result;
    }

    #[Override]
<<<<<<< HEAD
    public function sub(string $a, string $b): string
=======
    public function sub(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->add($a, $this->neg($b));
    }

    #[Override]
<<<<<<< HEAD
    public function mul(string $a, string $b): string
=======
    public function mul(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        /**
         * @var numeric-string $a
         * @var numeric-string $b
         */
        $result = $a * $b;

        if (is_int($result)) {
            return (string) $result;
        }

        if ($a === '0' || $b === '0') {
            return '0';
        }

        if ($a === '1') {
            return $b;
        }

        if ($b === '1') {
            return $a;
        }

        if ($a === '-1') {
            return $this->neg($b);
        }

        if ($b === '-1') {
            return $this->neg($a);
        }

        [$aNeg, $bNeg, $aDig, $bDig] = $this->init($a, $b);

        $result = $this->doMul($aDig, $bDig);

        if ($aNeg !== $bNeg) {
            $result = $this->neg($result);
        }

        return $result;
    }

    #[Override]
<<<<<<< HEAD
    public function divQ(string $a, string $b): string
=======
    public function divQ(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        return $this->divQR($a, $b)[0];
    }

    #[Override]
    public function divR(string $a, string $b): string
    {
        return $this->divQR($a, $b)[1];
    }

    #[Override]
<<<<<<< HEAD
    public function divQR(string $a, string $b): array
=======
    public function divQR(string $a, string $b) : array
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($a === '0') {
            return ['0', '0'];
        }

        if ($a === $b) {
            return ['1', '0'];
        }

        if ($b === '1') {
            return [$a, '0'];
        }

        if ($b === '-1') {
            return [$this->neg($a), '0'];
        }

        /** @var numeric-string $a */
        $na = $a * 1; // cast to number

        if (is_int($na)) {
            /** @var numeric-string $b */
            $nb = $b * 1;

            if (is_int($nb)) {
                // the only division that may overflow is PHP_INT_MIN / -1,
                // which cannot happen here as we've already handled a divisor of -1 above.
                $q = intdiv($na, $nb);
                $r = $na % $nb;

                return [
                    (string) $q,
<<<<<<< HEAD
                    (string) $r,
=======
                    (string) $r
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                ];
            }
        }

        [$aNeg, $bNeg, $aDig, $bDig] = $this->init($a, $b);

        [$q, $r] = $this->doDiv($aDig, $bDig);

        if ($aNeg !== $bNeg) {
            $q = $this->neg($q);
        }

        if ($aNeg) {
            $r = $this->neg($r);
        }

        return [$q, $r];
    }

    #[Override]
<<<<<<< HEAD
    public function pow(string $a, int $e): string
=======
    public function pow(string $a, int $e) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($e === 0) {
            return '1';
        }

        if ($e === 1) {
            return $a;
        }

        $odd = $e % 2;
        $e -= $odd;

        $aa = $this->mul($a, $a);

        $result = $this->pow($aa, $e / 2);

        if ($odd === 1) {
            $result = $this->mul($result, $a);
        }

        return $result;
    }

    /**
<<<<<<< HEAD
     * Algorithm from: https://www.geeksforgeeks.org/modular-exponentiation-power-in-modular-arithmetic/.
     */
    #[Override]
    public function modPow(string $base, string $exp, string $mod): string
=======
     * Algorithm from: https://www.geeksforgeeks.org/modular-exponentiation-power-in-modular-arithmetic/
     */
    #[Override]
    public function modPow(string $base, string $exp, string $mod) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        // special case: the algorithm below fails with 0 power 0 mod 1 (returns 1 instead of 0)
        if ($base === '0' && $exp === '0' && $mod === '1') {
            return '0';
        }

        // special case: the algorithm below fails with power 0 mod 1 (returns 1 instead of 0)
        if ($exp === '0' && $mod === '1') {
            return '0';
        }

        $x = $base;

        $res = '1';

        // numbers are positive, so we can use remainder instead of modulo
        $x = $this->divR($x, $mod);

        while ($exp !== '0') {
            if (in_array($exp[-1], ['1', '3', '5', '7', '9'])) { // odd
                $res = $this->divR($this->mul($res, $x), $mod);
            }

            $exp = $this->divQ($exp, '2');
            $x = $this->divR($this->mul($x, $x), $mod);
        }

        return $res;
    }

    /**
<<<<<<< HEAD
     * Adapted from https://cp-algorithms.com/num_methods/roots_newton.html.
     */
    #[Override]
    public function sqrt(string $n): string
=======
     * Adapted from https://cp-algorithms.com/num_methods/roots_newton.html
     */
    #[Override]
    public function sqrt(string $n) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($n === '0') {
            return '0';
        }

        // initial approximation
<<<<<<< HEAD
        $x = str_repeat('9', intdiv(strlen($n), 2) ?: 1);

        $decreased = false;

        for (; ;) {
=======
        $x = \str_repeat('9', \intdiv(\strlen($n), 2) ?: 1);

        $decreased = false;

        for (;;) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $nx = $this->divQ($this->add($x, $this->divQ($n, $x)), '2');

            if ($x === $nx || $this->cmp($nx, $x) > 0 && $decreased) {
                break;
            }

            $decreased = $this->cmp($nx, $x) < 0;
            $x = $nx;
        }

        return $x;
    }

    /**
     * Performs the addition of two non-signed large integers.
     *
     * @pure
     */
<<<<<<< HEAD
    private function doAdd(string $a, string $b): string
=======
    private function doAdd(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        [$a, $b, $length] = $this->pad($a, $b);

        $carry = 0;
        $result = '';

<<<<<<< HEAD
        for ($i = $length - $this->maxDigits; ; $i -= $this->maxDigits) {
=======
        for ($i = $length - $this->maxDigits;; $i -= $this->maxDigits) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $blockLength = $this->maxDigits;

            if ($i < 0) {
                $blockLength += $i;
                $i = 0;
            }

            /** @var numeric-string $blockA */
<<<<<<< HEAD
            $blockA = substr($a, $i, $blockLength);

            /** @var numeric-string $blockB */
            $blockB = substr($b, $i, $blockLength);

            $sum = (string) ($blockA + $blockB + $carry);
            $sumLength = strlen($sum);

            if ($sumLength > $blockLength) {
                $sum = substr($sum, 1);
                $carry = 1;
            } else {
                if ($sumLength < $blockLength) {
                    $sum = str_repeat('0', $blockLength - $sumLength) . $sum;
=======
            $blockA = \substr($a, $i, $blockLength);

            /** @var numeric-string $blockB */
            $blockB = \substr($b, $i, $blockLength);

            $sum = (string) ($blockA + $blockB + $carry);
            $sumLength = \strlen($sum);

            if ($sumLength > $blockLength) {
                $sum = \substr($sum, 1);
                $carry = 1;
            } else {
                if ($sumLength < $blockLength) {
                    $sum = \str_repeat('0', $blockLength - $sumLength) . $sum;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                }
                $carry = 0;
            }

            $result = $sum . $result;

            if ($i === 0) {
                break;
            }
        }

        if ($carry === 1) {
            $result = '1' . $result;
        }

        return $result;
    }

    /**
     * Performs the subtraction of two non-signed large integers.
     *
     * @pure
     */
<<<<<<< HEAD
    private function doSub(string $a, string $b): string
=======
    private function doSub(string $a, string $b) : string
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        if ($a === $b) {
            return '0';
        }

        // Ensure that we always subtract to a positive result: biggest minus smallest.
        $cmp = $this->doCmp($a, $b);

        $invert = ($cmp === -1);

        if ($invert) {
            $c = $a;
            $a = $b;
            $b = $c;
        }

        [$a, $b, $length] = $this->pad($a, $b);

        $carry = 0;
        $result = '';

        $complement = 10 ** $this->maxDigits;

<<<<<<< HEAD
        for ($i = $length - $this->maxDigits; ; $i -= $this->maxDigits) {
=======
        for ($i = $length - $this->maxDigits;; $i -= $this->maxDigits) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $blockLength = $this->maxDigits;

            if ($i < 0) {
                $blockLength += $i;
                $i = 0;
            }

            /** @var numeric-string $blockA */
<<<<<<< HEAD
            $blockA = substr($a, $i, $blockLength);

            /** @var numeric-string $blockB */
            $blockB = substr($b, $i, $blockLength);
=======
            $blockA = \substr($a, $i, $blockLength);

            /** @var numeric-string $blockB */
            $blockB = \substr($b, $i, $blockLength);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            $sum = $blockA - $blockB - $carry;

            if ($sum < 0) {
                $sum += $complement;
                $carry = 1;
            } else {
                $carry = 0;
            }

            $sum = (string) $sum;
<<<<<<< HEAD
            $sumLength = strlen($sum);

            if ($sumLength < $blockLength) {
                $sum = str_repeat('0', $blockLength - $sumLength) . $sum;
=======
            $sumLength = \strlen($sum);

            if ($sumLength < $blockLength) {
                $sum = \str_repeat('0', $blockLength - $sumLength) . $sum;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            }

            $result = $sum . $result;

            if ($i === 0) {
                break;
            }
        }

        // Carry cannot be 1 when the loop ends, as a > b
        assert($carry === 0);

<<<<<<< HEAD
        $result = ltrim($result, '0');
=======
        $result = \ltrim($result, '0');
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($invert) {
            $result = $this->neg($result);
        }

        return $result;
    }

    /**
     * Performs the multiplication of two non-signed large integers.
     *
     * @pure
     */
<<<<<<< HEAD
    private function doMul(string $a, string $b): string
    {
        $x = strlen($a);
        $y = strlen($b);

        $maxDigits = intdiv($this->maxDigits, 2);
=======
    private function doMul(string $a, string $b) : string
    {
        $x = \strlen($a);
        $y = \strlen($b);

        $maxDigits = \intdiv($this->maxDigits, 2);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $complement = 10 ** $maxDigits;

        $result = '0';

<<<<<<< HEAD
        for ($i = $x - $maxDigits; ; $i -= $maxDigits) {
=======
        for ($i = $x - $maxDigits;; $i -= $maxDigits) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
            $blockALength = $maxDigits;

            if ($i < 0) {
                $blockALength += $i;
                $i = 0;
            }

<<<<<<< HEAD
            $blockA = (int) substr($a, $i, $blockALength);
=======
            $blockA = (int) \substr($a, $i, $blockALength);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            $line = '';
            $carry = 0;

<<<<<<< HEAD
            for ($j = $y - $maxDigits; ; $j -= $maxDigits) {
=======
            for ($j = $y - $maxDigits;; $j -= $maxDigits) {
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                $blockBLength = $maxDigits;

                if ($j < 0) {
                    $blockBLength += $j;
                    $j = 0;
                }

<<<<<<< HEAD
                $blockB = (int) substr($b, $j, $blockBLength);
=======
                $blockB = (int) \substr($b, $j, $blockBLength);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

                $mul = $blockA * $blockB + $carry;
                $value = $mul % $complement;
                $carry = ($mul - $value) / $complement;

                $value = (string) $value;
<<<<<<< HEAD
                $value = str_pad($value, $maxDigits, '0', STR_PAD_LEFT);
=======
                $value = \str_pad($value, $maxDigits, '0', STR_PAD_LEFT);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

                $line = $value . $line;

                if ($j === 0) {
                    break;
                }
            }

            if ($carry !== 0) {
                $line = $carry . $line;
            }

<<<<<<< HEAD
            $line = ltrim($line, '0');

            if ($line !== '') {
                $line .= str_repeat('0', $x - $blockALength - $i);
=======
            $line = \ltrim($line, '0');

            if ($line !== '') {
                $line .= \str_repeat('0', $x - $blockALength - $i);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
                $result = $this->add($result, $line);
            }

            if ($i === 0) {
                break;
            }
        }

        return $result;
    }

    /**
     * Performs the division of two non-signed large integers.
     *
     * @return string[] The quotient and remainder.
     *
     * @pure
     */
<<<<<<< HEAD
    private function doDiv(string $a, string $b): array
=======
    private function doDiv(string $a, string $b) : array
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    {
        $cmp = $this->doCmp($a, $b);

        if ($cmp === -1) {
            return ['0', $a];
        }

<<<<<<< HEAD
        $x = strlen($a);
        $y = strlen($b);
=======
        $x = \strlen($a);
        $y = \strlen($b);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        // we now know that a >= b && x >= y

        $q = '0'; // quotient
        $r = $a; // remainder
        $z = $y; // focus length, always $y or $y+1

        /** @var numeric-string $b */
        $nb = $b * 1; // cast to number
        // performance optimization in cases where the remainder will never cause int overflow
        if (is_int(($nb - 1) * 10 + 9)) {
<<<<<<< HEAD
            $r = (int) substr($a, 0, $z - 1);
=======
            $r = (int) \substr($a, 0, $z - 1);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            for ($i = $z - 1; $i < $x; $i++) {
                $n = $r * 10 + (int) $a[$i];
                /** @var int $nb */
<<<<<<< HEAD
                $q .= intdiv($n, $nb);
                $r = $n % $nb;
            }

            return [ltrim($q, '0') ?: '0', (string) $r];
        }

        for (; ;) {
            $focus = substr($a, 0, $z);
=======
                $q .= \intdiv($n, $nb);
                $r = $n % $nb;
            }

            return [\ltrim($q, '0') ?: '0', (string) $r];
        }

        for (;;) {
            $focus = \substr($a, 0, $z);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            $cmp = $this->doCmp($focus, $b);

            if ($cmp === -1) {
                if ($z === $x) { // remainder < dividend
                    break;
                }

                $z++;
            }

<<<<<<< HEAD
            $zeros = str_repeat('0', $x - $z);
=======
            $zeros = \str_repeat('0', $x - $z);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            $q = $this->add($q, '1' . $zeros);
            $a = $this->sub($a, $b . $zeros);

            $r = $a;

            if ($r === '0') { // remainder == 0
                break;
            }

<<<<<<< HEAD
            $x = strlen($a);
=======
            $x = \strlen($a);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            if ($x < $y) { // remainder < dividend
                break;
            }

            $z = $y;
        }

        return [$q, $r];
    }

    /**
     * Compares two non-signed large numbers.
     *
     * @return -1|0|1
     *
     * @pure
     */
<<<<<<< HEAD
    private function doCmp(string $a, string $b): int
    {
        $x = strlen($a);
        $y = strlen($b);
=======
    private function doCmp(string $a, string $b) : int
    {
        $x = \strlen($a);
        $y = \strlen($b);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        $cmp = $x <=> $y;

        if ($cmp !== 0) {
            return $cmp;
        }

<<<<<<< HEAD
        return strcmp($a, $b) <=> 0; // enforce -1|0|1
=======
        return \strcmp($a, $b) <=> 0; // enforce -1|0|1
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * Pads the left of one of the given numbers with zeros if necessary to make both numbers the same length.
     *
     * The numbers must only consist of digits, without leading minus sign.
     *
     * @return array{string, string, int}
     *
     * @pure
     */
<<<<<<< HEAD
    private function pad(string $a, string $b): array
    {
        $x = strlen($a);
        $y = strlen($b);

        if ($x > $y) {
            $b = str_repeat('0', $x - $y) . $b;
=======
    private function pad(string $a, string $b) : array
    {
        $x = \strlen($a);
        $y = \strlen($b);

        if ($x > $y) {
            $b = \str_repeat('0', $x - $y) . $b;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            return [$a, $b, $x];
        }

        if ($x < $y) {
<<<<<<< HEAD
            $a = str_repeat('0', $y - $x) . $a;
=======
            $a = \str_repeat('0', $y - $x) . $a;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

            return [$a, $b, $y];
        }

        return [$a, $b, $x];
    }
}
