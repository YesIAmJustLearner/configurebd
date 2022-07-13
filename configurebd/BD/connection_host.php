<pre>
<?php
if (count($_POST) > 0) :
	$CONNECTION = [];
	$CONNECTION['CONNECTION_BD']['msg_error'] =  "";
    $CONNECTION['CONNECTION_FILE_NAME'] = "connection_bd.ini";
    $servername = filter_input(INPUT_POST, 'host', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $CONNECTION['CONNECTION_BD']['servername'] = !!$servername ? $servername : "";
    $CONNECTION['CONNECTION_BD']['username'] = !!$username ? $username : "";
    $CONNECTION['CONNECTION_BD']['password'] = !!$password ? $password : "";
    $CONNECTION['CONNECTION_BD']['connected'] = false;
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions 
    try {
        $conn = mysqli_connect($servername, $username, $password);
        if (!$conn->connect_error) {
            $CONNECTION['CONNECTION_BD']['connected'] = true;
        }
    } catch (mysqli_sql_exception $e) {
        $CONNECTION['CONNECTION_BD']['msg_error'] =  $e->getMessage();
    }
if ($CONNECTION['CONNECTION_BD']['connected']){

	//$ PHP_EOL + PHP_EOL
        $connection__file_name = $CONNECTION['CONNECTION_FILE_NAME'];

        $connection__file = fopen($connection__file_name, "w") or die("Unable to open file!");
		$Quotes = '"';
		$PHP_EOL = PHP_EOL;
		$text = "host = {$Quotes}$servername{$Quotes}{$PHP_EOL}username ={$Quotes}$username{$Quotes}{$PHP_EOL}password = {$Quotes}$password{$Quotes}{$PHP_EOL}database = {$Quotes}{$Quotes}{$PHP_EOL}";
        fwrite($connection__file, $text);
        fclose($connection__file);

        $permission = chmod($connection__file_name, 0777);

}
endif;
header("Location: ../");