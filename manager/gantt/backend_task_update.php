<?php
require_once('_db.php');

$milestone = isset($_POST["milestone"]);

db_update_task_full($_POST["task_id"], $_POST["start"], $_POST["end"], $_POST["name"], $_POST["complete"], $milestone);

class Result {}

$response = new Result();
$response->result = 'OK';

header('Content-Type: application/json');
echo json_encode($response);

?>
