<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

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
<?php include "sessaosegurauser.php";?>
<?php include "DBConnection.php";?>
<body>
  
	<?php include'menuuser.php';?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">	
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">Pesquisar Vaca
                		<div class="form-group">
						<br>
						<form action="sessaovaca.php" method="POST">
						<div class="input-group mb-3">					
                        <input type="text" class="form-control" name="vaca" aria-label="">
                        <div class="input-group-append">
						<?php $url='leitorqr.html'; ?>
                          <button onclick="window.location.href='<?php echo $url; ?>';"  target="_blank" type="button" class="btn btn-primary" >QRC</button>
                        </div>
						<div class="card-header">
								<button type="submit" class="btn btn-primary btn-lg btn-block">Procurar</button>
							</div>
                      </div>
							 
						</form>
						 
						</div>  
                 </div>    
                </div>
              </div>
            </div>
			
  <?php $vacasleiteirasqry = mysqli_query($link, "SELECT COUNT(numero) AS vacasleiteiras FROM vacas WHERE estado = 1 and ativo=0");
				$vacasleiteiras = mysqli_fetch_array($vacasleiteirasqry);

				$vacassecasqry = mysqli_query($link, "SELECT COUNT(numero) AS vacassecas FROM vacas WHERE estado = 0 and ativo=0");
					$vacassecas = mysqli_fetch_array($vacassecasqry); 
          $racaosecas = $vacassecas['vacassecas'] * 1;
					$racaoleiteiras = $vacasleiteiras['vacasleiteiras'] * 5;?>

			<div class="col-lg-4 col-md-4 col-sm-12">
			  <div class="card card-statistic-2">
				<div class="card-wrap">
				  <div class="card-header mb-3">
					<h4 class="text">Ração Gasta Hoje</h4>
				  </div>
				  <div class="card-body d-flex justify-content-between">
					<div>
					  <h5 class="mb-3">Vacas Leiteiras:</h5>
					  <p class="text-muted"><?php echo $racaoleiteiras ?> Kg</p>
					</div>
					<div>
					  <h5 class="mb-3">Vacas Secas:</h5>
					  <p class="text-muted"><?php echo $racaosecas ?>kg</p>
					</div>
				  </div>
				  <div class="card-header">
          <button onclick="window.location.href='listarvacas.php'"  target="_blank" type="button" class="btn btn-primary btn-lg btn-block" >Ver Vacas</button>
							</div>
							<br>
				</div>
			  </div>
			</div>


            <div class="col-lg-4 col-md-4 col-sm-12">
			  <div class="card card-statistic-2">
				<div class="card-wrap">
				  <div class="card-header mb-3">
					<h4 class="text">Utilizadores</h4>
				  </div>
				  <div class="card-body d-flex justify-content-between">
					<div>
					  <h5 class="mb-3">Administradores:</h5>
            <?php
            $numadmins = mysqli_query($link, "SELECT COUNT(coduser) AS admin FROM utilizadores WHERE tipo = 1 AND ativo=0 ");
            $row = mysqli_fetch_assoc($numadmins);
            $adminCount = $row['admin'];
            ?>
            <p class="text-muted"><?php echo $adminCount; ?></p>
					</div>
					<div>
					  <h5 class="mb-3">Utilizadores Normais:</h5>
					  <?php
            $numuser = mysqli_query($link, "SELECT COUNT(coduser) AS user FROM utilizadores WHERE tipo = 0 AND ativo=0 ");
            $row = mysqli_fetch_assoc($numuser);
            $userCount = $row['user'];
            ?>
            <p class="text-muted"><?php echo $userCount; ?></p>
					</div>
				  </div>
				  <div class="card-header">
          <button onclick="window.location.href='listarusers.php'"  target="_blank" type="button" class="btn btn-primary btn-lg btn-block" >Ver Utilizadores</button>
							</div>
							<br>
				</div>
			  </div>
			</div>
			
          </div>
          <div class="row">
            <div class="col-lg-8">
                           <div class="card">
                <div class="card-header">
                  <h4>Melhores Produtoras</h4>
                  <?php $qry=mysqli_query($link,"SELECT numero, sum(quantidade) as total_leite FROM leite GROUP BY numero order by total_leite DESC Limit 4");?>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th></th>
                        <th>Número</th>
                        <th>Quantidade</th>
                        <th>Estado Atual</th>
                        <th></th>
						<br>
                      </tr>
                      <?php while ($row=mysqli_fetch_array($qry)){?>
                      <tr>
                      <?php $dir='imagens_vacas/';
                      $fotoname=$row['numero'];?>
                        <td><img class="mr-3 rounded" width="55" src="<?php echo $dir.$fotoname;?>"></td>
                        <td class="font-weight-600"><?php echo $row['numero']; ?></td>
                        <td><?php echo $row['total_leite']; ?>L</td>
                        <?php $qry2=mysqli_query($link,"SELECT * from vacas where numero = $fotoname "); 
                        while ($row2=mysqli_fetch_array($qry2)){?>
                        <td><div class="font-weight-600"><?php if ($row2['estado']== 1){echo 'Lactação';} else{echo 'Seca';} }?></div></td>
                        <td>
                        <?php $url = 'sessaovacaqr.php?'.$row['numero'];?>
                        <button onclick="window.location.href='<?php echo $url; ?>';" class="btn btn-primary btn-lg btn-block">Abrir</button>
                        </td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Recordes de Produção</h4>
                </div>
				<?php
				$qry="SELECT * FROM leite where ativo=0 ORDER BY quantidade DESC LIMIT 3";
				$result=mysqli_query($link,$qry);
				$dir = 'imagens_vacas/';?>
                <div class="card-body p0">
                  <ul class="list-unstyled list-unstyled-border">
				  <?php while ($row=mysqli_fetch_array($result)){
					$fotoname=$row['numero'];?>
                    <li class="media">
                      <img class="mr-3 rounded" width="55" src="<?php echo $dir.$fotoname;?>">
                      <div class="media-body">
                        <div class="float-right"><div class="font-weight-600 text-muted text-small"><?php echo $row['data'];?></div></div>
                        <div class="media-title"><?php echo $row['numero'];?></div>
                        <div class="mt-1">
                          <div class="budget-price">
						  <?php $percent= $row['quantidade'] * 10;
						  
							$month= substr($row['data'],5,2);
							$qry2="SELECT * FROM precoleite where ativo=0 and MONTH(timestamp)=$month";
							$result2=mysqli_query($link,$qry2);
							while ($row2=mysqli_fetch_array($result2)){
							$preco=$row['quantidade']*$row2['preco'];}
							?>
                            <div class="budget-price-square bg-primary" data-width="<?php echo $percent;?>%"></div>
                            <div class="budget-price-label"><?php echo $row['quantidade'];?>L</div>
                          </div>
                          <div class="budget-price">
							<?php $percent2=$preco*10;?>
                            <div class="budget-price-square bg-danger" data-width="<?php echo $percent2;?>%"></div>
                            <div class="budget-price-label"><?php echo round($preco,2);?>€</div>
                          </div>
                        </div>
                      </div>
                    </li>
					<?php } ?>
                  </ul>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Litros</div>
                  </div>
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20"></div>
                    <div class="budget-price-label">Preço</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
			 <div class="col-lg-12">
                           <div class="card">
                <div class="card-header">
                  <h4>Vaca Mais Velha</h4>
                  <?php $qry=mysqli_query($link,"SELECT * from vacas where ativo=0 order by datanasc ASC Limit 1");?>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th></th>
                        <th>Número</th>
                        <th>data de Nascimento</th>
                        <th>Entrada na Exploração/Sistema</th>
                        <th></th>
                      </tr>
                      <?php while ($row=mysqli_fetch_array($qry)){?>
                      <tr>
                      <?php $dir='imagens_vacas/';
                      $fotoname=$row['numero'];?>
                        <td><img class="mr-3 rounded" width="55" src="<?php echo $dir.$fotoname;?>"></td>
                        <td class="font-weight-600"><?php echo $row['numero']; ?></td>
                        <td><?php echo $row['datanasc']; ?></td>                     
                        <td><div class="font-weight-600"><?php echo $row['timestamp']; ?></div></td>
                        <td>
                        <?php $url = 'sessaovacaqr.php?'.$row['numero'];?>
                        <button onclick="window.location.href='<?php echo $url; ?>';" class="btn btn-primary btn-lg btn-block">Abrir</button>
                        </td>
                      </tr>
                    <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-lg-12">
                           <div class="card">
                <div class="card-header">
                  <h4>Vaca Mais Nova</h4>
                  <?php $qry=mysqli_query($link,"SELECT * from vacas where ativo=0 order by datanasc Desc Limit 1");?>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th></th>
                        <th>Número</th>
                        <th>data de Nascimento</th>
                        <th>Entrada na Exploração/Sistema</th>
                        <th></th>
                      </tr>
                      <?php while ($row=mysqli_fetch_array($qry)){?>
                      <tr>
                      <?php $dir='imagens_vacas/';
                      $fotoname=$row['numero'];?>
                        <td><img class="mr-3 rounded" width="55" src="<?php echo $dir.$fotoname;?>"></td>
                        <td class="font-weight-600"><?php echo $row['numero']; ?></td>
                        <td><?php echo $row['datanasc']; ?></td>                     
                        <td><div class="font-weight-600"><?php echo $row['timestamp']; ?></div></td>
                        <td>
                        <?php $url = 'sessaovacaqr.php?'.$row['numero'];?>
                        <button onclick="window.location.href='<?php echo $url; ?>';" class="btn btn-primary btn-lg btn-block">Abrir</button>
                        </td>
                      </tr>
                    <?php } ?>
                    </table>
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

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/jquery.sparkline.min.js"></script>
  <script src="assets/modules/chart.min.js"></script>
  <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>