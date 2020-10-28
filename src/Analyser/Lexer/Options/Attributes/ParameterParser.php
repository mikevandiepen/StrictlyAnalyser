<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Options\Attributes;

use MikevanDiepen\Strictly\Analyser\Lexer\Options\Contracts\NodeLexerOptionInterface;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Docblock\Options\DocblockParameterParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\Type\DeclaredTypeParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Attributes\ParameterNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\DeclaredTypeNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Type\Location\HintedTypeNode;
use PhpParser\Node;

/**
 * Class ReturnParser.
 *
 * @package MikevanDiepen\Strictly\Lexer\Options\Attributes
 */
final class ParameterParser implements NodeLexerOptionInterface
{
    /**
     * The index of the parameter.
     * This property can be accessed through:
     * @method setParameterIndex(int $index): self
     * @method getParameterIndex(): int
     *
     * @var int
     */
    private int $parameterIndex;

    /**
     * An option specific parser process.
     *
     * @param \PhpParser\Node $node
     *
     * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode
     * @throws \ReflectionException
     */
    public function parse(Node $node): AbstractNode
    {
        $parameterNode = new ParameterNode();

        if (!$node->var instanceof Node\Expr\Error) {
            if ($node->var instanceof Node\Expr\Variable) {
                $parameterNode->setParameterIndex($this->getParameterIndex());
                $parameterNode->setParameterName($node->var->name);

                $docblockParser = (new DocblockParameterParser());
                $docblock = $docblockParser->getDocblockFromNode($node);
                $hintedTypeNode = $docblockParser->parse($docblock, $node->var->name);

                if ($hintedTypeNode instanceof HintedTypeNode) {
                    $parameterNode->setHintedTypeNode($hintedTypeNode);
                }

                $declaredTypeNode = (new DeclaredTypeParser())->parse($node);
                if ($declaredTypeNode instanceof DeclaredTypeNode) {
                    $parameterNode->setDeclaredTypeNode($declaredTypeNode);
                }
            }
        }

        return $parameterNode;
    }

    /**
     * Getting the index of the parameter.
     *
     * @return int
     */
    public function getParameterIndex(): int
    {
        return $this->parameterIndex;
    }

    /**
     * Setting the index of the parameter.
     *
     * @param int $parameterIndex
     *
     * @return $this
     */
    public function setParameterIndex(int $parameterIndex): self
    {
        $this->parameterIndex = $parameterIndex;

        return $this;
    }
}