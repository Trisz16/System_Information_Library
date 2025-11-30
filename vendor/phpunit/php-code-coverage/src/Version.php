<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage;

use function dirname;
use SebastianBergmann\Version as VersionId;

final class Version
{
    private static string $version = '';

    public static function id(): string
    {
        if (self::$version === '') {
<<<<<<< HEAD
            self::$version = (new VersionId('12.5.0', dirname(__DIR__)))->asString();
=======
            self::$version = (new VersionId('12.4.0', dirname(__DIR__)))->asString();
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        return self::$version;
    }
}
