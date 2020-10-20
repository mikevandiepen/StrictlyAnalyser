<?php

declare(strict_types = 1);

namespace MikevanDiepen\Strictly\Analyser\Issues;

use MikevanDiepen\Strictly\Analyser\Issues\Contracts\IssueInterface;
use MikevanDiepen\Strictly\Analyser\Issues\Contracts\LocationInterface;

/**
 * Class Issue.
 * An object to store the metadata for the issue.
 *
 * @package MikevanDiepen\Strictly\Analyser\Issues
 */
final class Issue
{
    /**
     * The location of the issue, either "Declared" or "Hinted".
     *
     * @var LocationInterface
     */
    private LocationInterface $location;

    /**
     * The type of issue, either "Mistyped" or "Untyped".
     *
     * @var IssueInterface
     */
    private IssueInterface $issue;

    /**
     * @return LocationInterface
     */
    public function getLocation(): LocationInterface
    {
        return $this->location;
    }

    /**
     * @param LocationInterface $location
     *
     * @return Issue
     */
    public function setLocation(LocationInterface $location): Issue
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return IssueInterface
     */
    public function getIssue(): IssueInterface
    {
        return $this->issue;
    }

    /**
     * @param IssueInterface $issue
     *
     * @return Issue
     */
    public function setIssue(IssueInterface $issue): Issue
    {
        $this->issue = $issue;
        return $this;
    }
}