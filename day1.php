<?php

$day = new day1();
$day->run();

class day1
{
    private $data = [];

    function run()
    {
        $file = file_get_contents('input/day1.txt');

        $this->data = explode("\n", $file);

        $match = $this->findFirstMatch();
        print PHP_EOL . "MATCH #1: {$match}" . PHP_EOL;

        $match = $this->findSecondMatch();
        print PHP_EOL . "MATCH #2: {$match}" . PHP_EOL;
    }

    function findFirstMatch()
    {
        foreach($this->data as $key => $value) {
            for ($i = $key; $i < count($this->data); $i++) {
                $sum = (intval($value) + intval($this->data[$i]));
                if ($sum === 2020) {
                    return intval($value) * intval($this->data[$i]);
                }
            }
        };
    }

    function findSecondMatch()
    {
        foreach($this->data as $key => $value) {
            for ($i = $key; $i < count($this->data); $i++) {
                for ($j = ($key+1); $j < count($this->data); $j++) {
                    $sum = (intval($value) + intval($this->data[$i]) + intval($this->data[$j]));
                    if ($sum === 2020) {
                        return intval($value) * intval($this->data[$i]) * intval($this->data[$j]);
                    }
                }
            }
        };
    }
}

