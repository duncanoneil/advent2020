<?php

$day = new day2();
$day->run();

class day2
{
    function run()
    {
        $file = file_get_contents('input/day2.txt');

        $re = '/([\d]*)-([\d]*) ([a-z]{1}): ([a-z]*)/m';

        preg_match_all($re, $file, $matches, PREG_SET_ORDER, 0);

        $validCount = $this->partOne($matches);
        print PHP_EOL . "Valid Passwords #1: {$validCount}" . PHP_EOL;

        $validCount = $this->partTwo($matches);
        print PHP_EOL . "Valid Passwords #2: {$validCount}" . PHP_EOL;
    }

    function partOne($matches)
    {
        $validCount = 0;
        foreach($matches as $match) {
            $chars = count_chars($match[4], 1);
            $count = key_exists(ord($match[3]), $chars) ? $chars[ord($match[3])] : 0;
            $min = intval($match[1]);
            $max = intval($match[2]);
            if ($min <= $count && $count <= $max) {
                $validCount++;
            }
        }
        return $validCount;
    }

    function partTwo($matches)
    {
        $validCount = 0;
        foreach($matches as $key => $match) {
            $first = intval($match[1]) - 1;
            $second = intval($match[2]) - 1;
            $a = ($match[4][$first] === $match[3]);
            $b = ($match[4][$second] === $match[3]);
            if (($a ^ $b) === 1) {
                $validCount++;
            }
        }
        return $validCount;
    }
}

