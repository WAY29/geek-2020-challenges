<?php
if (isset($_SESSION) && $_SESSION['status'] === true){
    session_destroy();
    header('Location: index.php?page=login');
}
