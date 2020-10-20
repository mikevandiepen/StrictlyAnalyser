<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes;

use MikevanDiepen\Strictly\Analyser\Issues\Issue;
use MikevanDiepen\Strictly\Exception\StrictlyException;
use PhpParser\Node;

/**
 * Class AbstractNode.
 *
 * @package MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes
 */
abstract class AbstractNode
{
    /**
     * The node which will be subject to preparation.
     *
     * @var Node
     */
    protected Node $node;

    /**
     * Whether the node has an issue.
     * This property can be accessed through:
     * @method setIssue(Issue $issue): self
     * @method getIssue(): Issue
     * @method hasIssue(): bool
     *
     * @var Issue
     */
    private Issue $issue;

    /**
     * The name of the node.
     * This property can be accessed through:
     * @method setName(string $name): self
     * @method getName(): string
     *
     * @var string
     */
    private string $name;

    /**
     * Getting the name of the node.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Setting the name of the node.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getting the issue for this node.
     *
     * @return Issue
     * @throws StrictlyException
     */
    public function getIssue(): Issue
    {
        if (!$this->hasIssue()) {
            throw new StrictlyException('Trying to access non existing issue.');
        }

        return $this->issue;
    }

    /**
     * Setting the issue of the node.
     *
     * @param Issue $issue
     *
     * @return $this
     */
    public function setIssue(Issue $issue): self
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Whether the node has passed the analysis.
     *
     * @return bool
     */
    public function hasIssue(): bool
    {
        return (bool) !empty($this->issue);
    }
}