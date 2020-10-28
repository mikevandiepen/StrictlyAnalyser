<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use phpDocumentor\Reflection\DocBlockFactory;
use PhpParser\Node;

/**
 * Class AbstractDocblockParser
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock
 */
abstract class AbstractDocblockParser
{
    protected const PROPERTY_TAG = 'var';
    protected const PARAMETER_TAG = 'param';
    protected const RETURN_TAG = 'return';

    /**
     * @param \PhpParser\Node $node
     *
     * @return \phpDocumentor\Reflection\DocBlock
     */
    public function getDocblockFromNode(Node $node): Docblock
    {
        $docblock = '/** */';

        return DocblockFactory::createInstance()->create(
            $node->getDocComment() !== null ? $node->getDocComment()->getText() : $docblock
        );
    }

    /**
     * Whether the docblock is suppressed by inheritdoc.
     *
     * @param \phpDocumentor\Reflection\DocBlock $docblock
     *
     * @return bool
     */
    protected function isSuppressedByInheritdoc(Docblock $docblock): bool
    {
        $inheritdoc = [
            '{@inheritdoc}',
            '@inheritdoc',
            'inheritdoc'
        ];

        if (in_array(strtolower($docblock->getSummary()), $inheritdoc)) {
            return true;
        }

        // The tag is a type, now checking whether the type is generic.
        foreach ($docblock->getDescription()->getTags() as $tag) {
            $matchesTags = in_array(strtolower($docblock->getSummary()), $inheritdoc);

            if ($tag instanceof Generic && $matchesTags) {
                return true;
            }
        }

        return false;
    }
}