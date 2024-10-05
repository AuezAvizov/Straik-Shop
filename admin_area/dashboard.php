<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Панель управления
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_products; ?></div>
                        <div>Продукты</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_products">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_customers; ?></div>
                        <div>Клиенты</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_customers">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_p_categories; ?></div>
                        <div>Категории продуктов</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_p_cats">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_total_orders; ?></div>
                        <div>Заказы</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_orders">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-dollar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_total_earnings; ?></div>
                        <div>Доход</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_orders">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-spinner fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_pending_orders; ?></div>
                        <div>Ожидающие заказы</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_orders">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_completed_orders; ?></div>
                        <div>Завершённые заказы</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_orders">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-percent fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_coupons; ?></div>
                        <div>Всего купонов</div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_orders">
                <div class="panel-footer">
                    <span class="pull-left">Посмотреть детали</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Новые заказы
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Номер заказа</th>
                                <th>Покупатель</th>
                                <th>Номер счёта</th>
                                <th>ID продукта</th>
                                <th>Количество</th>
                                <th>Размер</th>
                                <th>Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $get_order = "SELECT * FROM pending_orders ORDER BY 1 DESC LIMIT 0,5";
                            $run_order = mysqli_query($con, $get_order);
                            while ($row_order = mysqli_fetch_array($run_order)) {
                                $order_id = $row_order['order_id'];
                                $c_id = $row_order['customer_id'];
                                $invoice_no = $row_order['invoice_no'];
                                $product_id = $row_order['product_id'];
                                $qty = $row_order['qty'];
                                $size = $row_order['size'];
                                $order_status = $row_order['order_status'];
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php
                                    $get_customer = "SELECT * FROM customers WHERE customer_id='$c_id'";
                                    $run_customer = mysqli_query($con, $get_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    $customer_email = $row_customer['customer_email'];
                                    echo $customer_email;
                                    ?>
                                </td>
                                <td><?php echo $invoice_no; ?></td>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $size; ?></td>
                                <td>
                                    <?php
                                    if ($order_status == 'pending') {
                                        echo 'ожидается';
                                    } else {
                                        echo 'завершено';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?view_orders">
                        Посмотреть все заказы <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
