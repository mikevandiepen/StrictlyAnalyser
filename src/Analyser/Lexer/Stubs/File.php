<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs;

use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MethodNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ClosureNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\PropertyNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\FunctionNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MagicMethodNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ArrowFunctionNode;

/**
 * Class Nodes.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs
 */
final class File
{
    /**
     * The name of the file.
     *
     * This property can be accessed through:
     * @method setFileName(string $fileName): self
     * @method getFileName(): string
     *
     * @var string
     */
    private string $fileName;

    /**
     * The path where the file is located.
     *
     * This property can be accessed through:
     * @method setFilePath(string $filePath): self
     * @method getFilePath(): string
     *
     * @var string
     */
    private string $filePath;

    /**
     * The size of the file in bytes.
     *
     * This property can be accessed through:
     * @method setFileSize(int $fileSize): self
     * @method getFileSize(): int
     *
     * @var int
     */
    private int $fileSize;

    /**
     * The arrow function nodes from this file.
     *
     * This property can be accessed through:
     * @method setArrowFunction(ArrowFunctionNode $node): self
     * @method getArrowFunctions(): ArrowFunctionNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ArrowFunctionNode[]
     */
    private array $arrowFunctions = [];

    /**
     * The closure nodes from this file.
     *
     * This property can be accessed through:
     * @method setClosure(ClosureNode $node): self
     * @method getClosures(): ClosureNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ClosureNode[]
     */
    private array $closures = [];

    /**
     * The function nodes from this file.
     *
     * This property can be accessed through:
     * @method setFunctionNode(FunctionNode $node): self
     * @method getFunctionNodes(): FunctionNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\FunctionNode[]
     */
    private array $functions = [];

    /**
     * The magic method nodes from this file.
     *
     * This property can be accessed through:
     * @method setMagicMethod(MagicMethodNode $node): self
     * @method getMagicMethods(): MagicMethodNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MagicMethodNode[]
     */
    private array $magicMethods = [];

    /**
     * The method nodes from this file.
     *
     * This property can be accessed through:
     * @method setMethod(MethodNode $node): self
     * @method getMethods(): MethodNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MethodNode[]
     */
    private array $methods = [];

    /**
     * The property nodes from this file.
     *
     * This property can be accessed through:
     * @method setProperty(PropertyNode $node): self
     * @method getProperties(): PropertyNode[]
     *
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\PropertyNode[]
     */
    private array $properties = [];

    /**
     * Getting the name of this file.
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Setting the name of this file.
     *
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Getting the path of this file.
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Setting the path of this file.
     *
     * @param string $filePath
     *
     * @return $this
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * Getting the size of this file.
     *
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * Setting the size of this file.
     *
     * @param int $fileSize
     *
     * @return $this
     */
    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Setting the arrow functions of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setArrowFunction(AbstractNode $node): self
    {
        if ($node instanceof ArrowFunctionNode) {
            $this->arrowFunctions[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected ArrowFunctionNode.');
        }

        return $this;
    }

    /**
     * Getting the arrow functions of this file.
     *
     * @return array
     */
    public function getArrowFunctions(): array
    {
        return $this->arrowFunctions;
    }

    /**
     * Setting the closures of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setClosure(AbstractNode $node): self
    {
        if ($node instanceof ClosureNode) {
            $this->closures[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected ClosureNode.');
        }

        return $this;
    }

    /**
     * Getting the closures of this file.
     *
     * @return array
     */
    public function getClosures(): array
    {
        return $this->closures;
    }

    /**
     * Setting the function of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setFunction(AbstractNode $node): self
    {
        if ($node instanceof FunctionNode) {
            $this->functions[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected FunctionNode.');
        }

        return $this;
    }

    /**
     * Getting the function of this file.
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return $this->functions;
    }

    /**
     * Setting the magic methods of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setMagicMethod(AbstractNode $node): self
    {
        if ($node instanceof MagicMethodNode) {
            $this->magicMethods[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected MagicMethodNode.');
        }

        return $this;
    }

    /**
     * Getting the magic methods of this file.
     *
     * @return array
     */
    public function getMagicMethods(): array
    {
        return $this->magicMethods;
    }

    /**
     * Setting the methods of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setMethod(AbstractNode $node): self
    {
        if ($node instanceof MethodNode) {
            $this->methods[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected MethodNode.');
        }

        return $this;
    }

    /**
     * Getting the methods of this file.
     *
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * Setting the properties of this file.
     *
     * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\AbstractNode $node
     *
     * @return $this
     * @throws StrictlyException
     */
    public function setProperty(AbstractNode $node): self
    {
        if ($node instanceof PropertyNode) {
            $this->properties[] = $node;
        } else {
            throw new StrictlyException('Incorrect node supplied! Expected PropertyNode.');
        }

        return $this;
    }

    /**
     * Getting the properties of this file.
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }
}