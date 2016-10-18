<?php
require 'sdk/shiftplanning.php';

$shiftplanning = new shiftplanning(array('key' => 'ff6e6074fdf511e3a5759de753de27051c84c1e2'));
$session = $shiftplanning->getSession( );

if(!$session) {
    $response = $shiftplanning->doLogin(array(
        "username" => "darkotzar@hotmail.com",
        "password" => "q1w2e3r4t5"
    ));
}

$response = $shiftplanning->setRequest(array(
    "module"     => "schedule.shifts",
    "mode"       => "overview",
    "start_date" => date("M d, Y", strtotime("today")),
    "end_date"   => date("M d, Y", strtotime("today"))
));

echo '<table style="width:100%" align="center">';
echo '<th style="padding-bottom: 20px">Today\'s shifts</th>';
for($i = 0; $i < count($response["data"]); $i++) {
    
    $data = $response["data"][$i];
    $employees = $data["employees"];
    $startDate = $data["start_date"];
    $endDate = $data["end_date"];
    
    echo '<tr align="center"><td>';
    echo '<i>' . $employees[0]["name"] . '</i>';
    echo '</td></tr><tr align="center"><td>';
    echo 'Position : ' . $data["schedule_name"] . ' ';
    echo $startDate["time"] . ' - ' .$endDate["time"];
    echo '</td></tr>';
}
echo '</table>'

?>