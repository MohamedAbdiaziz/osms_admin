<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a class="text-nowrap logo-text">
            <h1>OSMS</h1>
            <p>Online Optical Shop</p>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <!-- Home cap -->
            <li class="nav-small-cap">
              <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>" aria-expanded="false">
                <span>
                  <i class="fas fa-chart-bar"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <!-- End Home Cap -->

            <!-- Product & Stock cap -->
            <li class="nav-small-cap">
              <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Product & Stock</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>category.php" aria-expanded="false">
                <span>
                  <i class="fas fa-sitemap"></i>
                </span>
                <span class="hide-menu">Category</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>product.php" aria-expanded="false">
                <span>
                  <i class="fas fa-cube"></i>
                </span>
                <span class="hide-menu">Product</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>stock.php" aria-expanded="false">
                <span>
                  <i class="fas fa-boxes"></i>
                </span>
                <span class="hide-menu">Stock</span>
              </a>
            </li>
            <!-- End Product & Stock Cap -->

            <!-- Payment & Transaction cap -->
            <li class="nav-small-cap">
              <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Transaction</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>payment.php" aria-expanded="false">
                 <span>
                  <i class="fas fa-exchange-alt"></i>
                </span>
                <span class="hide-menu">Transactions</span>
              </a>
            </li>
            
            <!-- End Payment & Transaction Cap -->

            <!-- Order & Delivery cap -->
            <li class="nav-small-cap">
              <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Order & Delivery</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>order.php" aria-expanded="false">
                <span>
                  <i class="fas fa-shopping-cart"></i>
                </span>
                <span class="hide-menu">Manage Order</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="./index.html" aria-expanded="false">
                <span>
                  <i class="fas fa-truck"></i>
                </span>
                <span class="hide-menu">Delivery</span>
              </a>
            </li> -->
            <!-- End Order & Delivery Cap -->

            <?php if($_SESSION['admin_role'] === "Super Admin"){?>
              <!-- Customer & User cap -->
              <li class="nav-small-cap">
                <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Customer & User</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo $URL?>customer_management.php" aria-expanded="false">
                  <span>
                    <i class="fas fa-users"></i>
                  </span>
                  <span class="hide-menu">Manage Customer</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo $URL?>admin_management.php" aria-expanded="false">
                  <span>
                    <i class="fas fa-user"></i>
                  </span>
                  <span class="hide-menu">Manage User</span>
                </a>
              </li>
              <!-- End Customer & User Cap -->
            <?php }?>

            <!-- Report & Backup cap -->
            <li class="nav-small-cap">
              <i class="fas fa-ellipsis-h nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Report</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $URL?>inventory_report.php" aria-expanded="false">
                <span>
                  <i class="fas fa-file-invoice"></i>
                </span>
                <span class="hide-menu">Inventory Report</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="./index.html" aria-expanded="false">
                <span>
                  <i class="fas fa-history"></i>
                </span>
                <span class="hide-menu">History</span>
              </a>
            </li> -->
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="../backend/backup.php" aria-expanded="false">
                <span>
                  <i class="fas fa-database"></i>
                </span>
                <span class="hide-menu">Backup</span>
              </a>
            </li> -->
            <!-- End Report & Backup Cap -->
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>