<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Coverage;

use MikevanDiepen\Strictly\Analyser\Issues\Issue;
use MikevanDiepen\Strictly\Analyser\Issues\Untyped;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\File;
use MikevanDiepen\Strictly\Analyser\Issues\Location\Hinted;
use MikevanDiepen\Strictly\Analyser\Issues\Location\Declared;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\FunctionLikeNode;

/**
 * Class AnalysisResults
 *
 * @package MikevanDiepen\Strictly\Coverage
 */
final class AnalysisResults
{
	/**
	 * The file which has been analysed.
	 *
	 * @var File
	 */
	private File $file;

	/**
	 * The strictness score of your project.
	 * Default 100.00 (%)
	 *
	 * @var float
	 */
	private float $score = 100.00;

	/** @var int The amount of analysed nodes. */
	private int $nodes = 0;
	private int $propertyNode = 0;
	private int $functionLikeNode = 0;
	private int $parameterNode = 0;
	private int $returnNode = 0;

	/** @var int Aggregated results for all the declared and hinted types. */
	private int $typed = 0;
	private int $untyped = 0;
	private int $mistyped = 0;

	/** @var int Aggregated results for all the declared types. */
	private int $untypedDeclared = 0;
	private int $mistypedDeclared = 0;

	/** @var int Aggregated results for all the hinted types. */
	private int $untypedHinted = 0;
	private int $mistypedHinted = 0;

	/**
	 * AnalysisResults constructor.
	 *
	 * @param File $file
	 *
	 * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
	 */
	public function __construct(File $file)
	{
		$this->file = $file;

		$this->buildReport();
	}

	/**
	 * Building the report based upon the file.
	 *
	 * @return void
	 * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
	 */
	private function buildReport(): void
	{
		foreach ($this->file->getArrowFunctions() as $arrowFunction) {
			$this->buildReportOnFunctionLikeNodes($arrowFunction);

			$this->nodes++;
			$this->functionLikeNode++;
		}

		foreach ($this->file->getClosures() as $closure) {
			$this->buildReportOnFunctionLikeNodes($closure);

			$this->nodes++;
			$this->functionLikeNode++;
		}

		foreach ($this->file->getFunctions() as $function) {
			$this->buildReportOnFunctionLikeNodes($function);

			$this->nodes++;
			$this->functionLikeNode++;
		}

		foreach ($this->file->getMagicMethods() as $magicMethod) {
			$this->buildReportOnFunctionLikeNodes($magicMethod);

			$this->nodes++;
			$this->functionLikeNode++;
		}

		foreach ($this->file->getMethods() as $method) {
			$this->buildReportOnFunctionLikeNodes($method);

			$this->nodes++;
			$this->functionLikeNode++;
		}

		foreach ($this->file->getProperties() as $property) {
			if ($property->hasIssue()) {
				$this->sortIssue(
					$property->getIssue()
				);
			} else {
				$this->typed++; // The node is type, no issue.
			}

			$this->nodes++;
			$this->propertyNode++;
		}
	}

	/**
	 * Building a report on function like methods and accessing the return and parameter node.
	 *
	 * @param FunctionLikeNode $functionLike
	 *
	 * @return void
	 * @throws \MikevanDiepen\Strictly\Exception\StrictlyException
	 */
	private function buildReportOnFunctionLikeNodes(FunctionLikeNode $functionLike): void
	{
		$parameters = $functionLike->getParameters();
		$return 	= $functionLike->getReturn();

		if ($functionLike->hasParameters()) {
			foreach ($parameters as $parameter) {
				if ($parameter->hasIssue()) {
					$this->sortIssue(
						$parameter->getIssue()
					);
				} else {
					$this->typed++; // The node is type, no issue.
				}

				$this->nodes++;
				$this->parameterNode++;
			}

			if ($return->hasIssue()) {
				$this->sortIssue(
					$return->getIssue()
				);
			} else {
				$this->typed++; // The node is type, no issue.
			}
		}

		$this->nodes++;
		$this->returnNode++;
	}

	/**
	 * Sorting issue by type and location.
	 *
	 * Issue types are "untyped" and "mistyped".
	 * Issue locations are "declared" and "hinted".
	 *
	 * @param Issue $issue
	 */
	private function sortIssue(Issue $issue): void
	{
		// Issue type.
		$untyped 	= (bool) ($issue instanceof Untyped);
		$mistyped	= (bool) ($issue instanceof Declared);

		// Issue location.
		$declared 	= (bool) ($issue instanceof Declared);
		$hinted 	= (bool) ($issue instanceof Hinted);

		if ($untyped)				$this->untyped++;
		if ($untyped && $declared)	$this->untypedDeclared++;
		if ($untyped && $hinted) 	$this->untypedHinted++;
		if ($mistyped)				$this->mistyped++;
		if ($mistyped && $declared)	$this->mistypedDeclared++;
		if ($mistyped && $hinted) 	$this->mistypedHinted++;
	}

	/**
	 * @return array
	 */
	public function getResults(): array
	{
		return [
			'Nodes' => [
				'nodes' 			=> $this->nodes,
				'propertyNode' 		=> $this->propertyNode,
				'functionLikeNode'	=> $this->functionLikeNode,
				'parameterNode' 	=> $this->parameterNode,
				'returnNode' 		=> $this->returnNode,
			],
			'IssueTypes' => [
				'typed' 			=> $this->typed,
				'untyped' 			=> $this->untyped,
				'mistyped' 			=> $this->mistyped,
				'untypedDeclared' 	=> $this->untypedDeclared,
				'mistypedDeclared' 	=> $this->mistypedDeclared,
				'untypedHinted' 	=> $this->untypedHinted,
				'mistypedHinted' 	=> $this->mistypedHinted,
			],
		];
	}
}