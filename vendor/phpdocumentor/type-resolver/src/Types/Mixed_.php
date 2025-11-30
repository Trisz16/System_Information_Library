<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\Types;

use phpDocumentor\Reflection\Type;

/**
 * Value Object representing an unknown, or mixed, type.
 *
 * @psalm-immutable
 */
<<<<<<< HEAD
class Mixed_ implements Type
=======
final class Mixed_ implements Type
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
{
    /**
     * Returns a rendered output of the Type as it would be used in a DocBlock.
     */
    public function __toString(): string
    {
        return 'mixed';
    }
}
