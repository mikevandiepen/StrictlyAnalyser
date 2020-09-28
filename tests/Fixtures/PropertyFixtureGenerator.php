<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Tests\Fixtures;

/**
 * Class PropertyFixtureGenerator.
 *
 * @package MikevanDiepen\Strictly\Tests\Fixtures
 */
final class PropertyFixtureGenerator extends AbstractFixtureGenerator
{
    /** @var string The member type of this generator. */
    private const MEMBER = 'property';

    public function generateTypedFunctionalProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateTypedHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateTypedFunctionalAndHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateUntypedFunctionalProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateUntypedHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateUntypedFunctionalAndHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateMistypedFunctionalProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateMistypedHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }

    public function generateMistypedFunctionalAndHintedProperty(
        string $member = parent::PUBLIC_MEMBER
    ): string
    {

    }
}