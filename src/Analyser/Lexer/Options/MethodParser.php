<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options;

use PhpParser\Node;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MethodNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ReturnParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits\ParseDocblockTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes\ParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\LexerOptionInterface;

/**
 * Class MethodParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options
 */
final class MethodParser implements LexerOptionInterface
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
        $this->setDocblockFromNode($node);

        $methodNode = new MethodNode();
        $methodNode->setName($node->name);
        $methodNode->setStartLine($node->getStartLine());
        $methodNode->setEndLine($node->getEndLine());

        // Parsing through all the parameters and handling them.
        for ($i = 0; $i < count($node->getParams()); $i++) {
            $parameter = new ParameterParser();
            $parameter->setDocblockFromNode($node);
            $parameter->setParameterIndex($i);

            $newNode = $node->getParams()[$i];

            $methodNode->setParameters($parameter->parse($newNode));
        }

        $return = new ReturnParser();
        $return->setDocblockFromNode($node);

        $methodNode->setReturn($return->parse($node));

        return $methodNode;
    }
}