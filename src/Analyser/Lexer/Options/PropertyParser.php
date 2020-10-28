<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options\DocblockPropertyParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\DeclaredTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\HintedTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\PropertyNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use PhpParser\Node;

/**
 * Class PropertyParser.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Lexer\Options
 */
final class PropertyParser implements NodeLexerOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     */
    public function parse(Node $node): AbstractNode
    {
        $propertyNode = new PropertyNode();
        $propertyNode->setName($node->name->name);
        $propertyNode->setStartLine($node->getStartLine());
        $propertyNode->setEndLine($node->getEndLine());

        $docblockParser = (new DocblockPropertyParser());
        $docblock = $docblockParser->getDocblockFromNode($node);
        $hintedTypeNode = $docblockParser->parse($docblock);

        if ($hintedTypeNode instanceof HintedTypeNode) {
            $propertyNode->setHintedTypeNode($hintedTypeNode);
        }

        $declaredTypeNode = (new DeclaredTypeParser())->parse($node);
        if ($declaredTypeNode instanceof DeclaredTypeNode) {
            $propertyNode->setDeclaredTypeNode($declaredTypeNode);
        }

        return $propertyNode;
    }
}