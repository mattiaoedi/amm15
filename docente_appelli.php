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

if ( (isset($_GET['add']) && ($_GET['add'] == "appello")) || (isset($_GET['show']) && ($_GET['show'] == $id_appello)) || (isset($_GET['edit']) && ($_GET['edit'] == $id_appello)) || (isset($_GET['delete']) && ($_GET['delete'] == $id_appello))){
	header( "refresh:1;url={$_SERVER['PHP_SELF']}" );
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
if ($_SESSION['login'] == "Yes" && $_SESSION['role'] == 'docente') {
?>
<page class="content">
  <section>
        <h2 class="icona" id="esame-m">Appelli</h2>
    <p>&nbsp;</p>
    <p><strong>Nome: </strong> <? echo $_SESSION['nome'] ?></p>
    <p><strong>Cognome: </strong> <? echo $_SESSION['cognome'] ?></p>
    <p><strong>Insegnamento: </strong> <? echo $_SESSION['insegnamento_nome'] ?></p>
    <hr width="100%" size="2" color="1c345a">
    <h3>Crea nuovo appello</h3>
    <form method="post" action="?add=appello">
      <p><b>Data</b><br />
        <input type="text" name="data"/>
        <br>
      </p>
      <p><b>Posti disponibili</b><br />
        <input name="posti" type="number">
        <br>
      </p>
      <p>
        <input id="button" type="submit" alt="crea" value="crea">
        <br />
      </p>
    </form>
    <?php
// attraverso un if controlliamo che il form sia stato inviato

if ( $_GET['add'] == "appello" ) {

// recuperiamo i dati inviati con il form

$data = $_POST['data'];
$posti = $_POST['posti'];
$insegnamento = $_SESSION['insegnamento_id'];

if ( $data == TRUE && $posti == TRUE ){

mysql_query("INSERT INTO appelli
             (id, insegnamento, data, posti )
             VALUES
             ('', '$insegnamento', '$data', '$posti')") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti creazione effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}
}
?>
	<p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">
<h3>Elenco appelli</h3>
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
	<td height="10">Modifica</td>
	<td height="10">Elimina</td>
  </tr>';
  
		$i=0;
		while ($i < $num) { 
     	$id_appello=mysql_result($appelli,$i,'id');
        $insegnamento=mysql_result($appelli,$i,'insegnamento');
        $data=mysql_result($appelli,$i,'data');
        $posti=mysql_result($appelli,$i,'posti');		
		
	
	$risultati = mysql_query("SELECT * FROM insegnamenti WHERE id = '$insegnamento'");

	$dati = mysql_fetch_array($risultati);

	$insegnamento = $dati['nome'];

	$cfu = $dati['crediti'];
 
        echo '<tr class="field">
    <td>'.$insegnamento.'</td>
    <td>'.$cfu.'</td>
    <td>'.$data.'</td>
    <td>'.$posti.'</td>
    <td><a href="'. $url .'?show='. $id_appello .'"><img src="files/img/edit.png" width="32" height="32" alt="edit" style="vertical-align:middle;" /></a></td>
    <td><a href="'. $url .'?delete='. $id_appello .'"><img src="files/img/delete.png" width="32" height="32" alt="delete" style="vertical-align:middle;" /></a></td>';

     	$i++;
		}
		
		echo '</tr>
		</table>';
		
		} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Non sono presenti appelli creati per il tuo insegnamento.</b>";

}
?>    
    <p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">
    <?php
//attraverso un while controlloriamo che il $_GET abbiamo un valore id valido

			$appelli = mysql_query("SELECT id FROM appelli ORDER BY id DESC"); 
			$num = mysql_num_rows($appelli);
			
			$i=0;
            while ($i < $num) {
			
			if ( $_GET['show'] == (mysql_result($appelli,$i,'id')) ) {
				
				$id_appello = $_GET['show'];
				$_SESSION['id_appello'] = $id_appello;
				
				}
				
            $i++;
			
            }				
?>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if ( $_GET['show'] == $id_appello ) {
	
	$get_url = $_SERVER['REQUEST_URI'];
	
	$risultati = mysql_query("SELECT * FROM appelli WHERE id = '$id_appello'");

	$appello = mysql_fetch_array($risultati);

	$data = $appello['data'];
	$posti = $appello['posti'];
	

?>
    <h3>Modifica appello creato</h3>
    <form method="post" action="<? $get_url ?>?edit=appello">
      <p><b>Data</b><br />
        <input type="text" name="data" value="<? echo $data ?>"/>
        <br>
      </p>
      <p><b>Posti disponibili</b><br />
        <input name="posti" type="number" value="<? echo $posti ?>">
        <br>
      </p>
      <p>
        <input id="button" type="submit" alt="modifica" value="modifica">
        <br />
      </p>
    </form>
<?
}
?>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if ( $_GET['edit'] == "appello" ) {

$id_appello = $_SESSION['id_appello'];		
// recuperiamo i dati inviati con il form
$data = $_POST['data'];
$posti = $_POST['posti'];

if ( $insegnamento == TRUE && $data == TRUE && $posti == TRUE){

mysql_query("UPDATE appelli SET data = '$data', posti = '$posti' WHERE id = '$id_appello'") OR DIE(mysql_error());

$_SESSION['id_appello'] = '';

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b><p>&nbsp;</p>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b><p>&nbsp;</p>";

}
} elseif ( $_GET['delete'] == $id_appello ) {
	
$id_appello = $_GET['delete'];

mysql_query("DELETE FROM appelli WHERE id = '$id_appello'") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Cancellazione appello effettuata con successo.</b><p>&nbsp;</p>";

}
?>
  </section>
  <!-- end .content -->
</page>  
<rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi visualizzare tutti gli appelli d'esame. In particolare:</p>
    <ul>
      <li>Puoi crearne uno nuovo premendo il pulsante <em>Crea</em>.</li>
      <li>Puoi modificarne uno esistente premendo il pulsante <em>Modifica</em>, identificabile dall'icona: <img src="files/img/edit.png" alt="icona modifica"></li>
      <li>Puoi eliminarne uno esistente premendo il pulsante <em>Elimina</em>, identificabile dall'icona:  <img src="files/img/delete.png" alt="icona elimina"></li>
    </ul>
    <p>&nbsp;</p>
    <p>Per l'inserimento e la modifica è necessario specificare solo la data ed i posti disponibili.</p>
  </rside>
<?
} elseif ($_SESSION['login'] != "Yes") {

	
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
