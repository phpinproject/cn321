<?php
include 'connection.php';
session_start();

if (empty($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
if (isset($_POST['edit'])) {
    $user = $_POST['user'];
    $get_user = $mysqli->query("SELECT * FROM users WHERE username = '$user'");
    $user_data = $get_user->fetch_assoc();
    $user_sql = "SELECT * FROM images WHERE user_id = " . $user_data["user_id"];
    $get_image = $mysqli->query($user_sql);
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $user_data['username'] ?>’s Profile Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?v3">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Folder Locked</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php?user<?php echo $_SESSION['username']; ?>">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="profile.php?user<?php echo $_SESSION['username']; ?>">Back to Profile</a>
                </li>
            </ul>
            <button class="btn btn-danger" type="submit" onclick="logout()">Log out</button>
        </div>
    </nav>
    <div class="container">
        <form method="POST" action="update-profile-action.php" enctype="multipart/form-data">
            <div class="col-md-10" style="margin: 50px auto 0 auto;">
                <h3>Update Profile Information</h3>
                <input type="hidden" name="username" value="<?php echo $user_data['username']; ?>">
                <input type="hidden" name="id" value="<?php echo $user_data['user_id']; ?>">

                <div class="form-group">
                    <label>Name:</label><br>
                    <input type="text" name="fullname" value="<?php echo $user_data['full_name'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>Age:</label><br>
                    <input type="text" name="age" value="<?php echo $user_data['age'] ?>" class="form-control"/>
                </div>
                
                <div class="form-group">
                    <label>Gender:</label><br>
                    <input type="text" name="gender" value="<?php echo $user_data['gender'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>Address:</label><br>
                    <input type="text" name="address" value="<?php echo $user_data['address'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>อาชีพ:</label><br>
                    <input type="text" name="test" value="<?php echo $user_data['test'] ?>" class="form-control"/>
                </div>

                <!--
                <div class="form-group">
                    <label>Image:</label><br>
                    <input type="file" name="image" id="fileToUpload">
                </div>
                -->

                <input type="submit" name="update_profile" value="Update Profile" class="btn btn-primary"/>
            </div>
        </form>
        <!--
        <br><br>

        <?php if ($get_image->num_rows > 0): ?>
            <table id="profile">
                <tr>
                    <th>Image</th>
                    <th>Image Name</th>
                    <th></th>
                </tr>
                <?php while ($row = $get_image->fetch_assoc()): ?>
                    <tr>
                        <td><img src="data:image/jpeg;base64,<?php echo base64_encode( $row['image'] ) ?>" class="img-fluid img-thumbnail" width="20%"/></td>
                        <td><?php echo $row['image_name'];?></td>
                        <td>
                            <form action="delete-image.php" method="POST">
                                <input type="hidden" name="username" value="<?php echo $user_data['username']; ?>">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
        -->
</div>

<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html> 