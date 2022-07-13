<?php 
$connection["connected"] = false;
$connection["status"] = "host";

$servername = "";
$username = "";
$password = "";
$database = "";

if (file_exists("BD/connection_bd.ini")){
    $env = parse_ini_file("BD/connection_bd.ini");
    $servername = $env['host'];
    $username = $env['username'];
    $password = $env['password'];
    $database = $env['database'];
	
	if (conn($servername, $username, $password, $database)){
		if (!$database){
			$connection["status"] = "bd";
		}else{
			$connection["connected"] = true;
		}
	}
}

function conn($servername, $username, $password, $database){
	    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions 
    try {
        $conn = mysqli_connect($servername, $username, $password, $database);
		return !$conn->connect_error;
    } catch (mysqli_sql_exception $e) {
		return false;
    }
}
function listdb($servername, $username, $password){
	    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions 
    try {
        $conn = mysqli_connect($servername, $username, $password);
			$sql = 'SHOW DATABASES';
			$result = $conn->query("SHOW DATABASES");
			$array = [];
			while ($row = $result->fetch_assoc()) {
				array_push($array,$row['Database']);
			}
			return $array;
    } catch (mysqli_sql_exception $e) {
		return "";
    }
}
 ?>
<?php if (!$connection["connected"]): ?>

    <form class="col s12" method="POST" action="BD/<?= $connection["status"]=="host" ? "connection_host" : "connection_bd" ?>.php">
  <div class="row">
    <div class="col m6 push-m3 center">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Conectar Banco</span>

		<div class="row">
      <div class="row">
<?php if ($connection["status"] == "bd"): ?>

<?php foreach (listdb($servername, $username, $password) as $list): ?>
<p>
      <label>
        <input name="database" value="<?= $list ?>" type="radio"/>
        <span><?= $list ?></span>
      </label>
    </p>
<?php endforeach; ?>


		
<?php elseif ($connection["status"] == "host"): ?>
        <div class="input-field col s12">
          <input placeholder="localhost" id="host" name="host" value="<?= $servername ?>" type="text" class="validate">
          <label for="host">Host</label>
        </div>
        <div class="input-field col s12">
          <input id="user" name="user" placeholder="root" type="text" value="<?= $username ?>" class="validate">
          <label for="user">Usuário</label>
        </div>
        <div class="input-field col s12">
          <input id="password" type="password" name="password" placeholder="************" value="<?= $password ?>" class="validate">
          <label for="password">Senha</label>
        </div>
<?php endif; ?>
      </div>
  </div>


        <div class="card-action">
          <button class="btn green">Conectar BD</button>
        </div>
      </div>
    </div>
  </div>
    </form>
<?php endif; ?>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	
    </body>
  </html>
        