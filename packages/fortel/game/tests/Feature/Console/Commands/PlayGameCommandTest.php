<?php

namespace Fortel\Game\Tests\Feature\Console\Commands;

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
    public function testPlayGameCommandSucceeds(string $teamA, string $teamB, string $expected): void
    {
        $this->artisan('fortel:play-game')
        ->expectsQuestion('Enter A Teams players', $teamA)
        ->expectsQuestion('Enter B Teams players', $teamB)
        ->expectsOutput($expected)
        ->assertExitCode(0);
    }

    /**
     * @dataProvider teamsDataFailsProvider
     * @param string $teamA
     * @param string $teamB
     * @param string $expected
     */
    public function testPlayGameCommandFails(string $teamA, string $teamB, string $expected): void
    {
        $this->artisan('fortel:play-game')
            ->expectsQuestion('Enter A Teams players', $teamA)
            ->expectsQuestion('Enter B Teams players', $teamB)
            ->expectsOutput($expected)
            ->assertExitCode(0);
    }

    public function testPlayGameCommandTeamAValidationFails(): void
    {
        $this->artisan('fortel:play-game')
            ->expectsQuestion('Enter A Teams players', 'A')
            ->expectsQuestion('Enter A Teams players', '1')
            ->expectsQuestion('Enter B Teams players', 'B')
            ->expectsQuestion('Enter B Teams players', '1')
            ->expectsOutput('Lose')
            ->assertExitCode(0);
    }

    /**
     * @return array
     */
    public function teamsDataFailsProvider(): array
    {
        return [
            [
                '35, 100', '35, 10, 30', 'Each team must have equal amount of players, team A: 2 , team B: 3'
            ],
            [
                '35, 100, 30', '10, 30', 'Each team must have equal amount of players, team A: 3 , team B: 2'
            ],
        ];
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
