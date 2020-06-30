<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\LineTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ReturnTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ParameterTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\FunctionLikeNode;

/**
 * Class MagicMethodNode.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
final class MagicMethodNode extends AbstractNode implements FunctionLikeNode
{
    use LineTrait, ParameterTrait, ReturnTrait;
}