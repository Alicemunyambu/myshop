<?php
@include("connect.php");

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']== 'GET'){
    //GET method: Show the data of the client

    if(isset($_GET["id"])){
        header("location: /myshop/index.php");
        exit;
    }

    $id = $_GET["id"];

    //Read the row of the selected client from database table
    $sql = "SELECT *FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /myshop/index.php");
        exit;
    }

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

}
else{
    //POST method: update the data of the client
 
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        } 
         
        $sql = "UPDATE clients" .
        "SET name = '$name', email = '$email', phone = '$phone' address = '$address'".
        "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Ivalid query: " . $connect->error;
            break;
        }

        $successMessage = "Client added successfully";

        header("location: /myshop/index.php");
        exit;


    }while (true);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg bg-info">
    <div class="container my-5">
        <h2>New Client</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button
            </div>
            ";
        }

        ?>
        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>">
             <div class="row my-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>

                <div class="row my-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>

                    <div class="row my-3">
                        <label class="col-sm-3 col-form-label">phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                        </div>

                        <div class="row my-3">
                            <label class="col-sm-3 col-form-label">address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                            </div>
                            <?php
                            if (!empty($successMessage)) {
                                echo "
                            <div class='row my-3'>
                                <div class='offset-sm-3 col-sm-6'>
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                       <strong>$successMessage</strong>
                                       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                                    </div>
                                </div>
                            </div>
                                   ";
                            }
                            ?>

                            <div class="row my-3">
                                <div class="offset-sm-3 col-sm-3 d-grid">
                                    <button type="Submit" class="btn btn-primary">Submit</button>
                                </div>

                                <div class="col-sm-3 d-grid">
                                    <a class="btn btn-primary" href="/myshop/index.php" role="button">Cancel</a>
                                </div>

                            </div>
        </form>

    </div>

</body>

</html>