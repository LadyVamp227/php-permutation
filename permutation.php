<?php
ini_set('memory_limit', '-1');

$time = -microtime(true);
$counter = 0;

function getCpu()
{
    $load = sys_getloadavg();
    return $load[0];
}

function getMemory()
{
    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    return $mem[2] / $mem[1] * 100;
}

$alphabet = array("a", "A", "b", "B", "c", "C", "d", "D", "e", "E", "f", "F", "g", "G", "h", "H", "i", "I", "j", "J",
    "k", "K", "l", "L", "m", "M", "n", "N", "o", "O", "p", "P", "q", "Q", "r", "R", "s", "S", "t", "T", "u", "U", "v",
    "V", "w", "W", "x", "X", "y", "Y", "z", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

$count = 0;
$cnt = count($alphabet);
$myString = "";

$file = fopen("file.txt", "a") or die("Unable to open a file");
for ($first = 0; $first < $cnt; $first++) {
    for ($second = 0; $second < $cnt; $second++){
        for ($third = 0; $third < $cnt; $third++){
            for ($fourth = 0; $fourth < $cnt; $fourth++){
                for ($fifth = 0; $fifth < $cnt; $fifth++){
                    $myString .= $alphabet[$first].$alphabet[$second].$alphabet[$third]
                        .$alphabet[$fourth].$alphabet[$fifth];
                }
                $counter++;
                if ($counter == 100000){
                    fwrite($file,$myString);
                    $myString= "";
                    $counter = 0;

                }
            }
        }
    }


}
fwrite($file, $myString);
fclose($file);
$time += microtime(true);
echo "\n", getCpu(), "\n";
echo "\n", getMemory(), "\n";
die("\n" . "$time done \n");
