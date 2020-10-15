<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits\TypeTrait;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;

/**
 * Class ReturnAttribute.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes
 */
final class ReturnNode extends AbstractNode implements HasType
{
    use TypeTrait;
}