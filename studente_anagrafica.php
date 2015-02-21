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

if ( (isset($_GET['edit']) && ($_GET['edit'] == "indirizzo")) || (isset($_GET['edit']) && ($_GET['edit'] == "contatti")) || (isset($_GET['edit']) && ($_GET['edit'] == "password"))) {
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
//controllo studente
if (@$_SESSION['login'] == "Yes" && @$_SESSION['role'] == 'studente' ) {
?>
  <page class="content">
    <section>
     <h2 class="icona" id="anagrafica-m">Dati personali</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? echo @$_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? echo @$_SESSION['cognome'] ?></p>
      <p><strong>Matricola: </strong> <? echo @$_SESSION['id'] ?></p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Indirizzo</h3>
            <form method="post" action="<? $url ?>?edit=indirizzo">
            <p><b>Via o piazza</b><br />
            <input name="via" type="text" value="<? echo @$_SESSION['via'] ?>">
            <br></p>
            <p><b>Numero civico</b><br />
            <input name="civico" type="number" value="<? echo @$_SESSION['civico'] ?>">
            <br></p>
            <p><b>Città</b><br />
            <input name="citta" type="text" value="<? echo @$_SESSION['citta'] ?>">
            <br></p>
            <p><b>Provincia</b><br />
            <input name="provincia" type="text" value="<? echo @$_SESSION['provincia'] ?>">
            <br></p>
            <p><b>Cap</b><br />
            <input name="cap" type="number" value="<? echo @$_SESSION['cap'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br /></p>
            </form>
              <?php
// attraverso un if controlliamo che il form sia stato inviato
if ( @$_GET['edit'] == "indirizzo" ) {

$id_studente=@$_SESSION['id'];
// recuperiamo i dati inviati con il form
$via = $_POST['via'];
$civico = $_POST['civico'];
$citta = $_POST['citta'];
$provincia = $_POST['provincia'];
$cap = $_POST['cap'];

$via = mysql_real_escape_string($via);
$civico = mysql_real_escape_string($civico);
$citta = mysql_real_escape_string($citta);
$provincia = mysql_real_escape_string($password);
$cap = mysql_real_escape_string($cap);

mysql_query("UPDATE studenti SET via = '$via', civico = '$civico', citta = '$citta', provincia = '$provincia', cap = '$cap' WHERE id = '$id_studente'") OR DIE(mysql_error());

@$_SESSION['via'] = $via;
@$_SESSION['civico'] = $civico;
@$_SESSION['citta'] = $citta;
@$_SESSION['provincia'] = $provincia;
@$_SESSION['cap'] = $cap;

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";
}
?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
            <h3>Contatti</h3>
            <form method="post" action="<? $url ?>?edit=contatti">
            <p><b>Email</b><br />
            <input name="email" type="text" value="<? echo @$_SESSION['email'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato
if ( @$_GET['edit'] == "contatti" ) {

$id_studente=@$_SESSION['id'];
// recuperiamo i dati inviati con il form
$email = $_POST['email'];

$sql = mysql_query("SELECT * FROM studenti WHERE email = '$email' WHERE id = '$id_studente'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

mysql_query("UPDATE studenti SET email = '$email'") OR DIE(mysql_error());

@$_SESSION['email'] = $email;

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Indirizzo email già utilizzato.</b>";

}
}
?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
            <h3>Password</h3>
            <form method="post" action="<? $url ?>?edit=password">
            <p><b>Nuova password</b><br />
            <input name="password" type="password">
            <br></p>
            <p><b>Conferma</b><br />
            <input name="controllo_pass" type="password">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br/></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato
if ( @$_GET['edit'] == "password" ) {

$id_studente=@$_SESSION['id'];
//recuperiamo i dati
$password = $_POST['password'];
$controllo_pass = $_POST['controllo_pass'];

if ( $password == $controllo_pass ) {

$password = mysql_real_escape_string($password);
// infine criptiamo la password con md5
$crypt_pass = md5($password);

mysql_query("UPDATE studenti SET password = '$crypt_pass' WHERE id = '$id_studente'") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Le password non corrispondono</b>";

}
}
?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi modificare i tuoi dati personali.</p>
    <ul>
      <li>Il tuo <strong>indirizzo</strong> di residenza.</li>
      <li>Il tuo indirizzo <strong>email</strong>.</li>
      <li>La tua <strong>password</strong></li>
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
