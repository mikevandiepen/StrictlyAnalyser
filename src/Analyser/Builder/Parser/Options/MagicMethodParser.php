<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\Parser\Options;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\MagicMethodNode;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes\ReturnParser;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Traits\ParseDocblockTrait;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Attributes\ParameterParser;
use Mikevandiepen\Strictly\Analyser\Builder\Parser\Options\Contracts\ParserOptionInterface;

/**
 * Class MagicMethodParser.
 *
 * @package Mikevandiepen\Strictly\Parser\Options
 */
final class MagicMethodParser implements ParserOptionInterface
{
    use ParseDocblockTrait;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode
     * @throws \Exception
     */
    public function parse(Node $node): AbstractNode
    {
        $magicMethodNode = new MagicMethodNode();
        $magicMethodNode->setName($node->name);
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
    }æ
}