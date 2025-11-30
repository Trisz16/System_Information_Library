<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Exception;

<<<<<<< HEAD
use Symfony\Component\HttpKernel\Attribute\WithHttpStatus;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
#[WithHttpStatus(403)]
=======
/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
final class ExpiredSignedUriException extends SignedUriException
{
    /**
     * @internal
     */
    public function __construct()
    {
        parent::__construct('The URI has expired.');
    }
}
