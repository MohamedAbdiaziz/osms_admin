
<?php// fetch_order_data.php
require_once("../classes/order.class.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $objOrder = new Order();
    $objOrder->setId($order_id);
    $order = $objOrder->getOrderById();
    $orderItems = $objOrder->getAllOrderItems();

    if ($order && $orderItems) {
        echo json_encode(['order' => $order, 'orderItems' => $orderItems]);
    } else {
        echo json_encode(['error' => 'Order not found']);
    }
} else {
    echo json_encode(['error' => 'Order ID not provided']);
}
?>
