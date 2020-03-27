<?php

namespace Fortel\Game\Tests\Unit\Models;

use Fortel\Game\Models\PlayGameModel;
use PHPUnit\Framework\TestCase;

class PlayGameModelTest extends TestCase
{
    /**
     * @dataProvider teamsDataProvider
     * @param array $teamA
     * @param array $teamB
     * @param array $expected
     * @param bool $expectedTeamAWins
     */
    public function testPlayHasTeamAWonUnit(array $teamA, array $teamB, array $expected, bool $expectedTeamAWins): void
    {
        $model = new PlayGameModel($teamA, $teamB);
        $actual = $model->play();
        $this->assertEquals($expected, $actual);
        $actual = $model->hasTeamAWon();
        $this->assertEquals($actual, $expectedTeamAWins);
    }

    /**
     * @return array
     */
    public function teamsDataProvider(): array
    {
        return [
            [
                [35, 100, 20, 50, 40], [35, 10, 30, 20, 90], [40, 20, 35, 50, 100], true
            ],
            [
                [1], [1], [PHP_INT_MAX], false
            ],
            [
                [2], [1], [2], true
            ],
            [
                [], [], [], true
            ],
        ];
    }
}
