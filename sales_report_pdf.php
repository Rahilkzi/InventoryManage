<?php
require_once "config.php";
require_once "fpdf/fpdf186/fpdf.php";

// Fetch company profile
$companyId = 1;
$stmt = mysqli_prepare($conn, "SELECT * FROM companyprofile WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $companyId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$companyProfile = mysqli_fetch_assoc($result);
$companyName = $companyProfile['name'];
$companyLogo = $companyProfile['profilepicture'];

// Fetch sales data
$date1 = isset($_POST['date1']) ? $_POST['date1'] . ' 00:00:00' : null;
$date2 = isset($_POST['date2']) ? $_POST['date2'] . ' 23:59:59' : null;


if ($date1 && $date2) {
    $query = "SELECT * FROM sales_report WHERE date BETWEEN ? AND ? ORDER BY date DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $date1, $date2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query($conn, "SELECT * FROM sales_report ORDER BY date DESC");
}

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);



// Logo
if (!empty($companyLogo)) {
    $pdf->Image($companyLogo, 92, 10, 30);
}
$pdf->Cell(0, 10, $companyName . ' - Sales Report', 0, 1, 'C');
$pdf->Ln(15);

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(15, 10, 'ID', 1);
$pdf->Cell(25, 10, 'Date', 1);
$pdf->Cell(25, 10, 'Product ID', 1);
$pdf->Cell(50, 10, 'Product Name', 1);
$pdf->Cell(25, 10, 'Unit Price', 1);
$pdf->Cell(20, 10, 'Qty', 1);
$pdf->Cell(30, 10, 'Amount', 1);
$pdf->Ln();

// Table Data
$pdf->SetFont('Arial', '', 11);
$totalQty = 0;
$totalAmount = 0;



while ($row = mysqli_fetch_assoc($result)) {
    $amount = $row['unitprice'] * $row['quantity'];
    $totalQty += $row['quantity'];
    $totalAmount += $amount;

    $pdf->Cell(15, 10, $row['id'], 1);
    $pdf->Cell(25, 10, date('Y-m-d', strtotime($row['date'])), 1);
    $pdf->Cell(25, 10, $row['product_id'], 1);
    $pdf->Cell(50, 10, $row['productname'], 1);
    $pdf->Cell(25, 10, number_format($row['unitprice'], 2), 1);
    $pdf->Cell(20, 10, $row['quantity'], 1);
    $pdf->Cell(30, 10, number_format($amount, 2), 1);
    $pdf->Ln();
}

// Totals
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Grand Total', 1);
$pdf->Cell(20, 10, $totalQty, 1);
$pdf->Cell(30, 10, number_format($totalAmount, 2), 1);
$pdf->Ln(20);

// Signature lines
$pdf->Cell(60, 10, 'Authorized Signature', 0, 0);
$pdf->Cell(70, 10, '', 0, 0);
$pdf->Cell(60, 10, 'Received By', 0, 1);
$pdf->Line(10, $pdf->GetY(), 70, $pdf->GetY());
$pdf->Line(140, $pdf->GetY(), 200, $pdf->GetY());

$pdf->Output();
?>