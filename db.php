<?php 

    // connect to database
    $db = mysqli_connect("localhost", "root", "", "todolist");

    // Initialize variables
    $id = 0;
    $task = "";
    $update = false;
    
    // initialize errors variable
    $errors = "";

    // insert a quote if submit button is clicked
    if (isset($_POST['save'])) {
        if (empty($_POST['task'])) {
            $errors = "You must fill in the task";
        }else{
            $task = $_POST['task'];
            $sql = "INSERT INTO tasks (task) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location: index.php');
        }
    }	

    // edit task
    if(isset($_GET['edit_task'])) {
        $id = $_GET['edit_task'];
        $update = true;
        $record = mysqli_query($db, "SELECT * FROM tasks WHERE task= $task");

        if(@count($record) == '$id') {
            $n = mysqli_fetch_array($record);
            $task = $n['task'];
        }
    }

    // update task
    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $task = $_POST['task'];

        mysqli_query($db, "UPDATE tasks SET task='$task' WHERE id= $id");
        header('location: index.php');
    }

    // delete task
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id= $id");
        header('location: index.php');
    }
    ?>