<?php
session_start();
include('../server.php');
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../index.php");
}

$sql = "SELECT * FROM client";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/b33e8d6cbf.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="AdminHome.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-orange elevation-4">

            <a href="AdminHome.php" class="brand-link">
                <i class="fa-solid fa-car-side fa-lg ml-3 mr-1"></i>
                <span class="brand-text font-weight-light">Car Rental</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="d-block text-white">Admin</span>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Databases
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="AdminPage.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Client</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rent Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage3.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Car Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage4.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Brand Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage5.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Interested Car</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage6.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Address</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/admin/AdminPage7.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Credit card Client</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Advanced Analysis Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/analysis/analysis.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/analysis/analysis2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/analysis/analysis3.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="../Logout.php" class="nav-link">
                                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="mb-2">
                        <div>
                            <h3 class="ml-2 mb-3">Client Table</h3>
                            <button type="button" class="btn btn-secondary ml-2 mb-2" style="height: 40px; width: 80px"
                                data-toggle="modal" data-target="#myModal">
                                Add
                            </button>

                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">New Client</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="controller/addClient.php" method="POST">
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="text" class="form-control" name="email" maxlength="30"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="text" class="form-control" name="password"
                                                        maxlength="20" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="firstname">First Name:</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        maxlength="30" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">Last Name:</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        maxlength="30" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone Number:</label>
                                                    <input type="text" class="form-control" name="phone" maxlength="10"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mr-2">Gender: &nbsp;</label>
                                                    <input type="radio" name="gender" value="male" required> Male
                                                    <span class="mr-3"></span>
                                                    <input type="radio" name="gender" value="female"> Female
                                                </div>
                                                <div class="form-group">
                                                    <label class="mr-1" for="day">Day:</label>
                                                    <select class="mr-3" id="day" name="day">
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <label class="mr-1" for="month">Month:</label>
                                                    <select class="mr-3" id="month" name="month">
                                                        <?php
                                                        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                                        foreach ($months as $month) {
                                                            echo "<option value='$month'>$month</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="year">Year:</label>
                                                    <select id="year" name="year">
                                                        <?php
                                                        $current_year = date("Y");
                                                        for ($i = $current_year; $i >= $current_year - 100; $i--) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="mr-2" style="width: 120px;">Interested Car:
                                                        &nbsp;</label>
                                                    <input type="checkbox" name="interestedcar[Sedan]" value="Sedan">
                                                    Sedan
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[Van]" value="Van"> Van
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[PPV]" value="PPV"> PPV
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[SUV]" value="SUV"> SUV
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[Pickup]" value="Pickup">
                                                    Pickup
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[MPV]" value="MPV"> MPV
                                                    <span class="mr-2"></span>
                                                    <input type="checkbox" name="interestedcar[Hatchback]"
                                                        value="Hatchback"> Hatchback
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-secondary" name="upload"
                                                        style="height:40px">Add</button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                                style="height:40px">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive-md">
                                <table class="table table-striped table-bordered">
                                    <thead class="">
                                        <tr>
                                            <th class="text-center" colspan="2">Action</th>
                                            <th>Client ID</th>
                                            <th>Driving License Number</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Phone Number</th>
                                            <th>Lessor state (0=False, 1=True)</th>
                                            <th>Banking Account</th>
                                            <th>Bank Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><button class="btn btn-primary" style="height:40px"
                                                        onclick="clientEditForm('<?= $row['client_id'] ?>')">Edit</button>
                                                </td>
                                                <td><button class="btn btn-danger" style="height:40px"
                                                        onclick="clientDelete('<?= $row['client_id'] ?>')">Delete</button>
                                                </td>

                                                <td>
                                                    <?php echo $row['client_id']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['driving_license_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['fname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['dateofbirth']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['gender']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['password']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['tel_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['lessor_state']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['banking_account']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['bank_name']; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['error'])) { ?>
            <div>
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['success'])) { ?>
            <div>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>
        <script src="dist/js/admincontroll.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>