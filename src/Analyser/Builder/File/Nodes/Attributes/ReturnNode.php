<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes;

use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\AbstractNode;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Traits\TypeTrait;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Contracts\HasType;

/**
 * Class ReturnAttribute.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Attributes
 */
final class ReturnNode extends AbstractNode implements HasType
{
    use TypeTrait;
}