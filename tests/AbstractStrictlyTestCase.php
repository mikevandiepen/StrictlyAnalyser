<?php

namespace Mikevandiepen\Strictly\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractStrictlyTestCase.
 * The abstract test case with helper functions to simplify the test suite.
 *
 * @package Mikevandiepen\Strictly\Tests
 */
abstract class AbstractStrictlyTestCase extends TestCase
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


    /**
     * Generating the code for the property, this will be used as a "fixture" in tests.
     *
     * @param string $member   - The member of the property, by default "public".
     * @param string $type     - The type of the property, by default "untyped".
     * @param string $name     - The name of the property, by default "myProperty".
     */
    public function generatePropertyCode(
        string $member = self::PUBLIC_MEMBER,
        string $type = self::UNTYPED,
        string $name = 'myProperty'
    )
    {

    }

    /**
     * Generating the docblock for the property, this will be used as a "fixture" in tests.
     *
     * @param string $type - The type of the property, by default "untyped".
     */
    public function generatePropertyDocblock(
        string $type = self::UNTYPED
    )
    {

    }
}