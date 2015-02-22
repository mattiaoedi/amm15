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
<?php 
	  if(!$_GET)
{
?>
<page class="content">
    <section>
     <h2>Descrizione portale</h2>
      <p>L&rsquo;applicazione  supporta la registrazione di statini sul web.   La funzionalità di base prevede che un professore possa inserire i dati   relativi all&rsquo;esame sostenuto da uno studente. I dati che devono figurare   per ogni statino sono i seguenti:</p>
      <ul>
        <li>Nome, cognome e matricola dello studente</li>
        <li>Nome e cognome del presidente della commissione</li>
        <li>Nome e cognome di uno o più mebri della commissione (uno o più docenti)</li>
        <li>Il codice, il nome ed il numero di crediti dell&rsquo;insegnamento</li>
        <li>Il voto conseguito<br>
        </li>
      </ul>
      <p>Inoltre, lo studente è in grado di visualizzare il suo libretto direttamente su web.<br>
      Per   supportare la registrazione da parte dei professori dei soli esami che   sono stati assegnati, è presente un amministratore (es. il   direttore del Dipartimento)  in grado di associare gli insegnamenti   ai professori. Un insegnamento è formato da:</p>
      <ul>
        <li>Un titolo</li>
        <li>Un codice</li>
        <li>Un Corso di Laurea di afferenza</li>
        <li>Un numero di crediti</li>
      </ul>
      <p>L&rsquo;applicazione mantiene una anagrafica dei professori e degli studenti, in particolare:</p>
      <ul>
        <li>Nome e Cognome</li>
        <li>Indirizzo</li>
        <li>Email</li>
      </ul>
      <p>Per i professori, si mantiene anche il Dipartimento di afferenza,   mentre per gli studenti si mantiene il Corso di Laurea, che a sua volta   afferisce ad un Dipartimento. <br>
        Inoltre, è necessario che per ogni   tipologia di utente l&rsquo;applicazione fornisca istruzioni dettagliate sulla   modalità di inserimento dei dati personali (che può essere fatto   direttamente da ogni utente) e sulla visualizzazione di:</p>
      <ul>
        <li>Libretto per gli studenti</li>
        <li>Liste degli esami registrati per i professori, con funzione di ricerca e filtraggio per data ed insegnamento.</li>
      </ul>
      <p>L&rsquo;amminstratore è in grado di accedere a modificare qualsiasi tipo di dato. <br>
        L&rsquo;applicazione   gestisce inoltre la prenotazione degli esami da parte degli studenti:   il docente inserisce una data ed un numero di studenti che possono   sostenere l&rsquo;esame. Lo studente si connette e si iscrive nel caso ci   siano ancora posti. </p>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>Descrizione portale amm15</p>
  </rside>
<?php   
}
else
{
    $pagine = array( 	
	'offerta'=>'<page class="content">
    <section>
     <h2>Offerta formativa</h2>
          <table>
            <caption>
              <strong>Corsi di Laurea </strong>
            </caption>
            <tbody>
              <tr>
                <th>Facoltà</th>
                <th>Tipo Struttura</th>
                <th>Corsi di Laurea</th>
                <th>A</th>
                <th>Sedi</th>
                <th>Durata </th>
                <th>Id</th>
              </tr>
              <tr>
                <td>INGEGNERIA E ARCHITETTURA </td>
                <td>Facoltà</td>
                <td>ARCHITETTURA</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-1</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>INGEGNERIA DELLE TELECOMUNICAZIONI</td>
                <td>L</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-2</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>INGEGNERIA AMBIENTALE</td>
                <td>L</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-3</td>
              </tr>
              <tr>
                <td>MEDICINA E CHIRURGIA</td>
                <td>Facoltà</td>
                <td>PROFESSIONI SANITARIE</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-4</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>MEDICINA E CHIRURGIA</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>6</td>
                <td>L-5</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>ODONTOIATRIA</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>6</td>
                <td>L-6</td>
              </tr>
              <tr>
                <td>SCIENZE</td>
                <td>Facoltà</td>
                <td>FISICA</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-7</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>INFORMATICA</td>
                <td>P</td>
                <td>Cagliari </td>
                <td>3</td>
                <td>L-8</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>MATEMATICA</td>
                <td>P</td>
                <td>Cagliari</td>
                <td>3</td>
                <td>L-9</td>
              </tr>
            </tbody>
          </table>
      <p>&nbsp;</p>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Leggenda</h2>
      <dl>
		<dt> <strong>Durata:</strong></dt>
        <dd>La sezione durata è espressa in anni</dd>
		<dt> <strong>Tabella "A":</strong></dt>
        <dd>La sezione A sta per tipo di accesso</dd>
        <dt> <strong>Accesso "P":</strong></dt>
        <dd>Corso ad accesso non libero, con superamento di prova concorsuale</dd>
        <dt> <strong>Accesso "L":</strong></dt>
        <dd>Corso ad accesso libero</dd>
        <dt> <strong>Accesso "N":</strong></dt>
        <dd>Immatricolazione non più consentita</dd>
        <dt> <strong>Accesso "T":</strong></dt>
        <dd>Corso con test non selettivi</dd>
        <dt> <strong>Accesso "X":</strong></dt>
        <dd>Tipologia di accesso non definita per anni accademici diversi da quello corrente</dd>
      </dl>
    <p>&nbsp;</p>
  </rside>',
	
	'ricerca'=>'<page class="content">
	<section>
     <h2>Ricerca</h2>
      <p></p>
	      </section>
  <!-- end .content --></page>
    <rside>
    <h2>Informazioni</h2>
    <p>Ricerca nel portale amm15</p>
  </rside>');

	if (isset($_GET['page']))
	$page = $_GET['page'];	
	
	if (isset($pagine))
	echo $pagine[$page] ;
	
	}
?>
<?php
if ( isset($_GET['page']) && $_GET['page'] == "login" ) {
$get_url = $_SERVER['REQUEST_URI'];	
?>
	'login'=>'<page class="content">
    <section>
     <h2>Login</h2>
      <p>
<form action="'<? echo $get_url ?>'&check=login" method="post">

	<p><b>Nome Utente</b><br />
	<input type="text" name="username" id="username"/>
	</p>
   
	<p><b>Password</b><br />
	<input type="password" name="password" id="password"/>
	</p>
  
	<p>
	<input id="button" type="submit" alt="login" value="login"/>
	<br />
	</p>

</form>
</p>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>Accesso al portale amm15</p>
  </rside>',
<?php
}
?>
<?php
/*login*/
// attraverso un if controlliamo che il form sia stato inviato
if ( isset($_GET['check']) && $_GET['check'] == "login" ) {

// recuperiamo i dati inviati con il form
$username = $_POST['username'];
$password = $_POST['password'];

// ora controlliamo che i campi siano stati tutti compilati

if ( $username == TRUE && $password == TRUE)  {

$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);	
$crypt_pass = md5($password);

$risultati = mysql_query("SELECT * FROM studenti WHERE username = '$username' AND password = '$crypt_pass'") OR DIE(mysql_error());

$studente = mysql_fetch_array($risultati);

$nums = mysql_num_rows($risultati);

$risultati = mysql_query("SELECT * FROM docenti WHERE username = '$username' AND password = '$crypt_pass'");

$docente = mysql_fetch_array($risultati);

$numd = mysql_num_rows($risultati);

if ( ($nums == 1) || ($numd == 1)) {
		session_start();
if ( $nums == 1) {		
		@$_SESSION['login'] = "yes";
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
	$risultati = mysql_query("SELECT dipartimento FROM corsi WHERE id = '$corso' ");
	$diparimento = mysql_fetch_array($risultati);
	$num = mysql_num_rows($risultati);

	if ( $num == 1) {
	$id_dipartimento = $diparimento['id'];
	$risultati = mysql_query("SELECT id, nome FROM corsi WHERE id = '$id_dipartimento' ") OR DIE(mysql_error());
	$diparimento = mysql_fetch_array($risultati);

		@$_SESSION['diparimento'] = $diparimento['id'];
		@$_SESSION['nome_diparimento'] = $diparimento['nome'];
		header("Location: studente_home.php");
	}		
} else {

		@$_SESSION['login'] = "yes";
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
	$num = mysql_num_rows($risultati);

	if ( $num == 1) {
		@$_SESSION['id_insegnamento'] = $insegnamento['id'];
		@$_SESSION['nome_insegnamento'] = $insegnamento['nome'];
	}

//reindirizzamento
    if ($docente['role'] = "docente") {
		
	header("Location: docente_home.php");	
	
	} elseif ($docente['role'] = "admin") {
		
	header("Location: admin_home.php");	
	}
}

// messaggi da far visualizzare per conferma login

 		echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti $username login effettuato con successo.</b><p>&nbsp;</p></a>";
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
//page registrazione gestita in modo di verso perchè il php non è ricorsivo e nella pagina uso altri echo
if (  isset($_GET['page']) && $_GET['page'] == "registrazione" ) {
$get_url = $_SERVER['REQUEST_URI'];	
?>
<page class="content">
	<section>
     <h2>Registrazione</h2>
      <p>
<form action="<? echo $get_url ?>&check=registrazione" method="post" name="registrazione">

	<p><b>Nome</b><br />
	<input type="text" name="nome" value="<? if (isset($_SESSION['nome_reg'])) echo $_SESSION['nome_reg'];?>"/>
	</p>
    
	<p><b>Cognome</b><br />
	<input type="text" value="<? if (isset($_SESSION['cognome_reg'])) echo $_SESSION['cognome_reg'];?>"/>
	</p>
    
	<p><b>Corso</b><br />
                    <select name="corso">
                    <option value="" selected>Seleziona un corso</option>
            <?php
                        
            $corso = mysql_query("SELECT id, nome FROM corsi ORDER BY id");
            $num = mysql_num_rows($corso);
			
			$i=0;
            while ($i < $num) {
			
			$id_corso = mysql_result($corso,$i,'id');
            $nome = mysql_result($corso,$i,'nome');

			if ( $id_corso == $_SESSION['corso_reg'] ) {
				
                echo "<option value='$id_corso'selected >$nome</option>";
				
			} else {
				
				echo "<option value='$id_corso'>$nome</option>";
				
			}
				
            $i++;
			
            }
                
            ?>
        </select>
	</p>
      
	<p><b>Email</b><br />
	<input type="email" name="email" value="<? if (isset($_SESSION['email_reg'])) echo $_SESSION['email_reg'];?>"/>
	</p>
    
	<p><b>Password</b><br />
	<input type="password" name="password"/>
	</p>
    
	<p><b>Ripeti Password</b><br />
	<input type="password" name="controllo_pass"/>
	</p>

	<p>
	<input id="button" type="submit" alt="completa registrazione" value="completa registrazione"/>
	<br />
	</p>

</form>

<?php
/*registrazione*/
//attraverso un if controlliamo che il form sia stato inviato
if (  isset($_GET['check']) && $_GET['check'] == "registrazione" ) {

//recuperiamo i dati inviati con il form
if (isset($_POST['nome'])) {
$nome = $_POST['nome'];
$_SESSION['nome_reg'] = $_POST['nome']; }
else $nome ="";
if (isset($_POST['cognome'])) {
$cognome = $_POST['cognome'];
$_SESSION['cognome_reg'] = $_POST['cognome']; }
else $cognome ="";
if (isset($_POST['corso'])) {
$corso = $_POST['corso'];
$_SESSION['corso_reg'] = ucwords($_POST['corso']); }
else $corso ="";
if (isset($_POST['email'])) {
$email = $_POST['email'];
$_SESSION['email_reg'] = $_POST['email']; }
else $email ="";
if (isset($_POST['password']))
$password = $_POST['password'];
else $password ="";
if (isset($_POST['controllo_pass']))
$controllo_pass = $_POST['controllo_pass'];
else $controllo_pass ="";

//ora controlliamo che i campi siano stati tutti compilati
if ( $nome  && $cognome == TRUE && $corso == TRUE && $password == TRUE && $controllo_pass == TRUE )  {

//controlliamo se l'mail è presente già nel database
$sql = mysql_query("SELECT * FROM studenti WHERE email = '$email'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

$num = null;

$username = strtolower (substr($nome, 0, 2));
$username .= ".";
$username .= strtolower ($cognome);
$username .= rand(0,99); 

//controlliamo se il nome utente generato è presente già nel database

$sql = mysql_query("SELECT * FROM studenti WHERE username = '$username'");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

//ora controlliamo che le password inserite siano identiche

if ( $password == $controllo_pass ) {

$nome = mysql_real_escape_string($nome);
$cognome = mysql_real_escape_string($cognome);
$corso = mysql_real_escape_string($corso);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
//infine criptiamo la password con md5
$crypt_pass = md5($password);

mysql_query("INSERT INTO studenti
             (id, role, nome, cognome, corso, via, civico, citta, provincia, cap, email, username, password, data )
             VALUES
             ('', 'studente', '$nome', '$cognome', '$corso', '', '', '', '', '', '$email', '$username', '$crypt_pass', CURRENT_TIMESTAMP )") OR DIE(mysql_error());

//inviamo una mail con la riuscita registazione FUNZIONE NON ATTIVA
@mail ($mail, "Registrazione OK", "Complimenti registrazione presso il portale amm 15 effettuata con successo.<br />Ricordiamo che le credeziali di accesso sono:<br />Nome utente:$username<br />Password:$password<br /><br />In caso smarriate una delle tue vi invitiamo a contattare l'amministratore.", "From: registrazioni@amm15.net");


echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;'/><b>Complimenti registrazione effettuata con successo.</b><br />Il tuo nome utente per l'accesso è <b>$username</b>.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Le password non corrispondono.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;'/><b>Nome utente già utilizzato.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;'/><b>Indirizzo email già utilizzato.";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;'/><b>Tutti i campi sono obbligatori.";

}

}

?>

</p>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>Registrazione al portale amm15</p>
  </rside>
 <?php
}
?>
<?php include 'include/footer.htm'; ?>
  <!-- end .container --></div>
</body>
</html>
