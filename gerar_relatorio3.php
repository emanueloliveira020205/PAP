<?php
error_reporting(E_ALL);
require('fpdf/fpdf.php');

// Verifica se os parâmetros foram enviados via POST
if (isset($_POST['table']) && isset($_POST['estado']) && isset($_POST['data1']) && isset($_POST['data2'])) {
    // Obtém os parâmetros enviados via POST
    $table = $_POST['table'];
    $estado = $_POST['estado'];
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
 

    
    // Conecta ao banco de dados MySQL
    include 'DBConnection.php';

    if($estado != 'Todos'){

    // Executa a consulta SQL
    $result = mysqli_query($link,"Select * from $table where estado='$estado' and datanasc BETWEEN '$data1' AND '$data2'");
    
    }else {
        // Executa a consulta SQL para todos
        $result = mysqli_query($link, "SELECT * FROM $table WHERE datanasc BETWEEN '$data1' AND '$data2'");
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
    
    $pdf->Cell(30, 10, utf8_decode('Número'), 1, 0, 'C');
    $pdf->Cell(40, 10, 'Data de Nascimento', 1, 0, 'C');
    $pdf->Cell(30, 10, utf8_decode('Espécie'), 1, 0, 'C');
    $pdf->Cell(30, 10, 'Estado', 1, 0, 'C');
    $pdf->Cell(65, 10, 'Observ', 1, 1, 'C');


    while ($linha = mysqli_fetch_array($result)) {
        $pdf->Cell(30, 10, $linha['numero'], 1, 0);
        $pdf->Cell(40, 10, $linha['datanasc'], 1, 0);
        $pdf->Cell(30, 10, utf8_decode($linha['especie']), 1, 0);
        if ($linha['estado']==0){$pdf->Cell(30, 10, utf8_decode('Seca'), 1, 0);}else{$pdf->Cell(30, 10, utf8_decode('Lactação'), 1, 0);}
        $pdf->Cell(65, 10, utf8_decode($linha['observ']), 1, 0);

        $pdf->Ln();
    }

    // Gera o PDF
   //header('Content-Type: application/pdf');
   $data=date("Y-m-d");
    $pdf->Output($table.'_'.$data.'.pdf', 'D');
}
?>