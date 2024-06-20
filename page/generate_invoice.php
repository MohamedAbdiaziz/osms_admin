
<?php
// generate_invoice.php
require_once("../classes/order.class.php");

function generateInvoiceHTML($order, $orderItems) {
    ob_start();
    ?>
    <html>
    <head>
        <style>
            /* Style for the print button */
            .print-button {
              display: inline-block;
              padding: 10px 20px;
              font-size: 16px;
              font-weight: bold;
              text-align: center;
              text-decoration: none;
              cursor: pointer;
              color: #fff;
              background-color: #007bff;
              border: 1px solid #007bff;
              border-radius: 5px;
              transition: background-color 0.3s, border-color 0.3s;
            }

            .print-button:hover,
            .print-button:focus {
              background-color: #0056b3;
              border-color: #0056b3;
            }

            .print-button:active {
              background-color: #004380;
              border-color: #004380;
            }
            /* Add your invoice CSS styles here */
            body { font-family: Arial, sans-serif; }
            .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
            .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
            .invoice-box table td { padding: 5px; vertical-align: top; }
            .invoice-box table tr td:nth-child(2) { text-align: right; }
            .invoice-box table tr.top table td { padding-bottom: 20px; }
            .invoice-box table tr.top table td.title { font-size: 45px; line-height: 45px; color: #333; }
            .invoice-box table tr.information table td { padding-bottom: 40px; }
            .invoice-box table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
            .invoice-box table tr.details td { padding-bottom: 20px; }
            .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
            .invoice-box table tr.item.last td { border-bottom: none; }
            .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; }
        </style>
    </head>
    <body>

        <div class="invoice-box">

            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <h2>Invoice</h2>
                                </td>
                                <td>
                                    Invoice #: <?php echo $order['ID']; ?><br>
                                    Created: <?php echo date("F d, Y", strtotime($order['Order_Date'])); ?><br>
                                    Status: <?php echo $order['Status']; ?>

                                </td>
                            </tr>
                            <tr><td></td>
                                <td><button id="printButton" class="print-button" onclick="window.print()">Print</button></td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Customer: <?php echo $order['Customer']; ?><br>
                                    Transaction: <?php echo $order['stripe_session_id']; ?>
                                </td>
                                <td>
                                    Online Optical Shop OOS
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="heading">
                    <td>Product</td>
                    <td>Price</td>
                </tr>
                <?php foreach ($orderItems as $item): ?>
                <tr class="item">
                    <td><?php echo $item['ProductName']; ?></td>
                    <td>$<?php echo $item['Price']; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="total">
                    <td></td>
                    <td>Total: $<?php echo $order['Total_Amount']; ?></td>
                </tr>
            </table>
        </div>
        <script>
            // Show the print button only if printing is supported
            // window.onbeforeprint = function() {
            //   document.getElementById('printButton').style.display = 'inline-block';
            // };

            // Hide the print button after printing is complete
            window.onbeforeprint = function() {
              document.getElementById('printButton').style.display = 'none';
            };
        </script>
    </body>
    </html>
    <?php
    return ob_get_clean();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $objOrder = new Order();
    $objOrder->setId($order_id);
    $order = $objOrder->getOrderById();
    $orderItems = $objOrder->getAllOrderItems();

    if ($order && $orderItems) {
        echo generateInvoiceHTML($order, $orderItems);
    } else {
        echo 'Order not found';
    }
} else {
    echo 'Order ID not provided';
}
?>
