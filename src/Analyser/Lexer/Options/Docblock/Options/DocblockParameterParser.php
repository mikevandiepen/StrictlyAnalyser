<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\AbstractDocblockParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\HintedTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Definition\TypeUndefinedNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode;
use phpDocumentor\Reflection\DocBlock;

/**
 * Class DocblockParameterParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options
 */
final class DocblockParameterParser extends AbstractDocblockParser
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\DocBlock $docblock
     * @param string                             $parameter
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode
     */
    public function parse(Docblock $docblock, string $parameter): TypeNode
    {
        // Whether the docblock is suppressed by inheritdoc.
        if ($this->isSuppressedByInheritdoc($docblock)) {
            $typeDefinition = new TypeUndefinedNode();
        } else {
            // Collecting the type from the docblock.
            /** @var \phpDocumentor\Reflection\DocBlock\Tags\Param[] $parameterTags */
            $parameterTags = $docblock->getTagsByName(parent::PARAMETER_TAG);

            // By default marking the type as undefined.
            $typeDefinition = new TypeUndefinedNode();

            foreach ($parameterTags as $parameterTag) {
                if ($parameterTag->getVariableName() === $parameter) {
                    $typeDefinition = (new HintedTypeParser())->parse(
                        $parameterTag->getType()
                    );
                }
            }
        }

        return new TypeNode($typeDefinition, new HintedTypeNode());
    }
}