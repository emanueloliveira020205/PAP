<?php
error_reporting(E_ALL);
require('fpdf/fpdf.php');

// Verifica se os parâmetros foram enviados via POST
if (isset($_POST['table']) && isset($_POST['user']) && isset($_POST['data1']) && isset($_POST['data2'])) {
    // Obtém os parâmetros enviados via POST
    $table = $_POST['table'];
    $iduser = $_POST['user'];
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];

    $data1= $data1.' 00:00:00';
    $data2=$data2.' 23:59:59' ;  

    
    // Conecta ao banco de dados MySQL
    include 'DBConnection.php';

    if($iduser != 'Todos'){

    // Executa a consulta SQL
    $result = mysqli_query($link,"Select * from $table where user='$iduser' and timestamp BETWEEN '$data1' AND '$data2'");
    
    }else {
        // Executa a consulta SQL para todos
        $result = mysqli_query($link, "SELECT * FROM $table WHERE timestamp BETWEEN '$data1' AND '$data2'");
    }

    // Cria um novo documento PDF
    $pdf = new FPDF();

    // Adiciona uma nova página
    $pdf->AddPage();

    // Define o título do relatório
    $pdf->SetTitle(utf8_decode('Relatório'));

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,utf8_decode('Relatorio de ').$table,0,1,'C');

    // Cria a tabela com os dados do relatório
    $pdf->SetFont('Arial', '', 10);
    
    $pdf->Cell(30, 10, 'Utilizador', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Valor', 1, 0, 'C');
    $pdf->Cell(65, 10, utf8_decode('Descrição'), 1, 0, 'C');
    $pdf->Cell(50, 10, 'Data/Hora', 1, 1, 'C');

    while ($linha = mysqli_fetch_array($result)) {
        $result2=mysqli_query($link,"Select * from utilizadores where coduser='$linha[user]'");
        while ($row = mysqli_fetch_array($result2)) {$nomeu=$row['nome'];}
        $pdf->Cell(30, 10, $nomeu, 1, 0);
        $pdf->Cell(30, 10, $linha['valor'], 1, 0);
        $pdf->Cell(65, 10, utf8_decode($linha['descricao']), 1, 0);
        $pdf->Cell(50, 10, $linha['timestamp'], 1, 0);
        $pdf->Ln();
    
    }

    // Gera o PDF
   //header('Content-Type: application/pdf');
   $data=date("Y-m-d");
    $pdf->Output($table.'_'.$data.'.pdf', 'D');
}
?>