<?php

namespace Mikevandiepen\Strictly\Tests\Fixtures;

/**
 * Class AbstractFixtureGenerator.
 * Base class for fixture generation.
 *
 * @package Mikevandiepen\Strictly\Tests\Fixtures
 */
abstract class AbstractFixtureGenerator
{
    # Standard members.
    public const PRIVATE_MEMBER = 'private';
    public const PROTECTED_MEMBER = 'protected';
    public const PUBLIC_MEMBER = 'public';
    # Static members.
    public const PRIVATE_STATIC_MEMBER = 'private static';
    public const PROTECTED_STATIC_MEMBER = 'protected static';
    public const PUBLIC_STATIC_MEMBER = 'public static';
    # Normal abstract members.
    public const PRIVATE_ABSTRACT_MEMBER = 'private abstract';
    public const PROTECTED_ABSTRACT_MEMBER = 'protected abstract';
    public const PUBLIC_ABSTRACT_MEMBER = 'public abstract';
    # Static abstract members.
    public const PRIVATE_STATIC_ABSTRACT_MEMBER = 'private static abstract';
    public const PROTECTED_STATIC_ABSTRACT_MEMBER = 'protected static abstract';
    public const PUBLIC_STATIC_ABSTRACT_MEMBER = 'public static abstract';
    # Untyped.
    public const UNTYPED = '';
    # Scalar types.
    public const SCALAR_TYPE_BOOLEAN = 'bool';
    public const SCALAR_TYPE_INTEGER = 'int';
    public const SCALAR_TYPE_FLOAT = 'float';
    public const SCALAR_TYPE_STRING = 'string';
    # Compound types.
    public const COMPOUND_TYPE_ARRAY = 'array';
    public const COMPOUND_TYPE_OBJECT = 'object';
    public const COMPOUND_TYPE_CALLABLE = 'callable'; # TODO: Support callable type.
    public const COMPOUND_TYPE_ITERABLE = 'iterable'; # TODO: Support iterable type.
}