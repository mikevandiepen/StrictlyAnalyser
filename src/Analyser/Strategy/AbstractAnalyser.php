<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Strategy;

use MikevanDiepen\Strictly\Analyser\Issues\Issue;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;

/**
 * Class AbstractAnalyser
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserOptions
 */
abstract class AbstractAnalyser
{
    /**
     * The node which is subject for analysis.
     *
     * @var HasType
     */
    protected HasType $node;

	/**
	 * All the issues found during the analysis process.
	 *
	 * @var Issue[]
	 */
    private array $issues = [];

    /**
     * AbstractAnalyser constructor.
     *
     * @param HasType $node
     */
    public function __construct(HasType $node)
    {
        // The node is an instance off HasType.
        $this->node = $node;
    }

	/**
	 * @return Issue[]
	 */
	public function getIssues(): array
	{
		return $this->issues;
	}

	/**
	 * @param Issue $issues
	 *
	 * @return AbstractAnalyser
	 */
	public function setIssue(Issue $issues): AbstractAnalyser
	{
		$this->issues[] = $issues;
		return $this;
	}
}