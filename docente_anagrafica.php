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
@$_SESSION['ricevimento_edit'] = '';// includiamo il file di connessione al database
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
<script type="text/javascript">
var zero = new Array("Seleziona un dipartimento");
var uno = new Array("Seleziona un corso", "Architettura", "Ingegneria delle telecomunicazioni", "Ingegneria ambientale");
var due = new Array("Seleziona un corso", "Professioni sanitarie", "Medicina e chirurgia", "Odontoiatria");
var tre = new Array("Seleziona un corso", "Fisica", "Informatica", "Matematica");

function set_corso() {
  var select_dipartimento = document.modifica.dipartimento;
  var select_corso = document.modifica.corso;
  var selected_dipartimento = select_dipartimento.options[select_dipartimento.selectedIndex].value;

  select_corso.options.length=0;
  if (selected_dipartimento == "Seleziona un dipartimento"){
    for(var i=0; i<zero.length; i++)
    select_corso.options[select_corso.options.length] = new Option(zero[i]);
  }
    if (selected_dipartimento == "Ingegneria e architettura"){
    for(var i=0; i<uno.length; i++)
    select_corso.options[select_corso.options.length] = new Option(uno[i]);
  }
  if (selected_dipartimento == "Medicina e chirurgia"){
    for(var i=0; i<due.length; i++)
    select_corso.options[select_corso.options.length] = new Option(due[i]);
  }
    if (selected_dipartimento == "Scienze"){
    for(var i=0; i<tre.length; i++)
    select_corso.options[select_corso.options.length] = new Option(tre[i]);
  }

}</script>
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
if (@$_SESSION['login'] == "Yes" && @$_SESSION['role'] == 'docente') {
?>
  <page class="content">
    <section>
     <h2 class="icona" id="anagrafica-m">Dati personali</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? echo @$_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? echo @$_SESSION['cognome'] ?></p>
      <p><strong>Insegnamento: </strong> <? echo @$_SESSION['insegnamento_nome'] ?></p>
      <hr width="100%" size="2" color="1c345a">
        <h3>Indirizzo</h3>
            <form method="post" action="<? $url ?>?edit=indirizzo">
            <p><b>Dipartimento</b><br />
            <select name="dipartimento" onchange="set_corso()">
            <option value="Seleziona un dipartimento" selected>Seleziona un dipartimento</option>
            <option value="Ingegneria e architettura">Ingegneria e architettura</option>
            <option value="Medicina e chirurgia">Medicina e chirurgia</option>
            <option value="Scienze">Scienze</option>
            </select>
            </p>
            <p><b>Corso</b><br />
            <select name="corso">
            <option value="Seleziona un dipartimento" selected>Seleziona un dipartimento</option>
            </select>
            </p>
            </p>
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

$id_docente=@$_SESSION['id'];
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

mysql_query("UPDATE docenti SET via = '$via', civico = '$civico', citta = '$citta', provincia = '$provincia', cap = '$cap' WHERE id = '$id_docente'") OR DIE(mysql_error());

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
            <p><b>Ricevimento</b><br />
            <input name="ricevimento" type="text" value="<? echo @$_SESSION['ricevimento'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="salva" value="salva"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato
if ( @$_GET['edit'] == "contatti" ) {

$id_docente=@$_SESSION['id'];
// recuperiamo i dati inviati con il form
$email = $_POST['email'];
$ricevimento = $_POST['ricevimento'];

$sql = mysql_query("SELECT * FROM docenti WHERE email = '$email'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

mysql_query("UPDATE docenti SET email = '$email', ricevimento = '$ricevimento' WHERE id = '$id_docente'") OR DIE(mysql_error());

@$_SESSION['email'] = $email;
@$_SESSION['ricevimento'] = $ricevimento;

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

$id_docente=@$_SESSION['id'];
// recuperiamo i dati inviati con il form
$password = $_POST['password'];
$controllo_pass = $_POST['controllo_pass'];

if ( $password == $controllo_pass ) {

$password = mysql_real_escape_string($password);
// infine criptiamo la password con md5
$crypt_pass = md5($password);

mysql_query("UPDATE studenti SET password = '$crypt_pass' WHERE id = '$id_docente'") OR DIE(mysql_error());

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
    <ul><li> Il tuo <strong>indirizzo</strong> del tuo ufficio.</li>
      <li>I tuoi contatti  (<strong>email</strong> e <strong>orario di ricevimento</strong>).</li>
      <li>La tua <strong>password</strong>.</li>
    </ul>
  </rside>
<?
} elseif (@$_SESSION['login'] != "Yes") {

	
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
