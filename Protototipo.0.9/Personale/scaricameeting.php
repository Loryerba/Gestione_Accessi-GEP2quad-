<?php
include 'validator/getMeetingTable.php';

    $myfile = fopen("meeting.csv", "w") or die("Unable to open file!");
    $csv = getMeetingCsv();
    fwrite($myfile, $csv);
    fclose($myfile);
    $filename = "meeting.csv";
    header("Content-disposition: attachment;filename=$filename");
    readfile($filename);
