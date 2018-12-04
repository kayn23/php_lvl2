<?
include_once 'app/pdo.php';
$id = (isset($_GET['id']))?(int)$_GET['id']-1:-1;
if ($id < 0) {
  header("HTTP/1.0 500 uncorrect params");
  exit;
}

$return = $db->query("SELECT * FROM products LIMIT $id,25")->fetchAll();
echo json_encode($return);