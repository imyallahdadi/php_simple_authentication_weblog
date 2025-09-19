<?php
session_start();
include 'access.php';
include '../db.php';
include 'mysql_backup.php';

new MySQLBackup($db_username, $db_password, $db_dbname, $backupPath, $db_servername);
?>
