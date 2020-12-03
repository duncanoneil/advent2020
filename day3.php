<?php

$day = new day3();
$day->run();

class day3
{
    private $data = [];

    function run()
    {
        $file = file_get_contents('input/day3.txt');

        $this->data = explode("\n", $file);

        $trees = $this->partOne();
        print PHP_EOL . "Num Trees: {$trees}" . PHP_EOL;

        $trees = $this->partTwo();
        print PHP_EOL . "Num Trees: {$trees}" . PHP_EOL;
    }

    function partOne()
    {
        $count = 0;
        $pos = 0;
        $maxPos = strlen($this->data[0]);
        foreach($this->data as $key => $value) {
            $char = $value[$pos];
            if ($char === '#') {
                $count++;
            }
            $pos += 3;
            if ($pos >= $maxPos) {
                $pos -= $maxPos;
            }
        };
        return $count;
    }

    function partTwo()
    {
        $trees = 1;
        $slopes = [
            ['right' => 1, 'down' => 1],
            ['right' => 3, 'down' => 1],
            ['right' => 5, 'down' => 1],
            ['right' => 7, 'down' => 1],
            ['right' => 1, 'down' => 2],
        ];
        foreach ($slopes as $slope) {
            $trees *= $this->navigateSlope($slope['right'], $slope['down']);
        }
        return $trees;
    }

    function navigateSlope($right, $down)
    {
        $count = 0;
        $pos = 0;
        $maxPos = strlen($this->data[0]);
        for($i = 0; $i <= count($this->data); $i += $down) {
            if (!isset($this->data[$i])) { continue; }
            $char = $this->data[$i][$pos];
            if ($char === '#') {
                $count++;
            }
            $pos += $right;
            if ($pos >= $maxPos) {
                $pos -= $maxPos;
            }
        };
        return $count;
    }
}

