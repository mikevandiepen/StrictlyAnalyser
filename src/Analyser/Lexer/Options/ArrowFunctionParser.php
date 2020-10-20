<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ArrowFunctionNode;
use PhpParser\Node;

/**
 * Class ArrowFunctionParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options
 */
final class ArrowFunctionParser implements NodeLexerOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws \ReflectionException|\MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function parse(Node $node): AbstractNode
    {
        $functionNode = new ArrowFunctionNode();
        $functionNode->setName('Arrow Function');
        $functionNode->setStartLine($node->getStartLine());
        $functionNode->setEndLine($node->getEndLine());

        // Parsing through all the parameters and handling them.
        for ($i = 0; $i < count($node->getParams()); $i++) {
            $parameter = new ParameterParser();
            $parameter->setDocblockFromNode($node);
            $parameter->setParameterIndex($i);

            $newNode = $node->getParams()[$i];

            $functionNode->setParameters($parameter->parse($newNode));
        }

        $return = new ReturnParser();
        $return->setDocblockFromNode($node);

        $functionNode->setReturn($return->parse($node));

        return $functionNode;
    }
}