<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Панель управления / Просмотр типов запросов
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Просмотр типов запросов
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название типа запроса</th>
                            <th>Удалить</th>
                            <th>Редактировать</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $get_enquiry_types = "SELECT * FROM enquiry_types";
                        $run_enquiry_types = mysqli_query($con, $get_enquiry_types);
                        while ($row_enquiry_types = mysqli_fetch_array($run_enquiry_types)) {
                            $enquiry_id = $row_enquiry_types['enquiry_id'];
                            $enquiry_title = $row_enquiry_types['enquiry_title'];
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $enquiry_title; ?></td>
                            <td>
                                <a href="index.php?delete_enquiry=<?php echo $enquiry_id; ?>">
                                    <i class="fa fa-trash-o"></i> Удалить
                                </a>
                            </td>
                            <td>
                                <a href="index.php?edit_enquiry=<?php echo $enquiry_id; ?>">
                                    <i class="fa fa-pencil"></i> Редактировать
                                </a>
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
<?php } ?>