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
 * Class DocblockReturnParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options
 */
final class DocblockReturnParser extends AbstractDocblockParser
{
    /**
     * An option specific parser process.
     *
     * @param \phpDocumentor\Reflection\DocBlock $docblock
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\TypeNode
     */
    public function parse(Docblock $docblock): TypeNode
    {
        // Whether the docblock is suppressed by inheritdoc.
        if ($this->isSuppressedByInheritdoc($docblock)) {
            $typeDefinition = new TypeUndefinedNode();
        } else {
            // Collecting the type from the docblock.
            /** @var \phpDocumentor\Reflection\DocBlock\Tags\Return_[] $returnTags */
            $returnTags = $docblock->getTagsByName(parent::RETURN_TAG);

            // By default marking the type as undefined.
            $typeDefinition = new TypeUndefinedNode();

            foreach ($returnTags as $returnTag) {
                $typeDefinition = (new HintedTypeParser())->parse(
                    $returnTag->getType()
                );
            }
        }

        return new TypeNode($typeDefinition, new HintedTypeNode());
    }
}