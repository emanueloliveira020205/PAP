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
          <li class=""><a href="#" data-toggle="" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?php echo $dirftuser.$fotouser;?>" class="rounded-circle mr-1">
		  <div class="d-sm-none d-lg-inline-block">Olá, <?php echo $varusers['nome'];?> :)</div></a><?php } ?>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="admin.php">4Cows</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="admin.php">4C</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Página Inicial</li>
				<li><a class="nav-link" href="admin.php"><i class="fas fa-th"></i> <span>Página Inicial</span></a></li>
            <li class="menu-header">Animais</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Vacas</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="listarvacas.php">Listar Vacas</a></li>
				<li><a class="nav-link" href="inserirvaca.php">Adicionar Vaca</a></li>
				</ul>
            </li>
			<li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Medicamentos</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="med_listar.php">Listar Medicamentos</a></li>
				<li><a class="nav-link" href="med_add.php">Inserir Medicamento</a></li>
				</ul>
            </li>
			<li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Ração</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="racao_listar.php">Listar Rações</a></li>
				<li><a class="nav-link" href="racao_add.php">Inserir Ração</a></li>
				</ul>
            </li>

         
            <li class="menu-header">Configurações</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Utilizadores</span></a>
              <ul class="dropdown-menu">
                <li><a href="listarusers.php">Listar Utilizadores</a></li> 
                <li><a href="adduser.php">Adicionar Utilizador</a></li> 
                <li><a href="logs.php">Logs</a></li> 
              </ul>
            </li>
			
			<li>
              <a href="carteira.php" class="nav-link"><i class="fas fa-pencil-ruler"></i> <span>Carteira</span></a>
            </li>

            <li>
              <a href="pedirrelatorio.php" class="nav-link"><i class="far fa-file-alt"></i> <span>Gerar Relatórios</span></a>
            </li>

            <li>
              <a href="racas.php" class="nav-link"><i class="fas fa-exclamation"></i> <span>Raças</span></a>
            </li>
			<li>
              <a href="paises.php" class="nav-link"><i class="fas fa-exclamation"></i> <span>Países</span></a>
            </li>
			      <li>
              <a href="precoleite.php" class="nav-link"><i class="fas fa-exclamation"></i> <span>Preço Leite</span></a>
            </li>

          <!--  <li>
              <a href="api_gerarrelatorio.php?acao=gerar_relatorio" class="nav-link"><i class="fas fa-th-large"></i> <span>API Gerar Relatório</span></a>
            </li> -->
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="logout.php" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-rocket"></i> Terminar Sessão
            </a>
          </div>        </aside>
      </div>