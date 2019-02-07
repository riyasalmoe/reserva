<?php
//I:\xampp\htdocs\RTA\csv\LMS Scheduling RTA.csv

// -- required tags --
// Uid = Unique identifier for the event
// Subject = Display name of the event
// start_time = UTC* ISO 8601 formatted start date/time
// end_time = UTC* ISO 8601 formatted end date/time

//--optionals tags --
// Location = Location name of the event
// Description = An additional description field for the event. Reserva can be configured to display this together with Subject in some circumstances.
// Organiser
// organiser_email
// all_day
// Private = Flag indicating if the event is private (subject name will be hidden etc).
// Confirmed = Flag indicating if the event has been confirmec
// Cancelled = Flag indicating if the event has been cancelled
// meeting_status = Cancelled or Confirmed will be processed. All other values will be ignored.


//return_sampleRooms();
return_XMLEvents();

function return_XMLEvents()
{

    $csv = file('I:\xampp\htdocs\RTA\csv\LMSTest02.csv');

    header('Content-Type: text/xml');
    print('<?xml version="1.0" encoding="utf-8"?>');
    print('<events>');

    $row = 1;

    foreach ($csv as $line) {
        if ($row == 1) {$row++;
            continue;}

        $data = explode(",", $line);

        print('<event>');

        print('<uid>' . uniqid() . '</uid>');

        print('<Subject>' . $data[20] . '</Subject>');

        print('<Start_Time>' . return_ISO8601($data[22]) . '</Start_Time>');

        print('<End_Time>' . return_ISO8601($data[23]) . '</End_Time>');

        print('</event>');
    }

    print('</events>');
}

function return_sampleRooms() {

    header('Content-Type: text/xml');
    print('<?xml version="1.0" encoding="utf-8"?>');
    print('<rooms>');
    for($rec=1;$rec<6;$rec++){

        print('<room>');
        print('<uid>' . uniqid() . '</uid>');
        print('<name>' . 'Room Name ' . $rec . '</name>');
        print('<description>' . 'Description here...' . '</description>');
        print('</room>');
    }
    print('</rooms>');
}


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
