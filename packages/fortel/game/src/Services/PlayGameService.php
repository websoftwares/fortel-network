<?php

declare(strict_types=1);

namespace Fortel\Game\Services;

use Fortel\Game\Models\PlayGameModel;
use Fortel\Game\Models\PlayGameModelInterface;
use InvalidArgumentException;

/**
 * @package Fortel\Game\Services
 */
class PlayGameService implements PlayGameServiceInterface
{
    /** @var array */
    private const PLAY_RETURN_VALUE_MAP = [0 => 'Lose', 1 => 'Win'];
    private const ERROR_TEAMS_NOT_EQUAL = 'Each team must have equal amount of players, team A: %s , team B: %s';

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
        $arrTeamA = $this->toArray($teamA);
        $arrTeamB = $this->toArray($teamB);
        $numberOfPlayersTeamA = \count($arrTeamA);
        $numberOfPlayersTeamB = \count($arrTeamB);

        if ($numberOfPlayersTeamA !== $numberOfPlayersTeamB) {
            throw new InvalidArgumentException(
                sprintf(self::ERROR_TEAMS_NOT_EQUAL, $numberOfPlayersTeamA, $numberOfPlayersTeamB)
            );
        }

        /** @var PlayGameModelInterface $playModel */
        $playModel = new PlayGameModel($arrTeamA, $arrTeamB);
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
