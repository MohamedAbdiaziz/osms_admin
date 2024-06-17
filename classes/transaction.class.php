<?php
class Transaction {
    private $id;
    private $customer_id;
    private $stripe_session_id;
    private $amount;
    private $created_at;
    private $status;
    public $dConn;

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }

    public function setCustomerId($customer_id) { $this->customer_id = $customer_id; }
    public function getCustomerId() { return $this->customer_id; }

    public function setStripeSessionId($stripe_session_id) { $this->stripe_session_id = $stripe_session_id; }
    public function getStripeSessionId() { return $this->stripe_session_id; }

    public function setAmount($amount) { $this->amount = $amount; }
    public function getAmount() { return $this->amount; }

    public function setCreatedAt($created_at) { $this->created_at = $created_at; }
    public function getCreatedAt() { return $this->created_at; }

    public function setStatus($status) { $this->status = $status; }
    public function getStatus() { return $this->status; }

    public function __construct() {
        require_once('../db/DbConnect.php');
        $db = new DbConnect();
        $this->dConn = $db->connect();
    }

    public function getAllTransactions() {
        $sql = "SELECT * FROM transactions";
        $stmt = $this->dConn->prepare($sql);
        $stmt->execute();
        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $transactions;
    }

    public function getTransactionById() {
        $sql = "SELECT * FROM transactions WHERE id = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
        return $transaction;
    }

    public function insertTransaction() {
        $sql = "INSERT INTO transactions (customer_id, stripe_session_id, amount, status) VALUES (:customer_id, :stripe_session_id, :amount, :status)";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':stripe_session_id', $this->stripe_session_id);
        $stmt->bindParam(':amount', $this->amount);
        // $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':status', $this->status);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function deleteTransaction() {
        $sql = "DELETE FROM transactions WHERE id = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function updateTransaction() {
        $sql = "UPDATE transactions SET status = :status WHERE id = :id";
        $stmt = $this->dConn->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        // $stmt->bindParam(':customer_id', $customer_id);
        // $stmt->bindParam(':stripe_session_id', $stripe_session_id);
        // $stmt->bindParam(':amount', $amount);
        // $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':status', $this->status);
        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Failed";
        }
    }

    public function getCurrentYearAmount() {
        $sql = "SELECT 
                  ROUND((current_year_sum / (current_year_sum + last_year_sum)) * 100, 2) AS percentage, 
                  current_year_sum AS Current_year_amount
                FROM (
                    SELECT 
                        SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) THEN amount ELSE 0 END) AS current_year_sum,
                        SUM(CASE WHEN YEAR(created_at) = YEAR(CURDATE()) - 1 THEN amount ELSE 0 END) AS last_year_sum
                    FROM transactions
                ) AS totals;";
        $stmt = $this->dConn->prepare($sql);
        $stmt->execute();
        $amounts = $stmt->fetch(PDO::FETCH_ASSOC);
        return $amounts;
    }

    public function getCurrentMonthAmount() {
        $sql = "SELECT 
                  ROUND((current_month_sum / (current_month_sum + last_month_sum)) * 100, 2) AS percentage, 
                  current_month_sum AS Current_month_amount
                FROM (
                    SELECT 
                        SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) THEN amount ELSE 0 END) AS current_month_sum,
                        SUM(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) - 1 THEN amount ELSE 0 END) AS last_month_sum
                    FROM transactions
                ) AS totals;";
        $stmt = $this->dConn->prepare($sql);
        $stmt->execute();
        $amounts = $stmt->fetch(PDO::FETCH_ASSOC);
        return $amounts;
    }

    public function getRecentTransactions() {
        $sql = "SELECT id, customer_id, stripe_session_id, amount, created_at, status FROM transactions ORDER BY id DESC LIMIT 4";
        $stmt = $this->dConn->prepare($sql);
        $stmt->execute();
        $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $transactions;
    }
}
?>
