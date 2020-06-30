<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ReturnNode;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class ReturnParser.
 *
 * @package Mikevandiepen\Strictly\Parser\Options\Attributes
 */
final class ReturnParser implements ParserOptionInterface
{
    use ParseDocblockTrait;

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
        $returnAttribute = new ReturnNode();

        $hintedType = new HintedType($this->getHintedReturnType());
        $returnAttribute->setHintedType($hintedType);

        $declaredType = new DeclaredType($node->type);
        $returnAttribute->setDeclaredType($declaredType);

        return $returnAttribute;
    }
}