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

if ( isset($_GET['add']) && ($_GET['add'] == "voto")) {
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
if (@$_SESSION['login'] == "Yes" && @$_SESSION['role'] == 'admin') {
?>
  <page class="content">
    <section>
     <h2 class="icona" id="libretto-m">Registra esame</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? echo @$_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? echo @$_SESSION['cognome'] ?></p>
      <p><strong>Gestione come amministratore</strong></p>
      <hr width="100%" size="2" color="1c345a">
        <h3>Registra voto esame</h3>
            <form method="post" action="?add=voto">
            <p><b>Insegnamento</b><br />
                                <select name="insegnamento">
                    <option value="Seleziona un insegnamento" selected>Seleziona un insegnamento</option>
            <?php
                        
            $risultati = mysql_query("SELECT * FROM insegnamenti ORDER BY nome");
			$dati = mysql_fetch_array($risultati);
            $num = mysql_num_rows($risultati);
			
			$i=0;
            while ($i < $num) {
			
			$id_insegnamento=$dati["id"];
            $nome=$dati["nome"];
			
                echo "<option value='$id_insegnamento'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
            <br></p>
            <p><b>Matricola</b><br />
            <input name="matricola" type="number">
            <br></p>
            <p><b>Voto</b><br />
            <input name="voto" type="number">
            <br></p>
            <p><input id="button" type="submit" alt="registra" value="registra"/>
            <br /></p>
            </form>
<?php
// attraverso un if controlliamo che il form sia stato inviato

if ( @$_GET['add'] == "voto" ) {

$id_docente = @$_SESSION['id'];
// recuperiamo i dati inviati con il form
$insegnamento = $_POST['insegnamento'];
$matricola = $_POST['matricola'];
$voto = $_POST['voto'];


if ( $matricola == TRUE && $voto == TRUE && $insegnamento == TRUE){

if ( ($voto >= 18) &&  ($voto <= 31)) {

mysql_query("INSERT INTO esami
             (id, insegnamento, matricola, voto, docente, data )
             VALUES
             ('', '$insegnamento', '$matricola', '$voto', '$id_docente ', CURRENT_TIMESTAMP)") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti registrazione effettuata con successo.</b>";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Voto deve essere compreso tra 18 e 31.</b>";

}

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}
}
?>
			<p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
    </section>
  <!-- end .content --></page> 
  <rside>
    <h2>Informazioni</h2>
    <p>In questa sezione puoi registrare un esame, inserendo i seguenti dati</p>
    <ul>
      <li>Insegnamento</li>
      <li>Matricola dello studente</li>
      <li>Voto</li>
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
