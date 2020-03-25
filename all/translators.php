<?php 

function int_to_day($int){

    // $int = 1 should be 'MON'
    $days = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];

    if($int > 0 && $int < 8){
        return $days[$int-1];
    }else{
        return 'ERR';
    }
}

function int_to_start_time($int){
    if($int < 30){
        $h = 0;
        $m = '00';
        $p = 'AM';
        $h = 6 + ceil($int/2);
        if($int%2 == 0){
            $m = '30';
        }
        if($h > 12){
            $h -= 12;
            $p = 'PM';
        }
        return $h.":".$m." ".$p;
    }else{
        return 'ERR';
    }
}

function int_to_end_time($int){
    $int++;
    if($int < 30){
        $h = 0;
        $m = '00';
        $p = 'AM';
        $h = 6 + ceil($int/2);
        if($int%2 == 0){
            $m = '30';
        }
        if($h > 12){
            $h -= 12;
            $p = 'PM';
        }
        return $h.":".$m." ".$p;
    }else{
        return 'ERR';
    }
}


?>