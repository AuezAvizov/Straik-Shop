<?php

// Проверяем, установлена ли сессия с электронной почтой администратора
if (!isset($_SESSION['admin_email'])) {
    // Если нет, перенаправляем на страницу входа
    echo "<script>window.open('login.php','_self')</script>";
} else {
    // Если сессия установлена, отображаем панель администратора

    ?>

    <!-- Навигационная панель -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <!-- Начало заголовка навигационной панели -->
        <div class="navbar-header">
            <!-- Кнопка переключения для мобильного отображения -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Переключить навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Бренд навигационной панели -->
            <a class="navbar-brand" href="index.php?dashboard">Панель администратора</a>
        </div>
        <!-- Конец заголовка навигационной панели -->

        <!-- Верхнее меню -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <!-- Выпадающее меню с именем администратора -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    <?php echo $admin_name; ?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <!-- Профиль администратора -->
                    <li>
                        <a href="index.php?user_profile=<?php echo $admin_id; ?>">
                            <i class="fa fa-fw fa-user"></i> Профиль
                        </a>
                    </li>
                    <!-- Продукты -->
                    <li>
                        <a href="index.php?view_products">
                            <i class="fa fa-fw fa-envelope"></i> Продукты
                            <span class="badge"><?php echo $count_products; ?></span>
                        </a>
                    </li>
                    <!-- Клиенты -->
                    <li>
                        <a href="index.php?view_customers">
                            <i class="fa fa-fw fa-gear"></i> Клиенты
                            <span class="badge"><?php echo $count_customers; ?></span>
                        </a>
                    </li>
                    <!-- Категории продуктов -->
                    <li>
                        <a href="index.php?view_p_cats">
                            <i class="fa fa-fw fa-gear"></i> Категории продуктов
                            <span class="badge"><?php echo $count_p_categories; ?></span>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <!-- Выход из системы -->
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-fw fa-power-off"></i> Выйти
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Конец верхнего меню -->

        <!-- Боковое меню -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <!-- Панель управления -->
                <li>
                    <a href="index.php?dashboard">
                        <i class="fa fa-fw fa-dashboard"></i> Панель управления
                    </a>
                </li>
                <!-- Продукты -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#products">
                        <i class="fa fa-fw fa-table"></i> Продукты
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="products" class="collapse">
                        <li>
                            <a href="index.php?insert_product"> Добавить продукт </a>
                        </li>
                        <li>
                            <a href="index.php?view_products"> Просмотреть продукты </a>
                        </li>
                    </ul>
                </li>
                <!-- Пакеты -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#bundles">
                        <i class="fa fa-fw fa-edit"></i> Пакеты
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="bundles" class="collapse">
                        <li>
                            <a href="index.php?insert_bundle"> Добавить пакет </a>
                        </li>
                        <li>
                            <a href="index.php?view_bundles"> Просмотреть пакеты </a>
                        </li>
                    </ul>
                </li>
                <!-- Отношения продуктов и пакетов -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#relations">
                        <i class="fa fa-fw fa-retweet"></i> Связи продуктов и пакетов
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="relations" class="collapse">
                        <li>
                            <a href="index.php?insert_rel"> Добавить связь </a>
                        </li>
                        <li>
                            <a href="index.php?view_rel"> Просмотреть связи </a>
                        </li>
                    </ul>
                </li>
                <!-- Производители -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#manufacturers">
                        <i class="fa fa-fw fa-briefcase"></i> Производители
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="manufacturers" class="collapse">
                        <li>
                            <a href="index.php?insert_manufacturer"> Добавить производителя </a>
                        </li>
                        <li>
                            <a href="index.php?view_manufacturers"> Просмотреть производителей </a>
                        </li>
                    </ul>
                </li>
                <!-- Категории продуктов -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#p_cat">
                        <i class="fa fa-fw fa-pencil"></i> Категории продуктов
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="p_cat" class="collapse">
                        <li>
                            <a href="index.php?insert_p_cat"> Добавить категорию продукта </a>
                        </li>
                        <li>
                            <a href="index.php?view_p_cats"> Просмотреть категории продуктов </a>
                        </li>
                    </ul>
                </li>
                <!-- Категории -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#cat">
                        <i class="fa fa-fw fa-arrows-v"></i> Категории
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="cat" class="collapse">
                        <li>
                            <a href="index.php?insert_cat"> Добавить категорию </a>
                        </li>
                        <li>
                            <a href="index.php?view_cats"> Просмотреть категории </a>
                        </li>
                    </ul>
                </li>
                <!-- Магазины -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#store">
                        <i class="fa fa-fw fa-briefcase"></i> Магазины
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="store" class="collapse">
                        <li>
                            <a href="index.php?insert_store"> Добавить магазин </a>
                        </li>
                        <li>
                            <a href="index.php?view_store"> Просмотреть магазины </a>
                        </li>
                    </ul>
                </li>
                <!-- Контакты -->
                <li>
                   
                    <ul id="contact_us" class="collapse">
                        <li>
                            <a href="index.php?edit_contact_us"> Редактировать контактную информацию </a>
                        </li>
                        <li>
                            <a href="index.php?insert_enquiry"> Добавить тип запроса </a>
                        </li>
                        <li>
                            <a href="index.php?view_enquiry"> Просмотреть типы запросов </a>
                        </li>
                    </ul>
                </li>
                <!-- О нас -->
                <li>
                    <a href="index.php?edit_about_us">
                        <i class="fa fa-fw fa-edit"></i> Редактировать страницу "О нас"
                    </a>
                </li>
                <!-- Купоны -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#coupons">
                        <i class="fa fa-fw fa-arrows-v"></i> Купоны
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="coupons" class="collapse">
                        <li>
                            <a href="index.php?insert_coupon"> Добавить купон </a>
                        </li>
                        <li>
                            <a href="index.php?view_coupons"> Просмотреть купоны </a>
                        </li>
                    </ul>
                </li>
                <!-- Условия -->
                <li>
                    <ul id="terms" class="collapse">
                        <li>
                            <a href="index.php?insert_term"> Добавить условия </a>
                        </li>
                        <li>
                            <a href="index.php?view_terms"> Просмотреть условия </a>
                        </li>
                    </ul>
                </li>
                <!-- Просмотр клиентов -->
                <li>
                    <a href="index.php?view_customers">
                        <i class="fa fa-fw fa-edit"></i> Просмотреть клиентов
                    </a>
                </li>
                <!-- Просмотр заказов -->
                <li>
                    <a href="index.php?view_orders">
                        <i class="fa fa-fw fa-list"></i> Просмотреть заказы
                    </a>
                </li>
                <!-- Просмотр платежей -->
                <li>
                    <a href="index.php?view_payments">
                        <i class="fa fa-fw fa-pencil"></i> Просмотреть платежи
                    </a>
                </li>
                <!-- Пользователи -->
                <li>
                    <a href="#" data-toggle="collapse" data-target="#users">
                        <i class="fa fa-fw fa-gear"></i> Пользователи
                        <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="users" class="collapse">
                        <li>
                            <a href="index.php?insert_user"> Добавить пользователя </a>
                        </li>
                        <li>
                            <a href="index.php?view_users"> Просмотреть пользователей </a>
                        </li>
                        <li>
                            <a href="index.php?user_profile=<?php echo $admin_id; ?>"> Редактировать профиль </a>
                        </li>
                    </ul>
                </li>
                <!-- Выход из системы -->
                <li>
                    <a href="logout.php">
                        <i class="fa fa-fw fa-power-off"></i> Выйти
                    </a>
                </li>
            </ul>
        </div>
        <!-- Конец бокового меню -->
    </nav>
    <!-- Конец навигационной панели -->

<?php } ?>
