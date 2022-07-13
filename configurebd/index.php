<!DOCTYPE html>
      <!--Criador: Jeremias / YesIAmJustLearner-->
  <html>
    <head>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
    <body>
<?php include_once "configurebd.php"; ?>
<?php if ($connection["connected"]): ?>
<div class="row">
    <div class="col m6 push-m3 center">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Banco Cadastrado</span>
        </div>
		</div>
    </div>
  </div>
<?php endif; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>	
    </body>
  </html>
        