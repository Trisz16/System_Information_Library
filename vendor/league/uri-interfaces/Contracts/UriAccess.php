<?php

/**
 * League.Uri (https://uri.thephpleague.com)
 *
 * (c) Ignace Nyamagana Butera <nyamsprod@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace League\Uri\Contracts;

use Psr\Http\Message\UriInterface as Psr7UriInterface;

<<<<<<< HEAD
/**
 * @deprecated since version 7.6.0
 */
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
interface UriAccess
{
    public function getUri(): UriInterface|Psr7UriInterface;

    /**
     * Returns the RFC3986 string representation of the complete URI.
     */
    public function getUriString(): string;
}
