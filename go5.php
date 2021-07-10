<?php
include 'security2.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;



if(isset($_POST["export"]))

{
$query = "select * from email_address where mid = '$_POST[mid]'";
$query_run = mysqli_query($conn, $query);

  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();
$active_sheet->setCellValue('A1', 'Attendance Report for '.$_POST['name'] );
  $active_sheet->setCellValue('A2', 'Email');
  $active_sheet->setCellValue('B2', 'Attendance Status');
   
  foreach($query_run as $row)

  {
    if ($row['attendance_status'] ==NULL ){
      # code...
      $attendance_status = 'NO RESPONSE';
    }
    else{
      $attendance_status = $row['attendance_status'];
    }
  $count = 3;

  
    $active_sheet->setCellValue('A' . $count, $row["email_address"]);
    $active_sheet->setCellValue('B' . $count, $attendance_status );
   

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

