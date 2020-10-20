<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Traits;

use MikevanDiepen\Strictly\Exception\StrictlyException;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Compound;
use phpDocumentor\Reflection\Types\Mixed_;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Object_;
use PhpParser\Node;

/**
 * Trait ParseDocblockTrait.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Lexer\Options\Traits
 */
trait ParseDocblockTrait
{
    /**
     * The docblock.
     * This property can be accessed through:
     * @method setDocblock(Docblock $docblock): self
     * @method getDocblock(): Docblock
     *
     * @var Docblock
     */
    private Docblock $docblock;

    /**
     * Setting the node from which the docblock should be extracted.
     *
     * @param \PhpParser\Node $node
     *
     * @return self
     */
    public function setDocblockFromNode(Node $node): self
    {
        $docblock = $node->getDocComment() !== null ? $node->getDocComment()->getText() : '/** */';
        $this->docblock = DocBlockFactory::createInstance()->create($docblock);

        return $this;
    }

    /**
     * Collecting the property from the docblock.
     *
     * @return \phpDocumentor\Reflection\Type|null
     * @throws StrictlyException
     */
    protected function getHintedPropertyType(): ?Type
    {
        $tagName = 'var';

        if ($this->isSuppressedByType($tagName)) {
            return null;
        }

        /** @var \phpDocumentor\Reflection\DocBlock\Tags\Property[] $tags */
        $tags = $this->getDocblock()->getTagsByName($tagName);

        if (count($tags) === 0) {
            return null;
        }

        return $tags[0]->getType();
    }

    /**
     * Dynamically validating whether the type of the given tag is suppressed by type in the docblock.
     * A compound type for example is "string|null", the "var", "param" and "return" tags can all have
     * compound types. Other types which will suppress are "Mixed_" and "Object_".
     * If the parameter argument is set the validation will analyse that specific parameter name.
     * Because validating all parameters is not the most effective way to approach the analysis.
     *
     * @param string      $type
     * @param string|null $parameter
     *
     * @return bool
     * @throws StrictlyException
     */
    protected function isSuppressedByType(string $type, ?string $parameter = null): bool
    {
        /** @var \phpDocumentor\Reflection\DocBlock\Tags\Property[] $tags */
        $tags = $this->getDocblock()->getTagsByName($type);

        foreach ($tags as $tag) {
            // The parameter analysis deviates from the default analysis.
            // since the analysis will be done by parameter name the approach is slightly different.
            if ($type === 'parameter' && $parameter !== null) {
                if ($tag->getVariableName() === $parameter) {
                    if ($this->typeIsset($tag->getType())) {
                        return true;
                    }
                    if ($this->typeIsMixed($tag->getType())) {
                        return true;
                    }
                    if ($this->typeIsObject($tag->getType())) {
                        return true;
                    }
                    if ($this->typeIsCompound($tag->getType())) {
                        return true;
                    }
                }

                continue;
            }

            if ($this->typeIsset($tag->getType())) {
                return true;
            }
            if ($this->typeIsMixed($tag->getType())) {
                return true;
            }
            if ($this->typeIsObject($tag->getType())) {
                return true;
            }
            if ($this->typeIsCompound($tag->getType())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Getting the docblock.
     *
     * @return \phpDocumentor\Reflection\Docblock
     */
    public function getDocblock(): Docblock
    {
        return $this->docblock;
    }

    /**
     * Analysing whether the type is set.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return bool
     */
    private function typeIsset(?Type $type): bool
    {
        return (bool) ($type !== null);
    }

    /**
     * Analysing whether the type is of abstract Mixed_.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return bool
     */
    private function typeIsMixed(?Type $type): bool
    {
        return (bool) ($type instanceof Mixed_);
    }

    /**
     * Analysing whether the type is an object. This can be the abstract Object_ type or a
     * custom object hinted by the developer.
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return bool
     */
    private function typeIsObject(?Type $type): bool
    {
        return (bool) (($type instanceof Object_) && (!$type->getFqsen()));
    }

    /**
     * Analysing whether the type is a compound type.
     * A compound type in a docblock will look like this "string|null".
     *
     * @param \phpDocumentor\Reflection\Type|null $type
     *
     * @return bool
     * @throws StrictlyException
     */
    private function typeIsCompound(?Type $type): bool
    {
        if ($type instanceof Compound) {
            if (2 === $type->getIterator()->count()) {
                // Ex: string|null => ?string
                foreach ($type as $t) {
                    if ($t instanceof Null_) {
                        return (bool) false;
                    }
                }
            }

            return (bool) true;
        }

        return (bool) false;
    }

    /**
     * Collecting the return from the docblock.
     *
     * @return \phpDocumentor\Reflection\Type|null
     * @throws StrictlyException
     */
    protected function getHintedReturnType(): ?Type
    {
        $tagName = 'return';

        if ($this->isSuppressedByType($tagName)) {
            return null;
        }

        /** @var \phpDocumentor\Reflection\DocBlock\Tags\Return_[] $tags */
        $tags = $this->docblock->getTagsByName($tagName);

        if (count($tags) === 0) {
            return null;
        }

        return $tags[0]->getType();
    }

    /**
     * Collecting the parameter from the docblock based upon the given parameter.
     * Returning null if the parameter is untyped.
     *
     * @param string $parameter
     *
     * @return \phpDocumentor\Reflection\Type|null
     * @throws StrictlyException
     */
    protected function getHintedParameterType(string $parameter): ?Type
    {
        $tagName = 'param';

        if ($this->isSuppressedByType($tagName)) {
            return null;
        }

        /** @var \phpDocumentor\Reflection\DocBlock\Tags\Param[] $tags */
        $tags = $this->docblock->getTagsByName($tagName);

        foreach ($tags as $tag) {
            // Validating whether the parameter tag has a type based upon the given type.
            if ($tag->getVariableName() !== $parameter) {
                continue;
            }

            return $tag->getType();
        }

        return null;
    }

    /**
     * Validating whether the docblock is suppressed by "inheritdoc" (Parent class docblock).
     *
     * @return bool
     */
    protected function isSuppressedByInheritDoc(): bool
    {
        $inheritdoc = [
            '{@inheritdoc}',
            '@inheritdoc',
            'inheritdoc'
        ];

        if (in_array(strtolower($this->docblock->getSummary()), $inheritdoc)) {
            return true;
        }

        foreach ($this->docblock->getDescription()->getTags() as $tag) {
            $matchesTags = in_array(strtolower($this->docblock->getSummary()), $inheritdoc);

            if ($tag instanceof Generic && $matchesTags) {
                return true;
            }
        }

        return false;
    }
}