<?php
session_start();
$_SESSION['date_posts']=$_GET['posts'];

header('Location: '.$_SESSION['date_process_url']);


?>