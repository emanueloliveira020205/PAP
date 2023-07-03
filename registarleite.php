<?php 
	session_start();
	include 'DBConnection.php';
	$vaca = $_SESSION['vaca'];
	if (isset($_POST["leite"]) && isset($vaca) && isset($_POST["timestamp"])) {
		$fleite = $_POST["leite"];
		$ftimestamp = $_POST["timestamp"];
		$fvaca = $vaca;
		$datarecolha = date("Y-m-d");
		
		$query = mysqli_query($link, "INSERT INTO leite (data, quantidade, numero, timestamp) VALUES ('$datarecolha', $fleite, '$fvaca', '$ftimestamp')");
		
		// log
		if ($query) {
			$iduser = $_SESSION['iduser'];
			mysqli_query($link, "INSERT INTO logs (idu, descricao) VALUES ($iduser, 'Registou Leite')");
			
			// registar racao consumida
			$data = date("Y-m-d");
			$qry = "SELECT * FROM logs WHERE descricao LIKE 'Alimentou Vacas' and DATE(timestamp)= '$data' "; //verifica se ja foi feito o registo
			$result = mysqli_query($link, $qry);
			$registos = mysqli_num_rows($result);
			
			if ($registos == 0) {
				$vacasleiteirasqry = mysqli_query($link, "SELECT COUNT(numero) AS vacasleiteiras FROM vacas WHERE estado = 1");
				$vacasleiteiras = mysqli_fetch_array($vacasleiteirasqry);

				$vacassecasqry = mysqli_query($link, "SELECT COUNT(numero) AS vacassecas FROM vacas WHERE estado = 0");
					$vacassecas = mysqli_fetch_array($vacassecasqry);
								
					$racaosecas = $vacassecas['vacassecas'] * 1000;
					$racaoleiteiras = $vacasleiteiras['vacasleiteiras'] * 5000;
								
					$stock = mysqli_query($link, "SELECT * FROM racao WHERE tipo = 0");  
					while ($row = mysqli_fetch_array($stock)) {
						$stock1 = $row['qd'];
						$fqdisp = $stock1 - $racaosecas;
					}
					mysqli_query($link, "UPDATE racao SET qd = $fqdisp WHERE tipo = 0");

					$stock = mysqli_query($link, "SELECT * FROM racao WHERE tipo = 1");  
					while ($row = mysqli_fetch_array($stock)) {
						$stock1 = $row['qd'];
						$fqdisp = $stock1 - $racaoleiteiras;
					}
					mysqli_query($link, "UPDATE racao SET qd = $fqdisp WHERE tipo = 1");

					mysqli_query($link, "INSERT INTO logs (idu, descricao) VALUES ($iduser, 'Alimentou Vacas')");
				}
				
				// venda de leite mensal
			$diaAtual = date("d");
			if ($diaAtual == '01') {
				$data = date("Y-m-d");
				$qry = "SELECT * FROM logs WHERE descricao LIKE 'Vendeu Leite' AND DATE(timestamp) = '$data'";
				$result = mysqli_query($link, $qry);
				$registos = mysqli_num_rows($result);

				if ($registos == 0) {
					$mes = date("m");
					if ($mes == "01") {
						$mes = "12";
					} else {
						$mes = str_pad($mes - 1, 2, "0", STR_PAD_LEFT);
					}
					$qry = "SELECT SUM(quantidade) AS total FROM leite WHERE MONTH(data) = '$mes'";
					$result = mysqli_query($link, $qry);
					$row = mysqli_fetch_assoc($result);
					$totalLeite = $row["total"];

					$preco = mysqli_query($link, "SELECT preco FROM precoleite WHERE MONTH(timestamp) = '$mes'");
					$row = mysqli_fetch_assoc($preco);
					$precoLeite = $row["preco"];

					$valorTotal = $totalLeite * $precoLeite;

					$iduser = $_SESSION['iduser'];

					mysqli_query($link, "INSERT INTO lucros (valor, descricao, user) VALUES ($valorTotal, 'Venda de Leite', $iduser)");

					mysqli_query($link, "INSERT INTO logs (idu, descricao) VALUES ($iduser, 'Vendeu Leite')");
				}
			}

			
			header("Refresh: 0; url=vaca.php");
		} else {
			echo "Erro ao inserir! Erro: " . mysqli_error($link);
		}
	}	
?>
