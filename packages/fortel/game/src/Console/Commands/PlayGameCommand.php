<?php

declare(strict_types=1);

namespace Fortel\Game\Console\Commands;

use Closure;
use Exception;
use Fortel\Game\Services\PlayGameService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

/**
 * @package Fortel\Game\Commands
 */
class PlayGameCommand extends Command
{
    private const GAME_DATA_ENTRY_PROMPT = 'Enter %s Teams players';
    private const TEAM_A = 'A';
    private const TEAM_A_DEFAULT = '30, 100, 20, 50, 40';
    private const TEAM_B = 'B';
    private const TEAM_B_DEFAULT = '35, 10, 30, 20, 90';

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
        $rules = 'regex:/(\d+)(,\s*\d+)*/';
        $rulesMessages = [
            'regex' => $this->buildQuestion(self::TEAM_A),
        ];

        $teamA = $this->withValidation(
            $this->buildClosureQuestion(self::TEAM_A, self::TEAM_A_DEFAULT),
            $rules,
            $rulesMessages
        );

        $rulesMessages['regex'] = $this->buildQuestion(self::TEAM_B);

        $teamB = $this->withValidation(
            $this->buildClosureQuestion(self::TEAM_B, self::TEAM_B_DEFAULT),
            $rules,
            $rulesMessages
        );

        $outputMethodName = 'warn';

        try {
            $output = $this->service->play($teamA, $teamB);
            $outputMethodName = 'info';
        } catch (Exception $err) {
            $output = $err->getMessage();
        }
        $this->{$outputMethodName}($output);
    }

    /**
     * @param Closure $callback
     * @param $rules
     * @param array $messages
     * @return mixed|string|null
     */
    private function withValidation(Closure $callback, $rules, array $messages = [])
    {
        $input = $callback();
        $mapMessages = static function ($message, $rule) {
            return ["input.$rule" => $message];
        };

        $validator = Validator::make(
            compact('input'),
            ['input' => $rules],
            collect($messages)->mapWithKeys($mapMessages)->toArray()
        );

        if ($validator->fails()) {
            $this->warn($validator->errors()->first());
            $input = $this->withValidation($callback, $rules, $messages);
        }

        return \is_string($input) && $input === '' ? null : $input;
    }


    /**
     * @param string $team
     * @return string
     */
    private function buildQuestion(string $team): string
    {
        return sprintf(self::GAME_DATA_ENTRY_PROMPT, $team);
    }

    /**
     * @param string $team
     * @param string $default
     * @return callable
     */
    private function buildClosureQuestion(string $team, string $default): callable
    {
        $question = $this->buildQuestion($team);

        return function () use ($question, $default) {
            return $this->ask($question, $default);
        };
    }
}
