<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Structural\TypeDefined;
use MikevanDiepen\Strictly\Exception\StrictlyException;

/**
 * Trait AnalyserTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits
 */
trait AnalyserTrait
{
    /**
     * Getting the subject node.
     *
     * @return HasType
     * @throws StrictlyException
     */
    public function getNodeWithType(): HasType
    {
        if (!$this->node instanceof HasType) {
            throw new StrictlyException('Node must implement HasType');
        }

        return $this->node;
    }

    /**
     * Analysing whether the declared type is set for the subject node.
     *
     * @return bool
     * @throws StrictlyException
     */
    protected function declaredTypeIsset(): bool
    {
        $declaredType = $this->getNodeWithType()->getDeclaredType()->getType();

        return (bool) ($declaredType instanceof TypeDefined);
    }

    /**
     * Analysing whether the hinted type is set for the subject node.
     *
     * @return bool
     * @throws StrictlyException
     */
    protected function hintedTypeIsset(): bool
    {
        $hintedType = $this->getNodeWithType()->getHintedType()->getType();

        return (bool) ($hintedType instanceof TypeDefined);
    }

    /**
     * Analysing whether the declared and hinted type match.
     *
     * @return bool
     * @throws StrictlyException
     */
    protected function typesMatch(): bool
    {
        if (!$this->declaredTypeIsset() || !$this->hintedTypeIsset()) {
            return false;
        }

        $declaredType = $this->getNodeWithType()->getDeclaredType()->getType();
        $hintedType   = $this->getNodeWithType()->getHintedType()->getType();

        if ($declaredType === $hintedType) {
            return true;
        }

        return false;
    }

    /**
     * Collecting the missing types declared in the functional code.
     *
     * @return string[]|null
     * @throws StrictlyException
     */
    protected function getMissingDeclaredTypes(): ?array
    {
        $hintedType   = $this->getNodeWithType()->gethintedType()->getType();
        $declaredType = $this->getNodeWithType()->getDeclaredType()->getType();

        return array_udiff($hintedType, $declaredType, function($hintedType, $declaredType) {
            if ($hintedType != $declaredType) {
                return $declaredType;
            }

            return []; // No missing declared types.
        });
    }

    /**
     * Whether the node has missing hinted types.
     *
     * @return string[]
     * @throws StrictlyException
     */
    protected function getMissingHintedTypes(): array
    {
        # TODO: When the type is an object check whether it implements the declared object.
        $hintedType   = $this->getNodeWithType()->gethintedType()->getType();
        $declaredType = $this->getNodeWithType()->getDeclaredType()->getType();

        return array_udiff($declaredType, $hintedType, function($declaredType, $hintedType) {
            if ($declaredType != $hintedType) {
                return $hintedType;
            }

            return []; // No missing declared types.
        });
    }
}