<?php
include "database.php";
try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `user` (`ID` int(11) NOT NULL,`LOGIN` varchar(50) DEFAULT NULL,`PASSWORD` varchar(255) DEFAULT NULL,`email` varchar(255) NOT NULL,`validation` int(11) NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $sql .= "ALTER TABLE `user` ADD PRIMARY KEY ('ID')";
    $sql .= "ALTER TABLE `user` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
    $dbh->exec($sql);
}
catch (PDOException $e)
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>