<?php

declare(strict_types=1);

namespace Fortel\Game\Services;

use Fortel\Game\Models\PlayGameModel;
use Fortel\Game\Models\PlayGameModelInterface;

/**
 * @package Fortel\Game\Services
 */
class PlayGameService implements PlayGameServiceInterface
{
    /** @var array */
    private const PLAY_RETURN_VALUE_MAP = [0 => 'Lose', 1 => 'Win'];

    /**
     * Returns
     *  - If A team can in than the output will be: Win
     *  - If A team lose than the output will be: Lose
     *
     * @param string $teamA players data comma separated
     * @param string $teamB players data comma separated
     * @return string
     */
    public function play(string $teamA, string $teamB): string
    {
        /** @var PlayGameModelInterface $playModel */
        $playModel = new PlayGameModel($this->toArray($teamA), $this->toArray($teamB));
        $playModel->play();
        $returnValue = (int)$playModel->hasTeamAWon();

        return self::PLAY_RETURN_VALUE_MAP[$returnValue];
    }

    /**
     * @param string $input
     * @return array
     */
    private function toArray(string $input): array
    {
        return explode(',', $input);
    }
}
