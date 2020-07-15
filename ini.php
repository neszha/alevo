<?php

function show_status($done, $total, $size=30) {
 
    static $start_time;
 
    // if we go over our bound, just ignore it
    if($done > $total) return;
 
    if(empty($start_time)) $start_time=time();
    $now = time();
 
    $perc=(double)($done/$total);
 
    $bar=floor($perc*$size);
 
    $status_bar="\r\033[0m[";
    $status_bar.=str_repeat("=", $bar);
    if($bar<$size){
        // $status_bar.=">";
        $status_bar.=str_repeat(" ", $size-$bar);
    } else {
        // $status_bar.="=";
    }
 
    $disp=number_format($perc*100, 0);
 
    $status_bar.="]\033[93m $disp% \033[0m\033[1m $done/$total";
 
    $rate = ($now-$start_time)/$done;
    $left = $total - $done;
    $eta = round($rate * $left, 2);
 
    $elapsed = $now - $start_time;
 
    $status_bar.= " remaining: ".number_format($eta)." sec.  elapsed: ".number_format($elapsed)." sec.";
    $status_bar .= " \033[45mRender view";
    $status_bar .="\033[0m \033[1mini$done.php";
 
    echo "$status_bar  ";
 
    flush();
 
    // when done, send a newline
    if($done == $total) {
        echo "\r hahahaha \r";
    }
 
}

for ($i = 0; $i < 100; $i++) echo "\033[{$i}m {$i} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, culpa.\n";

// die();

    echo ".\n[===========> Alevo Mode\n.\n";
 for($x=1;$x<=100;$x++){
     show_status($x, 100);
     usleep(10000);
 }

 for($x=1;$x<=100;$x++){
     show_status($x, 100);
     usleep(10000);
 }

 for($x=1;$x<=100;$x++){
     show_status($x, 100);
     usleep(10000);
 }


?>