<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    header('Content-Type: application/json');

    $contents = @file_get_contents('list.json');

    echo $contents ? $contents : json_encode(['items' => []]);

}
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["todolist"])) {
    $todolistJson = $_POST["todolist"];
    $todolistArray = json_decode($todolistJson, true);

    file_put_contents("list.json", json_encode($todolistArray));
} else {
    http_response_code(400);
}
?>
