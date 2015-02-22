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

if ( isset($_GET['sign']) || isset($_GET['delete'])) {
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
//controllo studente
if ((isset($_SESSION['login']) && $_SESSION['login'] == "yes") && (isset($_SESSION['role']) && $_SESSION['role'] == "studente") ) { ?>
  <page class="content">
    <section>
     <h2 class="icona" id="esame-m">Iscrizione appello</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? if (isset($_SESSION['nome']) ) echo $_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? if (isset($_SESSION['cognome']) ) echo $_SESSION['cognome'] ?></p>
      <p><strong>Matricola: </strong> <? if (isset($_SESSION['id']) ) echo $_SESSION['id'] ?></p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Appelli disponibili</h3>
<?
        $appelli = mysql_query("SELECT * FROM appelli ORDER BY id DESC"); 

        $num = mysql_num_rows($appelli);
		
		if ( $num > 0 ) {
			
		echo '<table>
  <tr class="head">
    <td height="10">Insegnamento</font></td>
	<td height="10">CFU</td>
    <td height="10">Data</td>
    <td height="10">Posti</td>
	<td height="10">Iscrizione</td>
  </tr>';
  
		$i=0;
		while ($i < $num) { 
     	$id=mysql_result($appelli,$i,'id');
        $insegnamento=mysql_result($appelli,$i,'insegnamento');
        $data=mysql_result($appelli,$i,'data');
        $posti=mysql_result($appelli,$i,'posti');		
		
	$id_studente = @$_SESSION['id'];
	
	$risultati = mysql_query("SELECT * FROM iscritti_appello WHERE appello = '$id' AND studente = '$id_studente'");
	
	$presente = mysql_num_rows($risultati);
	
		if ( ($presente == 0) && ($posti > 0)) {
    $td="<td><a href='?sign=".$id."'>iscriviti</a></td>";
	} elseif ( ($presente == 0) && ($posti == 0)) {
	$td="<td><em>scaduta</em></td>";
	} else {
	$td="<td><a href='?delete=".$id."'><img src='files/img/no.png' width='32' height='32' alt='cancellati' style='vertical-align:middle;'/></a></td>";
					}
	
	$risultati = mysql_query("SELECT * FROM insegnamenti WHERE id = '$insegnamento'");

	$dati = mysql_fetch_array($risultati);

	$insegnamento = $dati['nome'];

	$cfu = $dati['crediti'];
 
        echo '<tr class="field">
    <td>'.$insegnamento.'</td>
    <td>'.$cfu.'</td>
    <td>'.$data.'</td>
    <td>'.$posti.'</td>
	'.$td.'';
     	$i++;;
		}
		
		echo '</tr>
		</table>';
		
		} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Non sono presenti appelli creati.</b>";

}
?>
<?php
//attraverso un if controlliamo che il form sia stato inviato

$risultati = mysql_query("SELECT posti FROM appelli WHERE id = '$id_appello'");

$posti = mysql_fetch_array($risultati);

if ( isset($_GET['sign'])  ) {

//recuperiamo i dati inviati
if (isset($_GET['sign']))
$id_appello = $_GET['sign'];
if (isset($_SESSION['id']))
$id_studente = $_SESSION['id'];

mysql_query("UPDATE appelli SET posti = posti-1 WHERE id = '$id_appello'") OR DIE(mysql_error());

mysql_query("INSERT INTO iscritti_appello
             (appello, studente)
             VALUES
             ('$id_appello', '$id_studente')") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti iscrizione effettuata con successo.</b>";

} elseif ( isset($_GET['sign']) && (mysql_result($appelli,$id,'posti')) == 0 ) {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Posti non disponibili.</b>";
	
} elseif ( isset($_GET['delete']) ) {

//recuperiamo i dati inviati
if (isset($_GET['delete']))
$id_appello = $_GET['delete'];
if (isset($_SESSION['id']))
$id_studente = $_SESSION['id'];

mysql_query("UPDATE appelli SET posti = posti+1 WHERE id = '$id_appello'") OR DIE(mysql_error());

mysql_query("DELETE FROM iscritti_appello WHERE appello = '$id_appello' AND studente = '$id_studente'") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Cancellazione iscrizione effettuata con successo.</b>";

}

?>      
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione ti puoi iscrivere per sostenere un esame. Per ogni appello disponibile sono riportati:</p>
    <ul>
      <li> Il nome dell'insegnamento.</li>
      <li> Il codice dell'insegnamento.</li>
      <li> Il numero di crediti.</li>
      <li> La data in cui si terrà l'esame</li>
      <li> Il docente titolare dell'esame.</li>
      <li> Il numero di posti ancora disponibili. <br>
      </li>
    </ul>
    <p>&nbsp;</p>
    <p>È possibile iscriversi ad un determinato appello cliccando sul link <em>Iscriviti</em> della riga corrispondente.</p>
  </rside>
<?
} elseif (isset($_SESSION['login']) && $_SESSION['login'] != "yes") {
	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato'style='vertical-align:middle;' /><b>Accesso non autorizzato.</b><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a><p>&nbsp;</p><a href='index.php?page=registrazione'><input id='button' type='submit' alt='registrati' value='registrati'/></a></center></section></page>  <br>
	<rside>
    <h2>Informazioni</h2>
    <p>Per poter visualizzare questa pagina devi essere uno studente:</p>
      <li><strong>Login</strong>, esegui il login come studente.</li>
      <li><strong>Registrati</strong>, per diventare uno studente.</li>
  </rside>";

} else {
	
echo "<page class='content'><section><center><img src='files/img/no.png' width='32' height='32' alt='accesso negato' style='vertical-align:middle;' /><b>Accesso non autorizzato.</b></center></section></page>  <br>
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
