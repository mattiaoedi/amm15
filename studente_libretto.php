<?php
session_start();
@$_SESSION['id_edit'] = '';
@$_SESSION['role_edit'] = '';
@$_SESSION['nome_edit']= '';
@$_SESSION['cognome_edit'] = '';
@$_SESSION['via_edit'] = '';
@$_SESSION['civico_edit'] = '';
@$_SESSION['citta_edit'] = '';
@$_SESSION['provincia_edit'] = '';
@$_SESSION['cap_edit'] = '';
@$_SESSION['email_edit'] = '';
@$_SESSION['ricevimento_edit'] = '';
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
if (@$_SESSION['login'] == "Yes" && @$_SESSION['role'] == 'studente' ) {
?>
  <page class="content">
    <section>
     <h2 class="icona" id="libretto-m">Libretto online</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? echo @$_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? echo @$_SESSION['cognome'] ?></p>
      <p><strong>Matricola: </strong> <? echo @$_SESSION['id'] ?></p>
          <hr width="100%" size="2" color="1c345a">
            <?
        $esami = mysql_query("SELECT * FROM esami"); 

        $num = mysql_num_rows($esami);
		
		if ( $num > 0 ) {
			
		echo '<table>
  <tr class="head">
    <td height="10">Insegnamento</font></td>
    <td height="10">CFU</td>
	<td height="10">Matricola</td>
	<td height="10">Voto</td>
    <td height="10">Data</td>
  </tr>';
  
		$i=0;
		while ($i < $num) { 
     	$id=mysql_result($esami,$i,'id');
        $insegnamento=mysql_result($esami,$i,'insegnamento');
        $matricola=mysql_result($esami,$i,'matricola');
        $voto=mysql_result($esami,$i,'voto');		
		$data=mysql_result($esami,$i,'data');
		
	
	$risultati = mysql_query("SELECT * FROM insegnamenti WHERE id = '$insegnamento'");

	$dati = mysql_fetch_array($risultati);

	$insegnamento = $dati['nome'];
	
	$cfu = $dati['crediti'];

 
        echo '<tr class="field">
    <td>'.$insegnamento.'</td>
    <td>'.$cfu.'</td>
    <td>'.$matricola.'</td>
    <td>'.$voto.'</td>
    <td>'.$data.'</td>
';

     	$i++;
		}
		
		echo '</tr>
		</table>';
		
		} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Non sono presenti esami registrati.</b>";

}
?>    
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi visualizzare gli esami da te sostenuti. Per ogni esame vengono riportati:</p>
    <ul>
      <li> Il nome dell'insegnamento.</li>
      <li> Il codice dell'insegnamento.</li>
      <li> Il voto conseguito. </li>
      <li> La data in cui l'esame è stato sostenuto.</li>
      <li> Il numero di crediti. </li>
      <li> Il presidente della commissione.</li>
      <li> La lista di membri della commissione.</li>
    </ul>
  </rside>
<?
} elseif (@$_SESSION['login'] != "Yes") {

	
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
