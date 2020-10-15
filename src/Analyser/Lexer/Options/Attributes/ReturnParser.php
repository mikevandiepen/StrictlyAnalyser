<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use PhpParser\Node;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\HintedType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\DeclaredType;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;

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
     * @throws \ReflectionException
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