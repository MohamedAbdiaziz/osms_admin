<?php $title = "Dashboard" ?>
<?php include_once("../component/headerhtml.php");?>

    <!-- Sidebar Start -->
    <?php include_once("../component/sidebar.php");?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include_once("../component/navbar.php");?>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">   
        <?php

            $objProduct = new product();
            $CurrentYearAmount = $objProduct->CurrentYearAmount();
            $CurrentMonthAmount = $objProduct->CurrentMonthAmount();
          ?>     
          <?php if($_SESSION['admin_role'] === "Super Admin"){?>
            <div class="col-lg-8 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Sales Overview</h5>
                    </div>
                    
                  </div>
                  <canvas id="mychart"></canvas>
                </div>
              </div>
            </div>
          
            <div class="col-lg-4">
              <div class="row">
                <div class="col-lg-12">
                  <!-- Yearly Breakup -->
                  <div class="card overflow-hidden">
                    <div class="card-body p-4">
                      <h5 class="card-title mb-9 fw-semibold">Yearly Breakup</h5>
                      <div class="row align-items-center">
                        <div class="col-8">
                          <h4 class="fw-semibold mb-3">$<?php echo $CurrentYearAmount['Current_year_amount'];?></h4>
                          <div class="d-flex align-items-center mb-3">
                            <?php
                            if($CurrentYearAmount['percentage'] > '50'){
                            ?>
                            <span
                              class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                              <i class="ti ti-arrow-up-left text-success"></i>
                            </span>
                          <?php }
                          else{
                          ?>
                            <span
                              class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                              <i class="ti ti-arrow-down-left text-danger"></i>
                            </span>
                          <?php } ?>
                            <p class="text-dark me-1 fs-3 mb-0">+<?php echo $CurrentYearAmount['percentage'] ;?>%</p>
                            <p class="fs-3 mb-0">last year</p>
                          </div>
                          <div class="d-flex align-items-center">
                            <div class="me-4">
                              <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                              <span class="fs-2"><?php echo  date('Y') - 1;?></span>
                            </div>
                            <div>
                              <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                              <span class="fs-2"><?php echo  date('Y');?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="d-flex justify-content-center">
                            <div id="breakup"></div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <!-- Monthly Earnings -->
                  <div class="card">
                    <div class="card-body">
                      <div class="row alig n-items-start">
                        <div class="col-8">
                          <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                          <h4 class="fw-semibold mb-3">$<?php echo $CurrentMonthAmount['Current_month_amount'];?></h4>
                          <div class="d-flex align-items-center pb-1">
                            <?php
                            if($CurrentMonthAmount['percentage'] > '50'){
                            ?>
                            <span
                              class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                              <i class="ti ti-arrow-up-left text-success"></i>
                            </span>
                          <?php }
                          else{
                          ?>
                            <span
                              class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                              <i class="ti ti-arrow-down-left text-danger"></i>
                            </span>
                          <?php } ?>
                            <p class="text-dark me-1 fs-3 mb-0">+<?php echo $CurrentMonthAmount['percentage'];?>%</p>
                            <p class="fs-3 mb-0">last month</p>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="d-flex justify-content-end">
                            <div
                              class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                              <i class="ti ti-currency-dollar fs-6"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="earning"></div>
                  </div>
                </div>
              </div>
            </div>
        <?php }else{?>
            <div class="col-lg-12 d-flex align-items-strech">
              <div class="card w-100">
                <div class="card-body">
                  <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                      <h5 class="card-title fw-semibold">Sales Overview</h5>
                    </div>
                    
                  </div>
                  <canvas id="mychart"></canvas>
                </div>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="row">        
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Transactions</h5>
                <!-- <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Assigned</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Priority</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Budget</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                            <span class="fw-normal">Web Designer</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Elite Admin</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-3 fw-semibold">Low</span>
                          </div>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$3.9</h6>
                        </td>
                      </tr> 
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">2</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Andrew McDownland</h6>
                            <span class="fw-normal">Project Manager</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Real Homes WP Theme</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-secondary rounded-3 fw-semibold">Medium</span>
                          </div>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$24.5k</h6>
                        </td>
                      </tr> 
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">3</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Christopher Jamil</h6>
                            <span class="fw-normal">Project Manager</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">MedicalPro WP Theme</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-danger rounded-3 fw-semibold">High</span>
                          </div>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$12.8k</h6>
                        </td>
                      </tr>      
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">4</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                            <span class="fw-normal">Frontend Engineer</span>                          
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">Hosting Press HTML</p>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success rounded-3 fw-semibold">Critical</span>
                          </div>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">$2.4k</h6>
                        </td>
                      </tr>                       
                    </tbody>
                  </table>
                </div> -->
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Customer ID</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0"><span class="fw-normal">Stripe Session ID</span></h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Amount</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Created At</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Status</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php 
                                $transaction = $objProduct->TransactionRecent();
                                foreach($transaction AS $row){ ?>
                                    <tr>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="fw-normal"><?php echo htmlspecialchars($row['id']); ?></h6></span></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="fw-normal"><?php echo htmlspecialchars($row['customer_id']); ?></span></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="fw-normal"><?php echo htmlspecialchars(substr($row['stripe_session_id'],0,10)."***"); ?></span></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="fw-normal">$<?php echo number_format($row['amount'], 2); ?></span></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="fw-normal"><?php echo htmlspecialchars($row['created_at']); ?></span></h6></td>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0"><span class="badge <?php if($row['status'] == "completed"){echo 'bg-success';}else{echo "bg-danger";}?> rounded-3 fw-semibold"><?php echo htmlspecialchars($row['status']); ?></span></h6></td>
                                    </tr> 
                                <?php } 
                                  if(empty($row)){ ?>
                                    <tr>
                                      <td colspan="6" class="text-center">No transactions found.</td>
                                    </tr>
                                  <?php } ?>
                            
                                
                            
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>        
        <?php include_once("../component/footer.php");?>
      </div>
    </div>

<?php include_once("../component/footerhtml.php");?>