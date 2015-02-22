<?php
session_start();
if (isset($_SESSION['studente']) )
$_SESSION['studente'] = '';
if (isset($_SESSION['docente']) )
$_SESSION['docente'] = '';
if (isset($_SESSION['id_appello']) )
$_SESSION['id_appello'] = '';
if (isset($_SESSION['id_esame']) )
$_SESSION['id_esame'] = '';
if (isset($_SESSION['id_dipartimento']) )
$_SESSION['id_dipartimento'] = '';
if (isset($_SESSION['id_corso']) )
$_SESSION['id_corso'] = '';
if (isset($_SESSION['id_insegnamento']) )
$_SESSION['id_insegnamento'] = '';
if (isset($_SESSION['id_edit']) )
$_SESSION['id_edit'] = '';
if (isset($_SESSION['role_edit']) )
$_SESSION['role_edit'] = '';
if (isset($_SESSION['nome_edit']) )
$_SESSION['nome_edit']= '';
if (isset($_SESSION['cognome_edit']) )
$_SESSION['cognome_edit'] = '';
if (isset($_SESSION['via_edit']) )
$_SESSION['via_edit'] = '';
if (isset($_SESSION['civico_edit']) )
$_SESSION['civico_edit'] = '';
if (isset($_SESSION['citta_edit']) )
$_SESSION['citta_edit'] = '';
if (isset($_SESSION['provincia_edit']) )
$_SESSION['provincia_edit'] = '';
if (isset($_SESSION['cap_edit']) )
$_SESSION['cap_edit'] = '';
if (isset($_SESSION['email_edit']) )
$_SESSION['email_edit'] = '';
if (isset($_SESSION['ricevimento_edit']) )
$_SESSION['ricevimento_edit'] = '';
if (isset($_SESSION['nome_reg']) )
$_SESSION['nome_reg'] == '';
if (isset($_SESSION['cognome_reg']) )
$_SESSION['cognome_reg'] == '';
if (isset($_SESSION['corso_reg']) )
$_SESSION['corso_reg'] == '';
if (isset($_SESSION['email_reg']) )
$_SESSION['email_reg'] == '';
// includiamo il file di connessione al database
include ('files/config.php');

if ( isset($_GET['add']) && ($_GET['add'] == "voto")) {
	header( "refresh:2;url={$_SERVER['PHP_SELF']}" );
	}
	
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
//controllo docente
if ((isset($_SESSION['login']) && $_SESSION['login'] == "yes") && (isset($_SESSION['role']) && $_SESSION['role'] == "admin") ) {?>
  <page class="content">
    <section>
     <h2 class="icona" id="libretto-m">Registra esame</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? if (isset($_SESSION['nome']) ) echo $_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? if (isset($_SESSION['cognome']) ) echo $_SESSION['cognome'] ?></p>
      <p><strong>Gestione come amministratore</strong></p>
      <hr width="100%" size="2" color="1c345a">
        <h3>Registra voto esame</h3>
            <form method="post" action="?add=voto">
            <p><b>Insegnamento</b><br />
                                <select name="insegnamento">
                    <option value="Seleziona un insegnamento" selected>Seleziona un insegnamento</option>
            <?php
                        
            $risultati = mysql_query("SELECT * FROM insegnamenti ORDER BY nome");
			$dati = mysql_fetch_array($risultati);
            $num = mysql_num_rows($risultati);
			
			$i=0;
            while ($i < $num) {
			
			$id_insegnamento=$dati["id"];
            $nome=$dati["nome"];
			
                echo "<option value='$id_insegnamento'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
            <br></p>
            <p><b>Matricola</b><br />
            <input name="matricola" type="number">
            <br></p>
            <p><b>Voto</b><br />
            <input name="voto" type="number">
            <br></p>
            <p><input id="button" type="submit" alt="registra" value="registra"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if (  isset($_GET['add']) && $_GET['add'] == "voto" ) {

$id_docente = @$_SESSION['id'];
// recuperiamo i dati inviati con il form
if ( isset($_POST['matricola']))
$matricola = $_POST['matricola'];
else $matricola = '';
if ( isset($_POST['insegnamento_id']))
$insegnamento_id = $_POST['insegnamento_id'];
else $insegnamento_id = '';
if ( isset($_POST['voto']))
$matricola = $_POST['voto'];
else $voto = '';


if ( $matricola == TRUE && $voto == TRUE && $insegnamento == TRUE){

if ( ($voto >= 18) &&  ($voto <= 31)) {

mysql_query("INSERT INTO esami
             (id, insegnamento, matricola, voto, docente, data )
             VALUES
             ('', '$insegnamento', '$matricola', '$voto', '$id_docente ', CURRENT_TIMESTAMP)") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti registrazione effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Voto deve essere compreso tra 18 e 31.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}
}
?>
			<p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
    </section>
  <!-- end .content --></page> 
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi registrare un esame, inserendo i seguenti dati</p>
    <ul>
      <li>Insegnamento</li>
      <li>Matricola dello studente</li>
      <li>Voto</li>
    </ul>
  </rside>
<?
} elseif (isset($_SESSION['login']) && $_SESSION['login'] != "yes") {

	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato'style='vertical-align:middle;' /><b>Accesso non autorizzato.</b><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a><p>&nbsp;</p><a href='index.php?page=registrazione'><input id='button' type='submit' alt='registrati' value='registrati'/></a></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere un docente:</p>
      <li><strong>Login</strong>, esegui il login come docente.</li>
      <li><strong>Registrati</strong>, per diventare uno studente.</li>
  </rside>";

} else {
	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato' style='vertical-align:middle;' /><b>Accesso non autorizzato.</b></center></section></page>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere un docente:</p>
      <li><strong>Login</strong>, esegui il login come docente.</li>
  </rside>";	

}
?>
<?php include 'include/footer.htm'; ?>
  <!-- end .container --></div>
</body>
</html>
