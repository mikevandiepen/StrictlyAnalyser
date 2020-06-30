<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use PhpParser\Node;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\HintedType;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type\DeclaredType;

/**
 * Class AbstractNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
abstract class AbstractNode
{
    /**
     * The node which will be subject to preparation.
     *
     * @var Node
     */
    protected Node $node;

    /**
     * The name of the node.
     *
     * This property can be accessed through:
     * @method setName(string $name): self
     * @method getName(): string
     *
     * @var string
     */
    private string $name;

    /**
     * Setting the name of the node.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getting the name of the node.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}