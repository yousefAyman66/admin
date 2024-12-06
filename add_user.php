<?php
include_once('db.php');
$title = 'Add';
$name = "";
$email = "";
$phone = "";
$password = "";
$btn = 'save';
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $action = 'edit';
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $user = mysqli_query($con, $sql);
    if ($user) {
        $title = "Update";
        $current_user = $user->fetch_assoc();
        $name = $current_user['name'];
        $email = $current_user['email'];
        $phone = $current_user['phone'];
        $password = $current_user['password'];
        $btn = 'update';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Users_App</title>
</head>

<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="header">
                <div class="d-flex p-2 justify-content-between">
                    <h2 class="title"> <?php echo $title ?> user</h2>
                    <div>
                        <a href="index.php">
                            <i data-feather="corner-down-left" class="text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="form">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php echo $name; ?>"
                            placeholder="enter your name" name="name"
                            autocomplete="false">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo $email; ?>"
                            placeholder="enter your email" name="email"
                            autocomplete="false">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">phone number</label>
                        <input type="tel" class="form-control" value="<?php echo $phone; ?>"
                            placeholder="enter your phone number" name="phone"
                            autocomplete="false">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">password</label>
                        <input type="password" class="form-control" value="<?php echo $password; ?>"
                            placeholder="enter your password" name="password"
                            autocomplete="false">
                    </div>
                    <?php
                    if (isset($_GET['id'])) { ?>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <?php   }
                    ?>
                    <input type="submit" class="btn btn-primary" value="<?php echo $btn ?>" name="save">
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/icons.js"></script>

    <script>
        feather.replace();
    </script>
</body>

</html>