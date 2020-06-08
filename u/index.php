<?php
$password = "XXX";
$salt = "XXX";

if (isset($_COOKIE['PrivatePageLogin'])) {
   if ($_COOKIE['PrivatePageLogin'] == md5($password.$salt)) {
?>
<html>
	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="https://cdn.datatables.net/1.10.9/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<title>Galerie</title>
		<style>.fol::before{content:url(/images/folder.png);}a.share{margin-right: 10px;}a.share:hover{cursor: pointer;}</style>
		<script>
			function eraseCookie(name) { 
				document.cookie = name+'=; Max-Age=-99999999;';
				location.reload();
			}
		</script>
	</head>
	<body>
		<div class="container main_container">
			<h3><b>Galerie - <?php echo getcwd();?><br></b></h3>

			<?php
			    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
			    $base = 1024;
			    $bytes = disk_free_space("/"); 
			    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
			    echo "Freier Speicher: ";
			    echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . ' / ';
			    $bytes = disk_total_space("/");
			    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
			    echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . ' ';
			?>
			<button onclick="eraseCookie('PrivatePageLogin')">Logout</button>
			<br>
					<?php
					$ignore = Array("index.php", "js", "css", ".", "..", "gallery.php", "img", "upload.php");
					$files1 = scandir(".");
					?>
				<br>
				<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th>Dateiname</th>
			                <th>Grö&szlig;e (Bytes)</th>
			                <th>Datum</th>
			                <th>Typ</th>
			            </tr>
			        </thead>
			 
			        <tbody>
			        	<?php foreach($files1 as $file){
			        		if(!in_array($file, $ignore)){?>
			            <tr>
			                <td><a target="_blank" href="<?php echo($file);?>" <?php if(!pathinfo($file, PATHINFO_EXTENSION)){echo "class='fol'";}?>><?php echo($file);?></a><a title="Hier klicken um Datei zu löschen." style="float: right;" target="_blank" href="//hcm-photos-dresden.de/php/delete.php?k=<?php echo "XXX&delete=" . $file; ?>" onClick="reload();"><img src="/images/delico.png" /></a><a title="Hier klicken um link zu kopieren." style="float: right;" onClick='Clip(<?php echo '"'.$file.'"'; ?>);' class="share"><img src="/images/chain.png" /></a></td>
			                <td><?php echo filesize($file);?></td>
			                <td><?php echo date ("d M Y H:i", filemtime($file))?></td>
			                <td><?php echo pathinfo($file, PATHINFO_EXTENSION); if(!pathinfo($file, PATHINFO_EXTENSION)){echo "Ordner";}?></td>
			            </tr>
			            <?php } }?>
			        </tbody>
			    </table>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="/js/jquery.dataTables.min.js"></script>
		<script src="/js/dataTables.bootstrap.min.js"></script>
		<script src="/js/u_main.js"></script>
	</body>
</html>
<?php
      exit;
   } else {
      echo "Bad Cookie.";
      exit;
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
   if ($_POST['keypass'] != $password) {
      echo "Falsches Passwort. <button type='button' onclick='javascript:history.back()'>Zurück</button>";
      exit;
   } else if ($_POST['keypass'] == $password) {
      setcookie('PrivatePageLogin', md5($_POST['keypass'].$salt));
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, you could not be logged in at this time.";
   }
}
?>

<form style="position: fixed;top:50%; left:45%; width:250px;" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
Passwort: <input type="password" name="keypass" id="keypass"/><br/>
<input type="submit" id="submit" value="Login"/>
</form>