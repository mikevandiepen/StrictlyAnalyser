<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\LineTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ReturnTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ParameterTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\FunctionLikeNode;

/**
 * Class MethodNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
final class MethodNode extends AbstractNode implements FunctionLikeNode
{
    use LineTrait, ParameterTrait, ReturnTrait;
}