<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg bg-info">
    <div class="container my-5">
        <h2>List of clients</h2>
        <a class="btn btn-primary"  href="/myshop/create.php">New Client</a>
        <br>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php
            @include("connect.php");

            //check connection
            if($connection->connect_error){
                die("connection failed: ". $connection->connect_error);
            }

            //read all row from database table
            $sql = "SELECT *FROM clients";
            $result = $connection->query(($sql));

            //check if the query has been excuted or not
            if($result){
                echo"connected successfully";
            }
            else{
                echo"connection failed";
            }

            //read data of each row
            while($row = $result->fetch_assoc()){
                echo"
                <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a class='btn btn-primary btn-sm ' href='/myshop/edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm ' href='/myshop/delete.php?id=$row[id]'>Delete</a>
                </td>    
            </tr>
                ";
            }


            ?>
           


        </table>

    </div>
    
</body>
</html>