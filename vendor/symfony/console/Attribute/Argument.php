<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Attribute;

<<<<<<< HEAD
use Symfony\Component\Console\Attribute\Reflection\ReflectionMember;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Completion\Suggestion;
use Symfony\Component\Console\Exception\InvalidArgumentException;
=======
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\Completion\Suggestion;
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\String\UnicodeString;

<<<<<<< HEAD
#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::TARGET_PROPERTY)]
=======
#[\Attribute(\Attribute::TARGET_PARAMETER)]
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
class Argument
{
    private const ALLOWED_TYPES = ['string', 'bool', 'int', 'float', 'array'];

    private string|bool|int|float|array|null $default = null;
    private array|\Closure $suggestedValues;
    private ?int $mode = null;
<<<<<<< HEAD
    /**
     * @var string|class-string<\BackedEnum>
     */
    private string $typeName = '';
    private ?InteractiveAttributeInterface $interactiveAttribute = null;
=======
    private string $function = '';
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e

    /**
     * Represents a console command <argument> definition.
     *
     * If unset, the `name` value will be inferred from the parameter definition.
     *
     * @param array<string|Suggestion>|callable(CompletionInput):list<string|Suggestion> $suggestedValues The values used for input completion
     */
    public function __construct(
        public string $description = '',
        public string $name = '',
        array|callable $suggestedValues = [],
    ) {
        $this->suggestedValues = \is_callable($suggestedValues) ? $suggestedValues(...) : $suggestedValues;
    }

    /**
     * @internal
     */
<<<<<<< HEAD
    public static function tryFrom(\ReflectionParameter|\ReflectionProperty $member): ?self
    {
        $reflection = new ReflectionMember($member);

        if (!$self = $reflection->getAttribute(self::class)) {
            return null;
        }

        $type = $reflection->getType();
        $name = $reflection->getName();

        if (!$type instanceof \ReflectionNamedType) {
            throw new LogicException(\sprintf('The %s "$%s" of "%s" must have a named type. Untyped, Union or Intersection types are not supported for command arguments.', $reflection->getMemberName(), $name, $reflection->getSourceName()));
        }

        $self->typeName = $type->getName();
        $isBackedEnum = is_subclass_of($self->typeName, \BackedEnum::class);

        if (!\in_array($self->typeName, self::ALLOWED_TYPES, true) && !$isBackedEnum) {
            throw new LogicException(\sprintf('The type "%s" on %s "$%s" of "%s" is not supported as a command argument. Only "%s" types and backed enums are allowed.', $self->typeName, $reflection->getMemberName(), $name, $reflection->getSourceName(), implode('", "', self::ALLOWED_TYPES)));
=======
    public static function tryFrom(\ReflectionParameter $parameter): ?self
    {
        /** @var self $self */
        if (null === $self = ($parameter->getAttributes(self::class, \ReflectionAttribute::IS_INSTANCEOF)[0] ?? null)?->newInstance()) {
            return null;
        }

        if (($function = $parameter->getDeclaringFunction()) instanceof \ReflectionMethod) {
            $self->function = $function->class.'::'.$function->name;
        } else {
            $self->function = $function->name;
        }

        $type = $parameter->getType();
        $name = $parameter->getName();

        if (!$type instanceof \ReflectionNamedType) {
            throw new LogicException(\sprintf('The parameter "$%s" of "%s()" must have a named type. Untyped, Union or Intersection types are not supported for command arguments.', $name, $self->function));
        }

        $parameterTypeName = $type->getName();

        if (!\in_array($parameterTypeName, self::ALLOWED_TYPES, true)) {
            throw new LogicException(\sprintf('The type "%s" on parameter "$%s" of "%s()" is not supported as a command argument. Only "%s" types are allowed.', $parameterTypeName, $name, $self->function, implode('", "', self::ALLOWED_TYPES)));
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        }

        if (!$self->name) {
            $self->name = (new UnicodeString($name))->kebab();
        }

<<<<<<< HEAD
        $self->default = $reflection->hasDefaultValue() ? $reflection->getDefaultValue() : null;

        $isOptional = $reflection->hasDefaultValue() || $reflection->isNullable();
        $self->mode = $isOptional ? InputArgument::OPTIONAL : InputArgument::REQUIRED;
        if ('array' === $self->typeName) {
            $self->mode |= InputArgument::IS_ARRAY;
        }

        if (\is_array($self->suggestedValues) && !\is_callable($self->suggestedValues) && 2 === \count($self->suggestedValues) && ($instance = $reflection->getSourceThis()) && $instance::class === $self->suggestedValues[0] && \is_callable([$instance, $self->suggestedValues[1]])) {
            $self->suggestedValues = [$instance, $self->suggestedValues[1]];
        }

        if ($isBackedEnum && !$self->suggestedValues) {
            $self->suggestedValues = array_column($self->typeName::cases(), 'value');
        }

        $self->interactiveAttribute = Ask::tryFrom($member, $self->name);

        if ($self->interactiveAttribute && $isOptional) {
            throw new LogicException(\sprintf('The %s "$%s" argument of "%s" cannot be both interactive and optional.', $reflection->getMemberName(), $self->name, $reflection->getSourceName()));
        }

=======
        $self->default = $parameter->isDefaultValueAvailable() ? $parameter->getDefaultValue() : null;

        $self->mode = $parameter->isDefaultValueAvailable() || $parameter->allowsNull() ? InputArgument::OPTIONAL : InputArgument::REQUIRED;
        if ('array' === $parameterTypeName) {
            $self->mode |= InputArgument::IS_ARRAY;
        }

        if (\is_array($self->suggestedValues) && !\is_callable($self->suggestedValues) && 2 === \count($self->suggestedValues) && ($instance = $parameter->getDeclaringFunction()->getClosureThis()) && $instance::class === $self->suggestedValues[0] && \is_callable([$instance, $self->suggestedValues[1]])) {
            $self->suggestedValues = [$instance, $self->suggestedValues[1]];
        }

>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        return $self;
    }

    /**
     * @internal
     */
    public function toInputArgument(): InputArgument
    {
        $suggestedValues = \is_callable($this->suggestedValues) ? ($this->suggestedValues)(...) : $this->suggestedValues;

        return new InputArgument($this->name, $this->mode, $this->description, $this->default, $suggestedValues);
    }

    /**
     * @internal
     */
    public function resolveValue(InputInterface $input): mixed
    {
<<<<<<< HEAD
        $value = $input->getArgument($this->name);

        if (is_subclass_of($this->typeName, \BackedEnum::class) && (\is_string($value) || \is_int($value))) {
            return $this->typeName::tryFrom($value) ?? throw InvalidArgumentException::fromEnumValue($this->name, $value, $this->suggestedValues);
        }

        return $value;
    }

    /**
     * @internal
     */
    public function getInteractiveAttribute(): ?InteractiveAttributeInterface
    {
        return $this->interactiveAttribute;
    }

    /**
     * @internal
     */
    public function isRequired(): bool
    {
        return InputArgument::REQUIRED === (InputArgument::REQUIRED & $this->mode);
=======
        return $input->getArgument($this->name);
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
    }
}
