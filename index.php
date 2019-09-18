<?php
    include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Todo List</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Todo List</h2>
        <form method="post"  class="input_form">
            <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
            <?php } ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="task" class="task_input" value="<?php echo $task; ?>">

            <?php if ($update == true): ?>
            <button class="btn" type="submit" name="update" style="background: #fff; border: #17A2B8 3px solid; color: #17A2B8">Update</button>
            <?php else: ?>
            <button type="submit" name="save" id="add_btn" class="add_btn btn btn-info">Save</button>
            <?php endif ?>
        </form>
        <table>
            <thead>
                <tr>
                    <th class="task_num">N</th>
                    <th>Tasks</th>
                    <th style="width: 60px;">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                // select all tasks if page is visited or refreshed
                $todolist = mysqli_query($db, "SELECT * FROM tasks");

               while ($row = mysqli_fetch_array($todolist)) { ?>
                    <tr>
                        <td class="task_num"> <?php echo $row['id'];?> </td>
                        <td class="task"> <?php echo $row['task']; ?> </td>
                        <td class="edit">
                            <a href="index.php?edit_task=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td class="delete"> 
                            <a  class="btn btn-danger" href="db.php?del_task=<?php echo $row['id'] ?>">Delete</a> 
                        </td>
                    </tr>
               <?php } ?>	
	        </tbody>
        </table>
    </div>
</body>
</html>