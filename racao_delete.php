<?php
	include 'DBConnection.php';
	include'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$idracao=$divide['1'];
			$query = mysqli_query($link,"update racao set ativo=1 where idracao=$idracao");

					if($query){
						$iduser=$_SESSION['iduser'];
						mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou uma Ração')");
						Header("Location:racao_listar.php");
					}
	
?>