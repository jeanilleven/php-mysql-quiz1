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


?>