<?php

namespace App\Console\Commands\Aoc;

use Illuminate\Console\Command;

class Day2 extends Command
{
    use AocHelpersTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:day2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Day 2 of the Advent of Code';

    protected $fileDay = 'day2';

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

        $id_sum = 0;
        $total_red = 12;
        $total_green = 13;
        $total_blue = 14;
        
        foreach($file_contents as $line) {
            $game_id = 0;

            $game_and_sets = explode(': ', $line);
            $game_info = explode(' ', $game_and_sets[0]);
            $game_id = $game_info[1];
            $sets = explode('; ', $game_and_sets[1]);

            $game_possible = true;
            foreach($sets as $set) {
                $set_cube_totals = [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0
                ];

                $cubes = explode(', ', $set);
                foreach($cubes as $cube) {
                    list($cube_total, $cube_color) = explode(' ', $cube);
                    $set_cube_totals[$cube_color] += $cube_total;

                    foreach($set_cube_totals as $color => $total) {
                        $total_to_check = 0;
                        if($color == 'red') {
                            $total_to_check = $total_red;
                        }
                        elseif($color == 'green') {
                            $total_to_check = $total_green;
                        }
                        elseif($color == 'blue') {
                            $total_to_check = $total_blue;
                        }
        
                        if($total_to_check != 0 && $total > $total_to_check) {
                            $game_possible = false;
                        }
                    }
                }
            }


            if($game_possible) {
                $id_sum += $game_id;
            }
        }

        return $id_sum;
    }

    protected function part2() {
        $file_contents = $this->openAocFile($this->fileDay);

        $power_sum = 0;
        
        foreach($file_contents as $line) {
            $game_cube_maxs = [
                'red' => 0,
                'green' => 0,
                'blue' => 0
            ];

            $game_and_sets = explode(': ', $line);
            $game_info = explode(' ', $game_and_sets[0]);
            $game_id = $game_info[1];
            $sets = explode('; ', $game_and_sets[1]);

            foreach($sets as $set) {
                $cubes = explode(', ', $set);
                foreach($cubes as $cube) {
                    list($cube_total, $cube_color) = explode(' ', $cube);

                    if($cube_total > $game_cube_maxs[$cube_color]) {
                        $game_cube_maxs[$cube_color] = $cube_total;
                    }
                }
            }

            $power_sum += ($game_cube_maxs['red'] * $game_cube_maxs['green'] * $game_cube_maxs['blue']);
        }

        return $power_sum;
    }
}
