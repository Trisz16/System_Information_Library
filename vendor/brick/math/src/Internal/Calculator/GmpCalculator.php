<?php

declare(strict_types=1);

namespace Brick\Math\Internal\Calculator;

use Brick\Math\Internal\Calculator;
use GMP;
use Override;

<<<<<<< HEAD
use function gmp_add;
use function gmp_and;
use function gmp_div_q;
use function gmp_div_qr;
use function gmp_div_r;
use function gmp_gcd;
use function gmp_init;
use function gmp_invert;
use function gmp_mul;
use function gmp_or;
use function gmp_pow;
use function gmp_powm;
use function gmp_sqrt;
use function gmp_strval;
use function gmp_sub;
use function gmp_xor;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * Calculator implementation built around the GMP library.
 *
 * @internal
 */
final readonly class GmpCalculator extends Calculator
{
    #[Override]
<<<<<<< HEAD
    public function add(string $a, string $b): string
    {
        return gmp_strval(gmp_add($a, $b));
    }

    #[Override]
    public function sub(string $a, string $b): string
    {
        return gmp_strval(gmp_sub($a, $b));
    }

    #[Override]
    public function mul(string $a, string $b): string
    {
        return gmp_strval(gmp_mul($a, $b));
    }

    #[Override]
    public function divQ(string $a, string $b): string
    {
        return gmp_strval(gmp_div_q($a, $b));
    }

    #[Override]
    public function divR(string $a, string $b): string
    {
        return gmp_strval(gmp_div_r($a, $b));
    }

    #[Override]
    public function divQR(string $a, string $b): array
    {
        [$q, $r] = gmp_div_qr($a, $b);
=======
    public function add(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_add($a, $b));
    }

    #[Override]
    public function sub(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_sub($a, $b));
    }

    #[Override]
    public function mul(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_mul($a, $b));
    }

    #[Override]
    public function divQ(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_div_q($a, $b));
    }

    #[Override]
    public function divR(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_div_r($a, $b));
    }

    #[Override]
    public function divQR(string $a, string $b) : array
    {
        [$q, $r] = \gmp_div_qr($a, $b);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        /**
         * @var GMP $q
         * @var GMP $r
         */
        return [
<<<<<<< HEAD
            gmp_strval($q),
            gmp_strval($r),
=======
            \gmp_strval($q),
            \gmp_strval($r)
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        ];
    }

    #[Override]
<<<<<<< HEAD
    public function pow(string $a, int $e): string
    {
        return gmp_strval(gmp_pow($a, $e));
    }

    #[Override]
    public function modInverse(string $x, string $m): ?string
    {
        $result = gmp_invert($x, $m);
=======
    public function pow(string $a, int $e) : string
    {
        return \gmp_strval(\gmp_pow($a, $e));
    }

    #[Override]
    public function modInverse(string $x, string $m) : ?string
    {
        $result = \gmp_invert($x, $m);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if ($result === false) {
            return null;
        }

<<<<<<< HEAD
        return gmp_strval($result);
    }

    #[Override]
    public function modPow(string $base, string $exp, string $mod): string
    {
        return gmp_strval(gmp_powm($base, $exp, $mod));
    }

    #[Override]
    public function gcd(string $a, string $b): string
    {
        return gmp_strval(gmp_gcd($a, $b));
    }

    #[Override]
    public function fromBase(string $number, int $base): string
    {
        return gmp_strval(gmp_init($number, $base));
    }

    #[Override]
    public function toBase(string $number, int $base): string
    {
        return gmp_strval($number, $base);
    }

    #[Override]
    public function and(string $a, string $b): string
    {
        return gmp_strval(gmp_and($a, $b));
    }

    #[Override]
    public function or(string $a, string $b): string
    {
        return gmp_strval(gmp_or($a, $b));
    }

    #[Override]
    public function xor(string $a, string $b): string
    {
        return gmp_strval(gmp_xor($a, $b));
    }

    #[Override]
    public function sqrt(string $n): string
    {
        return gmp_strval(gmp_sqrt($n));
=======
        return \gmp_strval($result);
    }

    #[Override]
    public function modPow(string $base, string $exp, string $mod) : string
    {
        return \gmp_strval(\gmp_powm($base, $exp, $mod));
    }

    #[Override]
    public function gcd(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_gcd($a, $b));
    }

    #[Override]
    public function fromBase(string $number, int $base) : string
    {
        return \gmp_strval(\gmp_init($number, $base));
    }

    #[Override]
    public function toBase(string $number, int $base) : string
    {
        return \gmp_strval($number, $base);
    }

    #[Override]
    public function and(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_and($a, $b));
    }

    #[Override]
    public function or(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_or($a, $b));
    }

    #[Override]
    public function xor(string $a, string $b) : string
    {
        return \gmp_strval(\gmp_xor($a, $b));
    }

    #[Override]
    public function sqrt(string $n) : string
    {
        return \gmp_strval(\gmp_sqrt($n));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
