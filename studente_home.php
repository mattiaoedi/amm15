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
//controllo studente
if ($_SESSION['login'] == "yes" && $_SESSION['role'] == "studente" ) {
?>
<page class="content">
    <section>
      <h2 class="icona" id="areap">Area personale</h2>
      <p>Benvenuto, <? echo @$_SESSION['nome'] ?>.</p>
      <p>Benvenuto nella tua area riservata!</p>
	  <div class="box_link">
      <p><center><li><a href="studente_anagrafica.php" id="anagrafica">Anagrafica</a></li>
                    <li><a href="studente_libretto.php" id="libretto">Libretto</a></li>
                    <li><a href="studente_iscrivi.php" id="esame">Iscrizione</a></li></center></p>
					</div>
    </section>
  <!-- end .content --></page>  
  <rside>
    <h2>Informazioni</h2>
    <p>Seleziona una delle  seguenti funzionalità disponibili per la gestione dei tuoi esami:</p>
      <li><strong>Anagrafica</strong> per modificare i tuoi dati anagrafici e la tua password.</li>
      <li><strong>Libretto</strong> per visualizzare gli esami già sostenuti.</li>
      <li><strong>Iscrizione</strong> per iscriversi ad un appello di esame.</li>
  </rside>
  <?
} elseif (@$_SESSION['login'] != "yes") {

	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato'style='vertical-align:middle;' /><b>Accesso non autorizzato.</b><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a><p>&nbsp;</p><a href='index.php?page=registrazione'><input id='button' type='submit' alt='registrati' value='registrati'/></a></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere uno studente:</p>
      <li><strong>Login</strong>, esegui il login come studente.</li>
      <li><strong>Registrati</strong>, per diventare uno studente.</li>
  </rside>";

} else {
	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato' style='vertical-align:middle;' /><b>Accesso non autorizzato.</b></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere uno studente:</p>
      <li><strong>Login</strong>, esegui il login come studente.</li>
  </rside>";	

}
?>
<?php include 'include/footer.htm'; ?>
  <!-- end .container --></div>
</body>
</html>
