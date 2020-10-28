<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeDefinitionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeDefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Mixed_;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;
use phpDocumentor\Reflection\Types\Object_;
use phpDocumentor\Reflection\Types\Scalar;

/**
 * Class HintedTypeParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type
 */
final class HintedTypeParser
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\TypeDefinitionInterface
     */
    public function parse(?Type $type): TypeDefinitionInterface
    {
        // Whether the node is typed, else returning undefined stub.
        $typeDefinition = empty($type) ? new TypeUndefinedNode() : new TypeDefinedNode();

        if ($typeDefinition instanceof TypeDefinedNode) {
            /** @var \phpDocumentor\Reflection\Types\Nullable are nullable types.  */
            if ($type instanceof Nullable) {
                $typeDefinition->setType(['null']);

                // Setting also the type.
                $typeDefinition->setType([$type->getActualType()]);
            }

            if ($type instanceof Compound) {
                foreach ($type as $t) {
                    // Running recursive calls on the types.
                    $this->parse($t);
                }
            }

            if ($type instanceof Object_) {
                if ($type->getFqsen()) {
                    $typeDefinition->setType([$type->getFqsen()]);
                } else {
                    // Generic object type has been hinted, this is bad practice.
                    $typeDefinition = new TypeUndefinedNode();
                }
            }

            if ($type instanceof Mixed_) {
                // Generic mixed type has been hinted, this is bad practice.
                $typeDefinition = new TypeUndefinedNode();
            }

            if ((!$type instanceof Compound) && (!$type instanceof Object_) && (!$type instanceof Nullable)) {
                $typeDefinition->setType([$type]);
            }
        }

        return $typeDefinition;
    }
}