<?php

function tes($n)
{
    $i = 0;
    while ($i <= $n) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo ("\nPemrograman Website 2024");
        } else if ($i % 5 == 0) {
            echo ("\n2024");
        } else if ($i % 4 == 0 && $i % 6 != 0) {
            echo ("\nPemrograman");
        } else if ($i % 4 != 0 && $i % 6 == 0) {
            echo ("\nWebsite");
        } else {
            echo ("\n");
            echo ($i);
        }
        $i++;
    }
}

tes(20);