<?php

namespace App\Console\Commands;

use Anna\AI;
use Anna\GPS;
use Anna\Map;
use Anna\Rover;
use Exception;
use Illuminate\Console\Command;

class LaunchRover extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-technical-test {--initial_orientation=N} {--rectangle_width=4} {--rectangle_height=4} {--initial_x=2} {--initial_y=2} {--commands=ARARARAR}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run technical test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $rover = new Rover($this->option('initial_orientation'));
            $gps = new GPS();
            $map = new Map($this->option('rectangle_width'), $this->option('rectangle_height'), $gps);

            $gps->savePosition($this->option('initial_x'), $this->option('initial_y'));

            $AI = new AI();
            $AI->createCommands(str_split($this->option('commands')));
            $success = $AI->executeCommands($rover, $gps, $map);
        } catch (Exception $e) {
            $this->error('The command "Run technical test" failed');
            $this->newLine();
            $this->newLine();
            $this->line($e->getMessage());
            $this->newLine();
            $this->newLine();

            return Command::FAILURE;
        }

        if ($success) {
            $this->info('Great! Rover arrived succesfully!');
        } else {
            $this->info('Oh! Rover came out of the square');
        }

        $this->newLine();
        $this->info('success => '.($success === true ? 'true' : 'false'));
        $this->info('final_orientation => '.$rover->orientation());
        $this->info('initialX => '.$gps->firstPosition()['x']);
        $this->info('initialY => '.$gps->firstPosition()['y']);
        $this->info('rectangleWidth => '.$map->width());
        $this->info('rectangleHeight => '.$map->height());
        $this->info('commands => '.json_encode($AI->commands()));
        $this->info('final_position => '.json_encode($gps->lastPosition()));
        $this->info('steps => '.json_encode($gps->positions()));

        return Command::SUCCESS;
    }
}
