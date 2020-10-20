<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\DeclaredType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\Location\HintedType;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use PhpParser\Node;

/**
 * Class ReturnParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options\Attributes
 */
final class ReturnParser implements LexerOptionInterface
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
        $returnAttribute = new ReturnNode();

        $hintedType = new HintedType($this->getHintedReturnType());
        $returnAttribute->setHintedType($hintedType);

        $declaredType = new DeclaredType($node);
        $returnAttribute->setDeclaredType($declaredType);

        return $returnAttribute;
    }
}