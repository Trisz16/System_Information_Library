<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing\Attribute;

/**
 * This class is meant to be used in {@see Route} to define an alias for a route.
 */
class DeprecatedAlias
{
    public function __construct(
<<<<<<< HEAD
        public readonly string $aliasName,
        public readonly string $package,
        public readonly string $version,
        public readonly string $message = '',
    ) {
    }

    #[\Deprecated('Use the "message" property instead', 'symfony/routing:7.4')]
=======
        private string $aliasName,
        private string $package,
        private string $version,
        private string $message = '',
    ) {
    }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getMessage(): string
    {
        return $this->message;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "aliasName" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getAliasName(): string
    {
        return $this->aliasName;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "package" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getPackage(): string
    {
        return $this->package;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "version" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getVersion(): string
    {
        return $this->version;
    }
}
