<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ClosureNode;
use PhpParser\Node;

/**
 * Class ClosureParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options
 */
final class ClosureParser implements LexerOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     * @throws \ReflectionException
     */
    public function parse(Node $node): AbstractNode
    {
        $functionNode = new ClosureNode();
        $functionNode->setName('Closure');
        $functionNode->setStartLine($node->getStartLine());
        $functionNode->setEndLine($node->getEndLine());

        // Parsing through all the parameters and handling them.
        $nodeParams = $node->getParams();
        for ($i = 0; $i < count($nodeParams); $i++) {
            $parameter = new ParameterParser();
            $parameter->setDocblockFromNode($node);
            $parameter->setParameterIndex($i);

            $parameterNode = $parameter->parse($nodeParams[$i]);
            if ($parameterNode instanceof ParameterNode) {
                $functionNode->setParameters($parameterNode);
            }
        }

        $return = new ReturnParser();
        $return->setDocblockFromNode($node);

        $returnNode = $return->parse($node);
        if ($returnNode instanceof ReturnNode) {
            $functionNode->setReturn($returnNode);
        }

        return $functionNode;
    }
}