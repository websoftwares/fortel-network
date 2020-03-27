<?php

declare(strict_types=1);

namespace Fortel\Game\Services;

/**
 * @package Fortel\Game\Services
 */
interface PlayGameServiceInterface
{
    /**
     * Returns
     *  - If A team can in than the output will be: Win
     *  - If A team lose than the output will be: Lose
     *
     * @param string $teamA players data comma separated
     * @param string $teamB players data comma separated
     * @return string
     */
    public function play(string $teamA, string $teamB): string;
}
