<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "CarRental_DB");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT CASE 
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 18 AND 23 THEN '18-23'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 24 AND 29 THEN '24-29'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 30 AND 35 THEN '30-35'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 36 AND 41 THEN '36-41'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 42 AND 47 THEN '42-47'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 48 AND 53 THEN '48-53'
WHEN TIMESTAMPDIFF(YEAR, c.dateofbirth, CURDATE()) BETWEEN 54 AND 59 THEN '54-59'
ELSE '60+'
END AS Age_Group,
COUNT(r.rental_id) AS 'Number of Leases',
SUM(DATEDIFF(r.end_date, r.start_date) * ci.price_per_day) AS 'Revenue Generated from Leasing'
FROM client c
INNER JOIN rent_info r ON c.client_id = r.client_id
INNER JOIN car_info ci ON r.license_plate = ci.license_plate
GROUP BY Age_Group
ORDER BY FIELD(Age_Group, '18-23', '24-29', '30-35', '36-41', '42-47', '48-53', '54-59', '60+');";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../../css/admin.css">
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
                    <a href="../../AdminHome.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-orange elevation-4">

            <a href="../../AdminHome.php" class="brand-link">
                <i class="fa-solid fa-car-side fa-lg ml-3 mr-1"></i>
                <span class="brand-text font-weight-light">Car Rental</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/adminohm.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="d-block text-white">Admin OHM</span>
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
                                    <a href="../../AdminPage.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Client</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rent Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage3.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Car Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage4.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Brand Information</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage5.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Interested Car</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage6.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Address</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../admin/AdminPage7.php" class="nav-link">
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
                                    <a href="analysis.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="analysis2.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="analysis3.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Advanced Analysis Report 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="../../../Logout.php" class="nav-link">
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
                            <h3 class="ml-2 mb-3">Income and total leasing from each age group</h3>
                            <div class="table-responsive-md">
                                <table class="table table-striped table-bordered">
                                    <thead class="">
                                        <tr>
                                            <th>Age</th>
                                            <th>Number of Leases</th>
                                            <th>Revenue Generated from Leasing</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['Age_Group']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Number of Leases']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Revenue Generated from Leasing']; ?>
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

        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>