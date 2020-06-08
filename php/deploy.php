<?php
echo <<<EOT
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Git Deployment</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
EOT;

$key = 'XXX';
$allowed = false;

if (isset($_GET['key'])) {
    if ($_GET['key'] === $key) {
    	$allowed = true;
    }
}

if (!$allowed) {
	header('HTTP/1.1 403 Forbidden');
 	echo "<span style=\"color: #ff0000\">403 Forbidden</span>\n";
    echo "</pre>\n</body>\n</html>";
    exit;
}

flush();

chdir('..');

$commands = array(
	'echo $PWD',
	'whoami',
	'git status',
	'git pull', 
	'git submodule status',
	'git submodule sync',
    'git submodule update',
);

$output = "\n";

$log = "####### ".date('Y-m-d H:i:s'). " #######\n";

foreach($commands AS $command) {

    $tmp = shell_exec("$command 2>&1");

    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";

    $log  .= "\$ $command\n".trim($tmp)."\n";
}

$log .= "\n";

chdir('php');
file_put_contents('deploy-log.txt', $log, FILE_APPEND);

echo $output; 

?>
</pre>
</body>
</html>