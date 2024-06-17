<?php 
include_once("../component/headerhtml.php");
include_once("../component/sidebar.php");
require_once("../classes/order.class.php");

// Fetch all orders
$objOrder = new Order();
$orders = $objOrder->getAllOrders();
?>

<div class="body-wrapper">
  <!-- Navbar Start -->
  <?php include_once("../component/navbar.php");

  if (isset($_SESSION['Action'])) {
    echo $_SESSION['Action'];
    unset($_SESSION['Action']);
  }
  ?>
  <!-- Navbar end -->

  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Orders</h3>
      </div>
      <div class="card-body">
        <table id="table-id" class="table table-striped table-class" style="width:100%">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Transaction</th>
              <th>Order Date</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($orders)): ?>
              <?php foreach($orders as $order): ?>
                <tr>
                  <td><?php echo $order['ID']; ?></td>
                  <td><?php echo $order['Customer']; ?></td>
                  <td><?php echo $order['Transaction']; ?></td>
                  <td><?php echo $order['Order_Date']; ?></td>
                  <td><?php echo $order['Total_Amount']; ?></td>
                  <td><span class="badge rounded-3 fw-semibold <?php if($order['Status'] == "Delivered"){echo 'bg-success';}elseif($order['Status']=="Pending"){echo 'bg-info';}else{echo 'bg-danger';} ?>"><?php echo $order['Status']; ?></span></td>
                  <td>
                    <button class="btn btn-dark view-items-btn" data-order-id="<?php echo $order['ID']; ?>">View Items</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#OrderEdit<?php echo $order['ID']; ?>">Edit</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#OrderDelete<?php echo $order['ID']; ?>">Delete</button>
                  </td>

                  <!-- Modal Edit Order -->
                  <div class="modal fade" id="OrderEdit<?php echo $order['ID']; ?>" tabindex="-1" aria-labelledby="OrderEditLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="OrderEditLabel">Update Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="../backend/action.php">
                            <div class="mb-3">
                              <label for="OrderStatus" class="form-label">Status</label>
                              <input type="hidden" name="order_id" value="<?php echo $order['ID']; ?>">
                              <select class="form-control" name="OrderStatus" id="OrderStatus" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="Pending" <?php if($order['Status']=="Pending"): echo "selected"; endif;?>>Pending</option>
                                <option value="Delivered" <?php if($order['Status']=="Delivered"): echo "selected"; endif;?>>Delivered</option>
                                <option value="Failed" <?php if($order['Status']=="Failed"): echo "selected"; endif;?>>Failed</option>
                              </select>
                            </div>
                            <button type="submit" name="updateOrderStatus" class="btn btn-primary">Submit</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Delete Order -->
                  <div class="modal fade" id="OrderDelete<?php echo $order['ID']; ?>" tabindex="-1" aria-labelledby="OrderDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="OrderDeleteLabel">Delete Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="../backend/action.php" method="post">
                            <div class="mb-3">
                              <label class="form-label">Are you sure you want to delete this order?</label>
                            </div>
                            <input type="hidden" name="order_id" value="<?php echo $order['ID']; ?>">
                            <button type="submit" name="deleteOrder" class="btn btn-primary">Yes</button>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center">No orders found</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Transaction</th>
              <th>Order Date</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <!-- Footer start -->
    <?php include_once("../component/footer.php");?>
    <!-- Footer end -->
  </div>
</div>

<!-- Modal View Order Items -->
<div class="modal fade" id="OrderItemsModal" tabindex="-1" aria-labelledby="OrderItemsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="OrderItemsModalLabel">Order Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Product ID</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody id="order-items-tbody">
            <!-- Order items will be appended here via AJAX -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery and DataTables library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#table-id').DataTable({
        "pagingType": "full_numbers",
        "language": {
          "paginate": {
            "first": "&laquo;",
            "last": "&raquo;",
            "previous": "&lsaquo;",
            "next": "&rsaquo;"
          }
        },
        "order": [[5, 'desc'], [3, 'asc']], // Order by Status and then by Order Date
        "rowGroup": {
            "dataSrc": 'status'
        },
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;

            api.column(5, { page: 'current' }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="7">' + group + '</td></tr>'
                    );
                    last = group;
                }
            });
        }
    });

    // AJAX to load order items when the "View Items" button is clicked
    $('.view-items-btn').on('click', function() {
        var orderId = $(this).data('order-id');
        $.ajax({
            url: './get_order_items.php',
            method: 'GET',
            data: { order_id: orderId },
            success: function(response) {
                $('#order-items-tbody').html(response);
                $('#OrderItemsModal').modal('show');
            }
        });
    });
});
</script>

<?php include_once("../component/footerhtml.php");?>
