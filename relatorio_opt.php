<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=iso-8859-1"><meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>4Cows >Gerar Relatório</title>
 
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>
<?php include "DBConnection.php";?>
<?php include "sessaoseguraadmin.php";?>
<body>
<?php include'menuadmin.php';?>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Gerar Relatório</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="admin.php">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Confugurações</a></div>
              <div class="breadcrumb-item">Gerar Relatório</div>
            </div>
          </div>
<?php if(isset($_POST['table'])){
  $table=$_POST['table'];
  if($table=='despesas' OR $table=='lucros') { ?>
      <div class="card card-primary">
      <div class="card-body">
       <h4>Para Gerar um Relatório basta acompanhar o que lhe é pedido.<br> </h4>
             <h6>-Selecione o utilizador e o intervalo de tempo:</h6>
      
      <form enctype="multipart/form-data" action="gerar_relatorio1.php" method="POST">
       <div class="row">
       <div class="form-group col-12">
                      <label for="table">Categoria</label>
                      <input id="table" type="text" class="form-control" name="table" value="<?php echo $table; ?>" readonly>
                    </div>
         <div class="form-group col-12">
         <label>Selecionar Utilizador</label>
          <select class="form-control" name="user">
          <option value="todos">Todos</option>
           <?php  $qry=mysqli_query($link, "select * from utilizadores order by coduser");
             while ($row = mysqli_fetch_array($qry)){?>
                       <option value="<?php echo $row['coduser'];?>"><?php echo $row['nome'];?></option>
             <?php } ?>
                     </select>  
         </div>        
       </div>  
       <div class="row">
                    <div class="form-group col-6">
                      <label for="d1">Data Inicial</label>
                      <input id="num" type="text" class="form-control datepicker" name="data1" autofocus>
                    </div>
                    <div class="form-group col-6">
					<div class="form-group">
                      <label>Data Final</label>
                      <input type="text" class="form-control datepicker" name="data2">
                    </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Gerar
                    </button>
                  </div>
        <?php } 

if($table=='leite') { ?>
  <div class="card card-primary">
  <div class="card-body">
   <h4>Para Gerar um Relatório basta acompanhar o que lhe é pedido.<br> </h4>
         <h6>-Selecione a vaca e o intervalo de tempo:</h6>
  
  <form enctype="multipart/form-data" action="gerar_relatorio2.php" method="POST">
   <div class="row">
   <div class="form-group col-12">
                  <label for="table">Categoria</label>
                  <input id="table" type="text" class="form-control" name="table" value="<?php echo $table; ?>" readonly>
                </div>
     <div class="form-group col-12">
     <label>Selecionar Vaca</label>
      <select class="form-control" name="vaca">
      <option value="todos">Todas</option>
       <?php  $qry=mysqli_query($link, "select * from vacas order by numero");
         while ($row = mysqli_fetch_array($qry)){?>
                   <option value="<?php echo $row['numero'];?>"><?php echo $row['numero'];?></option>
         <?php } ?>
                 </select>  
     </div>        
   </div>  
   <div class="row">
                <div class="form-group col-6">
                  <label for="d1">Data Inicial</label>
                  <input id="num" type="text" class="form-control datepicker" name="data1" autofocus>
                </div>
                <div class="form-group col-6">
      <div class="form-group">
                  <label>Data Final</label>
                  <input type="text" class="form-control datepicker" name="data2">
                </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Gerar
                </button>
              </div>
    <?php } ?>
    
    <?php if($table=='vacas') { ?>
  <div class="card card-primary">
  <div class="card-body">
   <h4>Para Gerar um Relatório basta acompanhar o que lhe é pedido.<br> </h4>
         <h6>-Selecione o intervalo de daats de nascimento que pretende:</h6>
  
  <form enctype="multipart/form-data" action="gerar_relatorio3.php" method="POST">
   <div class="row">
   <div class="form-group col-12">
                  <label for="table">Categoria</label>
                  <input id="table" type="text" class="form-control" name="table" value="<?php echo $table; ?>" readonly>
                </div>
     <div class="form-group col-12">
     <label>Selecionar Estado</label>
      <select class="form-control" name="estado">
      <option value="Todos">Todos</option>
      <option value="0">Secas</option>
      <option value="1">Leiteiras</option>

                 </select>  
     </div>        
   </div>  
   <div class="row">
                <div class="form-group col-6">
                  <label for="d1">Data de Nascimento Inicial</label>
                  <input id="num" type="text" class="form-control datepicker" name="data1" autofocus>
                </div>
                <div class="form-group col-6">
      <div class="form-group">
                  <label>Data de Nascimento Final</label>
                  <input type="text" class="form-control datepicker" name="data2">
                </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Gerar
                </button>
              </div>
    <?php } ?>
 


       <?php } ?>


      
       </div>
       </div> 
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
  <script src="assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/forms-advanced-forms.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>