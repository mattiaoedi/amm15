<?php
session_start();
$_SESSION['id_edit'] = '';
$_SESSION['role_edit'] = '';
$_SESSION['nome_edit']= '';
$_SESSION['cognome_edit'] = '';
$_SESSION['via_edit'] = '';
$_SESSION['civico_edit'] = '';
$_SESSION['citta_edit'] = '';
$_SESSION['provincia_edit'] = '';
$_SESSION['cap_edit'] = '';
$_SESSION['email_edit'] = '';
$_SESSION['ricevimento_edit'] = '';
// includiamo il file di connessione al database
include ('files/config.php');

    $url = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>amm15 - Università di Cagliari</title>
<link href="files/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
<div class="header">
	<font size="5" color="#FFFFFF"><b><p>Università degli Studi di Cagliari<br>
	</p>
	<p>amm15</p></b></font>
</div>
<?php include 'include/lside.htm'; ?>
<? 
//controllo admin
if ($_SESSION['login'] == "Yes" && $_SESSION['role'] == 'admin') {
?>
<page class="content">
    <section>
      <h2 class="icona" id="areap">Area gestione</h2>
      <p>Benvenuto, <? echo $_SESSION['nome'] ?>.</p>
      <p>Benvenuto nella tua area riservata!</p>
	  <div class="box_link">
      <p><center><li><a href="admin_studenti.php" id="anagrafica">Studenti</a></li>
					<li><a href="admin_docenti.php" id="anagrafica">Docenti</a></li>
                    <li><a href="admin_appelli.php" id="esame">Appelli</a></li>
                    <li><a href="admin_registra.php" id="libretto">Registra esami</a></li>
                    <li><a href="admin_elenco.php" id="cerca">Cerca</a></li>
                    <li><a href="admin_quadro.php" id="quadro">Dipartimenti e corsi</a></li></center></p>
					</div>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>Seleziona una delle seguentifunzionalità disponibili per la gestione dei tuoi insegnamenti:</p>
    <li><strong>Studenti</strong> per modificare i dati anagrafici degli studenti.</li>
    <li><strong>Docenti</strong> per modificare i dati anagrafici dei docenti.</li>
    <li><strong>Appelli</strong> per modificare gli appelli inseriti dai docenti.</li>
    <li><strong>Registrazione esami</strong> per registrare nuovi esami.</li>
    <li><strong>Elenco esami</strong> per modificare le registrazioni degli esami inserite dai docenti.</li>
    <li><strong>Dipartimenti e corsi di laurea</strong> per modificare i dati sui dipartimenti e corsi di Laurea.</li>
  </rside>
<?
} elseif ($_SESSION['login'] != "Yes") {

	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato'style='vertical-align:middle;' /><b>Accesso non autorizzato.</b><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a><p>&nbsp;</p><a href='index.php?page=registrazione'><input id='button' type='submit' alt='registrati' value='registrati'/></a></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere un amministratore:</p>
      <li><strong>Login</strong>, esegui il login come amministratore.</li>
      <li><strong>Registrati</strong>, per diventare uno studente.</li>
  </rside>";

} else {
	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato' style='vertical-align:middle;' /><b>Accesso non autorizzato.</b></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere un amministratore:</p>
      <li><strong>Login</strong>, esegui il login come amministratore.</li>
  </rside>";	

}
?>
<?php include 'include/footer.htm'; ?>
  <!-- end .container --></div>
</body>
</html>
