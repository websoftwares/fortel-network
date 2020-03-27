<?php

declare(strict_types=1);

namespace Fortel\Game\Models;

use function in_array;

/**
 * @package Fortel\Game\Models
 */
class PlayGameModel implements PlayGameModelInterface
{
    private array $scoreBoard;
    private array $teamA;
    private array $teamB;

    /**
     * @param array $teamA
     * @param array $teamB
     */
    public function __construct(array $teamA, array $teamB)
    {
        $this->teamA = $teamA;
        $this->teamB = $teamB;
        $this->scoreBoard = [];
    }

    /**
     * @return bool
     */
    public function hasTeamAWon(): bool
    {
        sort($this->teamA);
        sort($this->scoreBoard);

        return $this->teamA === $this->scoreBoard;
    }

    /**
     * @return array
     */
    public function play(): array
    {
        foreach ($this->teamA as $indexA => $playerA) {
            $score = PHP_INT_MAX;
            foreach ($this->teamB as $indexB => $playerB) {
                if ($this->teamA[$indexB] > $this->teamB[$indexA]
                    && $this->teamA[$indexB] < $score
                    && !in_array($this->teamA[$indexB], $this->scoreBoard, true)
                ) {
                    $score = $this->teamA[$indexB];
                }
            }
            $this->scoreBoard[] = $score;
        }

        return $this->scoreBoard;
    }
}
