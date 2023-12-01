<?php

namespace App\Console\Commands\Aoc;

use Illuminate\Console\Command;

class Day1 extends Command
{
    use AocHelpersTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:day1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Day 1 of the Advent of Code';

    protected $fileDay = 'day1';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file_contents = $this->openAocFile($this->fileDay);

        $values = [];
        $sum = 0;
        
        foreach($file_contents as $line) {
            // dump($line);
            preg_match_all('/\d/', $line, $matches);
            // dump($matches);
            $number = (int) $matches[0][0].$matches[0][array_key_last($matches[0])];
            $values[] = $number;
            $sum += $number;
        }

        $this->info("Part 1: ".$sum);
    }
}
