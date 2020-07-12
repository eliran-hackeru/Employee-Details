<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Employee Details</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>
        
        <?php
        
        if (isset($_SESSION['message'])): ?>
        
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
             
             <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
             ?>
        </div>
        <?php endif ?>
        <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', 'root', 'employees') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
            //pre_r($result);
        ?>
        
        <div class="row justify-content-center">
            <h1>Employee Details</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <?php
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td id="colName"><?php echo $row['name']; ?></td>
                            <td id="colEmail"><?php echo $row['email']; ?></td>
                            <td id="colPhone"><?php echo $row['phone']; ?></td>
                            <td>
                                <a id="colEdit" href="index.php?edit=<?php echo $row['id']; ?>"
                                   class="btn btn-info">Edit</a>
                                <a id="colDelete" href="process.php?delete=<?php echo $row['id']; ?>"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
            </table>
        </div>
        <?php                
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <h2>Add or Update Employee</h2>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Name</label>
            <input id="name" type="text" name="name" class="form-control"
                   value="<?php echo $name; ?>" placeholder="Enter full name">
            </div>
            <div class="form-group">
            <label>Email Address</label>
            <input id="email" type="text" name="email" class="form-control"
                   value="<?php echo $email; ?>" placeholder="Enter email address">
            </div>
            <div class="form-group">
            <label>Phone</label>
            <input id="phone" type="text" name="phone" class="form-control"
                   value="<?php echo $phone; ?>"placeholder="Enter phone number">
            </div>
            <div class="form-group">
            <?php
            if ($update == true):
            ?>
                <button id="update" type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button id="save" type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        </div>     
    </body>
</html>