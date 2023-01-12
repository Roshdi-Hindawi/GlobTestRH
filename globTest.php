<?php

// Using a CLI, run php globTest.php and start testing,

/*  Question 1: la fonction accepte un tableau des intervalles en paramètre,
 et retourne an tableau des intervalles qui represente toute les intervalles possible avec ordre croissant en fusionnant ceux qui intersecte */

/* Question 2: */
$intervals = readline('enter your array of intervals: ');

do {
    echo '--------------------> result: ' .
        convertArray(json_decode($intervals)) .
        PHP_EOL;

    $intervals = readline('enter your array([enter] to exit): ');
} while ($intervals);

function convertArray($intervals)
{
    // sort intervals
    usort(
        $intervals,
        function ($a, $b) {
            return $a[0] <=> $b[0];
        }
    );

    // set result intervals to first interval of sorted intervals
    $result = [$intervals[0]];

    // iterate over sorted $intervals and merge intersecting intervals or append non intersecting intervals to $result intervals
    foreach ($intervals as $interval) {

        // check if current interval can be merged with the last result interval
        if (($interval[0] <= end($result)[1]) & ($interval[1] > end($result)[1])) {
            $result[array_key_last($result)][1] = $interval[1];
            //else add current interval as a new interval to the result intervals ($result)
        } elseif ($interval[0] > end($result)[1]) {
            array_push($result, $interval);
        }
    }

    return json_encode($result);
}


/* Question 3: 1H 30min */