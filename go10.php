<?php
include 'security2.php';
include '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;


 $sql = "SELECT * FROM organisation WHERE id = '$_SESSION[brands]'";
  $query_run2 = mysqli_query($conn, $sql)->fetch_assoc();
  $name = $query_run2['name'];

 
$query = "SELECT COUNT(event.id) as COUNT,event.id, register.email,register.department, register.organization, register.department FROM event JOIN register ON register.id=event.uid WHERE register.organization = '$name' GROUP BY register.department";
$query_run = mysqli_query($conn, $query);

if(isset($_POST["export"]))

{
  $file = new Spreadsheet();

  $active_sheet = $file->getActiveSheet();

  $active_sheet->setCellValue('A1', 'How many meetings have been held per organisation and department');
  $active_sheet->setCellValue('A2', 'Number');
  $active_sheet->setCellValue('B2', 'Organization');
   $active_sheet->setCellValue('C2', 'Organization Department');
   
  
  
  $count = 3;

  foreach($query_run as $row)
  {
    $active_sheet->setCellValue('A' . $count, $row["COUNT"]);
     $active_sheet->setCellValue('B' . $count, $row["organization"]);
    $active_sheet->setCellValue('C' . $count, $row["department"]);
    
   

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

