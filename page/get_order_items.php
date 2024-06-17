<?php
require_once("../classes/order.class.php");

if (isset($_GET['order_id'])) {
    

    $objOrderItem = new Order();
    $objOrderItem->setId($_GET['order_id']);
    $orderItems = $objOrderItem->getAllOrderItems();

    foreach ($orderItems as $item) {
        echo '<tr>
                <td>' . $item['ID'] . '</td>
                <td>' . $item['ProductName'] . '</td>
                <td>' . $item['Quantity'] . '</td>
                <td>' . $item['Price'] . '</td>
              </tr>';
    }
}
?>
