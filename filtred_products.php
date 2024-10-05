<?php
$con = mysqli_connect("localhost", "root", "", "airsoft_store");

$where = array();

if (!empty($aMan)) {
    $where[] = "manufacturer_id IN (" . implode(',', $aMan) . ")";
}

if (!empty($aPCat)) {
    $where[] = "p_cat_id IN (" . implode(',', $aPCat) . ")";
}

if (!empty($aCat)) {
    $where[] = "cat_id IN (" . implode(',', $aCat) . ")";
}

$sql = "SELECT * FROM products";
if (!empty($where)) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$run_products = mysqli_query($con, $sql);

if (mysqli_num_rows($run_products) > 0) {
    echo '<div class="container">'; 
    echo '<div class="row">'; 

    $counter = 0; 

    while ($row_products = mysqli_fetch_array($run_products)) {
        $product_title = $row_products['product_title'];
        $product_price = $row_products['product_price'];
        $product_img1 = $row_products['product_img1'];
        $product_url = $row_products['product_url'];
        $product_psp_price = $row_products['product_psp_price'];
        $product_label = $row_products['product_label'];

        // Определяем, отображать ли скидку
        if (!empty($product_psp_price) && $product_psp_price < $product_price) {
            $product_price_display = "<del>$$product_price</del> $$product_psp_price";
        } else {
            $product_price_display = "$$product_price";
        }

        $label_display = '';
        if (!empty($product_label)) {
            $label_display = "<span class='label label-success'>$product_label</span>";
        }

        echo "
            <div class='col-md-4 col-sm-6'>
                <div class='product'>
                    <a href='$product_url'>
                        <img src='admin_area/product_images/$product_img1' class='img-responsive' alt='$product_title'>
                    </a>
                    <div class='text'>
                        <h3><a href='$product_url'>$product_title</a></h3>
                        <p class='price'>$product_price_display</p>
                        <p class='button'>
                            <a href='$product_url' class='btn btn-default'>View Details</a>
                            <a href='$product_url' class='btn btn-primary'>
                                <i class='fa fa-shopping-cart'></i> Add to Cart
                            </a>
                        </p>
                        $label_display
                    </div>
                </div>
            </div>
        ";

        $counter++;

        if ($counter % 3 == 0) {
            echo '</div><div class="row">';
        }
    }

    echo '</div>'; 
    echo '</div>'; 
} else {
    echo "<p>No products found matching your criteria.</p>";
}
?>
