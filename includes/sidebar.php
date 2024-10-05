<?php
// Массив для хранения выбранных производителей
$aMan  = array();

// Массив для хранения выбранных категорий продуктов
$aPCat = array();

// Массив для хранения выбранных категорий
$aCat  = array();

/// Код производителей начинается ///

// Проверяем, что параметр 'man' передан и является массивом
if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {

    // Перебираем все значения параметра 'man'
    foreach ($_REQUEST['man'] as $sKey => $sVal) {
        // Если значение не равно 0, добавляем его в массив $aMan
        if ((int)$sVal != 0) {
            $aMan[(int)$sVal] = (int)$sVal;
        }
    }
}
/// Код производителей заканчивается ///

/// Код категорий продуктов начинается ///

// Проверяем, что параметр 'p_cat' передан и является массивом
if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {

    // Перебираем все значения параметра 'p_cat'
    foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {

        // Если значение не равно 0, добавляем его в массив $aPCat
        if ((int)$sVal != 0) {
            $aPCat[(int)$sVal] = (int)$sVal;
        }
    }
}

/// Код категорий продуктов заканчивается ///

/// Код категорий начинается ///

// Проверяем, что параметр 'cat' передан и является массивом
if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {

    // Перебираем все значения параметра 'cat'
    foreach ($_REQUEST['cat'] as $sKey => $sVal) {

        // Если значение не равно 0, добавляем его в массив $aCat
        if ((int)$sVal != 0) {
            $aCat[(int)$sVal] = (int)$sVal;
        }
    }
}

/// Код категорий заканчивается ///
?>

<div class="panel panel-default sidebar-menu"><!-- Панель бокового меню Starts -->

    <div class="panel-heading"><!-- Заголовок панели Starts -->
        <h3 class="panel-title"><!-- Заголовок панели Starts -->
            Производители
            <div class="pull-right"><!-- Кнопка скрытия/показа Starts -->
                <a href="#" style="color:black;">
                    <span class="nav-toggle hide-show">Скрыть</span>
                </a>
            </div><!-- Кнопка скрытия/показа Ends -->
        </h3><!-- Заголовок панели Ends -->
    </div><!-- Заголовок панели Ends -->

    <div class="panel-collapse collapse-data"><!-- Раскрытие панели Starts -->
        <div class="panel-body"><!-- Контент панели Starts -->
            <div class="input-group"><!-- Поле поиска Starts -->
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-manufacturer" placeholder="Фильтр производителей">
                <a class="input-group-addon"><i class="fa fa-search"></i></a>
            </div><!-- Поле поиска Ends -->
        </div><!-- Контент панели Ends -->

        <div class="panel-body scroll-menu"><!-- Меню с прокруткой Starts -->
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-manufacturer"><!-- Меню производителей Starts -->
                <?php
                // Получение производителей с 'manufacturer_top' = 'yes'
                $get_manfacturer = "select * from manufacturers where manufacturer_top='yes'";
                $run_manfacturer = mysqli_query($con, $get_manfacturer);

                while ($row_manfacturer = mysqli_fetch_array($run_manfacturer)) {

                    $manufacturer_id = $row_manfacturer['manufacturer_id'];
                    $manufacturer_title = $row_manfacturer['manufacturer_title'];
                    $manufacturer_image = $row_manfacturer['manufacturer_image'];

                    if ($manufacturer_image != "") {
                        $manufacturer_image = "<img src='admin_area/other_images/$manufacturer_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li style='background:#dddddd;' class='checkbox checkbox-primary'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечен ли производитель
                    if (isset($aMan[$manufacturer_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$manufacturer_id' name='manufacturer' class='get_manufacturer'>
                                <span>$manufacturer_image $manufacturer_title</span>
                            </label>
                        </a>
                    </li>";
                }

                // Получение производителей с 'manufacturer_top' = 'no'
                $get_manfacturer = "select * from manufacturers where manufacturer_top='no'";
                $run_manfacturer = mysqli_query($con, $get_manfacturer);

                while ($row_manfacturer = mysqli_fetch_array($run_manfacturer)) {

                    $manufacturer_id = $row_manfacturer['manufacturer_id'];
                    $manufacturer_title = $row_manfacturer['manufacturer_title'];
                    $manufacturer_image = $row_manfacturer['manufacturer_image'];

                    if ($manufacturer_image != "") {
                        $manufacturer_image = "<img src='admin_area/other_images/$manufacturer_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li class='checkbox checkbox-primary'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечен ли производитель
                    if (isset($aMan[$manufacturer_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$manufacturer_id' name='manufacturer' class='get_manufacturer'>
                                <span>$manufacturer_image $manufacturer_title</span>
                            </label>
                        </a>
                    </li>";
                }
                ?>
            </ul><!-- Меню производителей Ends -->
        </div><!-- Меню с прокруткой Ends -->
    </div><!-- Раскрытие панели Ends -->

    <div class="panel-footer text-center">
        <button type="submit" class="btn btn-primary">Применить фильтр</button>
    </div>
</div><!-- Панель бокового меню Ends -->

<div class="panel panel-default sidebar-menu"><!-- Панель бокового меню Starts -->

    <div class="panel-heading"><!-- Заголовок панели Starts -->
        <h3 class="panel-title"><!-- Заголовок панели Starts -->
            Категории продуктов
            <div class="pull-right"><!-- Кнопка скрытия/показа Starts -->
                <a href="#" style="color:black;">
                    <span class="nav-toggle hide-show">Скрыть</span>
                </a>
            </div><!-- Кнопка скрытия/показа Ends -->
        </h3><!-- Заголовок панели Ends -->
    </div><!-- Заголовок панели Ends -->

    <form method="GET" action="filtred_products.php"><!-- Форма Starts -->
    
    <div class="panel-collapse collapse-data"><!-- Раскрытие панели Starts -->
        <div class="panel-body"><!-- Контент панели Starts -->
            <div class="input-group"><!-- Поле поиска Starts -->
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-p-cats" placeholder="Фильтр категорий продуктов">
                <a class="input-group-addon"><i class="fa fa-search"></i></a>
            </div><!-- Поле поиска Ends -->
        </div><!-- Контент панели Ends -->

        <div class="panel-body scroll-menu"><!-- Меню с прокруткой Starts -->
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-p-cats"><!-- Меню категорий продуктов Starts -->
                <?php
                // Получение категорий продуктов с 'p_cat_top' = 'yes'
                $get_p_cats = "select * from product_categories where p_cat_top='yes'";
                $run_p_cats = mysqli_query($con, $get_p_cats);

                while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                    $p_cat_id = $row_p_cats['p_cat_id'];
                    $p_cat_title = $row_p_cats['p_cat_title'];
                    $p_cat_image = isset($row_p_cats['p_cat_image']) ? $row_p_cats['p_cat_image'] : '';

                    if ($p_cat_image != "") {
                        $p_cat_image = "<img src='admin_area/other_images/$p_cat_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li class='checkbox checkbox-primary' style='background:#dddddd;'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечена ли категория продукта
                    if (isset($aPCat[$p_cat_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$p_cat_id' name='p_cat[]' class='get_p_cat' id='p_cat'>
                                <span>$p_cat_image $p_cat_title</span>
                            </label>
                        </a>
                    </li>";
                }

                // Получение категорий продуктов с 'p_cat_top' = 'no'
                $get_p_cats = "select * from product_categories where p_cat_top='no'";
                $run_p_cats = mysqli_query($con, $get_p_cats);

                while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

                    $p_cat_id = $row_p_cats['p_cat_id'];
                    $p_cat_title = $row_p_cats['p_cat_title'];
                    $p_cat_image = isset($row_p_cats['p_cat_image']) ? $row_p_cats['p_cat_image'] : '';

                    if ($p_cat_image != "") {
                        $p_cat_image = "<img src='admin_area/other_images/$p_cat_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li class='checkbox checkbox-primary'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечена ли категория продукта
                    if (isset($aPCat[$p_cat_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$p_cat_id' name='p_cat[]' class='get_p_cat' id='p_cat'>
                                <span>$p_cat_image $p_cat_title</span>
                            </label>
                        </a>
                    </li>";
                }
                ?>
            </ul><!-- Меню категорий продуктов Ends -->
        </div><!-- Меню с прокруткой Ends -->

        <!-- Кнопка для фильтрации -->
        <div class="panel-footer text-center">
            <button type="submit" class="btn btn-primary">Применить фильтр</button>
        </div>

    </div><!-- Раскрытие панели Ends -->
    </form><!-- Форма Ends -->

</div><!-- Панель бокового меню Ends -->

<div class="panel panel-default sidebar-menu"><!-- Панель бокового меню Starts -->

    <div class="panel-heading"><!-- Заголовок панели Starts -->
        <h3 class="panel-title"><!-- Заголовок панели Starts -->
            Категории
            <div class="pull-right"><!-- Кнопка скрытия/показа Starts -->
                <a href="#" style="color:black;">
                    <span class="nav-toggle hide-show">Скрыть</span>
                </a>
            </div><!-- Кнопка скрытия/показа Ends -->
        </h3><!-- Заголовок панели Ends -->
    </div><!-- Заголовок панели Ends -->

    <div class="panel-collapse collapse-data"><!-- Раскрытие панели Starts -->
        <div class="panel-body"><!-- Контент панели Starts -->
            <div class="input-group"><!-- Поле поиска Starts -->
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-cats" placeholder="Фильтр категорий">
                <a class="input-group-addon"><i class="fa fa-search"></i></a>
            </div><!-- Поле поиска Ends -->
        </div><!-- Контент панели Ends -->

        <div class="panel-body scroll-menu"><!-- Меню с прокруткой Starts -->
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-cats"><!-- Меню категорий Starts -->
                <?php
                // Получение категорий с 'cat_top' = 'yes'
                $get_cat = "select * from categories where cat_top='yes'";
                $run_cat = mysqli_query($con, $get_cat);

                while ($row_cat = mysqli_fetch_array($run_cat)) {

                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $cat_image = isset($row_cat['cat_image']) ? $row_cat['cat_image'] : '';

                    if ($cat_image != "") {
                        $cat_image = "<img src='admin_area/other_images/$cat_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li class='checkbox checkbox-primary' style='background:#dddddd;'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечена ли категория
                    if (isset($aCat[$cat_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$cat_id' name='cat' class='get_cat' id='cat'>
                                <span>$cat_image $cat_title</span>
                            </label>
                        </a>
                    </li>";
                }

                // Получение категорий с 'cat_top' = 'no'
                $get_cat = "select * from categories where cat_top='no'";
                $run_cat = mysqli_query($con, $get_cat);

                while ($row_cat = mysqli_fetch_array($run_cat)) {

                    $cat_id = $row_cat['cat_id'];
                    $cat_title = $row_cat['cat_title'];
                    $cat_image = isset($row_cat['cat_image']) ? $row_cat['cat_image'] : '';

                    if ($cat_image != "") {
                        $cat_image = "<img src='admin_area/other_images/$cat_image' width='20px'>&nbsp;";
                    }

                    echo "
                    <li class='checkbox checkbox-primary'>
                        <a>
                            <label>
                                <input ";

                    // Проверяем, отмечена ли категория
                    if (isset($aCat[$cat_id])) {
                        echo "checked='checked'";
                    }

                    echo " type='checkbox' value='$cat_id' name='cat' class='get_cat' id='cat'>
                                <span>$cat_image $cat_title</span>
                            </label>
                        </a>
                    </li>";
                }
                ?>
            </ul><!-- Меню категорий Ends -->
        </div><!-- Меню с прокруткой Ends -->
    </div><!-- Раскрытие панели Ends -->

    <div class="panel-footer text-center">
        <button type="submit" class="btn btn-primary">Применить фильтр</button>
    </div>
</div><!-- Панель бокового меню Ends -->
