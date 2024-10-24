<?php
$baris = 5;
for ($i = 1; $i <= $baris; $i++) {
    echo str_repeat(" ", $baris - $i) . str_repeat("*", 2 * $i - 1) . "\n";
}


echo "\n";

$baris = 5;
for ($i = $baris; $i >= 1; $i--) {
    echo str_repeat(" ", $baris - $i) . str_repeat("*", 2 * $i - 1) . "\n";
}


function tes($n) {
    $i = 0;
    while ($i <= $n) {
        if ($i % 4 == 0 && $i % 6 == 0) {
            echo ("\nPemrograman Website 2024");
        } else if($i % 5 == 0){
            echo ("\n2024");
        }else if($i % 4 == 0 && $i % 6 != 0){
            echo ("\nPemrograman");
        }else if($i % 4 != 0 && $i % 6 == 0){
            echo ("\nWebsite");
        }else{
            echo ("\n");
            echo($i);
        }
        $i++;
    }
}

tes(20);


?>
