<?php
    include "top.html";

    session_start();

    if (!isset($_SESSION["name"])) {
        header("Location: index.php");
        exit;
    }


?>

    <div id="main">
        <h2><?= $_SESSION["name"] ?> To-Do List</h2>

        <ul id="todolist">
                
        </ul>

        <div id="buttons">
            <input id="itemtext" type="text" size="30" autofocus="autofocus"/>
            <button id="add">Add to Bottom</button>
            <button id="delete">Delete Top Item</button>
        </div>

        <ul>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>

<?php
    include "bottom.html";
?>