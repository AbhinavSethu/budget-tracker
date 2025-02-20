<?php
include("session.php");
$update = false;
$del = false;
$incomeamount = "";
$incomedate = date("Y-m-d");
$incomecategory = "";

if (isset($_POST['add'])) {
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $income_query = "INSERT INTO income (user_id, amount, date, category) VALUES ('$userid', '$incomeamount','$incomedate','$incomecategory')";
    mysqli_query($con, $income_query) or die("Something Went Wrong!");
    header('location: add_income.php');
}

if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $incomeamount = $_POST['incomeamount'];
    $incomedate = $_POST['incomedate'];
    $incomecategory = $_POST['incomecategory'];

    $sql = "UPDATE income SET amount='$incomeamount', date='$incomedate', category='$incomecategory' WHERE user_id='$userid' AND income_id='$id'";
    mysqli_query($con, $sql) or die("Error updating record");
    header('location: manage_income.php');
}

if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM income WHERE user_id='$userid' AND income_id='$id'";
    mysqli_query($con, $sql) or die("Error deleting record");
    header('location: manage_income.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['amount'];
        $incomedate = $n['date'];
        $incomecategory = $n['category'];
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $del = true;
    $record = mysqli_query($con, "SELECT * FROM income WHERE user_id='$userid' AND income_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $incomeamount = $n['amount'];
        $incomedate = $n['date'];
        $incomecategory = $n['category'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Income Manager - Dashboard</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/feather.min.js"></script>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <button class="toggler" type="button" id="menu-toggle"><span data-feather="menu"></span></button>
                <div class="col-md-12 text-center"><h3>Add Your Income</h3></div>
            </nav>
            <div class="container">
                <div class="row ">
                    <div class="col-md"></div>
                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Enter Amount</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" value="<?php echo $incomeamount; ?>" name="incomeamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Date</label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" value="<?php echo $incomedate; ?>" name="incomedate" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">Category</label>
                                <div class="col-md">
                                    <select class="form-control" name="incomecategory" required>
                                        <?php
                                        $categories_query = "SELECT * FROM income_categories";
                                        $categories_result = mysqli_query($con, $categories_query);
                                        while ($row = mysqli_fetch_assoc($categories_result)) {
                                            $category_name = $row['category_name'];
                                            $selected = ($category_name === $incomecategory) ? 'selected' : '';
                                            echo "<option value='$category_name' $selected>$category_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update) : ?>
                                        <button class="btn btn-warning btn-lg btn-block" type="submit" name="update">Update</button>
                                    <?php elseif ($del) : ?>
                                        <button class="btn btn-danger btn-lg btn-block" type="submit" name="delete">Delete</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-success btn-lg btn-block">Add Income</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        feather.replace();
    </script>
</body>
</html>
