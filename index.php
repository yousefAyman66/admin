<?php
include_once('db.php');
$action = false;
if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  if ($_POST['save'] == "save") {
    $save_sql = "INSERT INTO `users`(`name`, `email`, `phone`, `password`)
      VALUES ('$name', '$email', '$phone', '$password')";
  } else {
    $id = $_POST['id'];
    $save_sql = "UPDATE `users` SET `name`='$name', `email`='$email', `phone`='$phone', `password`='$password'
      WHERE id=$id";
  }

  $result_save = mysqli_query($con, $save_sql);
  if (!$result_save) {
    die(mysqli_error($con));
  } else {
    $action = isset($_POST['id']) ? "edit" : "add";
  }
}
if (isset($_GET['action']) && $_GET['action'] == 'del') {
  $id = $_GET['id'];
  $del_sql = "DELETE FROM users WHERE id=$id";
  $result_del = mysqli_query($con, $del_sql);
  if (!$del_sql) {
    die(mysqli_error($con));
  } else {
    $action = "del";
  }
}
$users_sql = "SELECT * FROM users";
$all_users = mysqli_query($con, $users_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/toastr.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Users_App</title>
</head>

<body>
  <div class="container">
    <div class="wrapper p-5 m-5">
      <div class="header">
        <div class=" d-flex p-2 justify-content-between mb-2">
          <h2 class="title">All users</h2>
          <div>
            <a href="add_user.php">
              <i class="text-white" data-feather="user-plus"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="table1">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ($user = $all_users->fetch_assoc()) { ?>
              <tr>
                <td> <?php echo $user['id'];  ?> </td>
                <td> <?php echo $user['name'];  ?> </td>
                <td> <?php echo $user['email'];  ?> </td>
                <td> <?php echo $user['phone'];  ?> </td>

                <td>
                  <div class="d-flex justify-content-between ">
                    <i onclick="confirm_delete(<?php echo $user['id']; ?>);" class="text-danger" data-feather="trash-2"></i>
                    <i onclick="edit(<?php echo $user['id']; ?>);" class="text-success" data-feather="edit"></i>
                  </div>
                </td>
              </tr>
            <?php }

            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/toastr.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/icons.js"></script>
  <script src="js/main.js"></script>

  <?php
  if ($action != false) {
    if ($action == 'add') {
  ?>
      <script>
        show_add()
      </script>
    <?php
    }
    if ($action == 'del') {
    ?>
      <script>
        show_del()
      </script>
    <?php
    }
    if ($action == 'edit') {
    ?>
      <script>
        show_update()
      </script>
  <?php
    }
  }
  ?>

  <script>
    feather.replace();
  </script>


</body>

</html>