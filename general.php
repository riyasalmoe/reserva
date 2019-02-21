<?php

//echo return_DateTimeStd('2019-01-31T18:00+4');
//echo date('H:i:00',time());
//echo return_TimeStd('2019-02-21T' . date('H:i:00',time()) . '+4');
// echo inTimeRange(return_TimeStd('2019-02-21T09:43+4'),return_TimeStd('2019-02-21T09:50+4')
                        // ,return_TimeStd('2019-02-21T' . date('H:i:00',time()) . '+4'));

function return_ISO8601($thisDate)
{
    $StringDateTime = $thisDate;
    $StringDateTime = str_replace('"', '', $StringDateTime);
    $StringDateTime = str_replace('Asia/Dubai', '', $StringDateTime);
    $StringDateTime = str_replace('AM ', 'AM', $StringDateTime);
    $StringDateTime = str_replace('PM ', 'PM', $StringDateTime);
    $ISO8601DateTime = date_create_from_format('d/F/Y h:i a', $StringDateTime);

    return (date_format($ISO8601DateTime, 'Y-m-d') . 'T' . date_format($ISO8601DateTime, 'H:m') . '+4');
}

function return_DateTimeStd($thisISO8601) {
    $data = explode("T", str_replace("+4","",$thisISO8601));
    $StringDate = $data[0];
    $StringTime = $data[1];
    $outputDate = new datetime($StringDate);
    return date_format($outputDate,'d-M-Y') . ' ' . $StringTime;
    
}

function return_TimeStd($thisISO8601) {
    $data = explode("T", str_replace("+4","",$thisISO8601));
    $StringDate = $data[0];
    $StringTime = $data[1];
    //$outputDate = new datetime($StringDate);
    return $StringTime;
    
}

function return_DateOnlyStd($thisISO8601) {
    $data = explode("T", str_replace("+4","",$thisISO8601));
    $StringDate = $data[0];
    //$StringTime = $data[1];
    $outputDate = new datetime($StringDate);
    return date_format($outputDate,'d-M-Y');
    
}

function inTimeRange($time_start, $time_end, $time_needle) {
    $res = false;
    $t1 = strtotime("1970-01-01 $time_start");
    //echo date('H:i:00',$t1) . "<br>";
    $t2 = strtotime("1970-01-01 $time_end");
    //echo date('H:i:00',$t2) . "<br>";
    $tn = strtotime("1970-01-01 $time_needle");
    //echo date('H:i:00',$tn) . "<br>";
    if ($t1 >= $t2) $t2 = strtotime('+1 day', $t2);
    //return ($tn >= $t1) && ($tn <= $t2); // or return ($tn > $t1) && ($tn < $t2);
    if(($tn >= $t1) && ($tn <= $t2)){
        return 1;
    }else{
        return 0;
    }
    }