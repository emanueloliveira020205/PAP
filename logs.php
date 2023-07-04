<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows >Logs</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>
<?php include "DBConnection.php";?>
<?php include "sessaosegurauser.php";?>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
     
		<?php 
		 if (($_SESSION['tipo']==1)){
		 include'menuadmin.php';}
		 else{
		  include'menuuser.php';}?>
		  
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Histórico de Operações</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Utilizadores</a></div>
              <div class="breadcrumb-item">Logs</div>
            </div>
          </div>

         <!-- <div class="section-body">
            <h2 class="section-title">Tables</h2>
            <p class="section-lead">
				Este espaço serve para Consultar os Animais existentes na Vacaria
            </p>-->

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
			  <form name="listar vaca" action="logs.php" method="post">
                <div class="form-group">
				<?php $qrya="Select * from utilizadores order by coduser"; 
					  $resulta=mysqli_query($link,$qrya); ?>
                      <label>Filtrar por Utilizador</label>
                      <select class="form-control" name="filtro">
					  <option value="todos">Todos</option>
					  <?php while ($fil=mysqli_fetch_array($resulta)){?>
                        <option value="<?php echo $fil['coduser']; ?>"><?php echo $fil['nome']; ?> </option>
					  <?php } ?>
                      </select>
					<button type="submit" class="btn btn-primary btn-lg btn-block" >Listar </button>
                </div>
			  </form>
			  
			<?php if (isset($_POST["filtro"])){
					$filtro=$_POST["filtro"];
			}else{
			$filtro="todos";} ?>
			
			<?php if ($filtro=='todos'){
										$qry = "SELECT logs.idlog, logs.idu, utilizadores.nome, logs.descricao, logs.timestamp 
												FROM logs 
												JOIN utilizadores ON logs.idu = utilizadores.coduser
												ORDER BY logs.timestamp DESC";//join associa o idu da tabela logs ao coduser da tabela utilizadores
										$result = mysqli_query($link, $qry);
										?>

										<div class="card">
											<table class="table table-striped table-dark">
												<thead>
													<tr>
														<th scope="col">IdLog</th>
														<th scope="col">IdUtilizador</th>
														<th scope="col">Nome Utilizador</th>
														<th scope="col">Descrição</th>
														<th scope="col">Data/Hora</th>
													</tr>
												</thead>
												
												<tbody>
													<?php while ($row = mysqli_fetch_array($result)) { ?>
													<tr>
														<td><?php echo $row['idlog']; ?></td>
														<td><?php echo $row['idu']; ?></td>
														<td><?php echo $row['nome']; ?></td>
														<td><?php echo $row['descricao']; ?></td>
														<td><?php echo $row['timestamp']; ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
									</div>
			<?php } else { 
							$qry="SELECT logs.idlog, logs.idu, utilizadores.nome, logs.descricao, logs.timestamp 
												FROM logs 
												JOIN utilizadores ON logs.idu = utilizadores.coduser
												where logs.idu like '$filtro'
												ORDER BY logs.timestamp DESC";
							$result=mysqli_query($link,$qry);
				?>
				<div class="card">
											<table class="table table-striped table-dark">
												<thead>
													<tr>
														<th scope="col">IdLog</th>
														<th scope="col">IdUtilizador</th>
														<th scope="col">Nome Utilizador</th>
														<th scope="col">Descrição</th>
														<th scope="col">Data/Hora</th>
													</tr>
												</thead>
												
												<tbody>
													<?php while ($row = mysqli_fetch_array($result)) { ?>
													<tr>
														<td><?php echo $row['idlog']; ?></td>
														<td><?php echo $row['idu']; ?></td>
														<td><?php echo $row['nome']; ?></td>
														<td><?php echo $row['descricao']; ?></td>
														<td><?php echo $row['timestamp']; ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
									</div>
			<?php } ?>
            </div>
          </div>
        </section>
		
      </div>
      <?php include 'footer.php';?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>