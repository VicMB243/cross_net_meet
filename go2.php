<?php
include 'security.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if(isset($_POST["custom"])){
switch ($_POST["custom"]) {
  case 'All':
    # code...
   $query = "SELECT * FROM subscription ORDER BY id DESC";
    break;
    case 'Suspended':
    # code...
   $query = "SELECT * FROM subscription WHERE status= 'suspended' ORDER BY id DESC";
    break;
    case 'Pending':
    $query = "SELECT * FROM subscription WHERE status= 'pending' ORDER BY id DESC";
    break;
    case 'Active':
    # code...
   $query = "SELECT * FROM subscription WHERE status= 'active' ORDER BY id DESC";
    break;
  
  default:
    # code...
  $query = "SELECT * FROM subscription ORDER BY id DESC";
    break;
}



}
else{

$query = "SELECT * FROM subscription ORDER BY id DESC";
}
$query_run = mysqli_query($conn, $query);

if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'name');
  $active_sheet->setCellValue('B1', 'email');
  $active_sheet->setCellValue('C1', 'phone');
  $active_sheet->setCellValue('D1', 'package');
  $active_sheet->setCellValue('E1', 'startdate');
  $active_sheet->setCellValue('F1', 'enddate');
  $active_sheet->setCellValue('G1', 'status');

  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["name"]);
    $active_sheet->setCellValue('B' . $count, $row["email"]);
    $active_sheet->setCellValue('C' . $count, $row["phone"]);
    $active_sheet->setCellValue('D' . $count, $row["package"]);
    $active_sheet->setCellValue('E' . $count, $row["startdate"]);
    $active_sheet->setCellValue('F' . $count, $row["enddate"]);
    $active_sheet->setCellValue('G' . $count, $row["status"]);

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

