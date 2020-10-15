<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes;

use PhpParser\Node;

/**
 * Class AbstractNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes
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
     * Getting the name of the node.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

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
}