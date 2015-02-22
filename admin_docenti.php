<?php
session_start();
if (isset($_SESSION['studente']) )
$_SESSION['studente'] = '';
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

if ( (isset($_GET['show']) && ($_GET['show'] == "docente")) ||  (isset($_GET['edit']) && ($_GET['edit'] == "dati")) || (isset($_GET['edit']) && ($_GET['edit'] == "indirizzo")) || (isset($_GET['edit']) && ($_GET['edit'] == "contatti")) || (isset($_GET['edit']) && ($_GET['edit'] == "password"))) {
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
//controllo admin
if ((isset($_SESSION['login']) && $_SESSION['login'] == "yes") && (isset($_SESSION['role']) && $_SESSION['role'] == "admin") ) {?>
  <page class="content">
    <section>
     <h2 class="icona" id="anagrafica-m">Docenti</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? if (isset($_SESSION['nome']) ) echo $_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? if (isset($_SESSION['cognome']) ) echo $_SESSION['cognome'] ?></p>
      <p><strong>Gestione come amministratore</strong></p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Elenco docenti</h3>
        <form method="post" action="<? $url ?>?show=docente">
        <p><b></b><br />
                    <select name="docente">
                    <option value="Seleziona un docente" selected>Seleziona un docente</option>
            <?php
                        
            $docente = mysql_query("SELECT * FROM docenti ORDER BY cognome");
            $num = mysql_num_rows($docente);
			
			$i=0;
            while ($i < $num) {
			
			$id_docente = mysql_result($docente,$i,'id');
            $nome = mysql_result($docente,$i,'nome');
			$cognome = mysql_result($docente,$i,'cognome');
			
                echo "<option value='$id_docente'>$cognome $nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
        <br></p>
        <p><input id="button" type="submit" alt="visualliza" value="visualliza"/>
            <br/></p>
        </form>
			<p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
<?php
//controllo per riaprire l'anagrafica dopo che premo su un bottone modifica
if( (empty($_POST['docente']) || $_POST['docente'] == '') && ( isset($_SESSION['id_docente'])  &&  $_SESSION['id_docente'] != '') ) {

if ( isset($_SESSION['id_docente']) )	
$id_docente = $_SESSION['id_docente'];
if( isset($_GET['show']) )
{} else
$_GET['show'] = "docente";

}

if ( isset($_GET['show']) && $_GET['show'] == "docente" ) {
	if ( isset($_POST['docente'])) 
	$id_docente = $_POST["docente"];
	$_SESSION['id_docente'] = $id_docente;
	$risultati = mysql_query("SELECT * FROM docenti WHERE id = '$id_docente' ORDER BY cognome");
	$docente = mysql_fetch_array($risultati);
		$_SESSION['id_edit'] = $docente['id'];
		$_SESSION['role_edit'] = $docente['role'];
		$_SESSION['nome_edit'] = $docente['nome'];
		$_SESSION['cognome_edit'] = $docente['cognome'];
		$_SESSION['via_edit'] = $docente['via'];
		$_SESSION['civico_edit'] = $docente['civico'];
		$_SESSION['citta_edit'] = $docente['citta'];
		$_SESSION['provincia_edit'] = $docente['provincia'];
		$_SESSION['cap_edit'] = $docente['cap'];
		$_SESSION['email_edit'] = $docente['email'];
		$_SESSION['ricevimento_edit'] = $docente['ricevimento'];

?>	
                  <h3>Dati</h3>
            <form method="post" action="<? $url ?>?edit=dati">
            <p><b>Matricola</b><br />
            <input name="email" type="text" value="<? if (isset($_SESSION['id_edit']) )  echo $_SESSION['id_edit'] ?>">
            <br></p>            
            <p><b>Nome</b><br />
            <input name="email" type="text" value="<? if (isset($_SESSION['nome_edit']) )  echo $_SESSION['nome_edit'] ?>">
            <br></p>
            <p><b>Cognome</b><br />
            <input name="ricevimento" type="text" value="<? if (isset($_SESSION['cognome_edit']) )  echo $_SESSION['cognome_edit'] ?>">
            <br></p>
            <p><b>Ruolo</b><br />
            <select name="ruolo">
                    <option value="" selected>Seleziona un ruolo</option>
            <?php
			$risultati = mysql_query("SELECT role FROM docenti WHERE id = '$id_docente' ORDER BY id");
			$ruolo_docente=mysql_fetch_array($risultati);
			
			if ( $ruolo_docente["role"] == "admin" ) {
				
			echo "<option value='admin' selected>Admin</option>";
				
			} else {
			
			echo "<option value='admin'>Admin</option>";
			
			}
			if ( $ruolo_docente["role"] == "docente" ) {
				
			echo "<option value='docente' selected>Docente</option>";
				
			} else {
			
			echo "<option value='docente'>Docente</option>";
			}
            ?>
        </select><br /></p>
            <p><b>Dipartimento</b><br />
            <select name="dipartimento">
                    <option value="" selected>Seleziona un dipartimento</option>
            <?php
                        
            $dipartimento = mysql_query("SELECT * FROM dipartimenti ORDER BY id");
            $num = mysql_num_rows($dipartimento );
			
			$i=0;
            while ($i < $num) {
			
			$id_dipartimento = mysql_result($dipartimento ,$i,'id');
            $nome = mysql_result($dipartimento ,$i,'nome');
			
			$docente = mysql_query("SELECT dipartimento FROM docenti ORDER BY id");
			$dipartimento_docente = mysql_result($docente,$id_docente-1,'dipartimento');
			
			if ( $id_dipartimento == $dipartimento_docente ) {
				
			echo "<option value='$id_dipartimento' selected>$nome</option>";
				
			} else {
			
			echo "<option value='$id_dipartimento'>$nome</option>";
			
			}
				
            $i++;
			
            }
                
            ?>
        </select><br /></p>
        <p><b>Corso</b><br />
        <select name="corso">
                    <option value="" selected>Seleziona un corso</option>
            <?php
                        
            $corso = mysql_query("SELECT * FROM corsi ORDER BY id");
            $num = mysql_num_rows($corso);
			
			$i=0;
            while ($i < $num) {
			
			$id_corso = mysql_result($dipartimento ,$i,'id');
            $nome = mysql_result($dipartimento ,$i,'nome');
			
			$docente = mysql_query("SELECT corso FROM docenti ORDER BY id");
			$corso_docente = mysql_result($docente,$id_docente-1,'corso');
			
			if ( $id_corso == $corso_docente ) {
				
			echo "<option value='$id_corso' selected>$nome</option>";
				
			} else {
			
			echo "<option value='$id_corso'>$nome</option>";
			
			}
				
            $i++;
			
            }
                
            ?>
        </select><br /></p>
            <p><input id="button" type="submit" alt="modifca" value="modifca"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if (isset($_GET['edit']) && $_GET['edit'] == "dati" ) {

// recuperiamo i dati inviati con il form
if (isset($_POST['matricola']))
$matricola = $_POST['matricola'];
elseif (isset($_SESSION['id_edit'])) 
$matricola = $_SESSION['id_edit'];
else $matricola='';
if (isset($_POST['nome']))
$nome = $_POST['nome'];
elseif (isset($_SESSION['nome_edit'])) 
$nome = $_SESSION['nome_edit'];
else $nome='';
if (isset($_POST['cognome']))
$cognome = $_POST['cognome'];
elseif (isset($_SESSION['cognome_edit'])) 
$cognome = $_SESSION['cognome_edit'];
else $cognome='';
if (isset($_POST['ruolo']))
$ruolo = $_POST['ruolo'];
elseif (isset($_SESSION['ruolo_edit'])) 
$ruolo = $_SESSION['ruolo_edit'];
else $ruolo='';
if (isset($_POST['dipartimento']))
$dipartimento = $_POST['dipartimento'];
elseif (isset($_SESSION['dipartimento_edit'])) 
$dipartimento = $_SESSION['dipartimento_edit'];
else $dipartimento='';
if (isset($_POST['corso']))
$corso = $_POST['corso'];
elseif (isset($_SESSION['corso_edit'])) 
$corso = $_SESSION['corso_edit'];
else $corso='';

if (isset($_POST['matricola']))
$matricola = mysql_real_escape_string($matricola);
if (isset($_POST['nome']))
$nome = mysql_real_escape_string($nome);
if (isset($_POST['cognome']))
$cognome = mysql_real_escape_string($cognome);
if (isset($_POST['ruolo']))
$ruolo = mysql_real_escape_string($ruolo);
if (isset($_POST['dipartimento']))
$dipartimento = mysql_real_escape_string($dipartimento);
if (isset($_POST['corso']))
$corso = mysql_real_escape_string($corso);

mysql_query("UPDATE docenti SET id = '$matricola', role = '$role', nome = '$nome', cognome = '$cognome', dipartimento ='$dipartimento', corso = '$corso' WHERE id = '$id_docente'") OR DIE(mysql_error());


if ( $id_docente == @$_SESSION['id'] ) {
	
@$_SESSION['matricola'] = $matricola;
@$_SESSION['nome'] = $nome;
@$_SESSION['cognome'] = $cognome;
@$_SESSION['ruolo'] = $ruolo;
@$_SESSION['dipartimento'] = $dipartimento;
@$_SESSION['corso'] = $corso;

}

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";

}
?>
            <p>&nbsp;</p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Indirizzo</h3>
            <form method="post" action="<? $url ?>?edit=indirizzo">
            <p><b>Via o piazza</b><br />
            <input name="via" type="text" value="<? if (isset($_SESSION['via_edit']) )  echo $_SESSION['via_edit'] ?>">
            <br></p>
            <p><b>Numero civico</b><br />
            <input name="civico" type="number" value="<? if (isset($_SESSION['civico_edit']) )  echo $_SESSION['civico_edit'] ?>">
            <br></p>
            <p><b>Città</b><br />
            <input name="citta" type="text" value="<? if (isset($_SESSION['citta_edit']) )  echo $_SESSION['citta_edit'] ?>">
            <br></p>
            <p><b>Provincia</b><br />
            <input name="provincia" type="text" value="<? if (isset($_SESSION['provincia_edit']) )  echo $_SESSION['provincia_edit'] ?>">
            <br></p>
            <p><b>Cap</b><br />
            <input name="cap" type="number" value="<? if (isset($_SESSION['cap_edit']) )  echo $_SESSION['cap_edit'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="modifca" value="modifca"/>
            <br /></p>
            </form>
              <?php
// attraverso un if controlliamo che il form sia stato inviato

if (isset($_GET['edit']) && $_GET['edit'] == "indirizzo" ) {

// recuperiamo i dati inviati con il form

if (isset($_POST['via']))
$via = $_POST['via'];
elseif (isset($_SESSION['via_edit'])) 
$via = $_SESSION['via_edit'];
else $via='';
if (isset($_POST['civico']))
$civico = $_POST['civico'];
elseif (isset($_SESSION['civico_edit'])) 
$civico = $_SESSION['civico_edit'];
else $civico='';
if (isset($_POST['citta']))
$citta = $_POST['citta'];
elseif (isset($_SESSION['citta_edit'])) 
$citta = $_SESSION['citta_edit'];
else $citta='';
if (isset($_POST['provincia']))
$provincia = $_POST['provincia'];
elseif (isset($_SESSION['provincia_edit'])) 
$provincia = $_SESSION['provincia_edit'];
else $provincia='';
if (isset($_POST['cap']))
$cap = $_POST['cap'];
elseif (isset($_SESSION['cap_edit'])) 
$cap = $_SESSION['cap_edit'];
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

mysql_query("UPDATE docenti SET via = '$via', civico = '$civico', citta = '$citta', provincia = '$provincia', cap = '$cap' WHERE id = '$id_docenti'") OR DIE(mysql_error());

if (isset($_SESSION['id']))
if ( $id_docente == @$_SESSION['id'] ) {
	
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
}

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";
}

?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
            <h3>Contatti</h3>
            <form method="post" action="<? $url ?>?edit=contatti">
            <p><b>Email</b><br />
            <input name="email" type="text" value="<? if (isset($_SESSION['email_edit']) )  echo $_SESSION['email_edit'] ?>">
            <br></p>
            <p><b>Ricevimento</b><br />
            <input name="ricevimento" type="text" value="<? if (isset($_SESSION['ricevimento_edit']) )  echo $_SESSION['ricevimento_edit'] ?>">
            <br></p>
            <p><input id="button" type="submit" alt="modifca" value="modifca"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if (isset($_GET['edit']) && $_GET['edit'] == "contatti" ) {

// recuperiamo i dati inviati con il form
if (isset($_POST['email']))
$email = $_POST['email'];
elseif (isset($_SESSION['email_edit'])) 
$email = $_SESSION['email_edit'];
else $email='';
if (isset($_POST['ricevimento']))
$ricevimento = $_POST['ricevimento'];
elseif (isset($_SESSION['ricevimento_edit'])) 
$ricevimento = $_SESSION['ricevimento_edit'];
else $ricevimento='';

$sql = mysql_query("SELECT * FROM docenti WHERE email = '$email'") or die ("Mail già occupata");

$num = mysql_num_rows($sql);

if ( $num == 0 ) {

mysql_query("UPDATE docenti SET email = '$email', ricevimento = '$ricevimento' WHERE id = '$id_docente'") OR DIE(mysql_error());

if (isset($_SESSION['id']))
if ( $id_docente == $_SESSION['id'] ) {
if (isset($_SESSION['email_edit']))
$_SESSION['email_edit'] = $email;
if (isset($_SESSION['ricevimento_edit']))
$_SESSION['ricevimento_edit'] = $ricevimento;
}

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
            <p><input id="button" type="submit" alt="modifca" value="modifca"/>
            <br/></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if (isset($_GET['edit']) && $_GET['edit'] == "password" ) {

// recuperiamo i dati inviati con il form

$password = $_POST['password'];

$controllo_pass = $_POST['controllo_pass'];

if ( $password == $controllo_pass ) {

$password = mysql_real_escape_string($password);
// infine criptiamo la password con md5
$crypt_pass = md5($password);

mysql_query("UPDATE docenti SET password = '$crypt_pass' WHERE id = '$id_docenti'") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Le password non corrispondono</b>";

}
}
?>
<p>&nbsp;</p>
<hr width="100%" size="2" color="1c345a">
<?php

}
			
?>
    </section>
  <!-- end .content --></page>
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi modificare i  dati personali degli studenti.</p>
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
