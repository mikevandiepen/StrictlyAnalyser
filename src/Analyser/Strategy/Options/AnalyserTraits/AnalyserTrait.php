<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;

/**
 * Trait AnalyserTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits
 */
trait AnalyserTrait
{
    /**
     * Analysing whether the declared and hinted type match.
     *
     * @return bool
     */
    protected function typesMatch(): bool
    {
        if (!$this->declaredTypeIsset()) {
            return false;
        }

        if (!$this->hintedTypeIsset()) {
            return false;
        }

        $declaredType   = $this->getNodeWithType()->getDeclaredType()->getType();
        $hintedType     = $this->getNodeWithType()->getHintedType()->getType();

        if ($declaredType === $hintedType) {
            return true;
        }

        return false;
    }

    /**
     * Analysing whether the declared type is set for the subject node.
     *
     * @return bool
     */
    protected function declaredTypeIsset(): bool
    {
        $declaredType = $this->getNodeWithType()->getDeclaredType()->getType();

        return (bool) (count($declaredType) > 0);
    }

    /**
     * Getting the subject node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType
     */
    public function getNodeWithType(): HasType
    {
        return $this->node;
    }

    /**
     * Analysing whether the hinted type is set for the subject node.
     *
     * @return bool
     */
    protected function hintedTypeIsset(): bool
    {
        $hintedType = $this->getNodeWithType()->getHintedType()->getType();

        return (bool) (count($hintedType) > 0);
    }

    /**
     * Collecting the missing types declared in the functional code.
     *
     * @return string[]|null
     */
    protected function getMissingDeclaredTypes(): ?array
    {
        $hintedType     = $this->getNodeWithType()->gethintedType()->getType();
        $declaredType   = $this->getNodeWithType()->getDeclaredType()->getType();

        return array_udiff($hintedType, $declaredType, function ($hintedType, $declaredType) {
            if ($hintedType != $declaredType) {
                return $declaredType;
            }

            return null; // No missing declared types.
        });
    }

    /**
     * Collecting the missing types hinted in the docblock.
     *
     * @return string[]|null
     */
    protected function getMissingHintedTypes(): ?array
    {
        $hintedType     = $this->getNodeWithType()->gethintedType()->getType();
        $declaredType   = $this->getNodeWithType()->getDeclaredType()->getType();

        return array_udiff($declaredType, $hintedType, function ($declaredType, $hintedType) {
            if ($declaredType != $hintedType) {
                return $hintedType;
            }

            return null; // No missing hinted types.
        });
    }
}