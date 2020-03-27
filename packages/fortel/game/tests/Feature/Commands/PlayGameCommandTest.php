<?php

namespace Fortel\Game\Tests\Feature\Commands;

use Tests\TestCase;

/**
 * @package Fortel\Game\Tests\Feature\Commands
 */
class PlayGameCommandTest extends TestCase
{
    /**
     * @dataProvider teamsDataProvider
     * @param string $teamA
     * @param string $teamB
     * @param string $expected
     */
    public function testPlayGameCommand(string $teamA, string $teamB, string $expected): void
    {
        $this->artisan('fortel:play-game')
        ->expectsQuestion('Enter A Teams players', $teamA)
        ->expectsQuestion('Enter B Teams players', $teamB)
        ->expectsOutput($expected)
        ->assertExitCode(0);
    }

    /**
     * @return array
     */
    public function teamsDataProvider(): array
    {
        return [
            [
                '35, 100, 20, 50, 40', '35, 10, 30, 20, 90', 'Win'
            ],
            [
                '1', '1', 'Lose'
            ],
        ];
    }
}
