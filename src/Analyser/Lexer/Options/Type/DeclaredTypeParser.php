<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Type;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\DeclaredTypeLexerInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\DeclaredCompoundTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\DeclaredPseudoTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\DeclaredScalarTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\Declared\DeclaredSpecialTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ArrayTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\CallableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\IterableTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\CompoundTypes\ObjectTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\MixedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\NumberTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\PseudoTypes\VoidTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\BooleanTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\FloatTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\IntegerTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\ScalarTypes\StringTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\NullTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Options\SpecialTypes\ResourceTypeNode;
use PhpParser\Node\Identifier;

/**
 * Class DeclaredTypeParser
 * @see https://www.php.net/manual/en/language.types.intro.php
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Type
 */
final class DeclaredTypeParser implements DeclaredTypeLexerInterface
{
    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\AbstractTypeNode
     */
    public function parse(Identifier $type): AbstractTypeNode
    {
        if ($this->isScalar($type)) {
            return (new DeclaredScalarTypeParser())->parse($type);
        }

        if ($this->isCompound($type)) {
            return (new DeclaredCompoundTypeParser())->parse($type);
        }

        if ($this->isSpecial($type)) {
            return (new DeclaredSpecialTypeParser())->parse($type);
        }

        if ($this->isPseudo($type)) {
            return (new DeclaredPseudoTypeParser())->parse($type);
        }

        return new TypeUndefinedNode();
    }

    /**
     * Whether the type is a scalar type.
     * @example ("boolean", "integer", "float", "string").
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isScalar(Identifier $type): bool
    {
        /** @var string[] $scalarTypes All the type stubs. */
        $scalarTypes = [
            new BooleanTypeNode(),
            new IntegerTypeNode(),
            new FloatTypeNode(),
            new StringTypeNode(),
        ];

        return (bool) (in_array(strtolower($type->name) , $scalarTypes));
    }

    /**
     * Whether the type is a compound type.
     * @example ("array", "object", "callable", "iterable").
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isCompound(Identifier $type): bool
    {
        /** @var string[] $compoundTypes All the type stubs. */
        $compoundTypes = [
            new ArrayTypeNode(),
            new ObjectTypeNode(),
            new CallableTypeNode(),
            new IterableTypeNode(),
        ];

        return (bool) (in_array(strtolower($type->name) , $compoundTypes));
    }

    /**
     * Whether the type is a special type.
     * @example ("resource", "null").
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isSpecial(Identifier $type): bool
    {
        /** @var string[] $specialTypes All the type stubs. */
        $specialTypes = [
            new ResourceTypeNode(),
            new NullTypeNode(),
        ];

        return (bool) (in_array(strtolower($type->name) , $specialTypes));
    }

    /**
     * Whether the type is a scalar type.
     * @example ("mixed", "number", "void").
     *
     * @param \PhpParser\Node\Identifier $type
     *
     * @return bool
     */
    private function isPseudo(Identifier $type): bool
    {
        /** @var string[] $pseudoTypes All the type stubs. */
        $pseudoTypes = [
            new MixedTypeNode(),
            new NumberTypeNode(),
            new VoidTypeNode(),
        ];

        return (bool) (in_array(strtolower($type->name) , $pseudoTypes));
    }
}