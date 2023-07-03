<div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" action="sessaovaca.php" method="POST">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Procurar Vaca" aria-label="Search" name="vaca" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">

		  <?php
		  $dirftuser='imagens_users/';
		  $fotouser=$_SESSION['iduser'];
		  $users=mysqli_query($link,"Select * from utilizadores where coduser='$fotouser'");
		  while ($varusers=mysqli_fetch_array($users)){?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img src="<?php echo $dirftuser.$fotouser;?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Olá, <?php echo $varusers['nome'];?> :)</div></a><?php } ?>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">4Cows</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="user.php">4C</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Página Inicial</li>
				<li><a class="nav-link" href="user.php"><i class="fas fa-th"></i> <span>Página Inicial</span></a></li>
            <li class="menu-header">Ações</li>
				<li><a class="nav-link" href="listarvacas.php"><i class="fas fa-th"></i> <span>Listar Vacas</span></a></li>
				<li><a class="nav-link" href="med_listar.php"><i class="fas fa-th"></i> <span>Listar Medicamentos</span></a></li>
				<li><a class="nav-link" href="racao_listar.php"><i class="fas fa-th"></i> <span>Listar Rações</span></a></li>

        
          
            <li class="menu-header">Configurações</li>
            <li><a class="nav-link" href="listarusers.php"><i class="far fa-user"></i> <span>Utilizadores</span></a></li>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="logout.php" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Terminar Sessão
            </a>
          </div>        </aside>
      </div>