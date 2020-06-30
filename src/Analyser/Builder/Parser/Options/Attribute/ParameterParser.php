<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ParameterNode;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class ReturnParser.
 *
 * @package Mikevandiepen\Strictly\Parser\Options\Attributes
 */
final class ParameterParser implements ParserOptionInterface
{
    use ParseDocblockTrait;

    /**
     * The index of the parameter.
     *
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
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode
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

    /**
     * Getting the index of the parameter.
     *
     * @return int
     */
    public function getParameterIndex(): int
    {
        return $this->parameterIndex;
    }
}