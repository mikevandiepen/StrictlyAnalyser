<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options\DocblockReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\DeclaredTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use PhpParser\Node;

/**
 * Class ReturnParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options\Attributes
 */
final class ReturnParser implements NodeLexerOptionInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws \ReflectionException
     */
    public function parse(Node $node): AbstractNode
    {
        $returnNode = new ReturnNode();

        $docblockParser = (new DocblockReturnParser());
        $docblock = $docblockParser->getDocblockFromNode($node);
        $hintedTypeNode = $docblockParser->parse($docblock);

        if ($hintedTypeNode instanceof HintedTypeNode) {
            $returnNode->setHintedTypeNode($hintedTypeNode);
        }

        $declaredTypeNode = (new DeclaredTypeParser())->parse($node);
        if ($declaredTypeNode instanceof DeclaredTypeNode) {
            $returnNode->setDeclaredTypeNode($declaredTypeNode);
        }

        return $returnNode;
    }
}