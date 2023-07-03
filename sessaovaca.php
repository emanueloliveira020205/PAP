<?php

include 'DBConnection.php';

$vaca=$_POST['vaca']; // via formulário, recebe o número via POST

$sql = mysqli_query($link,"SELECT * FROM vacas WHERE numero = '$vaca'");

$row = mysqli_num_rows($sql);
if($row == 0){
session_start();
$pag='admin.php?erro=1';
$_SESSION['erro']=1;
Header("Location:$pag");
}

else {
	session_start();

	$_SESSION['vaca'] = $vaca;
	Header("Location:vaca.php");

}
	?>