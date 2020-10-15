<?php

declare(strict_types=1);

namespace MikevanDiepen\Strictly\Analyser\Strategy\Options;

use MikevanDiepen\Strictly\Analyser\Issues\Issue;
use MikevanDiepen\Strictly\Analyser\Issues\Untyped;
use MikevanDiepen\Strictly\Analyser\Issues\Mistyped;
use MikevanDiepen\Strictly\Analyser\Issues\Location\Hinted;
use MikevanDiepen\Strictly\Analyser\Issues\Location\Declared;
use MikevanDiepen\Strictly\Analyser\Strategy\AbstractAnalyser;
use MikevanDiepen\Strictly\Analyser\Lexer\Stubs\Nodes\Contracts\HasType;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\Contracts\AnalyserInterface;
use MikevanDiepen\Strictly\Analyser\Strategy\Options\AnalyserTraits\AnalyserTrait;

/**
 * Class AnalyseProperty.
 *
 * @package MikevanDiepen\Strictly\Analyser\Strategy\Options
 */
final class AnalyseProperty extends AbstractAnalyser implements AnalyserInterface
{
    use AnalyserTrait;

	/**
	 * AnalyseProperty constructor.
	 *
	 * @param HasType $node
	 */
    public function __construct(HasType $node)
	{
		parent::__construct($node);
	}

	/**
     * Analysing only the declared types.
     *
     * @return void
     */
    public function onlyDeclared(): void
    {
        if (!$this->declaredTypeIsset()) {
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Declared())
			);
        }
    }

    /**
     * Analysing only the hinted types.
     *
     * @return void
     */
    public function onlyHinted(): void
    {
        if (!$this->hintedTypeIsset()) {
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Hinted())
			);
        }
    }

    /**
     * Analysing both the declared and hinted types.
     *
     * @return void
     */
    public function bothDeclaredAndHinted(): void
    {
        if ($this->declaredTypeIsset() && $this->hintedTypeIsset()) {
            if (!$this->typesMatch()) {
                if ($this->getMissingDeclaredTypes() > 0) {
					$this->setIssue(
						(new Issue())->setIssue(new Mistyped())->setLocation(new Declared())
					);
                }

                if ($this->getMissingHintedTypes() > 0) {
					$this->setIssue(
						(new Issue())->setIssue(new Mistyped())->setLocation(new Hinted())
					);
                }
            }
        } elseif ($this->declaredTypeIsset() && !$this->hintedTypeIsset()) {
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Hinted())
			);
        } elseif (!$this->declaredTypeIsset() && $this->hintedTypeIsset()) {
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Declared())
			);
        } else {
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Hinted())
			);
			$this->setIssue(
				(new Issue())->setIssue(new Untyped())->setLocation(new Declared())
			);
        }
    }
}