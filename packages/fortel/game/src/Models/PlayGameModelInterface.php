<?php

declare(strict_types=1);

namespace Fortel\Game\Models;

/**
 * @package Fortel\Game\Models
 */
interface PlayGameModelInterface
{
    /**
     * @return array
     */
    public function play(): array;

    /**
     * @return bool
     */
    public function hasTeamAWon(): bool;
}
