<?php
//definisco i parametri per il login del server mysql

$db_host = "localhost";
$db_user = "sarritzuMattia";
$db_password = "capinera262";
$db_name = "amm14_sarritzuMattia";

//connessione al server mysql 
$db = mysql_connect($db_host, $db_user, $db_password) or die ('Errore durante la connessione');

//connessi al server, abbiamo bisogno di scegliere il database del server in cui lavorare
mysql_select_db($db_name, $db) or die ('Errore durante la selezione del db');
?>