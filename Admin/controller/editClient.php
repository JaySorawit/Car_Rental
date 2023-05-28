<div class="container p-5">

    <h4 class="text-bold mb-4">Edit Client Detail</h4>
    <?php
    include('../../server.php');
    $ID = $_POST['record'];
    $qry = mysqli_query($con, "SELECT * FROM client WHERE client_id = '$ID'");
    $numberOfRow = mysqli_num_rows($qry);
    if ($numberOfRow > 0) {
        while ($row1 = mysqli_fetch_array($qry)) {
            $client_id = $row1["client_id"];
            $driving_license_no = $row1["driving_license_no"];
            $fname = $row1["fname"];
            $lname = $row1["lname"];
            $tel_no = $row1["tel_no"];
            ?>
            <form id="update-Items" onsubmit="updateClient()">
                <div class="form-group">
                    <input type="text" class="form-control" name="client_id" id="client_id" value="<?= $row1['client_id'] ?>" hidden>
                </div>
                <div class="form-group">
                    <label>Driving License Number:</label>
                    <input type="text" class="form-control" name="driving_license_no" id="driving_license_no" maxlength="30"  value="<?= $row1['driving_license_no'] ?>">
                </div>
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" class="form-control" name="fname" id="fname" maxlength="30"  value="<?= $row1['fname'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Last Name:</label>
                    <input type="text" class="form-control" name="lname" id="lname" maxlength="30"  value="<?= $row1['lname'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="text" class="form-control" name="tel_no" id="tel_no" maxlength="10"  value="<?= $row1['tel_no'] ?>" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" style="height:40px" class="btn btn-primary">Edit</button>
                </div>
                <?php
        }
    }
    ?>
    </form>


</div>