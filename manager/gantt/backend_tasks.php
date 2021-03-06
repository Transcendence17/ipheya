<?php
require_once('_db.php');

class Task {}

$result = tasklist($pdo, db_get_tasks($_GET['project_id']));

header('Content-Type: application/json');
echo json_encode($result);

function tasklist($pdo, $items) {
    $result = array();

    foreach($items as $item) {
      $r = new Task();

      // rows
      $r->id = $item['task_id'];
      $r->text = htmlspecialchars($item['name']);
      $r->start = $item['start'];
      $r->end = $item['end'];
      $r->complete = $item['complete'];
      if ($item['milestone']) {
          $r->type = 'Milestone';
      }

      $parent = $r->id;

      $children = db_get_tasks($parent);

      if (!empty($children)) {
          $r->children = tasklist($pdo, $children);
      }

      $result[] = $r;
    }
    return $result;
}
?>
