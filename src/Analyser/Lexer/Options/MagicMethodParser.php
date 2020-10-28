<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\DocblockParserTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MagicMethodNode;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use PhpParser\Node;

/**
 * Class MagicMethodParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options
 */
final class MagicMethodParser implements NodeLexerOptionInterface
{
    use DocblockParserTrait;

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
        $magicMethodNode = new MagicMethodNode();
        $magicMethodNode->setName($node->name->name);
        $magicMethodNode->setStartLine($node->getStartLine());
        $magicMethodNode->setEndLine($node->getEndLine());

        // Parsing through all the parameters and handling them.
        for ($i = 0; $i < count($node->getParams()); $i++) {
            $parameter = new ParameterParser();
            $parameter->setDocblockFromNode($node);
            $parameter->setParameterIndex($i);

            $newNode = $node->getParams()[$i];

            $magicMethodNode->setParameters($parameter->parse($newNode));
        }

        $return = new ReturnParser();
        $return->setDocblockFromNode($node);

        $magicMethodNode->setReturn($return->parse($node));

        return $magicMethodNode;
    }
}