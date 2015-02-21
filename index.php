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
	'login'=>'<page class="content">
    <section>
     <h2>Login</h2>
      <p>
<form action="authentication.php?check=login" method="post">

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
	
	'registrazione'=>'',
	
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

    $pagine_2 = array(
	'area'=> '',
	'anagrafica'=> '',
	'libretto'=> '',
	'esami'=> '');
	
	$pagine_3 = array(
	'area'=> '',
	'anagrafica'=> '',
	'apelli'=> '',
	'registra'=> '',
	'elenco'=> '');
	
	$pagine_4 = array(
	'area'=> '',
	'studenti'=> '',
	'docenti'=> '',
	'appelli'=> '',
	'registrazione'=> '',
	'elenco'=> '',
	'dipartimenti'=> '');

	$page = $_GET['page'];	
	$studente = $_GET['studente'];
	$docente = $_GET['docente'];
	$admin = $_GET['admin'];

	
	echo $pagine[$page] ;
	echo $pagine_2[$studente] ;
	echo $pagine_3[$docente] ;
	echo $pagine_4[$admin] ;
	
	}
?>
<?php
//page registrazione gestita in modo di verso perchè il php non è ricorsivo e nella pagina uso altri echo
if ($_GET['page'] == "registrazione" ) {
?>
<page class="content">
	<section>
     <h2>Registrazione</h2>
      <p>
<form action="authentication.php?check=registrazione" method="post" name="registrazione">

	<p><b>Nome</b><br />
	<input type="text" name="nome"/>
	</p>
    
	<p><b>Cognome</b><br />
	<input type="text" name="cognome"/>
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

                echo "<option value='$id_corso'>$cognome $nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
	</p>
      
	<p><b>Email</b><br />
	<input type="email" name="email"/>
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
