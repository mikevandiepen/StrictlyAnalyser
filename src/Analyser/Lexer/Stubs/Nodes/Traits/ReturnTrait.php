<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode;
use MikevanDiepen\Strictly\Exception\StrictlyException;

/**
 * Trait ReturnTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits
 */
trait ReturnTrait
{
    /**
     * The return which belongs to the arrow function node.
     *
     * This property can be accessed through:
     * @method setReturn(ReturnNode $returnAttribute): self
     * @method getReturn(): ReturnNode
     *
     * @var ReturnNode
     */
    private ReturnNode $return;

    /**
     * Getting the return from the node.
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode
     */
    public function getReturn(): ReturnNode
    {
        return $this->return;
    }

    /**
     * Setting the return from the node.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ReturnNode $returnNode
     *
     * @return void
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function setReturn(ReturnNode $returnNode): void
    {
        if ($returnNode instanceof ReturnNode) {
            $this->return = $returnNode;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected ReturnNode.');
        }
    }
}