<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeDefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
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
        $declaredType = $this->getNodeWithType()->getDeclaredTypeNode()->getDefinition();

        return (bool) ($declaredType instanceof TypeDefinedNode);
    }

    /**
     * Analysing whether the hinted type is set for the subject node.
     *
     * @return bool
     * @throws StrictlyException
     */
    protected function hintedTypeIsset(): bool
    {
        $hintedType = $this->getNodeWithType()->getHintedTypeNode()->getDefinition();

        return (bool) ($hintedType instanceof TypeUndefinedNode);
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

        $declaredType = $this->getNodeWithType()->getDeclaredTypeNode()->getDefinition()->getType();
        $hintedType   = $this->getNodeWithType()->getHintedTypeNode()->getDefinition()->getType();

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
        $hintedType   = $this->getNodeWithType()->getHintedTypeNode()->getDefinition()->getType();
        $declaredType = $this->getNodeWithType()->getDeclaredTypeNode()->getDefinition()->getType();

        return array_udiff($hintedType, $declaredType, function($hintedType, $declaredType) {
            if (($hintedType instanceof $declaredType) || ($declaredType instanceof $hintedType)) {
                return []; // There is no missing type, it implements a interface or parent class.
            }

            if ($hintedType !== $declaredType) {
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
        $hintedType   = $this->getNodeWithType()->getHintedTypeNode()->getDefinition()->getType();
        $declaredType = $this->getNodeWithType()->getDeclaredTypeNode()->getDefinition()->getType();

        return array_udiff($declaredType, $hintedType, function($declaredType, $hintedType) {
            if (($declaredType instanceof $hintedType) || ($hintedType instanceof $declaredType)) {
                return []; // There is no missing type, it implements a interface or parent class.
            }

            if ($declaredType !== $hintedType) {
                return $hintedType;
            }

            return []; // No missing declared types.
        });
    }
}