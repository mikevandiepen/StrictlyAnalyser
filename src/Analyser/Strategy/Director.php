<?php

namespace Mikevandiepen\Strictly\Analyser\Strategy;

use Mikevandiepen\Strictly\Analyser\Builder\File\File;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseMethod;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseClosure;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseFunction;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseProperty;
use Mikevandiepen\Strictly\Analyser\Builder\File\Nodes\ClosureNode;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseMagicMethod;
use Mikevandiepen\Strictly\Analyser\Strategy\Options\AnalyseArrowFunction;

/**
 * Class Director.
 *
 * @package Mikevandiepen\Strictly\Analyser\Strategy
 */
final class Director
{
    /**
     * The subject file of the analysis.
     *
     * @var \Mikevandiepen\Strictly\Analyser\Builder\File\File
     */
    private File $file;

    /**
     * Director constructor.
     *
     * @param \Mikevandiepen\Strictly\Analyser\Builder\File\File $file
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
     */
    public function direct(array $filters): void
    {
        // Whether ANY functional code or docblock can be analysed.
        $functional = (bool) in_array('functional', $filters);
        $docblock   = (bool) in_array('docblock', $filters);

        // Whether ANY return or parameter can be analysed.
        $parameter  = (bool) in_array('parameter', $filters);
        $return     = (bool) in_array('return', $filters);

        // Parameter functional or docblock scope.
        $parameterFunctional = (bool) ($functional && $parameter)
            ? (in_array('parameter-functional', $filters))
            : false;
        $parameterDocblock = (bool) ($docblock && $parameter)
            ? (in_array('parameter-docblock', $filters))
            : false;

        // Return functional or docblock scope.
        $declaredReturns = (bool) ($functional && $return)
            ? (in_array('return-functional', $filters))
            : false;
        $hintedReturns = (bool) ($docblock && $return)
            ? (in_array('parameter-docblock', $filters))
            : false;

        if (in_array('arrow-function', $filters)) {
            $arrowFunctionFunctional = (bool) ($functional)
                ? in_array('arrow-function-functional', $filters)
                : false;
            $arrowFunctionDocblock = (bool) ($docblock)
                ? in_array('arrow-function-docblock', $filters)
                : false;

            // Whether arrow-function parameter analysis is enabled.
            $arrowFunctionParameterFunctional = (bool) ($arrowFunctionFunctional && $parameterFunctional)
                ? in_array('arrow-function-parameter-functional', $filters)
                : false;
            $arrowFunctionParameterDocblock = (bool) ($arrowFunctionDocblock && $parameterDocblock)
                ? in_array('arrow-function-parameter-docblock', $filters)
                : false;

            // Whether arrow-function return analysis is enabled.
            $arrowFunctiondeclaredReturns = (bool) ($arrowFunctionFunctional && $declaredReturns)
                ? in_array('arrow-function-return-functional', $filters)
                : false;
            $arrowFunctionhintedReturns = (bool) ($arrowFunctionDocblock && $hintedReturns)
                ? in_array('arrow-function-return-docblock', $filters)
                : false;

            if (isset($this->file->arrowFunctionNode) && count($this->file->arrowFunctionNode) > 0) {
                foreach ($this->file->arrowFunctionNode as $arrowFunctionNode) {
                    $this->analyseArrowFunction(
                        $arrowFunctionNode,
                        $arrowFunctionFunctional,
                        $arrowFunctionDocblock,
                        $arrowFunctionParameterFunctional,
                        $arrowFunctionParameterDocblock,
                        $arrowFunctiondeclaredReturns,
                        $arrowFunctionhintedReturns
                    );
                }
            }
        }

        if (in_array('closure', $filters)) {
            $closureFunctional = (bool) ($functional)
                ? in_array('closure-functional', $filters)
                : false;
            $closureDocblock = (bool) ($docblock)
                ? in_array('closure-docblock', $filters)
                : false;

            // Whether closure parameter analysis is enabled.
            $closureParameterFunctional = (bool) ($closureFunctional && $parameterFunctional)
                ? in_array('closure-parameter-functional', $filters)
                : false;
            $closureParameterDocblock = (bool) ($closureDocblock && $parameterDocblock)
                ? in_array('closure-parameter-docblock', $filters)
                : false;

            // Whether closure return analysis is enabled.
            $closuredeclaredReturns = (bool) ($closureFunctional && $declaredReturns)
                ? in_array('closure-return-functional', $filters)
                : false;
            $closurehintedReturns = (bool) ($closureDocblock && $hintedReturns)
                ? in_array('closure-return-docblock', $filters)
                : false;

            if (count($this->file->getClosures()) > 0) {
                foreach ($this->file->getClosures() as $closures) {
                    $this->analyseClosure(
                        $closures,
                        $closureFunctional,
                        $closureDocblock,
                        $closureParameterFunctional,
                        $closureParameterDocblock,
                        $closuredeclaredReturns,
                        $closurehintedReturns
                    );
                }
            }
        }

        if (in_array('function', $filters)) {
            $functionFunctional = (bool) ($functional)
                ? in_array('function-functional', $filters)
                : false;
            $functionDocblock = (bool) ($docblock)
                ? in_array('function-docblock', $filters)
                : false;

            // Whether function parameter analysis is enabled.
            $functionParameterFunctional = (bool) ($functionFunctional && $parameterFunctional)
                ? in_array('function-parameter-functional', $filters)
                : false;
            $functionParameterDocblock = (bool) ($functionDocblock && $parameterDocblock)
                ? in_array('function-parameter-docblock', $filters)
                : false;

            // Whether function return analysis is enabled.
            $functiondeclaredReturns = (bool) ($functionFunctional && $declaredReturns)
                ? in_array('function-return-functional', $filters)
                : false;
            $functionhintedReturns = (bool) ($functionDocblock && $hintedReturns)
                ? in_array('function-return-docblock', $filters)
                : false;

            if (isset($this->file->functionNode) && count($this->file->functionNode) > 0) {
                foreach ($this->file->functionNode as $functionNode) {
                    $this->analyseFunction(
                        $functionNode,
                        $functionFunctional,
                        $functionDocblock,
                        $functionParameterFunctional,
                        $functionParameterDocblock,
                        $functiondeclaredReturns,
                        $functionhintedReturns
                    );
                }
            }
        }

        if (in_array('magic-method', $filters)) {
            $magicMethodFunctional = (bool) ($functional)
                ? in_array('magic-method-functional', $filters)
                : false;
            $magicMethodDocblock = (bool) ($docblock)
                ? in_array('magic-method-docblock', $filters)
                : false;

            // Whether magic method parameter analysis is enabled.
            $magicMethodParameterFunctional = (bool) ($magicMethodFunctional && $parameterFunctional)
                ? in_array('magic-method-parameter-functional', $filters)
                : false;
            $magicMethodParameterDocblock = (bool) ($magicMethodDocblock && $parameterDocblock)
                ? in_array('magic-method-parameter-docblock', $filters)
                : false;

            // Whether magic method return analysis is enabled.
            $magicMethoddeclaredReturns = (bool) ($magicMethodFunctional && $declaredReturns)
                ? in_array('magic-method-return-functional', $filters)
                : false;
            $magicMethodhintedReturns = (bool) ($magicMethodDocblock && $hintedReturns)
                ? in_array('magic-method-return-docblock', $filters)
                : false;

            if (isset($this->file->magicMethodNode) && count($this->file->magicMethodNode) > 0) {
                foreach ($this->file->magicMethodNode as $methodNode) {
                    $this->analyseMagicMethod(
                        $methodNode,
                        $magicMethodFunctional,
                        $magicMethodDocblock,
                        $magicMethodParameterFunctional,
                        $magicMethodParameterDocblock,
                        $magicMethoddeclaredReturns,
                        $magicMethodhintedReturns
                    );
                }
            }
        }

        if (in_array('method', $filters)) {
            $methodFunctional = (bool) ($functional)
                ? in_array('method-functional', $filters)
                : false;
            $methodDocblock = (bool) ($docblock)
                ? in_array('method-docblock', $filters)
                : false;

            // Whether method parameter analysis is enabled.
            $methodParameterFunctional = (bool) ($methodFunctional && $parameterFunctional)
                ? in_array('method-parameter-functional', $filters)
                : false;
            $methodParameterDocblock = (bool) ($methodDocblock && $parameterDocblock)
                ? in_array('method-parameter-docblock', $filters)
                : false;

            // Whether method return analysis is enabled.
            $methoddeclaredReturns = (bool) ($methodFunctional && $declaredReturns)
                ? in_array('method-return-functional', $filters)
                : false;
            $methodhintedReturns = (bool) ($methodDocblock && $hintedReturns)
                ? in_array('method-return-docblock', $filters)
                : false;

            if (isset($this->file->methodNode) && count($this->file->methodNode) > 0) {
                foreach ($this->file->methodNode as $methodNode) {
                    $this->analyseMethod(
                        $methodNode,
                        $methodFunctional,
                        $methodDocblock,
                        $methodParameterFunctional,
                        $methodParameterDocblock,
                        $methoddeclaredReturns,
                        $methodhintedReturns
                    );
                }
            }
        }

        if (in_array('property', $filters)) {
            $propertyFunctional = (bool) ($functional)
                ? in_array('property-functional', $filters)
                : false;
            $propertyDocblock = (bool) ($docblock)
                ? in_array('property-docblock', $filters)
                : false;

            if (isset($this->file->propertyNodes) && count($this->file->propertyNodes) > 0) {
                foreach ($this->file->propertyNodes as $propertyNode) {
                    $this->analyseProperty(
                        $propertyNode,
                        $propertyFunctional,
                        $propertyDocblock
                    );
                }
            }
        }
    }

    /**
     * Returning all the issues which have been detected in this file analysis process.
     *
     * @return IssueInterface[]
     */
    public function getIssues(): array
    {
        return $this->issues;
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
    private function analyseArrowFunction(
        ArrowFunctionNode $arrowFunctionNode,
        bool $functional,
        bool $docblock,
        bool $declaredParameters,
        bool $hintedParameters,
        bool $declaredReturns,
        bool $hintedReturns
    ): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseArrowFunction($arrowFunctionNode);
        $analyser->analysedeclaredParameters($declaredParameters);
        $analyser->analysehintedParameters($hintedParameters);
        $analyser->analysedeclaredReturns($declaredReturns);
        $analyser->analysehintedReturns($hintedReturns);

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

        foreach ($analyser->getIssues() as $issue) {
            $this->issues[] = $issue;
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
    private function analyseClosureNode(
        ClosureNode $closureNode,
        bool $functional,
        bool $docblock,
        bool $declaredParameters,
        bool $hintedParameters,
        bool $declaredReturns,
        bool $hintedReturns
    ): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseClosure($closureNode);
        $analyser->analysedeclaredParameters($declaredParameters);
        $analyser->analysehintedParameters($hintedParameters);
        $analyser->analysedeclaredReturns($declaredReturns);
        $analyser->analysehintedReturns($hintedReturns);

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

        foreach ($analyser->getIssues() as $issue) {
            # TODO: HANDLE ISSUES
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
    private function analyseFunction(
        FunctionNode $functionNode,
        bool $functional,
        bool $docblock,
        bool $declaredParameters,
        bool $hintedParameters,
        bool $declaredReturns,
        bool $hintedReturns
    ): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseFunction($functionNode);
        $analyser->analysedeclaredParameters($declaredParameters);
        $analyser->analysehintedParameters($hintedParameters);
        $analyser->analysedeclaredReturns($declaredReturns);
        $analyser->analysehintedReturns($hintedReturns);

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

        foreach ($analyser->getIssues() as $issue) {
            $this->issues[] = $issue;
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
    private function analyseMagicMethod(
        MagicMethodNode $magicMethodNode,
        bool $functional,
        bool $docblock,
        bool $declaredParameters,
        bool $hintedParameters,
        bool $declaredReturns,
        bool $hintedReturns
    ): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseMagicMethod($magicMethodNode);
        $analyser->analysedeclaredParameters($declaredParameters);
        $analyser->analysehintedParameters($hintedParameters);
        $analyser->analysedeclaredReturns($declaredReturns);
        $analyser->analysehintedReturns($hintedReturns);

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

        foreach ($analyser->getIssues() as $issue) {
            $this->issues[] = $issue;
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
    private function analyseMethod(
        MethodNode $methodNode,
        bool $functional,
        bool $docblock,
        bool $declaredParameters,
        bool $hintedParameters,
        bool $declaredReturns,
        bool $hintedReturns
    ): void
    {
        // The analyser class for this strategy.
        $analyser = new AnalyseMethod($methodNode);
        $analyser->analysedeclaredParameters($declaredParameters);
        $analyser->analysehintedParameters($hintedParameters);
        $analyser->analysedeclaredReturns($declaredReturns);
        $analyser->analysehintedReturns($hintedReturns);

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

        foreach ($analyser->getIssues() as $issue) {
            $this->issues[] = $issue;
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
     */
    private function analyseProperty(
        PropertyNode $propertyNode,
        bool $functional,
        bool $docblock
    ): void
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

        foreach ($analyser->getIssues() as $issue) {
            $this->issues[] = $issue;
        }
    }
}