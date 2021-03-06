<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\FunctionLikeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\LineTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\ParameterTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\ReturnTrait;

/**
 * Class ArrowFunctionNode
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes
 */
final class ArrowFunctionNode extends AbstractNode implements FunctionLikeNode
{
    use LineTrait, ParameterTrait, ReturnTrait;
}