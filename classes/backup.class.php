<?php
class Backup
{
    private $dbConn;
    private $backupDir = '../backups/';
    private $dbName;
    private $dbHost;
    private $dbUser;
    private $dbPass;

    public function __construct()
    {
        require_once("../db/DbConnect.php");
        $db = new DbConnect();
        $this->dbConn = $db->connect();
        $this->dbName = $db->getDbName();
        $this->dbHost = $db->gethost();
        $this->dbUser = $db->getuser();
        $this->dbPass = $db->getPassword();
    }

    public function setBackup()
    {
        if (!is_dir($this->backupDir)) {
            mkdir($this->backupDir, 0777, true);
        }

        try {
            $backupFileName = $this->backupDir . $this->dbName . '-' . date('Y-m-d-H-i-s') . '.sql';

            // Construct the command
            $command = sprintf(
                'mysqldump --host=%s --user=%s %s %s > %s',
                escapeshellarg($this->dbHost),
                escapeshellarg($this->dbUser),
                !empty($this->dbPass) ? '--password=' . escapeshellarg($this->dbPass) : '',
                escapeshellarg($this->dbName),
                escapeshellarg($backupFileName)
            );

            // Debug: print the command
            file_put_contents('backup_command_log.txt', $command);

            $output = [];
            $resultCode = null;
            exec($command . ' 2>&1', $output, $resultCode);

            // Debug: log the output and result code
            file_put_contents('backup_output_log.txt', implode("\n", $output));
            file_put_contents('backup_result_code_log.txt', $resultCode);

            if ($resultCode !== 0) {
                return "Backup command failed to execute. Check backup_output_log.txt for details.";
            }

            if (file_exists($backupFileName)) {
                return "Database backup successfully created at: $backupFileName";
            } else {
                return "Backup file was not created.";
            }

        } catch (Exception $e) {
            die("Backup process failed: " . $e->getMessage());
        }
    }
}
?>
