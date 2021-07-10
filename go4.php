<?php
include 'security.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;


 $query = "SELECT COUNT(event.id) as COUNT,event.id, register.email,register.organization, register.department FROM event JOIN register ON register.id=event.uid WHERE register.organization !='' GROUP BY register.organization";
  $query_run = mysqli_query($conn, $query);

if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'Organization Name');
   $active_sheet->setCellValue('B1', 'Number of Meetings');
  
  
  $count = 2;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["organization"]);
    $active_sheet->setCellValue('B' . $count, $row["COUNT"]);
   

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

