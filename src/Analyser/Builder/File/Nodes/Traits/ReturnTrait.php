<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ReturnNode;

/**
 * Trait ReturnTrait.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits
 */
trait ReturnTrait
{
    /**
     * The return which belongs to the arrow function node.
     * This property can be accessed through:
     * @method setReturn(ReturnNode $returnAttribute): self
     * @method getReturn(): ReturnAttribute
     *
     * @var ReturnNode
     */
    private ReturnNode $return;

    /**
     * Setting the return from the node.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode $returnNode
     *
     * @return self
     * @throws \Exception
     */
    public function setReturn(AbstractNode $returnNode): self
    {
        if ($returnNode instanceof ReturnNode) {
            $this->return = $returnNode;
        } else {
            throw new \Exception('Incorrect node supplied! Expected ReturnNode.');
        }

        return $this;
    }

    /**
     * Getting the return from the node.
     *
     * @return \Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes\ReturnNode
     */
    public function getReturn(): ReturnNode
    {
        return $this->return;
    }
}