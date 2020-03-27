<?php

declare(strict_types=1);

namespace Fortel\Game\Commands;

use Fortel\Game\Services\PlayGameService;
use Illuminate\Console\Command;

/**
 * @package Fortel\Game\Commands
 */
class PlayGameCommand extends Command
{
    private const GAME_DATA_ENTRY_PROMPT = 'Enter %s Teams players';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fortel:play-game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start playing the game';

    /**
     * @var PlayGameService
     */
    private PlayGameService $service;

    /**
     * Create a new command instance.
     *
     * @param PlayGameService $service
     */
    public function __construct(PlayGameService $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $teamA = $this->ask(sprintf(self::GAME_DATA_ENTRY_PROMPT, 'A'), '30, 100, 20, 50, 40');
        $teamB = $this->ask(sprintf(self::GAME_DATA_ENTRY_PROMPT, 'B'), '35, 10, 30, 20, 90');

        $output = $this->service->play($teamA, $teamB);
        $outputMethodName = $output === 'Win' ? 'info' : 'error';

        $this->{$outputMethodName}($output);
    }
}
