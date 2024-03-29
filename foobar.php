<?php

$output = "";
for( $i = 1; $i <= 100; $i++ ) {
    if($i % 3 == 0 && $i % 5 == 0) $output .= "foobar";
    else if($i % 3 == 0) $output .= "foo";
    else if($i % 5 == 0) $output .= "bar";
    else {
        $output .= $i;
    }

    $output .= ($i < 100) ? ", " : "";
}

echo $output;
?>