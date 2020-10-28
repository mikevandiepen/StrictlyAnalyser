<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\FunctionNode;
use PhpParser\Node;

/**
 * Class FunctionParser
 *
 * @package MikevanDiepen\Strictly\Lexer\Options
 */
final class FunctionParser implements NodeLexerOptionInterface
{
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
        $functionNode = new FunctionNode();
        $functionNode->setName($node->name->name);
        $functionNode->setStartLine($node->getStartLine());
        $functionNode->setEndLine($node->getEndLine());

        // Parsing through all the parameters and handling them.
        for ($i = 0; $i < count($node->getParams()); $i++) {
            $parameter = new ParameterParser();
            $parameter->setParameterIndex($i);

            $newNode = $node->getParams()[$i];

            $parameterNode = $parameter->parse($newNode);
            if ($parameterNode instanceof ParameterNode) {
                $functionNode->setParameters($parameterNode);
            }
        }

        $returnNode = new ReturnParser();
        $returnNode = $returnNode->parse($node);
        if ($returnNode instanceof ReturnNode) {
            $functionNode->setReturn($returnNode);
        }

        return $functionNode;
    }
}