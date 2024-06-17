<?php
class Order {
    private $id;
    
    private $status;
    public $dConn;

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function __construct() {
        require_once('../db/DbConnect.php');
        $db = new DbConnect();
        $this->dConn = $db->connect();
    }

    public function getAllOrders() {
        $sql = "SELECT * FROM tblorder ORDER BY FIELD(Status, 'Pending', 'Delivered', 'Failed'), Order_Date ASC";
        $stmt = $this->dConn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderById() {
        $sql = "SELECT *, t.stripe_session_id FROM tblorder o JOIN transactions t ON t.ID = o.Transaction WHERE o.ID = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateOrderStatus() {
        $sql = "UPDATE tblorder SET status = :status WHERE id = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':status', $this->status);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllOrderItems() {
        $stmt = $this->dConn->prepare("SELECT *,p.ProductName FROM tblorderitem o JOIN tblproduct p ON p.ID = o.Product WHERE Order_ID = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteOrder() {
        $sql = "DELETE FROM tblorder WHERE id = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
