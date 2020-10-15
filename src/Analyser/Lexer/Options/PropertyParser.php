<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use PhpParser\Node;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\PropertyNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;

/**
 * Class PropertyParser.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Lexer\Options
 */
final class PropertyParser implements LexerOptionInterface
{
    use ParseDocblockTrait;

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
        $propertyNode = new PropertyNode();
		$propertyNode->setName($node->name->name);
        $propertyNode->setStartLine($node->getStartLine());
        $propertyNode->setEndLine($node->getEndLine());

        $this->setDocblockFromNode($node);

        // Type set in docblock.
        $hintedType = new HintedType($this->getHintedPropertyType());
        $propertyNode->setHintedType($hintedType);

        // Type declared in code.
        $declaredType = new DeclaredType($node);
        $propertyNode->setDeclaredType($declaredType);

        return $propertyNode;
    }
}