<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\MethodNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes\ReturnParser;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes\ParameterParser;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class MethodParser.
 *
 * @package Mikevandiepen\Strictly\Parser\Options
 */
final class MethodParser implements ParserOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode
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