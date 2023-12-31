<!DOCTYPE html>
<?php include'sessaosegurauser.php';?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows ><?php echo $_SESSION['vaca'];?></title>
  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/chocolat/dist/css/chocolat.css">
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/meucss.css">
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

<?php
		$vaca=$_SESSION['vaca'];
		$qry="Select * from vacas where numero ='$vaca' ";
		$result=mysqli_query($link,$qry);
		$row=mysqli_fetch_array($result);
		 $dir = 'imagens_vacas/';
		 $ext= $row['extensao'];
		 $fotoname=$vaca.$ext;
		?>
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
            <h1><?php echo $vaca;?>  <?php  if (($_SESSION['tipo']==1)){
				  $url1 = 'editarvaca.php?'.$vaca; ?>
			  <button onclick="window.location.href='<?php echo $url1; ?>';" class="btn btn-primary" type="submit">Editar</button>
			  <?php }else{}?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Vacas</a></div>
              <div class="breadcrumb-item">Menu Vaca</div>
            </div>
          </div>

          <div class="section-body">
            

            <div class="row">
              <div class="col-12 col-sm-12 col-lg-4">
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card profile-widget">
						<div class="gallery">		  
							<br><img class="gallery-item" data-image="<?php echo $dir.$fotoname;?>" width="100" height="100">
							<div class="profile-widget-items">
							  <div class="profile-widget-item">
								<div class="profile-widget-item-label">DataNascimento</div>
								<div class="profile-widget-item-value"><?php echo $row['datanasc'];?></div>
							  </div>
							  <div class="profile-widget-item">
								<div class="profile-widget-item-label">Idade(anos)</div>
								<div class="profile-widget-item-value"><?php echo calcularIdade($row['datanasc'])?></div>
							  </div>
							  <div class="profile-widget-item">
								<div class="profile-widget-item-label">Estado</div>
								<div class="profile-widget-item-value"><?php if($row['estado']==1){echo "Lactação";}else{echo"Seca";}?></div>
							  </div>
							</div>
						  </div>
						  <div class="profile-widget-description">
							<div class="profile-widget-name"><?php echo $row['especie'];?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $row['pais'];?></div></div>
							<?php echo $row['observ'];?>
						  </div>
						  <div class="card-footer text-center">
							<div class="font-weight-bold mb-2"></div> 
						  </div>
						</div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-body">
					  <form action="registarleite.php" method="POST">
                      <div class="form-group">
                      <label for="leite"><h5>Leite</h5></label><br>
                      <label>Date/Hora</label>
                      <input type="text" class="form-control" value="<?php echo date('Y-m-d H:i:s');?>" name="timestamp">
					  <br>
					  <label>Quantidade(litros)</label>
                      <input id="leite" type="text" class="form-control" name="leite" autofocus>
                    </div>
					  <div class="form-group">
					   <button type="submit" class="btn btn-primary btn-lg btn-block">Inserir</button>
					  </div>
					  </form>
                      </div>
                    </div>
                  </div>
				  
				 <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card">
                      <div class="card-body">
                      <div class="form-group">
                      <label for="leite"><h5>QR-Code</h5></label><br>
					  <br>
					   <img src="qrcode/<?php echo $vaca;?>.svg">
                    </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  
			  
              <div class="col-12 col-sm-6 col-lg-8">
				 <div class="card card-danger">
                  <div class="card-header">
                    <h4>Últimos 7 Dias</h4>
                  </div>
				  <div class="card-body">
				  <div id="curve_chart" style="width: 100%; height: 700"></div>
				  <div class="row">					
				</div>  
				</div>
				
                </div>
			
                   <div class="card card-danger">
                      <div class="card-body">
					  <form action="vaci_add.php" method="POST">
                      <div class="form-group">
                      <label for="vacinacao"><h5>Vacinação</h5></label>
					 <div class="row">
					<div class="form-group col-6">
                      <label>Medicamento</label>
                      <select class="form-control" name="medic">
						<?php $qry=mysqli_query($link,"Select * from medicamentos where ativo=0");  
							while ($row=mysqli_fetch_array($qry)){?>
                        <option><?php echo $row['nome'];?></option>
							<?php }?>
                      </select>
                    </div>
					<div class="form-group col-6">
					<label>Dose</label>
                      <input id="dose" type="text" class="form-control" name="dose" autofocus>
                    </div>
                    </div>
					  <label>Motivo</label>
                      <textarea class="form-control" required="" style="height: 182px;" name="motivo"></textarea>
                    </div>
					  <div class="form-group">
					   <button type="submit" class="btn btn-primary btn-lg btn-block">Inserir</button>
					  </div>
					  </form>
                      </div>
                    </div>
					
				<!-- historico vaci -->	
					<div class="card card-danger">
                      <div class="card-body">
                     
					  <label for="vacinacao"><h5>Histórico de Vacinação</h5></label>
						<?php $qry="Select * from vacinacao where numero=$vaca order by data Desc limit 7";
									$result=mysqli_query($link,$qry);
							$qry="SELECT vacinacao.idm, medicamentos.nome, vacinacao.data, vacinacao.dose, vacinacao.motivo 
												FROM vacinacao 
												JOIN medicamentos ON vacinacao.idm = medicamentos.idm
												where vacinacao.numero=$vaca order by vacinacao.data Desc limit 7";
							$result=mysqli_query($link,$qry);?>

					<div class="table-responsive table-invoice">
                    <table class="table table-striped">

                        <tr>
                          <th scope="col">Medicamento</th>
                          <th scope="col">Data de Administração</th>
                          <th scope="col">Quantidade</th>
                          <th scope="col">Motivo</th>
                        </tr>
					  <?php while ($row=mysqli_fetch_array($result)){?>
                      <tbody>
                        <tr>
                          <td class="font-weight-600"><?php echo $row['nome'];?></td>
                          <td><?php echo $row['data'];?></td>
                          <td class="font-weight-600"><?php echo $row['dose'];?></td>
                          <td><?php echo $row['motivo'];?></td>
                        </tr>
                      </tbody>
					  <?php	}?>
                    </table>
                    </div>
              
                    </div>
                  
					</div>
              </div>

            </div>
          </div>
        </section>
      </div>
      <?php include 'footer.php';?>
    </div>
  </div>
  <!-- CalcularIdade -->
  <?php
	
	function calcularIdade($datanasc){
		
		$datanasc = explode("-",$datanasc);

		 $anoNasc    = $datanasc[0];
		 $mesNasc    = $datanasc[1];
		 $diaNasc    = $datanasc[2];
		 
		 $anoAtual   = date("Y");
		 $mesAtual   = date("m");
		 $diaAtual   = date("d");
		 
		 $idade      = $anoAtual - $anoNasc;
		 
		 if ($mesAtual < $mesNasc){
			$idade -= 1;
		} elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
			$idade -= 1;
		}
		
		return $idade;
	}
  ?>
	
 <!-- Grafico -->
 <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Manhã', 'Tarde'],
		  <?php 
			
			$qry2="SELECT * FROM (SELECT * FROM leite where numero='$vaca' and hour(timestamp)>12 ORDER BY timestamp DESC LIMIT 8) AS leite ORDER BY leite.timestamp";
			
			$result2=mysqli_query($link,$qry2);

			while ($row2=mysqli_fetch_array($result2)){
			$fdata=$row2['data'];
		  $result=mysqli_query($link,"SELECT * FROM (SELECT * FROM leite where numero='$vaca' and data='$fdata' and hour(timestamp)<12 ORDER BY timestamp DESC LIMIT 8) AS leite ORDER BY leite.timestamp");
			$row=mysqli_fetch_array($result);?>
          ['<?php echo $row2['data'];?>', <?php echo $row['quantidade'];?>,<?php echo $row2['quantidade'];?>],
          <?php } ?>
        ]);

        var options = {
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
	

 
 
  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="assets/modules/jquery.sparkline.min.js"></script>
  <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  
</body>
</html>

