<?php
session_start();

// Session ellenőrzés
if (!isset($_SESSION['todo_list'])) {
    $_SESSION['todo_list'] = [];
}

// Elem hozzáadása a listához
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new'])) {
    $newItem = trim($_POST['new']);
    if (!empty($newItem)) {
        $_SESSION['todo_list'][] = $newItem;
    }
}

// Elem törlése
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $deleteIndex = $_POST['delete'];
    if (isset($_SESSION['todo_list'][$deleteIndex])) {
        unset($_SESSION['todo_list'][$deleteIndex]);
        $_SESSION['todo_list'] = array_values($_SESSION['todo_list']); // Re-index array
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        *{
            box-sizing:border-box;
        }
        body{
            background-color: gainsboro;
            width: max-content;
            height: max-content;
        }
        #container{
            width: max-content;
        }
        h1{
            padding-left: 100px;
        }
        label{
            margin: 10px;
            font-size: 17px;
            display: inline;
        }
        #list{
            list-style-type: circle;
        }
        li{
            font-size: 17px;
            display: inline;
        }
        input{
            display: inline;
            width: 250px;
        }
        button{
            margin: 10px;
            border: 0;
            border-radius: 3px;
            display: inline;
        }
        #delete{
            display: inline;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Teendők</h1>
        <form action="" method="post">
            <label for="new">Új Teendő</label>
            <input type="text" name="new" id="new">
            <button type="submit">Hozzáad</button>
        </form>
        <hr>
        <ul id="list">
            <?php foreach ($_SESSION['todo_list'] as $index => $item): ?>
                <form action="" method="post" style="display:inline;">
                        <button type="submit" name="delete" id="delete" value="<?php echo $index; ?>">Törlés</button>
                    </form>
                <li>
                    <?php echo htmlspecialchars($item); ?>
                   
                </li>
               
                <hr>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
