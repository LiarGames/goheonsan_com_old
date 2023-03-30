<?php
	$con = mysqli_connect("localhost","go", "qwe123!@#", "goheonsan");
	mysqli_query("SET NAMES utf8");
	mysqli_query($con, "set session character_set_connection=utf8;");
    mysqli_query($con, "set session character_set_results=utf8;");
    mysqli_query($con, "set session character_set_client=utf8;");
?>