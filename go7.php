<?php
include 'security2.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if(isset($_POST["custom"])){
switch ($_POST["custom"]) {
  case 'All':
    # code...
$sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
$query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
$name = $query_run2['name'];
$query = "select * from register where organization = '$name' ORDER BY id DESC";

    break;
    case '2':
    # code...
   $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];
$query = "select * from register where organization = '$name' AND active='2' ORDER BY id DESC";

    break;
    case '0':
   $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];
$query = "select * from register where organization = '$name' AND active='0' ORDER BY id DESC";

    break;
    case '1':
    # code...
   $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];
$query = "select * from register where organization = '$name' AND active='1' ORDER BY id DESC";

    break;
  
  default:
    # code...
 $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];
$query = "select * from register where organization = '$name' ORDER BY id DESC";

    break;
}



}
else{

$sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];
$query = "select * from register where organization = '$name' ORDER BY id DESC";
}
$query_run = mysqli_query($conn, $query);

if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'username');
  $active_sheet->setCellValue('B1', 'email');
  $active_sheet->setCellValue('C1', 'organization');
  $active_sheet->setCellValue('D1', 'department');
  $active_sheet->setCellValue('E1', 'active');
  

  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["username"]);
    $active_sheet->setCellValue('B' . $count, $row["email"]);
    $active_sheet->setCellValue('C' . $count, $row["organization"]);
    $active_sheet->setCellValue('D' . $count, $row["department"]);
    $active_sheet->setCellValue('E' . $count, $row["active"]);
   

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

