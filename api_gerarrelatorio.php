<?php
require('fpdf/fpdf.php');
// Definir as rotas da API REST
if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['acao'] == 'gerar_relatorio') {

    $db_name= 'pap';
	$link= mysqli_connect('localhost','root','',$db_name);
	if(!$link){
		die('Could not connect: '.mysql_error());
	}

    $pdf = new FPDF();

    $pdf->AddPage();

    $pdf->SetTitle(utf8_decode('Relatório Geral'));

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,utf8_decode('Animais na Exploração'),0,1,'C');

    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Cell(30, 10, 'Núumero', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Data de Nascimento', 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Espécie'), 1, 0, 'C');
    $pdf->Cell(50, 10, utf8_decode('Mãe'), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Estado'), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('País'), 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Observações'), 1, 1, 'C');
    

    $result = mysqli_query($link, "SELECT * FROM vacas WHERE ativo=0");

    while ($row = mysqli_fetch_array($result)) {
        $pdf->Cell(30, 10, $nomeu, 1, 0);
        $pdf->Cell(30, 10, $row['valor'], 1, 0);
        $pdf->Cell(65, 10, utf8_decode($row['descricao']), 1, 0);
        $pdf->Cell(50, 10, $row['timestamp'], 1, 0);
        $pdf->Ln();
    
    }

    $pdf->AddPage();

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,utf8_decode('Relatorio de Despesas'),0,1,'C');

    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Cell(30, 10, 'Utilizador', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Valor', 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Descrição'), 1, 0, 'C');
    $pdf->Cell(50, 10, 'Data/Hora', 1, 1, 'C');

    $result = mysqli_query($link, "SELECT * FROM despesas WHERE ativo=0");

    while ($row = mysqli_fetch_array($result)) {
        $result2=mysqli_query($link,"Select * from utilizadores where coduser='$row[user]'");
        while ($linha = mysqli_fetch_array($result2)) {$nomeu=$linha['nome'];}
        $pdf->Cell(30, 10, $nomeu, 1, 0);
        $pdf->Cell(30, 10, $row['valor'], 1, 0);
        $pdf->Cell(65, 10, utf8_decode($row['descricao']), 1, 0);
        $pdf->Cell(50, 10, $row['timestamp'], 1, 0);
        $pdf->Ln();
    
    }

    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,utf8_decode('Relatorio de Lucros'),0,1,'C');

    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Cell(30, 10, 'Utilizador', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Valor', 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Descrição'), 1, 0, 'C');
    $pdf->Cell(50, 10, 'Data/Hora', 1, 1, 'C');

    $result = mysqli_query($link, "SELECT * FROM lucros WHERE ativo=0");

    while ($row = mysqli_fetch_array($result)) {
        $result2=mysqli_query($link,"Select * from utilizadores where coduser='$row[user]'");
        while ($linha = mysqli_fetch_array($result2)) {$nomeu=$linha['nome'];}
        $pdf->Cell(30, 10, $nomeu, 1, 0);
        $pdf->Cell(30, 10, $row['valor'], 1, 0);
        $pdf->Cell(65, 10, utf8_decode($row['descricao']), 1, 0);
        $pdf->Cell(50, 10, $row['timestamp'], 1, 0);
        $pdf->Ln();
    
    }

    $pdf->Output('D');

    // Enviar o resultado da API REST
   
}
?>
