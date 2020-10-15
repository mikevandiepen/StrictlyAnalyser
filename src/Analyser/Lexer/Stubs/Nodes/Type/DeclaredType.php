<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use PhpParser\Node;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\TypeDefined;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\TypeUndefined;

/**
 * Class DeclaredType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
final class DeclaredType extends AbstractType
{
    /**
     * TODO: Improve the type analysis with PHPDocumentor.
     *
     * DeclaredType constructor.
     *
     * @param Node\Identifier|Node\Name|Node\NullableType|Node\UnionType|null $type
     */
    public function __construct($type)
    {
        $this->getTypeFromNode($type);
    }

	/**
	 * The nodes are assigned in the constructor and that is where the process starts.
	 * This method is purely so it can run recursively.
	 *
	 * @param $type
	 *
	 * @return void
	 */
	protected function getTypeFromNode($type): void
	{
		if (empty($type)) {
			$this->setType(new TypeUndefined());

			return;
		}

		if ($type instanceof Node\Param) {
			$this->getTypeFromNode($type->type);
		}

		if (isset($type->type)) {
			if (isset($type->type) && ($type->type === null || in_array($type->type, ['NULL', 'Null', 'null']))) {
				$this->getTypeFromNode(null);
			}

			if ($type->type instanceof Node\NullableType) {
				$this->getTypeFromNode($type->type);
			}

			if ($type->type instanceof Node\UnionType) {
				// Iterating through the union types.
				foreach ($type->type as $item) {
					$this->getTypeFromNode($item);
				}
			}
		} else {
			if ($type instanceof Node\Identifier) {
				$this->setType(new TypeDefined(ltrim($type->name, '\\')));
			}

			if ($type instanceof Node\Name) {
				if (count($type->parts) > 0) {
					$this->setType(new TypeDefined(implode('', $type->parts)));
				}
			}
		}
	}
}