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
    <h2 class="icona" id="cerca-m">Elenco storico esami</h2>
    <p>&nbsp;</p>
    <p><strong>Nome: </strong> <? echo $_SESSION['nome'] ?></p>
    <p><strong>Cognome: </strong> <? echo $_SESSION['cognome'] ?></p>
    <p><strong>Insegnamento: </strong> <? echo $_SESSION['insegnamento_nome'] ?></p>
    <hr width="100%" size="2" color="1c345a">
    <h3>Filtri</h3>
    <form method="post" action="?search=esami">
      <p><b>Matricola</b><br />
        <input type="number" name="matricola"/>
        <br>
      </p>
      <p><b>Studente</b><br />
                <select name="nome">
                    <option value="Seleziona uno studente" selected>Seleziona uno studente</option>
            <?php
                        
            $risultati = mysql_query("SELECT id, nome, cognome FROM studenti ORDER BY cognome");
			$dati = mysql_fetch_array($risultati);
            $num = mysql_num_rows($risultati);
			
			$i=0;
            while ($i < $num) {
			
			$id_studente=$dati["id"];
            $nome=$dati["nome"];
			$cognome=$dati["cognome"];
			
                echo "<option value='$id_studente'>$cognome $nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
        <br>
      </p>
      <p><b>Data</b><br />
        <input name="data" type="text">
        <br>
      </p>
      <p>
        <input id="button" type="submit" alt="cerca" value="cerca">
        <br />
      </p>
    </form>
    <p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">
    <h3>Elenco esami</h3>
<?	
		if ( $_GET['search'] == "esami" ) {
			
		} else {

        $id_insegnamento = $_SESSION['id_insegnamento'];

        $esami = mysql_query("SELECT * FROM esami WHERE insegnamento = '$id_insegnamento' ORDER BY id DESC"); 

        $num = mysql_num_rows($esami); 
		
		}
		
		if ( $num > 0 ) {
			
		echo '<table>
		<tr class="head">
		<td height="10">Insegnamento</font></td>
		<td height="10" >Matricola</font></td>
		<td height="10">Studente</font></td>
		<td height="10">Voto</font></td>
		<td height="10">Data</font></td>
		<td height="10">Modifica</td>
		<td height="10">Elimina</td>
		</tr>';
  
		$i=0;
		while ($i < $num) { 
     	$id_esame=mysql_result($esami,$i,'id');
        $matricola=mysql_result($esami,$i,'matricola');
        $insegnamento_id=mysql_result($esami,$i,'insegnamento');
		$voto=mysql_result($esami,$i,'voto');
        $docente=mysql_result($esami,$i,'docente');
        $data=mysql_result($esami,$i,'data');
		
	
	$risultati = mysql_query("SELECT * FROM insegnamenti WHERE id = '$insegnamento_id' ");

	$dati = mysql_fetch_array($risultati);

	$insegnamento= $dati['nome'];
 
	$risultati = mysql_query("SELECT * FROM studenti WHERE id = '$matricola' ");

	$dati = mysql_fetch_array($risultati);

	$nome = $dati['nome'];
	$nome .= "&#160;";
	$nome .= $dati['cognome'];
 
        echo '<tr class="field">
    <td>'.$insegnamento.'</td>
    <td>'.$matricola.'</td>
    <td>'.$nome.'</td>
    <td>'.$voto.'</td>
    <td>'.$data.'</td>
    <td><a href="'. $url .'?show='. $id_esame .'"><img src="files/img/edit.png" width="32" height="32" alt="edit" style="vertical-align:middle;" /></a></td>
    <td><a href="'. $url .'?delete='. $id_esame .'"><img src="files/img/delete.png" width="32" height="32" alt="delete" style="vertical-align:middle;" /></a></td>';

     	$i++;
		}
		
		echo '</tr>
		</table>';
		
		} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Non sono presenti esami registrati per il tuo insegnamento.</b>";

}
?>
    <p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">   
<?php
//attraverso un while controlloriamo che il $_GET abbiamo un valore id valido

			$esami = mysql_query("SELECT * FROM esami ORDER BY id DESC"); 
			$num = mysql_num_rows($esami);
			
			$i=0;
            while ($i < $num) {
			
			if ( $_GET['show'] == (mysql_result($esami,$i,'id')) ) {
				
				$id_esame = $_GET['show'];
				$_SESSION['id_esame'] = $id_esame;
				
				}
				
            $i++;
			
}
?>
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( $_GET['show'] == $id_esame ) {
	
	$get_url = $_SERVER['REQUEST_URI'];
	
	$risultati = mysql_query("SELECT * FROM esami WHERE id = '$id_esame'");

	$esame = mysql_fetch_array($risultati);

	$matricola = $esame['matricola'];
	$voto = $esame['voto'];
	

?>
    <h3>Modifica esame registrato</h3>
    <form method="post" action="<? $get_url ?>?edit=esame">
            <p><b>Matricola</b><br />
            <input name="matricola" type="number" value="<? echo $matricola ?>">
            <br></p>
            <p><b>Voto</b><br />
            <input name="voto" type="number" value="<? echo $voto ?>">
            <br></p>
        <input id="button" type="submit" alt="modifica" value="modifica">
        <br />
      </p>
    </form>
<?
echo '<p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">';	
}
?>
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( $_GET['edit'] == "esame" ) {

$id_esame = $_SESSION['id_esame'];		
//recuperiamo i dati inviati con il form
$matricola = $_POST['matricola'];
$voto = $_POST['voto'];

if ( $matricola == TRUE && $voto == TRUE ) {

mysql_query("UPDATE esami SET matricola = '$matricola', voto = '$voto' WHERE id = '$id_esame'") OR DIE(mysql_error());

$_SESSION['id_esame'] = '';

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b><p>&nbsp;</p>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b><p>&nbsp;</p>";

}
} elseif ( $_GET['delete'] == $id_esame ) {
	
$id_esame = $_GET['delete'];

mysql_query("DELETE FROM esami WHERE id = '$id_esame'") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Cancellazione esame registrato effettuata con successo.</b><p>&nbsp;</p>";

echo '<p>&nbsp;</p>
    <hr width="100%" size="2" color="1c345a">';

}
?>
  </section>
  <!-- end .content -->
</page>   
<rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi visualizzare lo storico degli esami registrati. È possibile filtrarli per data e per studente</p>
    <p> Puoi modificarne uno la registrazione di un esame esistente premendo il pulsante <em>Modifica</em>, identificabile dall'icona:<br>
    <img src="files/img/edit.png" alt="icona modifica"></p>
    <p> È possibile eliminare la registrazione di un esame tramite il pulsante <em>Elimina</em>, identificabile dall'icona: <br>
    <img src="files/img/delete.png" alt="icona elimina"></p>
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
