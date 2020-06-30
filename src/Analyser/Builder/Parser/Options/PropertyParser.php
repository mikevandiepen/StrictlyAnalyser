<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\PropertyNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class PropertyParser.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\Parser\Options
 */
final class PropertyParser implements ParserOptionInterface
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
        $propertyNode = new PropertyNode();
        $propertyNode->setName($node->name);
        $propertyNode->setStartLine($node->getStartLine());
        $propertyNode->setEndLine($node->getEndLine());

        $this->setDocblockFromNode($node);

        // Type set in docblock.
        $hintedType = new HintedType($this->getHintedPropertyType());
        $propertyNode->setHintedType($hintedType);

        // Type declared in code.
        $declaredType = new DeclaredType($node->type);
        $propertyNode->setDeclaredType($declaredType);
    }
}