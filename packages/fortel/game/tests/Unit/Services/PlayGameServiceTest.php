<?php

namespace Fortel\Game\Tests\Unit\Services;

use Fortel\Game\Services\PlayGameService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @package Fortel\Game\Tests\Models
 */
class PlayGameServiceTest extends TestCase
{

    /**
     * @var PlayGameService
     */
    private PlayGameService $service;

    protected function setUp(): void
    {
        $this->service = new PlayGameService();
        parent::setUp();
    }

    /**
     * @dataProvider teamsDataProvider
     * @param string $teamA
     * @param string $teamB
     * @param string $expected
     */
    public function testPlayUnit(string $teamA, string $teamB, string $expected): void
    {
        $actual = $this->service->play($teamA, $teamB);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider teamsDataFailsProvider
     * @param string $teamA
     * @param string $teamB
     * @param string $expected
     */
    public function testPlayUnitFails(string $teamA, string $teamB, string $expected): void
    {
        try {
            $this->service->play($teamA, $teamB);
        } catch (InvalidArgumentException $err) {
            $this->assertEquals($expected, $err->getMessage());
        }
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

    /**
     * @return array
     */
    public function teamsDataFailsProvider(): array
    {
        return [
            [
                '1', '2,1', 'Each team must have equal amount of players, team A: 1 , team B: 2'
            ],
            [
                '1,2', '1', 'Each team must have equal amount of players, team A: 2 , team B: 1'
            ],
        ];
    }
}
