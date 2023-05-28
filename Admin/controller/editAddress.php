<div class="container p-5">

    <h4 class="text-bold mb-4">Edit Address Detail</h4>
    <?php
    include('../../server.php');
    $ID1 = $_POST['record1'];
    $ID2 = $_POST['record2'];
    $qry = mysqli_query($con, "SELECT * FROM address WHERE zipcode = '$ID1' AND district = '$ID2'");
    $numberOfRow = mysqli_num_rows($qry);
    if ($numberOfRow > 0) {
        while ($row1 = mysqli_fetch_array($qry)) {
            $zipcode = $row1["zipcode"];
            $district = $row1["district"];
            $province = $row1["province"];

            ?>
            <form id="update-Items" onsubmit="updateAddress()">
                <div class="form-group">
                    <label>Zipcode:</label>
                    <input type="text" class="form-control" name="zipcode" id="zipcode" maxlength="50"  value="<?= $row1['zipcode'] ?>" readonly required>
                </div>
                <div class="form-group">
                    <label>District:</label>
                    <input type="text" class="form-control" name="district" id="district" maxlength="50"  value="<?= $row1['district'] ?>" readonly required>
                </div>
                <div class="form-group">
                    <label>Province:</label>
                    <input type="text" class="form-control" name="province" id="province" maxlength="50"  value="<?= $row1['province'] ?>" required>
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