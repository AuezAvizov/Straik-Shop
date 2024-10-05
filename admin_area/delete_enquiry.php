<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

    if (isset($_GET['delete_enquiry'])) {
        $delete_id = $_GET['delete_enquiry'];

        $delete_enquiry = "DELETE FROM enquiry_types WHERE enquiry_id='$delete_id'";

        $run_delete = mysqli_query($con, $delete_enquiry);
        if ($run_delete) {
            echo "<script>alert('Один тип запроса был удален')</script>";
            echo "<script>window.open('index.php?view_enquiry','_self')</script>";
        }
    }
}
?>