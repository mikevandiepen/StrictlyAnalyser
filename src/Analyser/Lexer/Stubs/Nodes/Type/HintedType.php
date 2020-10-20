<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\TypeDefined;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Structural\TypeUndefined;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Object_;

/**
 * Class HintedType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
final class HintedType extends AbstractType
{
    /**
     * DeclaredType constructor.
     * Resolving the types hinted in the docblock, all the types will be made as detailed as
     * possible and casted to string.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @throws \ReflectionException
     */
    public function __construct(?Type $type)
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
     * @throws \ReflectionException
     */
    protected function getTypeFromNode($type): void
    {
        if (empty($type)) {
            $this->setType(new TypeUndefined());

            return;
        }

        if ($type instanceof Compound) {
            foreach (explode('|', $type) as $tagType) {
                $this->setType(new TypeDefined(ltrim($tagType, '\\')));
            }
        } else {
            if ($type instanceof Object_) {
                $this->setType(new TypeDefined((new \ReflectionClass($type))->getShortName()));
            } else {
                $this->setType(new TypeDefined($type));
            }
        }
    }
}