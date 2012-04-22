<?php
include_once 'userhandler.class.php';
//sjekker om det kommer forespørsel med brukernavn og email, da sjekker om det finnes eller ikke i databasen
if(isset($_GET['name']) & isset($_GET['email'])){
    $name = $_GET['name'];
    $mail = $_GET['email'];
    $handler = new UserHandler($name);
    try {
        $handler->checkIfUsernameExists($name);
        $handler->checkIfEmailExists($mail);
    }
    catch(Exception $e) {
        print $e->getMessage();
    }

}
?>
