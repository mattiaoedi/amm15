<lside> 
	<h2>Benvenuto!</h2>
      <p><a href="index.php">Descrizione</a></p>
<?php

$url = basename($_SERVER['PHP_SELF']);

if ((((isset($_SESSION['login']) && $_SESSION['login']) =="yes" )) && (isset($_SESSION['role']) && ($_SESSION['role'] == "studente" && $_SESSION['role'] != "docente" && $_SESSION['role'] != "admin"))) {?>
    <h2>Area riservata</h2>
      <p>Ciao, <? echo $_SESSION['nome'] ?>  <a href="<? echo $url ?>?check=logout"><img src="files/img/logout.png" width="16" height="16" alt="logout" style="vertical-align:middle;"></a></p>
      <p><a href="studente_home.php">Home</a></p>
      <p><a href="studente_anagrafica.php">Anagrafica</a></p>
      <p><a href="studente_libretto.php">Libretto</a></p>
      <p><a href="studente_iscrivi.php">Esami</a></p>
    <p><!-- end .sidebar1 --></p>
<?php
} elseif ((((isset($_SESSION['login']) && $_SESSION['login']) =="yes" )) && (isset($_SESSION['role']) && ($_SESSION['role'] != "studente" && $_SESSION['role'] == "docente" && $_SESSION['role'] != "admin"))) {?>
    <h2>Area riservata</h2>
      <p>Ciao, <? echo $_SESSION['nome'] ?>  <a href="<? echo $url ?>?check=logout"><img src="files/img/logout.png" width="16" height="16" alt="logout" style="vertical-align:middle;"></a></p>
      <p><a href="docente_home.php">Home</a></p>
      <p><a href="docente_anagrafica.php">Anagrafica</a></p>
      <p><a href="docente_appelli.php">Appelli</a></p>
      <p><a href="docente_registra.php">Registra esame</a></p>
      <p><a href="docente_elenco.php">Elenco esami</a></p>
<?php
} elseif ((((isset($_SESSION['login']) && $_SESSION['login']) =="yes" )) && isset($_SESSION['role']) && ($_SESSION['role'] != "studente" && $_SESSION['role'] != "docente" && $_SESSION['role'] == "admin")) { ?>
    <h2>Area riservata</h2>
      <p>Ciao, <? echo $_SESSION['nome'] ?>  <a href="<? echo $url ?>?check=logout"><img src="files/img/logout.png" width="16" height="16" alt="logout" style="vertical-align:middle;"></a></p>
      <p><a href="admin_home.php">Home</a></p>
      <p><a href="admin_studenti.php">Studenti</a></p>
      <p><a href="admin_docenti.php">Docenti</a></p>
      <p><a href="admin_appelli.php">Appelli</a></p>
      <p><a href="admin_registra.php">Registra esami</a></p>
      <p><a href="admin_elenco.php">Elenco esami</a></p>
      <p><a href="admin_quadro.php">Dip &amp; CdL</a></p>
<?php
} else {
?> 
    <h2>Area riservata</h2>
      <p><a href="index.php?page=login">Login</a></p>
      <p><a href="index.php?page=registrazione">Registrazione</a></p>
<?php
}
?>
    <p><!-- end .sidebar1 --></p>
        <h2>Didattica</h2>
      <p><a href="index.php?page=offerta">Offerta formativa</a></p>
      <p><a href="http://www.unica.it/" target="_blank">Università di Cagliari</a></p>
    <p><!-- end .sidebar1 --></p>
</lside>
<?php
/*logout*/
// attraverso un if controlliamo che il form sia stato inviato
	if ( isset($_GET['check']) && $_GET['check'] == "logout" ) {
//Distruggo la vecchia sessione		
	$_SESSION['login'] = "no";
	session_unset();
	session_destroy();
//Apro una nuova sessione	
	session_start();
	echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Logout effettuato con successo.</b><p>&nbsp;</p><a href='index.php'><input id='button' type='submit' alt='home page' value='home page'/></a><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a>";
}
?>
