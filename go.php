<?php
include 'security.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if(isset($_POST["custom"])){
switch ($_POST["custom"]) {
  case 'All':
    # code...
   $query = "SELECT * FROM admin ORDER BY id DESC";
    break;
    case 'Suspended':
    # code...
   $query = "SELECT * FROM admin WHERE status= 'disabled' ORDER BY id DESC";
    break;
    case 'Active':
    # code...
   $query = "SELECT * FROM admin WHERE status= 'active' ORDER BY id DESC";
    break;
  
  default:
    # code...
  $query = "SELECT * FROM admin ORDER BY id DESC";
    break;
}



}
else{

$query = "SELECT * FROM admin ORDER BY id DESC";
}
$query_run = mysqli_query($conn, $query);

if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'username');
  $active_sheet->setCellValue('B1', 'email');
  $active_sheet->setCellValue('C1', 'datecreated');
  $active_sheet->setCellValue('D1', 'status');
  
  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["username"]);
    $active_sheet->setCellValue('B' . $count, $row["email"]);
    $active_sheet->setCellValue('C' . $count, $row["datecreated"]);
    $active_sheet->setCellValue('D' . $count, $row["status"]);
    

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

