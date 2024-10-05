<?php

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php', '_self')</script>";
} else {
?>

    <!-- Основная структура страницы -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Панель управления / Просмотр пользователей
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Просмотр пользователей
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Имя пользователя</th>
                                    <th>Email</th>
                                    <th>Фото</th>
                                    <th>Страна</th>
                                    <th>Должность</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $get_admin = "SELECT * FROM admins";
                                $run_admin = mysqli_query($con, $get_admin);

                                while ($row_admin = mysqli_fetch_array($run_admin)) {
                                    $admin_id = $row_admin['admin_id'];
                                    $admin_name = $row_admin['admin_name'];
                                    $admin_email = $row_admin['admin_email'];
                                    $admin_image = $row_admin['admin_image'];
                                    $admin_country = $row_admin['admin_country'];
                                    $admin_job = $row_admin['admin_job'];
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($admin_name); ?></td>
                                        <td><?php echo htmlspecialchars($admin_email); ?></td>
                                        <td><img src="admin_images/<?php echo htmlspecialchars($admin_image); ?>" width="60" height="60" alt="Фото администратора"></td>
                                        <td><?php echo htmlspecialchars($admin_country); ?></td>
                                        <td><?php echo htmlspecialchars($admin_job); ?></td>
                                        <td>
                                            <a href="index.php?user_delete=<?php echo $admin_id; ?>">
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
<?php } ?>