<?php
include 'security.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$query = "SELECT * FROM subscription WHERE enddate='$date'  AND payment_status = 'not_paid'";
$query_run = mysqli_query($conn, $query);
if(isset($_POST["export"]))
{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'ID');
  $active_sheet->setCellValue('B1', 'Username');
  $active_sheet->setCellValue('C1', 'Email');
  $active_sheet->setCellValue('D1', 'Status');
  

  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["id"]);
    $active_sheet->setCellValue('B' . $count, $row["username"]);
    $active_sheet->setCellValue('C' . $count, $row["email"]);
    $active_sheet->setCellValue('D' . $count, $row["active"]);
    

    $count = $count + 1;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

  $file_name = time() . '.' . strtolower($_POST["file_type"]);

  $writer->save($file_name);
header('Content-Type: application/x-www-form-urlencoded');
header('Content-Transfer-Encoding: Binary');
header("Content-disposition: attachment; filename=\"".$file_name."\"");
readfile($file_name);
unlink($file_name);
exit;
}
?>

