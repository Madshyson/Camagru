<?php
require "database.php";
try {
    //table des utilisateurs
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "DROP TABLE IF EXISTS `user`;";
    $sql .= "DROP TABLE IF EXISTS `likes`;";
    $sql .= "DROP TABLE IF EXISTS `img`;";
    $sql .= "DROP TABLE IF EXISTS `pics`;";
    $sql .= "DROP TABLE IF EXISTS `comments`;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `user` (`ID` int(11) NOT NULL,`LOGIN` varchar(50) DEFAULT NULL,`PASSWORD` varchar(255) DEFAULT NULL,`email` varchar(255) NOT NULL,`validation` int(11) NOT NULL DEFAULT '0', `clef` varchar(255) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `user` ADD PRIMARY KEY(`ID`);";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `user` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "INSERT INTO `user` (`ID`, `LOGIN`, `PASSWORD`, `email`, `validation`, `clef`) VALUES (1, 'admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 'mlavanan@student.42.fr', 1, '0');";
    $dbh->exec($sql);
    //Table des commentaires
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `comments` (`IDpic` int(11) NOT NULL, `IDuser` int(11) NOT NULL, `com` varchar(255) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $dbh->exec($sql);
    //Table des likes
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `likes`  (`IDpic` int(11) NOT NULL, `IDuser` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $dbh->exec($sql);
    //still need to create place for pic and overlay
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `img` (`IDimg` int(11) NOT NULL, `PRD_Img` varchar(200) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `img` ADD PRIMARY KEY(`IDimg`);";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `img` MODIFY `IDimg` int(11) NOT NULL AUTO_INCREMENT;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "CREATE TABLE `pics` (`IDpic` int(11) NOT NULL,`IDusr` int(11) NOT NULL, `PRD_pic` varchar(200) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `pics` ADD PRIMARY KEY(`IDpic`);";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "ALTER TABLE `pics` MODIFY `IDpic` int(11) NOT NULL AUTO_INCREMENT;";
    $dbh->exec($sql);
    $sql = "use camagru;";
    $sql .= "INSERT INTO `img` (`PRD_Img`) VALUES ('Ressources/feela.png');";
    $sql .= "INSERT INTO `img` (`PRD_Img`) VALUES ('Ressources/feelg.png');";
    $sql .= "INSERT INTO `img` (`PRD_Img`) VALUES ('Ressources/foreva.png');";
    $sql .= "INSERT INTO `img` (`PRD_Img`) VALUES ('Ressources/fuuuuu.png');";
    $sql .= "INSERT INTO `img` (`PRD_Img`) VALUES ('Ressources/tface.png');";
    $dbh->exec($sql);
}
catch (PDOException $e)
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>