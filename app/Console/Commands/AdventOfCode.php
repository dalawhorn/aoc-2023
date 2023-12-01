<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\select;

use Illuminate\Support\Str;

class AdventOfCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Advent of Code 2023 Scripts';

    protected $shouldKeepRunning = true;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->trap(SIGTERM, fn () => $this->shouldKeepRunning = false);

        while($this->shouldKeepRunning) {
            $this->info('Advent of code 2023');
            $selection = Str::remove(' ', select(
                label: 'Select a day to run its script...',
                options: ['Day 1', 'Exit'],
            ));

            if($selection == "Exit") {
                $this->shouldKeepRunning = false;
            }
            else {
                $this->call('aoc:'.$selection);
            }
        }
        
    }
}
