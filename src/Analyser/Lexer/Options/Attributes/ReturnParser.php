<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\DeclaredTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Hinted\HintedTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use PhpParser\Node;

/**
 * Class ReturnParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options\Attributes
 */
final class ReturnParser implements NodeLexerOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws StrictlyException
     */
    public function parse(Node $node): AbstractNode
    {
        $returnNode = new ReturnNode();

        $hintedTypeNode = (new HintedTypeParser())->parse($this->getHintedReturnType());
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