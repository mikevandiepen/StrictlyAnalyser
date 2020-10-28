<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Strategy;

use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ArrowFunctionNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\ClosureNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\FunctionNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MagicMethodNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\MethodNode;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\PropertyNode;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseArrowFunction;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseClosure;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseFunction;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseMagicMethod;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseMethod;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyseProperty;
use MikevanDiepen\Strictly\Configuration\Types\AbstractConfiguration;

/**
 * Class Director.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy
 */
final class Director
{
    /**
     * The subject file of the analysis.
     *
     * @var File
     */
    private File $file;

    /**
     * Director constructor.
     *
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Asserting based upon the filters what the analysis strategy will be.
     *
     * @param array $filters
     *
     * @return void
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    public function direct(array $filters): void
    {
        // Whether ANY functional code or docblock can be analysed.
        $functional = (bool) in_array(AbstractConfiguration::FUNCTIONAL, $filters);
        $docblock = (bool) in_array(AbstractConfiguration::DOCBLOCK, $filters);

        // Whether ANY return or parameter can be analysed.
        $parameter = (bool) in_array(AbstractConfiguration::PARAMETER, $filters);
        $return = (bool) in_array(AbstractConfiguration::RETURN, $filters);

        // Parameter functional or docblock scope.
        $parameterFunctional = (bool) ($functional && $parameter) ? (in_array(AbstractConfiguration::PARAMETER_FUNCTIONAL, $filters)) : false;
        $parameterDocblock = (bool) ($docblock && $parameter) ? (in_array(AbstractConfiguration::PARAMETER_DOCBLOCK, $filters)) : false;

        // Return functional or docblock scope.
        $declaredReturns = (bool) ($functional && $return) ? (in_array(AbstractConfiguration::RETURN_FUNCTIONAL, $filters)) : false;
        $hintedReturns = (bool) ($docblock && $return) ? (in_array(AbstractConfiguration::RETURN_DOCBLOCK, $filters)) : false;

        if (in_array(AbstractConfiguration::ARROW_FUNCTION, $filters)) {
            $arrowFunctionFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::ARROW_FUNCTION_FUNCTIONAL, $filters) : false;
            $arrowFunctionDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::ARROW_FUNCTION_DOCBLOCK, $filters) : false;

            // Whether arrow-function parameter analysis is enabled.
            $arrowFunctionParameterFunctional = (bool) ($arrowFunctionFunctional && $parameterFunctional) ? in_array(AbstractConfiguration::ARROW_FUNCTION_PARAMETER_FUNCTIONAL, $filters) : false;
            $arrowFunctionParameterDocblock = (bool) ($arrowFunctionDocblock && $parameterDocblock) ? in_array(AbstractConfiguration::ARROW_FUNCTION_PARAMETER_DOCBLOCK, $filters) : false;

            // Whether arrow-function return analysis is enabled.
            $arrowFunctionDeclaredReturns = (bool) ($arrowFunctionFunctional && $declaredReturns) ? in_array(AbstractConfiguration::ARROW_FUNCTION_RETURN_FUNCTIONAL, $filters) : false;
            $arrowFunctionHintedReturns = (bool) ($arrowFunctionDocblock && $hintedReturns) ? in_array(AbstractConfiguration::ARROW_FUNCTION_RETURN_DOCBLOCK, $filters) : false;

            if (isset($this->file->arrowFunctionNode) && count($this->file->arrowFunctionNode) > 0) {
                foreach ($this->file->arrowFunctionNode as $arrowFunctionNode) {
                    $this->analyseArrowFunction($arrowFunctionNode, $arrowFunctionFunctional, $arrowFunctionDocblock, $arrowFunctionParameterFunctional, $arrowFunctionParameterDocblock, $arrowFunctionDeclaredReturns, $arrowFunctionHintedReturns);
                }
            }
        }

        if (in_array(AbstractConfiguration::CLOSURE, $filters)) {
            $closureFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::CLOSURE_FUNCTIONAL, $filters) : false;
            $closureDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::CLOSURE_DOCBLOCK, $filters) : false;

            // Whether closure parameter analysis is enabled.
            $closureParameterFunctional = (bool) ($closureFunctional && $parameterFunctional) ? in_array(AbstractConfiguration::CLOSURE_PARAMETER_FUNCTIONAL, $filters) : false;
            $closureParameterDocblock = (bool) ($closureDocblock && $parameterDocblock) ? in_array(AbstractConfiguration::CLOSURE_PARAMETER_DOCBLOCK, $filters) : false;

            // Whether closure return analysis is enabled.
            $closureDeclaredReturns = (bool) ($closureFunctional && $declaredReturns) ? in_array(AbstractConfiguration::CLOSURE_RETURN_FUNCTIONAL, $filters) : false;
            $closureHintedReturns = (bool) ($closureDocblock && $hintedReturns) ? in_array(AbstractConfiguration::CLOSURE_RETURN_DOCBLOCK, $filters) : false;

            if (count($this->file->getClosures()) > 0) {
                foreach ($this->file->getClosures() as $closures) {
                    $this->analyseClosure($closures, $closureFunctional, $closureDocblock, $closureParameterFunctional, $closureParameterDocblock, $closureDeclaredReturns, $closureHintedReturns);
                }
            }
        }

        if (in_array(AbstractConfiguration::FUNCTION, $filters)) {
            $functionFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::FUNCTION_FUNCTIONAL, $filters) : false;
            $functionDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::FUNCTION_DOCBLOCK, $filters) : false;

            // Whether function parameter analysis is enabled.
            $functionParameterFunctional = (bool) ($functionFunctional && $parameterFunctional) ? in_array(AbstractConfiguration::FUNCTION_PARAMETER_FUNCTIONAL, $filters) : false;
            $functionParameterDocblock = (bool) ($functionDocblock && $parameterDocblock) ? in_array(AbstractConfiguration::FUNCTION_PARAMETER_DOCBLOCK, $filters) : false;

            // Whether function return analysis is enabled.
            $functionDeclaredReturns = (bool) ($functionFunctional && $declaredReturns) ? in_array(AbstractConfiguration::FUNCTION_RETURN_FUNCTIONAL, $filters) : false;
            $functionHintedReturns = (bool) ($functionDocblock && $hintedReturns) ? in_array(AbstractConfiguration::FUNCTION_RETURN_DOCBLOCK, $filters) : false;

            if (isset($this->file->functionNode) && count($this->file->functionNode) > 0) {
                foreach ($this->file->functionNode as $functionNode) {
                    $this->analyseFunction($functionNode, $functionFunctional, $functionDocblock, $functionParameterFunctional, $functionParameterDocblock, $functionDeclaredReturns, $functionHintedReturns);
                }
            }
        }

        if (in_array(AbstractConfiguration::MAGIC_METHOD, $filters)) {
            $magicMethodFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::MAGIC_METHOD_FUNCTIONAL, $filters) : false;
            $magicMethodDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::MAGIC_METHOD_DOCBLOCK, $filters) : false;

            // Whether magic method parameter analysis is enabled.
            $magicMethodParameterFunctional = (bool) ($magicMethodFunctional && $parameterFunctional) ? in_array(AbstractConfiguration::MAGIC_METHOD_PARAMETER_FUNCTIONAL, $filters) : false;
            $magicMethodParameterDocblock = (bool) ($magicMethodDocblock && $parameterDocblock) ? in_array(AbstractConfiguration::MAGIC_METHOD_PARAMETER_DOCBLOCK, $filters) : false;

            // Whether magic method return analysis is enabled.
            $magicMethodDeclaredReturns = (bool) ($magicMethodFunctional && $declaredReturns) ? in_array(AbstractConfiguration::MAGIC_METHOD_RETURN_FUNCTIONAL, $filters) : false;
            $magicMethodHintedReturns = (bool) ($magicMethodDocblock && $hintedReturns) ? in_array(AbstractConfiguration::MAGIC_METHOD_RETURN_DOCBLOCK, $filters) : false;

            if (isset($this->file->magicMethodNode) && count($this->file->magicMethodNode) > 0) {
                foreach ($this->file->magicMethodNode as $methodNode) {
                    $this->analyseMagicMethod($methodNode, $magicMethodFunctional, $magicMethodDocblock, $magicMethodParameterFunctional, $magicMethodParameterDocblock, $magicMethodDeclaredReturns, $magicMethodHintedReturns);
                }
            }
        }

        if (in_array(AbstractConfiguration::METHOD, $filters)) {
            $methodFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::METHOD_FUNCTIONAL, $filters) : false;
            $methodDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::METHOD_DOCBLOCK, $filters) : false;

            // Whether method parameter analysis is enabled.
            $methodParameterFunctional = (bool) ($methodFunctional && $parameterFunctional) ? in_array(AbstractConfiguration::METHOD_PARAMETER_FUNCTIONAL, $filters) : false;
            $methodParameterDocblock = (bool) ($methodDocblock && $parameterDocblock) ? in_array(AbstractConfiguration::METHOD_PARAMETER_DOCBLOCK, $filters) : false;

            // Whether method return analysis is enabled.
            $methodDeclaredReturns = (bool) ($methodFunctional && $declaredReturns) ? in_array(AbstractConfiguration::METHOD_RETURN_FUNCTIONAL, $filters) : false;
            $methodHintedReturns = (bool) ($methodDocblock && $hintedReturns) ? in_array(AbstractConfiguration::METHOD_RETURN_DOCBLOCK, $filters) : false;

            if (isset($this->file->methodNode) && count($this->file->methodNode) > 0) {
                foreach ($this->file->methodNode as $methodNode) {
                    $this->analyseMethod($methodNode, $methodFunctional, $methodDocblock, $methodParameterFunctional, $methodParameterDocblock, $methodDeclaredReturns, $methodHintedReturns);
                }
            }
        }

        if (in_array(AbstractConfiguration::PROPERTY, $filters)) {
            $propertyFunctional = (bool) ($functional) ? in_array(AbstractConfiguration::PROPERTY_FUNCTIONAL, $filters) : false;
            $propertyDocblock = (bool) ($docblock) ? in_array(AbstractConfiguration::PROPERTY_DOCBLOCK, $filters) : false;

            if (isset($this->file->propertyNodes) && count($this->file->propertyNodes) > 0) {
                foreach ($this->file->propertyNodes as $propertyNode) {
                    $this->analyseProperty($propertyNode, $propertyFunctional, $propertyDocblock);
                }
            }
        }
    }

    /**
     * The analyser for the arrow function node.
     *
     * @param ArrowFunctionNode $arrowFunctionNode
     * @param bool              $functional
     * @param bool              $docblock
     * @param bool              $declaredParameters
     * @param bool              $hintedParameters
     * @param bool              $declaredReturns
     * @param bool              $hintedReturns
     *
     * @return void
     */
    private function analyseArrowFunction(ArrowFunctionNode $arrowFunctionNode, bool $functional, bool $docblock, bool $declaredParameters, bool $hintedParameters, bool $declaredReturns, bool $hintedReturns): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseArrowFunction($arrowFunctionNode);
        $analyser->analyseDeclaredParameters($declaredParameters);
        $analyser->analyseHintedParameters($hintedParameters);
        $analyser->analyseDeclaredReturns($declaredReturns);
        $analyser->analyseHintedReturns($hintedReturns);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * The analyser for the closure node.
     *
     * @param ClosureNode $closureNode
     * @param bool        $functional
     * @param bool        $docblock
     * @param bool        $declaredParameters
     * @param bool        $hintedParameters
     * @param bool        $declaredReturns
     * @param bool        $hintedReturns
     *
     * @return void
     */
    private function analyseClosure(ClosureNode $closureNode, bool $functional, bool $docblock, bool $declaredParameters, bool $hintedParameters, bool $declaredReturns, bool $hintedReturns): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseClosure($closureNode);
        $analyser->analyseDeclaredParameters($declaredParameters);
        $analyser->analyseHintedParameters($hintedParameters);
        $analyser->analyseDeclaredReturns($declaredReturns);
        $analyser->analyseHintedReturns($hintedReturns);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * The analyser for the function node.
     *
     * @param FunctionNode $functionNode
     * @param bool         $functional
     * @param bool         $docblock
     * @param bool         $declaredParameters
     * @param bool         $hintedParameters
     * @param bool         $declaredReturns
     * @param bool         $hintedReturns
     *
     * @return void
     */
    private function analyseFunction(FunctionNode $functionNode, bool $functional, bool $docblock, bool $declaredParameters, bool $hintedParameters, bool $declaredReturns, bool $hintedReturns): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseFunction($functionNode);
        $analyser->analyseDeclaredParameters($declaredParameters);
        $analyser->analyseHintedParameters($hintedParameters);
        $analyser->analyseDeclaredReturns($declaredReturns);
        $analyser->analyseHintedReturns($hintedReturns);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * The analyser for the magic node.
     *
     * @param MagicMethodNode $magicMethodNode
     * @param bool            $functional
     * @param bool            $docblock
     * @param bool            $declaredParameters
     * @param bool            $hintedParameters
     * @param bool            $declaredReturns
     * @param bool            $hintedReturns
     *
     * @return void
     */
    private function analyseMagicMethod(MagicMethodNode $magicMethodNode, bool $functional, bool $docblock, bool $declaredParameters, bool $hintedParameters, bool $declaredReturns, bool $hintedReturns): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseMagicMethod($magicMethodNode);
        $analyser->analyseDeclaredParameters($declaredParameters);
        $analyser->analyseHintedParameters($hintedParameters);
        $analyser->analyseDeclaredReturns($declaredReturns);
        $analyser->analyseHintedReturns($hintedReturns);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * The analyser for the method node.
     *
     * @param MethodNode $methodNode
     * @param bool       $functional
     * @param bool       $docblock
     * @param bool       $declaredParameters
     * @param bool       $hintedParameters
     * @param bool       $declaredReturns
     * @param bool       $hintedReturns
     *
     * @return void
     */
    private function analyseMethod(MethodNode $methodNode, bool $functional, bool $docblock, bool $declaredParameters, bool $hintedParameters, bool $declaredReturns, bool $hintedReturns): void
    {
        // The analyser class for this strategy.
        $analyser = (new AnalyseMethod($methodNode));
        $analyser->analyseDeclaredParameters($declaredParameters);
        $analyser->analyseHintedParameters($hintedParameters);
        $analyser->analyseDeclaredReturns($declaredReturns);
        $analyser->analyseHintedReturns($hintedReturns);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * The analyser for the property node.
     *
     * @param PropertyNode $propertyNode
     * @param bool         $functional
     * @param bool         $docblock
     *
     * @return void
     * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
     */
    private function analyseProperty(PropertyNode $propertyNode, bool $functional, bool $docblock): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseProperty($propertyNode);

        // Analysing both the functional code and the docblock.
        if ($functional && $docblock) {
            $analyser->bothDeclaredAndHinted();
        }

        // Analysing only the functional code and not the docblock.
        if ($functional && !$docblock) {
            $analyser->onlyDeclared();
        }

        // Analysing only the docblock and not the functional code.
        if (!$functional && $docblock) {
            $analyser->onlyHinted();
        }
    }

    /**
     * Returning the file after it has been analysed.
     *
     * @return File
     */
    public function getAnalysisResults(): File
    {
        return $this->file;
    }
}