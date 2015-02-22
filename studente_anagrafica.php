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

if ( (isset($_GET['edit']) && ($_GET['edit'] == "indirizzo")) || (isset($_GET['edit']) && ($_GET['edit'] == "contatti")) || (isset($_GET['edit']) && ($_GET['edit'] == "password"))) {
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
if ((isset($_SESSION['login']) && $_SESSION['login'] == "yes") && (isset($_SESSION['role']) && $_SESSION['role'] == "studente") ) {
?>
  <page class="content">
    <section>
     <h2 class="icona" id="anagrafica-m">Dati personali</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? if (isset($_SESSION['nome']) ) echo $_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? if (isset($_SESSION['cognome']) ) echo $_SESSION['cognome'] ?></p>
      <p><strong>Matricola: </strong> <? if (isset($_SESSION['id']) ) echo $_SESSION['id'] ?></p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Indirizzo</h3>
            <form method="post" action="<? $url ?>?edit=indirizzo">
            <p><b>Via o piazza</b><br />
            <input name="via" type="text" value="<? if (isset($_SESSION['via']) ) echo $_SESSION['via'] ?>">
            <br></p>
            <p><b>Numero civico</b><br />
            <input name="civico" type="number" value="<? if (isset($_SESSION['civico']) ) echo $_SESSION['civico'] ?>">
            <br></p>
            <p><b>Città</b><br />
            <input name="citta" type="text" value="<? if (isset($_SESSION['citta']) ) echo $_SESSION['citta'] ?>">
            <br></p>
            <p><b>Provincia</b><br />
            <input name="provincia" type="text" value="<? if (isset($_SESSION['provincia']) ) echo $_SESSION['provincia'] ?>">
            <br></p>
            <p><b>Cap</b><br />
            <input name="cap" type="number" value="<? if (isset($_SESSION['cap']) ) echo $_SESSION['cap'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br /></p>
            </form>
              <?php
// attraverso un if controlliamo che il form sia stato inviato
if (isset($_GET['edit']) && $_GET['edit'] == "indirizzo" ) {

if (isset($_SESSION['id']))
$id_studente=$_SESSION['id'];
// recuperiamo i dati inviati con il form
if (isset($_POST['via']))
$via = $_POST['via'];
elseif (isset($_SESSION['via'])) 
$via = $_SESSION['via'];
else $via='';
if (isset($_POST['civico']))
$civico = $_POST['civico'];
elseif (isset($_SESSION['civico'])) 
$civico = $_SESSION['civico'];
else $civico='';
if (isset($_POST['citta']))
$citta = $_POST['citta'];
elseif (isset($_SESSION['citta'])) 
$citta = $_SESSION['citta'];
else $citta='';
if (isset($_POST['provincia']))
$provincia = $_POST['provincia'];
elseif (isset($_SESSION['provincia'])) 
$provincia = $_SESSION['provincia'];
else $provincia='';
if (isset($_POST['cap']))
$cap = $_POST['cap'];
elseif (isset($_SESSION['cap'])) 
$cap = $_SESSION['cap'];
else $cap='';

if (isset($_POST['via']))
$via = mysql_real_escape_string($via);
if (isset($_POST['civico']))
$civico = mysql_real_escape_string($civico);
if (isset($_POST['citta']))
$citta = mysql_real_escape_string($citta);
if (isset($_POST['provincia']))
$provincia = mysql_real_escape_string($password);
if (isset($_POST['cap']))
$cap = mysql_real_escape_string($cap);

mysql_query("UPDATE studenti SET via = '$via', civico = '$civico', citta = '$citta', provincia = '$provincia', cap = '$cap' WHERE id = '$id_studente'") OR DIE(mysql_error());

if (isset($_SESSION['via']))
$_SESSION['via'] = $via;
if (isset($_SESSION['civico']))
$_SESSION['civico'] = $civico;
if (isset($_SESSION['citta']))
$_SESSION['citta'] = $citta;
if (isset($_SESSION['provincia']))
$_SESSION['provincia'] = $provincia;
if (isset($_SESSION['cap']))
$_SESSION['cap'] = $cap;

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";
}
?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
            <h3>Contatti</h3>
            <form method="post" action="<? $url ?>?edit=contatti">
            <p><b>Email</b><br />
            <input name="email" type="text" value="<? if (isset($_SESSION['email']) ) echo $_SESSION['email'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato
if (isset($_GET['edit']) && $_GET['edit'] == "contatti" ) {

if (isset($_SESSION['id']))
$id_studente=$_SESSION['id'];
// recuperiamo i dati inviati con il form
if (isset($_POST['email']))
$email = $_POST['email'];
elseif (isset($_SESSION['email'])) 
$email = $_SESSION['email'];
else $email='';

$risultati = mysql_query("SELECT * FROM studenti WHERE email = '$email' WHERE id = '$id_studente'");
$num = mysql_num_rows($risultati);

if ( $num == 0 ) {

mysql_query("UPDATE studenti SET email = '$email'") OR DIE(mysql_error());

if (isset($_SESSION['email']))
$_SESSION['email'] = $email;

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
if (isset($_GET['edit']) && $_GET['edit'] == "password" ) {

if (isset($_SESSION['id']))
$id_studente=$_SESSION['id'];
//recuperiamo i dati
if (isset($_POST['password']))
$password = $_POST['password'];
else $password ="";
if (isset($_POST['controllo_pass']))
$controllo_pass = $_POST['controllo_pass'];
else $controllo_pass ="";


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
