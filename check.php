<?php
if (isset($_GET['submit'])) {
    $log = $_GET['name'];
    // $passe = md5($_POST['pass']);
    $passe = $_GET['pass'];
    require '../connection.php';
    $stmt = $dbh->prepare('SELECT * FROM login WHERE name=? and pass=?');
    $parametres = array($log, $passe);
    $stmt->execute($parametres);
    if ($rs = $stmt->fetch()) {


        //
        session_start();
        $_SESSION['droit'] = $rs;
        if ($rs['function'] == "admin") {
            header('location:../admin_side/admin_interface.php');
        } elseif ($rs['function'] == "user") {
            header('location:../user_side/user_interface.php');
        }
    } else {
        header('location:../error.php');
    }
}
