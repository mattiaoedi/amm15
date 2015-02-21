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

if ( (isset($_GET['check']) && ($_GET['check'] == "login")) || (isset($_GET['check']) && ($_GET['check'] == "registrazione")) || (isset($_GET['check']) && ($_GET['check'] == "logout"))) {
	header( "refresh:1;url={$_SERVER['PHP_SELF']}" );
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
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
  <page class="content">
    <section>
      <h2>Verifica</h2>
<?php
/*login*/
// attraverso un if controlliamo che il form sia stato inviato

if ( @$_GET['check'] == "login" ) {

// recuperiamo i dati inviati con il form

$username = $_POST['username'];

$password = $_POST['password'];

// ora controlliamo che i campi siano stati tutti compilati

if ( $username == TRUE && $password == TRUE)  {

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);	
$crypt_pass = md5($password);

$risultati = mysql_query("SELECT * FROM studenti WHERE username = '$username' AND password = '$crypt_pass'");

$studente = mysql_fetch_array($risultati);

$nums = mysql_num_rows($risultati);

$risultati = mysql_query("SELECT * FROM docenti WHERE username = '$username' AND password = '$crypt_pass'");

$docente = mysql_fetch_array($risultati);

$numd = mysql_num_rows($risultati);

if ( ($nums == 1) || ($numd == 1)) {

		session_start();
		
if ( $nums == 1) {		
		@$_SESSION['login'] = "Yes";
		@$_SESSION['id'] = $studente['id'];
		@$_SESSION['role'] = $studente['role'];
		@$_SESSION['nome'] = $studente['nome'];
		@$_SESSION['cognome'] = $studente['cognome'];
		@$_SESSION['corso'] = $studente['corso'];
		@$_SESSION['via'] = $studente['via'];
		@$_SESSION['civico'] = $studente['civico'];
		@$_SESSION['citta'] = $studente['citta'];
		@$_SESSION['provincia'] = $studente['provincia'];
		@$_SESSION['cap'] = $studente['cap'];
		@$_SESSION['email'] = $studente['email'];
		@$_SESSION['username'] = $studente['username'];
		@$_SESSION['password'] = $studente['password'];
		@$_SESSION['data'] = $studente['data'];
		
//ricavo dati diparimento
	$corso=@$_SESSION['corso'];
	$risultati = mysql_query("SELECT * FROM corsi WHERE docente = '$corso' ");

	$diparimento = mysql_fetch_array($risultati);

		@$_SESSION['diparimento'] = $diparimento['id'];
		@$_SESSION['nome_diparimento'] = $diparimento['nome'];
//

		
} 
else {

		@$_SESSION['login'] = "Yes";
		@$_SESSION['id'] = $docente['id'];
		@$_SESSION['role'] = $docente['role'];
		@$_SESSION['nome'] = $docente['nome'];
		@$_SESSION['cognome'] = $docente['cognome'];
		@$_SESSION['dipartimento'] = $docente['dipartimento'];
		@$_SESSION['corso'] = $docente['corso'];
		@$_SESSION['via'] = $docente['via'];
		@$_SESSION['civico'] = $docente['civico'];
		@$_SESSION['citta'] = $docente['citta'];
		@$_SESSION['provincia'] = $docente['provincia'];
		@$_SESSION['cap'] = $docente['cap'];
		@$_SESSION['email'] = $docente['email'];
		@$_SESSION['ricevimento'] = $docente['ricevimento'];
		@$_SESSION['username'] = $docente['username'];
		@$_SESSION['password'] = $docente['password'];
		@$_SESSION['data'] = $docente['data'];

//ricavo dati insegnamento	
	$id = @$_SESSION['id'];
	$risultati = mysql_query("SELECT * FROM insegnamenti WHERE docente = '$id' ");

	$insegnamento = mysql_fetch_array($risultati);

		@$_SESSION['id_insegnamento'] = $insegnamento['id'];
		@$_SESSION['nome_insegnamento'] = $insegnamento['nome'];

//
}
// messaggi da far visualizzare per conferma login

//controlli per il reindirizzamento
if (@$_SESSION['role'] == 'studente') {
	$url="studente_home.php";
} elseif (@$_SESSION['role'] == 'docente') {
	$url="docente_home.php";;
} elseif (@$_SESSION['role'] == 'admin') {
	$url="admin_home.php";
}

 		echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti $username login effettuato con successo.</b><p>&nbsp;</p><a href='$url'><input id='button' type='submit' alt='area riservata' value='area riservata'/></a><p>&nbsp;</p><a href='index.php'><input id='button' type='submit' alt='home page' value='home page'/></a><p>&nbsp;</p><a href='authentication.php?check=logout'><input id='button' type='submit' alt='logout' value='logout'/></a>";
}

else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Username o password sbagliati</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Username o password mancanti.</b>";

}

}
?>
<?php
/*registrazione*/
// attraverso un if controlliamo che il form sia stato inviato

if ( @$_GET['check'] == "registrazione" ) {

// recuperiamo i dati inviati con il form
$nome = ucwords($_POST['nome']);

$cognome = ucwords($_POST['cognome']);

$corso = ucwords($_POST['corso']);

$email = $_POST['email'];

$password = $_POST['password'];

$controllo_pass = $_POST['controllo_pass'];

// ora controlliamo che i campi siano stati tutti compilati

if ( $nome == TRUE && $cognome == TRUE && $corso == TRUE && $password == TRUE && $controllo_pass == TRUE )  {

// controlliamo se l'mail è presente già nel database

$sql = mysql_query("SELECT * FROM studenti WHERE email = '$email'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

$num = null;

$username = strtolower (substr($nome, 0, 2));
$username .= ".";
$username .= strtolower ($cognome);
$username .= rand(0,99); 

// controlliamo se il nome utente generato è presente già nel database

$sql = mysql_query("SELECT * FROM studenti WHERE username = '$username'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

// ora controlliamo che le password inserite siano identiche

if ( $password == $controllo_pass ) {

$nome = mysql_real_escape_string($nome);
$cognome = mysql_real_escape_string($cognome);
$dipartimento = mysql_real_escape_string($dipartimento);
$corso = mysql_real_escape_string($corso);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// infine criptiamo la password con md5
$crypt_pass = md5($password);

mysql_query("INSERT INTO studenti
             (id, role, nome, cognome, corso, via, civico, citta, provincia, cap, email, username, password, data )
             VALUES
             ('', '', '$nome', '$cognome', '$corso', '', '', '', '', '', '$email', '$username', '$crypt_pass', CURRENT_TIMESTAMP )") OR DIE(mysql_error());

// e inviamo una mail con la riuscita registazione

mail ($mail, "Registrazione OK", "Complimenti registrazione presso il portale amm 15 effettuata con successo.<br />Ricordiamo che le credeziali di accesso sono:<br />Nome utente:$username<br />Password:$password<br /><br />In caso smarriate una delle tue vi invitiamo a contattare l'amministratore.", "From: registrazioni@amm15.net");

// messaggi da far visualizzare all'utente finale

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti registrazione effettuata con successo.</b><br />Il tuo nome utente per l'accesso è <b>$username</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Le password non corrispondono</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Nome utente già utilizzato.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Indirizzo email già utilizzato.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.";

}

}

?>
<?php
/*registrazione*/
// attraverso un if controlliamo che il form sia stato inviato
	if ( @$_GET['check'] == "logout" ) {
//Distruggo la vecchia sessione		
	session_unset();
	session_destroy();
//Apro una nuova sessione	
	session_start();
	echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Logout effettuato con successo.</b><p>&nbsp;</p><a href='index.php'><input id='button' type='submit' alt='home page' value='home page'/></a><p>&nbsp;</p><a href='index.php?page=login'><input id='button' type='submit' alt='login' value='login'/></a>";
}
?>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>Ricerca sul portale amm15</p>
  </rside>
<?php include 'include/footer.htm'; ?>
  <!-- end .container --></div>
</body>
</html>
