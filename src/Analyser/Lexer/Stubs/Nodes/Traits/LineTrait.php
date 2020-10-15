<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Traits;

trait LineTrait
{
    /**
     * The line where the node starts.
     *
     * This property can be accessed through:
     * @method setStartLine(int $line): self
     * @method getStartLine(): int
     *
     * @var int
     */
    private int $startLine;

    /**
     * The line where the node ends.
     *
     * This property can be accessed through:
     * @method setEndLine(int $line): self
     * @method getEndLine(): int
     *
     * @var int
     */
    private int $endLine;

    /**
     * Getting the line where the node starts.
     *
     * @return int
     */
    public function getStartLine(): int
    {
        return $this->startLine;
    }

    /**
     * Setting the line where the node starts.
     *
     * @param int $line
     *
     * @return $this
     */
    public function setStartLine(int $line): self
    {
        $this->startLine = $line;

        return $this;
    }

    /**
     * Getting the line where the node ends.
     *
     * @return int
     */
    public function getEndLine(): int
    {
        return $this->endLine;
    }

    /**
     * Setting the line where the node ends.
     *
     * @param int $line
     *
     * @return $this
     */
    public function setEndLine(int $line): self
    {
        $this->endLine = $line;

        return $this;
    }
}