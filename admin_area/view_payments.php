<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Панель управления / Просмотр платежей
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Просмотр платежей
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Номер счета</th>
                            <th>Сумма оплаты</th>
                            <th>Метод оплаты</th>
                            <th>Номер ссылки</th>
                            <th>Код оплаты</th>
                            <th>Дата оплаты</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $i = 0;
                        $get_payments = "SELECT * FROM payments";
                        $run_payments = mysqli_query($con, $get_payments);

                        while ($row_payments = mysqli_fetch_array($run_payments)) {

                            $payment_id = $row_payments['payment_id'];
                            $invoice_no = $row_payments['invoice_no'];
                            $amount = $row_payments['amount'];
                            $payment_mode = $row_payments['payment_mode'];
                            $ref_no = $row_payments['ref_no'];
                            $code = $row_payments['code'];
                            $payment_date = $row_payments['payment_date'];

                            $i++;

                        ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td bgcolor="yellow"><?php echo $invoice_no; ?></td>
                            <td>$<?php echo $amount; ?></td>
                            <td><?php echo $payment_mode; ?></td>
                            <td><?php echo $ref_no; ?></td>
                            <td><?php echo $code; ?></td>
                            <td><?php echo $payment_date; ?></td>
                            <td>
                                <a href="index.php?payment_delete=<?php echo $payment_id; ?>">
                                    <i class="fa fa-trash-o"></i> Удалить
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

<?php

if (isset($_GET['payment_delete'])) {
    $delete_id = $_GET['payment_delete'];
    $delete_payment = "DELETE FROM payments WHERE payment_id='$delete_id'";
    $run_delete = mysqli_query($con, $delete_payment);

    if ($run_delete) {
        echo "<script>alert('Один платеж был удален')</script>";
        echo "<script>window.open('index.php?view_payments','_self')</script>";
    }
}
?>

<?php } ?>
