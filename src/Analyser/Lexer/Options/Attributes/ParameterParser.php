<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use PhpParser\Node;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;

/**
 * Class ReturnParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options\Attributes
 */
final class ParameterParser implements LexerOptionInterface
{
    use ParseDocblockTrait;

    /**
     * The index of the parameter.
     * This property can be accessed through:
     * @method setParameterIndex(int $index): self
     * @method getParameterIndex(): int
     *
     * @var int
     */
    private int $parameterIndex;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function parse(Node $node): AbstractNode
    {
        $parameterNode = new ParameterNode();

        if (!$node->var instanceof Node\Expr\Error) {
            if ($node->var instanceof Node\Expr\Variable) {
                $parameterNode->setParameterIndex($this->getParameterIndex());
                $parameterNode->setParameterName($node->var->name);

                $hintedType = new HintedType($this->getHintedParameterType($node->var->name));
                $parameterNode->setHintedType($hintedType);

                $declaredType = new DeclaredType($node->type);
                $parameterNode->setDeclaredType($declaredType);
            }
        }

        return $parameterNode;
    }

    /**
     * Getting the index of the parameter.
     *
     * @return int
     */
    public function getParameterIndex(): int
    {
        return $this->parameterIndex;
    }

    /**
     * Setting the index of the parameter.
     *
     * @param int $parameterIndex
     *
     * @return $this
     */
    public function setParameterIndex(int $parameterIndex): self
    {
        $this->parameterIndex = $parameterIndex;

        return $this;
    }
}