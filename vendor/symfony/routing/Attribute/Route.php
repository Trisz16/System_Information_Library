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

<<<<<<< HEAD
use Symfony\Component\Routing\Exception\LogicException;

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
/**
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander M. Turek <me@derrabus.de>
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class Route
{
<<<<<<< HEAD
    /** @var string[] */
    public array $methods;

    /** @var string[] */
    public array $envs;

    /** @var string[] */
    public array $schemes;

    /** @var (string|DeprecatedAlias)[] */
    public array $aliases = [];
=======
    private ?string $path = null;
    private array $localizedPaths = [];
    private array $methods;
    private array $schemes;
    /**
     * @var (string|DeprecatedAlias)[]
     */
    private array $aliases = [];
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * @param string|array<string,string>|null                  $path         The route path (i.e. "/user/login")
     * @param string|null                                       $name         The route name (i.e. "app_user_login")
     * @param array<string|\Stringable>                         $requirements Requirements for the route attributes, @see https://symfony.com/doc/current/routing.html#parameters-validation
     * @param array<string, mixed>                              $options      Options for the route (i.e. ['prefix' => '/api'])
     * @param array<string, mixed>                              $defaults     Default values for the route attributes and query parameters
     * @param string|null                                       $host         The host for which this route should be active (i.e. "localhost")
     * @param string|string[]                                   $methods      The list of HTTP methods allowed by this route
     * @param string|string[]                                   $schemes      The list of schemes allowed by this route (i.e. "https")
     * @param string|null                                       $condition    An expression that must evaluate to true for the route to be matched, @see https://symfony.com/doc/current/routing.html#matching-expressions
     * @param int|null                                          $priority     The priority of the route if multiple ones are defined for the same path
     * @param string|null                                       $locale       The locale accepted by the route
     * @param string|null                                       $format       The format returned by the route (i.e. "json", "xml")
     * @param bool|null                                         $utf8         Whether the route accepts UTF-8 in its parameters
     * @param bool|null                                         $stateless    Whether the route is defined as stateless or stateful, @see https://symfony.com/doc/current/routing.html#stateless-routes
<<<<<<< HEAD
     * @param string|string[]|null                              $env          The env(s) in which the route is defined (i.e. "dev", "test", "prod", ["dev", "test"])
     * @param string|DeprecatedAlias|(string|DeprecatedAlias)[] $alias        The list of aliases for this route
     */
    public function __construct(
        public string|array|null $path = null,
        public ?string $name = null,
        public array $requirements = [],
        public array $options = [],
        public array $defaults = [],
        public ?string $host = null,
        array|string $methods = [],
        array|string $schemes = [],
        public ?string $condition = null,
        public ?int $priority = null,
=======
     * @param string|null                                       $env          The env in which the route is defined (i.e. "dev", "test", "prod")
     * @param string|DeprecatedAlias|(string|DeprecatedAlias)[] $alias        The list of aliases for this route
     */
    public function __construct(
        string|array|null $path = null,
        private ?string $name = null,
        private array $requirements = [],
        private array $options = [],
        private array $defaults = [],
        private ?string $host = null,
        array|string $methods = [],
        array|string $schemes = [],
        private ?string $condition = null,
        private ?int $priority = null,
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        ?string $locale = null,
        ?string $format = null,
        ?bool $utf8 = null,
        ?bool $stateless = null,
<<<<<<< HEAD
        string|array|null $env = null,
        string|DeprecatedAlias|array $alias = [],
    ) {
        $this->path = $path;
        $this->methods = (array) $methods;
        $this->schemes = (array) $schemes;
        $this->envs = (array) $env;
        $this->aliases = \is_array($alias) ? $alias : [$alias];
=======
        private ?string $env = null,
        string|DeprecatedAlias|array $alias = [],
    ) {
        if (\is_array($path)) {
            $this->localizedPaths = $path;
        } else {
            $this->path = $path;
        }
        $this->setMethods($methods);
        $this->setSchemes($schemes);
        $this->setAliases($alias);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

        if (null !== $locale) {
            $this->defaults['_locale'] = $locale;
        }

        if (null !== $format) {
            $this->defaults['_format'] = $format;
        }

        if (null !== $utf8) {
            $this->options['utf8'] = $utf8;
        }

        if (null !== $stateless) {
            $this->defaults['_stateless'] = $stateless;
        }
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "path" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "path" property instead', 'symfony/routing:7.4')]
    public function getPath(): ?string
    {
        return \is_array($this->path) ? null : $this->path;
    }

    #[\Deprecated('Use the "path" property instead', 'symfony/routing:7.4')]
    public function setLocalizedPaths(array $localizedPaths): void
    {
        $this->path = $localizedPaths;
    }

    #[\Deprecated('Use the "path" property instead', 'symfony/routing:7.4')]
    public function getLocalizedPaths(): array
    {
        return \is_array($this->path) ? $this->path : [];
    }

    #[\Deprecated('Use the "host" property instead', 'symfony/routing:7.4')]
=======
    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setLocalizedPaths(array $localizedPaths): void
    {
        $this->localizedPaths = $localizedPaths;
    }

    public function getLocalizedPaths(): array
    {
        return $this->localizedPaths;
    }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setHost(string $pattern): void
    {
        $this->host = $pattern;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "host" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getHost(): ?string
    {
        return $this->host;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "name" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setName(string $name): void
    {
        $this->name = $name;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "name" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getName(): ?string
    {
        return $this->name;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "requirements" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setRequirements(array $requirements): void
    {
        $this->requirements = $requirements;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "requirements" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getRequirements(): array
    {
        return $this->requirements;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "options" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "options" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getOptions(): array
    {
        return $this->options;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "defaults" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setDefaults(array $defaults): void
    {
        $this->defaults = $defaults;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "defaults" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getDefaults(): array
    {
        return $this->defaults;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "schemes" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setSchemes(array|string $schemes): void
    {
        $this->schemes = (array) $schemes;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "schemes" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getSchemes(): array
    {
        return $this->schemes;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "methods" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setMethods(array|string $methods): void
    {
        $this->methods = (array) $methods;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "methods" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getMethods(): array
    {
        return $this->methods;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "condition" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setCondition(?string $condition): void
    {
        $this->condition = $condition;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "condition" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getCondition(): ?string
    {
        return $this->condition;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "priority" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "priority" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getPriority(): ?int
    {
        return $this->priority;
    }

<<<<<<< HEAD
    #[\Deprecated('Use the "envs" property instead', 'symfony/routing:7.4')]
    public function setEnv(?string $env): void
    {
        $this->envs = (array) $env;
    }

    #[\Deprecated('Use the "envs" property instead', 'symfony/routing:7.4')]
    public function getEnv(): ?string
    {
        if (!$this->envs) {
            return null;
        }
        if (\count($this->envs) > 1) {
            throw new LogicException(\sprintf('The "env" property has %d environments. Use "getEnvs()" to get all of them.', \count($this->envs)));
        }

        return $this->envs[0];
=======
    public function setEnv(?string $env): void
    {
        $this->env = $env;
    }

    public function getEnv(): ?string
    {
        return $this->env;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }

    /**
     * @return (string|DeprecatedAlias)[]
     */
<<<<<<< HEAD
    #[\Deprecated('Use the "aliases" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @param string|DeprecatedAlias|(string|DeprecatedAlias)[] $aliases
     */
<<<<<<< HEAD
    #[\Deprecated('Use the "aliases" property instead', 'symfony/routing:7.4')]
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    public function setAliases(string|DeprecatedAlias|array $aliases): void
    {
        $this->aliases = \is_array($aliases) ? $aliases : [$aliases];
    }
}

if (!class_exists(\Symfony\Component\Routing\Annotation\Route::class, false)) {
    class_alias(Route::class, \Symfony\Component\Routing\Annotation\Route::class);
}
