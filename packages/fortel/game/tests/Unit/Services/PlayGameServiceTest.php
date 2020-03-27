<?php

namespace Fortel\Game\Tests\Unit\Services;

use Fortel\Game\Services\PlayGameService;
use PHPUnit\Framework\TestCase;

/**
 * @package Fortel\Game\Tests\Models
 */
class PlayGameServiceTest extends TestCase
{
    /**
     * @dataProvider teamsDataProvider
     * @param string $teamA
     * @param string $teamB
     * @param string $expected
     */
    public function testPlayUnit(string $teamA, string $teamB, string $expected): void
    {
        $service = new PlayGameService();
        $actual = $service->play($teamA, $teamB);
        $this->assertEquals($expected, $actual);
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
