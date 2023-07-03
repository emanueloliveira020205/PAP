<?php
	include 'DBConnection.php';
	include 'sessaoseguraadmin.php';
			$divide  = explode("?", $_SERVER["REQUEST_URI"]);
			$divide['1'];
			$numero=$divide['1'];
			$query = mysqli_query($link,"update vacas set ativo=1 where numero=$numero");

					if($query){
						$iduser=$_SESSION['iduser'];
						$log=mysqli_query($link,"insert into logs(idu,descricao) values($iduser,'Eliminou uma Vaca')");
						if($log){
						Header("Location:listarvacas.php");}
					}
	
?>