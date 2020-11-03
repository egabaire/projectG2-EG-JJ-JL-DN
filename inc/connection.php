<?php
	$db = new PDO("sqlite::.\db/databas.db"); 
	$db1 = new SQLite3('db/databas.db');
	$db1->busyTimeout(5000);
    // WAL mode has better control over concurrency.
    // Source: https://www.sqlite.org/wal.html
    $db1->exec('PRAGMA journal_mode = wal;');

	$username="";

	if(isset($_SESSION['username']))
	{
		$username=$_SESSION['username'];
	}

	$loggedInId=$db1->querySingle("select id from Users where username='$username'");
	
?>
