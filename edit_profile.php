<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// error_reporting(E_ERROR | E_PARSE);

require("../../connection/db_connect.php");
$user = $_SESSION['user'];
$uid = $user['usr_id'];
?>

<head>
    <meta charset="utf-8">
    <title>PARMAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="/parmas/assets/css/profile.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="my-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/parmas/index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                        </ol>
                    </nav>
                    <hr>
                </div>
                <form method="POST" action="#" class="file-upload" enctype="multipart/form-data">
                    <div class="row mb-5 gx-5">
                        <div class="col-xxl-4">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <div class="text-center">
                                        <div class="square position-relative display-2 mb-3">
                                            <img id="img_upld" src="/parmas/assets/img/profile/<?= $user['usr_profile'] ?>">
                                            <input type="file" id="pro_upld" name="pro_upld" style="display:none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Contact detail</h4>
                                    <div class="col-md-6">
                                        <label class="form-label">First Name </label> <label class="form-label error" id="f_error"></label>
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder=""
                                            aria-label="First name" value="<?= $user['usr_fname'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name </label> <label class="form-label error" id="s_error"></label>
                                        <input type="text" name="sname" id="sname" class="form-control" placeholder=""
                                            aria-label="Last name" value="<?= $user['usr_sname'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone number </label> <label class="form-label error" id="p_error"></label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder=""
                                            aria-label="Phone number" value="<?= $user['usr_phone'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email </label> <label class="form-label error" id="e_error"></label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder=""
                                            aria-label="Phone number" value="<?= $user['usr_email'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">House Name </label> <label class="form-label error" id="h_error"></label>
                                        <input type="text" name="hname" class="form-control" id="hname"
                                            value="<?= $user['usr_houseName'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Baptism Name </label> <label class="form-label error" id="bap_error"></label>
                                        <?php if ($user['usr_bapName'] == null) { ?>
                                            <input type="text" name="bap_name"" class="form-control" id="bap_name"
                                                required>
                                        <?php } else { ?>
                                            <input type="text" name="bap_name" id="bap_name" class="form-control"
                                                value="<?= $user['usr_bapName'] ?>" required>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Ward </label> <label class="form-label error" id="ward_error"></label>
                                        <?php if ($user['usr_ward'] == null) { ?>
                                            <input type="text" name="usr_ward" id="usr_ward" class="form-control"
                                                required>
                                        <?php } else { ?>
                                            <input type="text" name="usr_ward" id="usr_ward" class="form-control"
                                                value="<?= $user['usr_ward'] ?>" required>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label text-light">Ward</label>
                                        <span class="form-control" style="display:none">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label text-light">w</label>
                                        <input type="submit" name="update" id="Update" class="form-control btn-primary"
                                            value="Update">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label text-light">w</label>
                                        <a href="./profile.php" class="form-control btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            </form>
        </div>
    </div>
    </div>
    <?php
    if (isset($_POST['update'])) {
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $hname = $_POST['hname'];
        $bap_name = $_POST['bap_name'];
        $ward = $_POST['usr_ward'];
        $files = $_FILES['pro_upld']['name'];
        if ($fname != null && $sname != null && $phone != null && $email != null && $hname != null && $bap_name != null && $ward != null &&$files !=null) {
            $sql = "UPDATE `tbl_register` SET `usr_fname`='$fname',`usr_sname`=' $sname',`usr_email`='$email',`usr_phone`='$phone',`usr_bapName`='$bap_name',`usr_ward`='$ward' ,`usr_houseName`='$hname' ,`usr_profile`='$files' WHERE `usr_id`= $uid";
            mysqli_query($con, $sql);
            $targetdir = "../../assets/img/profile/";
            $file_path = $targetdir .$files;
            move_uploaded_file($_FILES['pro_upld']['tmp_name'], $file_path);
        }
        $sql = "SELECT * FROM `tbl_register` WHERE `usr_id` = $uid";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $_SESSION['user'] = $row;
        $url = "profile.php";
        echo ("<script>location.href='$url'</script>");

    }
    ?>
</body>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/parmas/assets/js/edit_profile.js"></script>
<script>

    document.getElementById('img_upld').addEventListener('click', () => {
        document.getElementById('pro_upld').click()
    })
</script>

</html>