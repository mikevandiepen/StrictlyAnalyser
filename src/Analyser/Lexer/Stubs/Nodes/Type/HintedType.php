<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type;

use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Object_;
use phpDocumentor\Reflection\Types\Compound;

/**
 * Class HintedType.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type
 */
final class HintedType extends AbstractType
{
    /**
     * DeclaredType constructor.
     *
     * Resolving the types hinted in the docblock, all the types will be made as detailed as
     * possible and casted to string.
     *
     * @param \phpDocumentor\Reflection\Type $type
     *
     * @throws \ReflectionException
     */
    public function __construct(Type $type)
    {
        $processedTypes = [];

        if ($type instanceof Compound) {
            foreach (explode('|', $type) as $tagType) {
                $processedTypes[] = ltrim($tagType, '\\');
            }
        } else {
            if ($type instanceof Object_) {
                $processedTypes[] = (new \ReflectionClass($type))->getShortName();
            } else {
                $processedTypes[] = $type;
            }
        }

        $this->type = $processedTypes;
    }
}