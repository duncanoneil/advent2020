<?php

$day = new day10();
$day->run();

class day10
{
    private $data = [];

    function run()
    {
        $file = file_get_contents('input/day10.txt');

        $this->data = explode("\n", $file);
        sort($this->data);

        $partOne = $this->partOne();
        print PHP_EOL . "Part One: {$partOne}" . PHP_EOL;

        $partTwo = $this->partTwo();
        print PHP_EOL . "Part Two: {$partTwo}" . PHP_EOL;
    }

    function partOne()
    {
        $currentJoltage = 0;
        $diffOne = 0;
        $diffThree = 1; //built in adapter is 3
        foreach($this->data as $joltVal) {
            $diff = $joltVal - $currentJoltage;
            if ($diff === 1) {
                $diffOne++;
            } elseif ($diff === 3) {
                $diffThree++;
            }
            $currentJoltage = (int)$joltVal;
        }
        return $diffOne * $diffThree;
    }

    function partTwo()
    {
        $currentJoltage = 0;
        $runs = [];
        $currentRun = 1;

        foreach($this->data as $joltVal) {
            $diff = $joltVal - $currentJoltage;
            if ($diff === 1) {
                $currentRun++;
            } elseif ($diff === 3) {
                $runs[] = $currentRun;
                $currentRun = 1;
            }
            $currentJoltage = (int)$joltVal;
        }
        // Get the last run before the built in adapter
        if ($currentRun > 1) {
            $runs[] = $currentRun;
        }
        $countThrees = $countFours = $countFives = 0;
        foreach ($runs as $run) {
            switch ($run) {
                case 1:
                case 2:
                    break;
                case 3:
                    $countThrees++;
                    break;
                case 4:
                    $countFours++;
                    break;
                case 5:
                    $countFives++;
                    break;
            }
        }
        //Tribonacci sequence, to get the number of paths between each grouping of 3, 4, and 5 adapters
        // Calculated by hand originally, 13 and 24 follow for higher orders, but my input didn't need them
        return pow(2, $countThrees) * pow(4, $countFours) * pow(7, $countFives);
    }

}

