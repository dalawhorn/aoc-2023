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
        $val1 = $this->part1();
        $val2 = $this->part2();

        $this->info("Part 1: ".$val1);
        $this->info("Part 2: ".$val2);
    }

    protected function part1() {
        $file_contents = $this->openAocFile($this->fileDay);

        $values = [];
        $sum = 0;
        
        foreach($file_contents as $line) {
            // dump($line);
            preg_match_all('/\d/', $line, $matches);
            // dump($matches);
            if(count($matches[0]) > 0) {
                $number = (int) $matches[0][0].$matches[0][array_key_last($matches[0])];
                $values[] = $number;
                $sum += $number;
            }
        }

        return $sum;
    }

    protected function part2() {
        $file_contents = $this->openAocFile($this->fileDay);

        $values = [];
        $sum = 0;
        
        foreach($file_contents as $line) {
            //Use look ahead because out put can have numbers together ie eighthree... not accounted for in AoC test case, thanks reddit.
            preg_match_all('/(?=(\d|one|two|three|four|five|six|seven|eight|nine))/', $line, $matches);

            if(count($matches[1]) > 0) {
                $val1 = $matches[1][0];
                $val2 = $matches[1][array_key_last($matches[1])];
                if(!is_numeric($val1)) {
                    $val1 = $this->stringToNum($val1);
                }
                if(!is_numeric($val2)) {
                    $val2 = $this->stringToNum($val2);
                }
                
                $number = $val1.$val2;

                $values[] = (int) $number;
                $sum += (int) $number;
            }
        }

        return $sum;
    }

    protected function stringToNum($string) {
        $return = 0;

        $conversions = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19
        ];

        if(isset($conversions[$string])) {
            $return = $conversions[$string];
        }

        return $return;
    }
}
