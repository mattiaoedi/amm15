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

if ( (isset($_GET['edit']) && ($_GET['edit'] == "dipartimento")) ||  (isset($_GET['edit']) && ($_GET['edit'] == "corso")) || (isset($_GET['edit']) && ($_GET['edit'] == "insegnamento")) || (isset($_GET['add']) && ($_GET['add'] == "dipartimento")) ||  (isset($_GET['add']) && ($_GET['add'] == "corso")) || (isset($_GET['add']) && ($_GET['add'] == "insegnamento"))) {
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
     <h2 class="icona" id="quadro-m">Dipartimenti e corsi di laurea</h2>
      <p>&nbsp;</p>
      <p><strong>Nome: </strong> <? if (isset($_SESSION['nome']) ) echo $_SESSION['nome'] ?></p>
      <p><strong>Cognome: </strong> <? if (isset($_SESSION['cognome']) ) echo $_SESSION['cognome'] ?></p>
      <p><strong>Gestione come amministratore</strong></p>
          <hr width="100%" size="2" color="1c345a">
        <h3>Dipartimenti</h3>
        <form method="post" action="<? echo $url ?>?show=dipartimento">
        <p><b></b><br />
                    <select name="dipartimento">
                    <option value="Seleziona un dipartimento" selected>Seleziona un dipartimento</option>
            <?php
                        
            $dipartimento = mysql_query("SELECT * FROM dipartimenti ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($dipartimento);
			
			$i=0;
            while ($i < $num) {
			
			$id_dipartimento = mysql_result($dipartimento,$i,'id');
            $nome = mysql_result($dipartimento,$i,'nome');
			
                echo "<option value='$id_dipartimento'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
        <br></p>
        <p><input id="button" type="submit" alt="visualliza" value="visualliza"/>
            <br/></p>
        </form>
        <?php
//attraverso un while controlloriamo che il $id abbiamo un valore id valido

			$dipartimento = mysql_query("SELECT id FROM dipartimenti ORDER BY id") OR DIE(mysql_error()); 
			$num = mysql_num_rows($corso);
			
			$i=0;
            while ($i < $num) {
			
			if ( $id_dipartimento == (mysql_result($dipartimento,$i,'id')) ) {
				
				$id_dipartimento = $_SESSION['id_dipartimento'];
				
				}
				
            $i++;
			
            }
?>        
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['show']) && $_GET['show'] == "dipartimento" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	
$id_dipartimento = $_POST['dipartimento'];
$_SESSION['id_dipartimento'] = $id_dipartimento;
$risultati = mysql_query("SELECT * FROM dipartimenti WHERE id = '$id_dipartimento' ORDER BY id");
$dipartimento = mysql_fetch_array($risultati);
$echo_dipartimento_nome = $dipartimento["nome"];
?>   
<form method="post" action="<? echo $get_url ?>&edit=dipartimento">
      <p><b>Nome</b><br />
        <input type="text" name="nome" value="<? echo $echo_dipartimento_nome ?>"/>
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="modifica" value="modifica">
        <br />
      </p>
    </form>   
<?php
}
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['edit']) && $_GET['edit'] == "dipartimento" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	

$nome_dipartimento = $_POST['nome'];

if ( $nome_dipartimento == TRUE ) {

$nome_insegnamento = mysql_real_escape_string($nome_insegnamento);
$cfu = mysql_real_escape_string($cfu);

mysql_query("UPDATE dipartimenti SET nome = '$nome_dipartimento' WHERE id ='$id_dipartimento'") OR DIE(mysql_error());

$_SESSION['id_dipartimento'] = '';

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}

}
	?>          
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
        <h3>Corsi</h3>
                <form method="post" action="<? echo $url ?>?show=corso">
        <p><b></b><br />
                    <select name="corso">
                    <option value="Seleziona un corso" selected>Seleziona un corso</option>
            <?php
                        
            $corso = mysql_query("SELECT * FROM corsi ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($corso);
			
			$i=0;
            while ($i < $num) {
			
			$id_corso = mysql_result($corso,$i,'id');
            $nome = mysql_result($corso,$i,'nome');
			
                echo "<option value='$id_corso'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
        <br></p>
        <p><input id="button" type="submit" alt="visualliza" value="visualliza"/>
            <br/></p>
        </form>
<?php
//attraverso un while controlloriamo che il $id abbiamo un valore id valido

			$corso = mysql_query("SELECT id FROM corsi ORDER BY id") OR DIE(mysql_error()); 
			$num = mysql_num_rows($corso);
			
			$i=0;
            while ($i < $num) {
			
			if ( $id_corso == (mysql_result($corso,$i,'id')) ) {
				
				$id_corso = $_SESSION['id_corso'];
				
				}
				
            $i++;
			
            }
?>        
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['show']) && $_GET['show'] == "corso" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	
$id_corso = $_POST['corso'];
$_SESSION['id_corso'] = $id_corso;
$risultati = mysql_query("SELECT * FROM corsi WHERE id = '$id_corso' ORDER BY id") OR DIE(mysql_error());
$corso = mysql_fetch_array($risultati);
$echo_corso_nome = $corso["nome"];
?>   
<form method="post" action="<? echo $get_url ?>&edit=corso">
                     <p><b>Dipartimento</b><br />
                            <select name="dipartimento">
                    <option value="" selected>Seleziona un dipartimento</option>
            <?php
                        
            $dipartimento = mysql_query("SELECT * FROM dipartimenti ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($dipartimento );
			
			$i=0;
            while ($i < $num) {
			
			$id_dipartimento = mysql_result($dipartimento ,$i,'id');
            $nome = mysql_result($dipartimento ,$i,'nome');
			
			$corso = mysql_query("SELECT dipartimento FROM corsi ORDER BY id") OR DIE(mysql_error());
			$dipartimento_corso = mysql_result($corso,$id_corso-1,'dipartimento');
			
			if ( $id_dipartimento == $dipartimento_corso ) {
				
			echo "<option value='$id_dipartimento' selected>$nome</option>";
				
			} else {
			
			echo "<option value='$id_dipartimento'>$nome</option>";
			
			}
				
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
      <p><b>Nome</b><br />
        <input type="text" name="nome" value="<? echo $echo_corso_nome?>"/>
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="modifica" value="modifica">
        <br />
      </p>
    </form>   
<?php
}
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['edit']) && $_GET['edit'] == "corso" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	

$dipartimento_corso = $_POST['dipartimento'];
$nome_corso = $_POST['nome'];

if ( ($dipartimento_corso == TRUE) &&  ($nome_corso == TRUE)) {

$nome_insegnamento = mysql_real_escape_string($nome_insegnamento);
$cfu = mysql_real_escape_string($cfu);

mysql_query("UPDATE insegnamenti SET nome = '$nome_corso', dipartimento = '$dipartimento_corso' WHERE id = 'id_corso'") OR DIE(mysql_error());

$_SESSION['id_corso'] = '';

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}

}
	?>   
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
        <h3>Insegnamenti</h3>
                        <form method="post" action="<? echo $url ?>?show=insegnamento">
        <p><b></b><br />
                    <select name="insegnamento">
                    <option value="Seleziona un insegnamento" selected>Seleziona un insegnamento</option>
            <?php
                        
            $insegnamento = mysql_query("SELECT * FROM insegnamenti ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($insegnamento);
			
			$i=0;
            while ($i < $num) {
			
			$id_insegnamento = mysql_result($insegnamento,$i,'id');
            $nome = mysql_result($insegnamento,$i,'nome');
			
                echo "<option value='$id_insegnamento'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
        <br></p>
        <p><input id="button" type="submit" alt="visualliza" value="visualliza"/>
            <br/></p>
        </form>
<?php
//attraverso un while controlloriamo che il $id abbiamo un valore id valido

			$insegnamentio = mysql_query("SELECT id FROM insegnamenti ORDER BY id") OR DIE(mysql_error()); 
			$num = mysql_num_rows($insegnamento);
			
			$i=0;
            while ($i < $num) {
			
			if ( $id_insegnamento == (mysql_result($insegnamento,$i,'id')) ) {
				
				$id_insegnamento = @$_SESSION['id_insegnamento'];
				
				}
				
            $i++;
			
            }
?>        
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['show']) && $_GET['show'] == "insegnamento" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	
$id_insegnamento = $_POST['insegnamento'];
$_SESSION['id_insegnamento'] = $id_insegnamento;
$risultati = mysql_query("SELECT * FROM insegnamenti WHERE id = '$id_insegnamento' ORDER BY id") OR DIE(mysql_error());
$insegnamento = mysql_fetch_array($risultati);
$echo_insegnamento_nome = $insegnamento["nome"];
$echo_insegnamento_cfu = $insegnamento["crediti"];
?>   
<form method="post" action="<? echo $get_url ?>&edit=insegnamento">
             <p><b>Corso</b><br />
                            <select name="corso">
                    <option value="" selected>Seleziona un corso</option>
            <?php
                        
            $corso = mysql_query("SELECT * FROM corsi ORDER BY id");
            $num = mysql_num_rows($corso );
			
			$i=0;
            while ($i < $num) {
			
			$id_corso = mysql_result($corso ,$i,'id');
            $nome = mysql_result($corso ,$i,'nome');
			
			$insegnamento = mysql_query("SELECT corso FROM insegnamenti ORDER BY id") OR DIE(mysql_error());
			$corso_insegnamento = mysql_result($insegnamento,$id_insegnamento-1,'corso');
			
			if ( $id_corso == $corso_insegnamento ) {
				
			echo "<option value='$id_corso' selected>$nome</option>";
				
			} else {
			
			echo "<option value='$id_corso'>$nome</option>";
			
			}
			
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
                     <p><b>Docente</b><br />
                            <select name="docente">
                    <option value="" selected>Seleziona un docente</option>
            <?php
                        
            $docente = mysql_query("SELECT * FROM docenti ORDER BY cognome") OR DIE(mysql_error());
            $num = mysql_num_rows($docente );
			
			$i=0;
            while ($i < $num) {
			
			$id_docente = mysql_result($docente ,$i,'id');
            $nome = mysql_result($docente ,$i,'nome');
			$cognome = mysql_result($docente ,$i,'cognome');
			
			$insegnamento = mysql_query("SELECT docente FROM insegnamenti ORDER BY id") OR DIE(mysql_error());
			$docente_insegnamento = mysql_result($insegnamento,$id_insegnamento-1,'docente');
			
			if ( $id_docente == $docente_insegnamento ) {

				echo "<option value='$id_docente' selected>$cognome $nome</option>";
				
			} else {
				
                echo "<option value='$id_docente'>$cognome $nome</option>";
				
			}
				
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
      <p><b>Nome</b><br />
        <input type="text" name="nome" value="<? echo $echo_insegnamento_nome ?>"/>
        <br>
        </p>
              <p><b>CFU</b><br />
        <input type="text" name="cfu" value="<? echo $echo_insegnamento_cfu ?>"/>
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="modifica" value="modifica">
        <br />
      </p>
    </form>   
<?php
}
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['edit']) && $_GET['edit'] == "insegnamento" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	

$corso_insegnamento = $_POST['corso_insegnamento'];
$docente_insegnamento = $_POST['docente_insegnamento'];
$nome_insegnamento = $_POST['nome_insegnamento'];
$cfu_insegnamento = $_POST['cfu_insegnamento'];

if ( ($corso_insegnamento == TRUE) &&  ($docente_insegnamento == TRUE) &&  ($nome_insegnamento == TRUE) &&  ($cfu_insegnamento == TRUE)) {

$nome_insegnamento = mysql_real_escape_string($nome_insegnamento);
$cfu = mysql_real_escape_string($cfu);

mysql_query("UPDATE SET insegnamenti nome = '$nome_insegnamento', corso = '$corso_insegnamento', docente = '$docente_insegnamento', cfu = '$cfu_insegnamento' WHERE id = 'id_insegnamento'") OR DIE(mysql_error());

$_SESSION['id_insegnamento'] = '';

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti modifica effettuata con successo.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}

}
	?> 
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
        <h3>Aggiungi dipartimento</h3>
        <form method="post" action="<? echo $get_url ?>&add=dipartimento">
      <p><b>Nome</b><br />
        <input type="text" name="nome_dipartimento" />
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="aggiungi" value="aggiungi">
        <br />
      </p>
    </form>
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['add']) && $_GET['add'] == "dipartimento" ) {

$get_url = $_SERVER['REQUEST_URI'];

$nome_dipartimento = $_POST['nome_dipartimento'];

if ( $nome_dipartimento == TRUE ) {

$nome_dipartimento = mysql_real_escape_string($nome_dipartimento);

mysql_query("INSERT INTO dipartimenti
             (id, nome )
             VALUES
             ('', '$nome_dipartimento' )") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti dipartimento aggiunto con successo.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}

}
	?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
        <h3>Aggiungi corso</h3>
                <form method="post" action="<? echo $url ?>?add=corso">
             <p><b>Dipartimento del nuovo corso</b><br />
                            <select name="dipartimento_corso">
                    <option value="Seleziona un dipartimento" selected>Seleziona un dipartimento</option>
            <?php
                        
            $dipartimento = mysql_query("SELECT * FROM dipartimenti ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($dipartimento);
			
			$i=0;
            while ($i < $num) {
			
			$id_dipartimento = mysql_result($dipartimento,$i,'id');
            $nome = mysql_result($dipartimento,$i,'nome');
			
                echo "<option value='$id_dipartimento'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
      <p><b>Nome</b><br />
        <input type="text" name="nome_corso" />
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="aggiungi" value="aggiungi">
        <br />
      </p>
    </form>
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['add']) && $_GET['add'] == "corso" ) {

$get_url = $_SERVER['REQUEST_URI'];

$dipartimento_corso = $_POST['dipartimento_corso'];
$nome_corso = $_POST['nome_corso'];

if ( ($dipartimento_corso == TRUE) &&  ($nome_corso == TRUE)) {

$nome_dipartimento = mysql_real_escape_string($nome_dipartimento);

mysql_query("INSERT INTO corsi
             (id, nome, dipartimento )
             VALUES
             ('', '$nome_corso', '$dipartimento_corso' )") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti corso aggiunto con successo.";

} else {

echo "<img src='files/img/no.png' width='32' height='32' alt='no' style='vertical-align:middle;' /><b>Tutti i campi sono obbligatori.</b>";

}

}
	?>
            <p>&nbsp;</p>
            <hr width="100%" size="2" color="1c345a">
        <h3>Aggiungi insegnamento</h3>
                <form method="post" action="<? echo $url ?>?add=insegnamento">
             <p><b>Corso del nuovo insegnamento</b><br />
                            <select name="corso_insegnamento">
                    <option value="Seleziona un dipartimento" selected>Seleziona un corso</option>
            <?php
                        
            $corso = mysql_query("SELECT * FROM corsi ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($corso );
			
			$i=0;
            while ($i < $num) {
			
			$id_corso = mysql_result($corso ,$i,'id');
            $nome = mysql_result($corso ,$i,'nome');
			
                echo "<option value='$id_corso'>$nome</option>";
				
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
                     <p><b>Docente del nuovo insegnamento</b><br />
                            <select name="docente_insegnamento">
                    <option value="Seleziona un dipartimento" selected>Seleziona un docente</option>
            <?php
                        
            $docente = mysql_query("SELECT * FROM docenti ORDER BY cognome") OR DIE(mysql_error());
            $num = mysql_num_rows($corso );
			
			$i=0;
            while ($i < $num) {
			
			$id_docente = mysql_result($docente ,$i,'id');
            $nome = mysql_result($docente ,$i,'nome');
			$cognome = mysql_result($docente ,$i,'cognome');
			
            $corso = mysql_query("SELECT * FROM corsi WHERE docente = 'id_docente' ORDER BY id") OR DIE(mysql_error());
            $num = mysql_num_rows($corso );
			
			if ( $num == 1) {
			} else {
                echo "<option value='$id_docente'>$cognome $nome</option>";
			}
				
            $i++;
			
            }
                
            ?>
        </select>
                <br>
        </p>
      <p><b>Nome</b><br />
        <input type="text" name="nome_insegnamento" />
        <br>
        </p>
              <p><b>CFU</b><br />
        <input type="text" name="cfu_insegnamento" />
        <br>
        </p>
      <p>
        <input id="button" type="submit" alt="aggiungi" value="aggiungi">
        <br />
      </p>
    </form>
<?php
//attraverso un if controlliamo che il form sia stato inviato

if ( isset($_GET['add']) && $_GET['add'] == "insegnamento" ) {
	
$get_url = $_SERVER['REQUEST_URI'];	

$corso_insegnamento = $_POST['corso_insegnamento'];
$docente_insegnamento = $_POST['docente_insegnamento'];
$nome_insegnamento = $_POST['nome_insegnamento'];
$cfu_insegnamento = $_POST['cfu_insegnamento'];

if ( ($corso_insegnamento == TRUE) &&  ($docente_insegnamento == TRUE) &&  ($nome_insegnamento == TRUE) &&  ($cfu_insegnamento == TRUE)) {

$nome_dipartimento = mysql_real_escape_string($nome_dipartimento);

mysql_query("INSERT INTO insegnamenti
             (id, nome, corso, docente ,cfu )
             VALUES
             ('', '$nome_insegnamento', '$corso_insegnamento', '$docente_insegnamento', '$cfu_insegnamento' )") OR DIE(mysql_error());

echo "<img src='files/img/ok.png' width='32' height='32' alt='ok' style='vertical-align:middle;' /><b>Complimenti insegnamento aggiunto con successo.";

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
    <p>In questa sezione è possibile inserire nuovi dipartimenti, nuovi corsi e nuovi insegnamenti. Negli insegnamenti è possibile associare solo docenti senza corso.</p>
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
