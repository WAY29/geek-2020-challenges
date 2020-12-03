<?php
session_start();
if (!isset($_GET['page'])){
	header("Location: index.php?page=home");
} else {
	include_once($_GET['page'].".php");
}