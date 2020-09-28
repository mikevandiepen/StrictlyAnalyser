<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\LineTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\ReturnTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\ParameterTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\FunctionLikeNode;

/**
 * Class MethodNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes
 */
final class MethodNode extends AbstractNode implements FunctionLikeNode, \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType
{
    use LineTrait, ParameterTrait, ReturnTrait;
}