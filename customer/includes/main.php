<header class="page-header">
    <!-- topline -->
    <div class="page-header__topline">
      <div class="container clearfix">

        <div class="currency">
          <a class="currency__change" href="customer/my_account.php?my_orders">
            <?php
            if (!isset($_SESSION['customer_email'])) {
              echo "Welcome: Guest";
            } else {
              echo "Welcome: " . $_SESSION['customer_email'];
            }
            ?>
          </a>
        </div>

        <div class="basket">
          <a href="cart.php" class="btn btn--basket">
            <i class="fas fa-shopping-cart"></i>
            <?php items(); ?> items
          </a>
        </div>

        <ul class="login">
    <ul class="login__item">
        <?php
        if (!isset($_SESSION['customer_email'])) {
            echo '<a href="customer_register.php" class="login__link">Register</a>';
        } else {
            $current_page = basename($_SERVER['PHP_SELF']);
            
            if ($current_page == 'my_account.php') {
                echo '<span class="login__link">My Account</span>';
            } else {
                echo '<a href="my_account.php?my_orders" class="login__link">My Account</a>';
            }
        }
        ?>
    </li>
</ul>


          <li class="login__item">
            <?php
            if (!isset($_SESSION['customer_email'])) {
              echo '<a href="checkout.php" class="login__link">Sign In</a>';
            } else {
              echo '<a href="logout.php" class="login__link">Logout</a>';
            }
            ?>
          </li>
        </ul>

      </div>
    </div>
    <!-- bottomline -->
    <div class="page-header__bottomline">
      <div class="container clearfix">
        <div class="logo">
           <a class="logo__link" href="/military-shop/index.php">
            <img class="logo__img" src="https://banner2.cleanpng.com/20180718/qej/bd1007cf8a5991054b57359f8c59e7d8.webp" alt="Airsoft Store Logo" width="43" height="30">
          </a>
        </div>

        <nav class="main-nav">
          <ul class="categories">
            <li class="categories__item">
              <a class="categories__link" href="/military-shop/shop.php?category=weapons">
                Weapons
              </a>
            </li>
            <li class="categories__item">
              <a class="categories__link" href="/military-shop/shop.php?category=gear">
                Gear
              </a>
            </li>
            <li class="categories__item">
              <a class="categories__link" href="/military-shop/shop.php?category=accessories">
                Accessories
              </a>
            </li>
            <li class="categories__item">
              <a class="categories__link categories__link--active" href="shop.php">
                Shop
              </a>
            </li>

            <li class="categories__item">
              <a class="categories__link" href=customer/my_account.php?my_orders.php">
                My Account
                <i class="icon-down-open-1"></i>
              </a>
              <div class="dropdown dropdown--lookbook">
                <div class="clearfix">
                  <div class="dropdown__half">
                    <div class="dropdown__heading">Account Settings</div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="my_wishlist.php" class="dropdown__link">My Wishlist</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="my_orders.php" class="dropdown__link">My Orders</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="cart.php" class="dropdown__link">View Shopping Cart</a>
                      </li>
                    </ul>
                  </div>
                  <div class="dropdown__half">
                    <div class="dropdown__heading"></div>
                    <ul class="dropdown__items">
                      <li class="dropdown__item">
                        <a href="edit_account.php" class="dropdown__link">Edit Your Account</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="change_pass.php" class="dropdown__link">Change Password</a>
                      </li>
                      <li class="dropdown__item">
                        <a href="delete_account.php" class="dropdown__link">Delete Account</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>