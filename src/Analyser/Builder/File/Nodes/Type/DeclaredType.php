<?php

namespace Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type;

use PhpParser\Node;

/**
 * Class DeclaredType.
 *
 * @package Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\Type
 */
final class DeclaredType extends AbstractType
{
    /**
     * TODO: Improve the type analysis with PHPDocumentor.
     *
     * DeclaredType constructor.
     *
     * @param Node\Identifier|Node\Name|Node\NullableType|Node\UnionType|null $node
     */
    public function __construct($node)
    {
        $type = [];

        if ($node === null) {
            $this->type = $type;
        }

        if ($node instanceof Node\Param) {
            $type[] = $this->getTypeFromNode($node->type);
        }

        if (isset($node->type)) {
            if (isset($node->type) && ($node->type === null || in_array($node->type, ['NULL', 'Null', 'null']))) {
                $type[] = 'null';
            }

            if ($node->type instanceof Node\NullableType) {
                $type[] = $this->getTypeFromNode($node->type);
            }

            if ($node->type instanceof Node\UnionType) {
                // Iterating through the union types.
                foreach ($node->type as $item) {
                    $type[] = $this->getTypeFromNode($item);
                }
            }
        } else {
            if ($node instanceof Node\Identifier) {
                $type[] = ltrim($node->name, '\\');
            }

            if ($node instanceof Node\Name) {
                if (count($node->parts) > 0) {
                    $type[] = implode('', $node->parts);
                }
            }
        }

        $this->type = $type;
    }
}