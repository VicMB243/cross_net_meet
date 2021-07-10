<?php
include 'security2.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

 $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run['name'];

$query = "SELECT * FROM event WHERE id = '$name'";
$query_run = mysqli_query($conn, $query);


if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

$active_sheet->setCellValue('A1', 'Attendance Report for '.$_POST['name'] );
  $active_sheet->setCellValue('A1', 'Duration');
   $active_sheet->setCellValue('B1', 'Description');
  
  
  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["duration"]);
    $active_sheet->setCellValue('B' . $count, $row["description"]);
   

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

