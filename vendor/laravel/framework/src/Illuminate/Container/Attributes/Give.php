<?php

namespace Illuminate\Container\Attributes;

use Attribute;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Container\ContextualAttribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Give implements ContextualAttribute
{
    /**
     * Provide a concrete class implementation for dependency injection.
     *
<<<<<<< HEAD
     * @param  string  $class
=======
     * @template T
     *
     * @param  class-string<T>  $class
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * @param  array|null  $params
     */
    public function __construct(
        public string $class,
        public array $params = [],
    ) {
    }

    /**
     * Resolve the dependency.
     *
     * @param  self  $attribute
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return mixed
     */
    public static function resolve(self $attribute, Container $container): mixed
    {
        return $container->make($attribute->class, $attribute->params);
    }
}
