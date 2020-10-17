<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer;

use PhpParser\Node;
use PhpParser\ParserFactory;
use Symfony\Component\Finder\SplFileInfo;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\MethodParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\ClosureParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\PropertyParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\FunctionParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\MagicMethodParser;
use MikevanDiepen\Strictly\Analyser\Lexer\Options\ArrowFunctionParser;

/**
 * Class Lexer.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer
 */
final class Lexer
{
    /**
     * @var \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File
     */
    private File $file;

    /**
     * All the names of the magic methods.
     *
     * @var array
     */
    private array $magicMethods = [
        '__construct',
        '__destruct',
        '__call',
        '__callStatic',
        '__get',
        '__set',
        '__isset',
        '__unset',
        '__sleep',
        '__wakeup',
        '__toString',
        '__invoke',
        '__set_state',
        '__clone',
        '__debugInfo',
    ];

	/**
	 * Stubs constructor.
	 * Handling the file and sorting the nodes into the correct node group.
	 *
	 * @param SplFileInfo $file
	 *
	 * @throws StrictlyException
	 * @throws \ReflectionException
	 */
    public function __construct(SplFileInfo $file)
    {
        // Creating a new "mock" file.
        $this->setFile(new File());

        // Adding the file meta to the "mock" file.
        $this->getFile()->setFileName($file->getFilename());
        $this->getFile()->setFilePath($file->getPath());
        $this->getFile()->setFileSize($file->getSize());

        $parser = (new ParserFactory())->create(ParserFactory::ONLY_PHP7);
        $nodes = $parser->parse($file->getContents());

        // Parsing through all the nodes and preparing the file's content for analysis.
        foreach ($nodes as $node) {
            $this->analyseNode($node);
        }
    }

	/**
	 * Analysing the node and storing the node in the right node-group.
	 *
	 * @param Node $node
	 *
	 * @return void
	 * @throws StrictlyException
	 * @throws \ReflectionException
	 */
    private function analyseNode(Node $node): void
    {
        if ($this->isAssign($node)) {
            $this->analyseNode($node->expr); // Recursive call on the nodes expressions.
        }

        if ($this->isClass($node)) {
            $this->parseSubNodes($node);
        }

        if ($this->isCallable($node)) {
            $this->parseNodeArguments($node);
        }

        if ($this->isExpression($node)) {
            $this->analyseNode($node->expr); // Recursive call on the nodes expressions.
        }

        if ($this->isFunctionLike($node)) {
            if ($this->isArrowFunction($node)) {
                $this->getFile()->setArrowFunction(
                	(new ArrowFunctionParser())->parse($node)
				);
            }

            if ($this->isClosure($node)) {
                $this->getFile()->setClosure(
                	(new ClosureParser())->parse($node)
				);
            }

            if ($this->isFunction($node)) {
                $this->getFile()->setFunction(
                	(new FunctionParser())->parse($node)
				);
            }

            if ($this->isMagicMethod($node)) {
                $this->getFile()->setMagicMethod(
                	(new MagicMethodParser())->parse($node)
				);
            }

            if ($this->isMethod($node)) {
                $this->getFile()->setMethod(
                	(new MethodParser())->parse($node)
				);
            }
        }

        if ($this->isPropertyGroup($node)) {
            $this->parsePropertyGroup($node);
        }

        if ($this->isProperty($node)) {
            $this->getFile()->setProperty(
            	(new PropertyParser())->parse($node)
			);
        }

        $this->parseSubNodes($node); // No particular nodes found, parsing the sub nodes.
    }

    /**
     * Whether the node is an instance of assign.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isAssign(Node $node): bool
    {
        return (bool) ($node instanceof Node\Expr\Assign);
    }

    /**
     * Whether the node is an instance of Class.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isClass(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\Class_);
    }

    /**
     * Parsing the sub nodes of the parent node.
     *
     * @param Node $node
     *
     * @return void
     * @throws StrictlyException|\ReflectionException
	 */
    private function parseSubNodes(Node $node): void
    {
        if (isset($node->stmts) && count($node->stmts) > 0) {
            foreach ($node->stmts as $subNode) {
                // Running a recursive call for the sub node.
                $this->analyseNode($subNode);
            }
        }
    }

    /**
     * Whether the node falls in the callable group.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isCallable(Node $node): bool
    {
        $functionCall = ($node instanceof Node\Expr\FuncCall);
        $methodCall = ($node instanceof Node\Expr\MethodCall);
        $staticCall = ($node instanceof Node\Expr\StaticCall);

        return (bool) ($functionCall || $methodCall || $staticCall);
    }

    /**
     * Parsing the arguments of the parent node.
     *
     * @param Node $node
     *
     * @return void
     * @throws StrictlyException
     */
    private function parseNodeArguments(Node $node): void
    {
        foreach ($node->args as $arg) {
            $this->analyseNode($arg->value);
        }
    }

    /**
     * Whether the node is an instance of expression.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isExpression(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\Expression);
    }

    /**
     * Whether the node is an instance of functionLike.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isFunctionLike(Node $node): bool
    {
        return (bool) ($node instanceof Node\FunctionLike);
    }

    /**
     * Whether the node is an arrow function.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isArrowFunction(Node $node): bool
    {
		return (bool) ($node instanceof Node\Expr\Closure);
    }

    /**
     * Whether the node is an instance of closure.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isClosure(Node $node): bool
    {
        return (bool) ($node instanceof Node\Expr\Closure);
    }

    /**
     * Whether the node is an instance of function.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isFunction(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\Function_);
    }

    /**
     * Whether the node is an instance of (magic) method.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isMagicMethod(Node $node): bool
    {
        return (bool) ($this->isMethod($node) && in_array($node->name->name, $this->magicMethods));
    }

    /**
     * Whether the node is an instance of method.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isMethod(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\ClassMethod);
    }

    /**
     * Whether the node is an instance of property.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isPropertyGroup(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\Property);
    }

    /**
     * Parsing the properties from the property group.
     *
     * @param Node $node
     *
     * @return void
     * @throws StrictlyException
     */
    private function parsePropertyGroup(Node $node): void
    {
        foreach ($node->props as $properties) {
            $this->analyseNode($properties);
        }
    }

    /**
     * Whether the node is an instance of property.
     *
     * @param Node $node
     *
     * @return bool
     */
    private function isProperty(Node $node): bool
    {
        return (bool) ($node instanceof Node\Stmt\PropertyProperty);
    }

	/**
	 * @param \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File $file
	 *
	 * @return Lexer
	 */
	public function setFile(File $file): Lexer
	{
		$this->file = $file;
		return $this;
	}

	/**
	 * @return \MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File
	 */
	public function getFile(): File
	{
		return $this->file;
	}
}