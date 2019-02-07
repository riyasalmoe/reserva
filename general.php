<?php

//return_DateTimeStd('2019-01-31T18:00+4');

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

function return_DateOnlyStd($thisISO8601) {
    $data = explode("T", str_replace("+4","",$thisISO8601));
    $StringDate = $data[0];
    //$StringTime = $data[1];
    $outputDate = new datetime($StringDate);
    return date_format($outputDate,'d-M-Y');
    
}