<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\LineTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ReturnTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\ParameterTrait;

/**
 * Class ArrowFunctionNode
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes
 */
final class ArrowFunctionNode extends AbstractNode
{
    use LineTrait, ParameterTrait, ReturnTrait;
}