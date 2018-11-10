<meta charset="utf-8">
<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
require_once("Classes/PHPExcel/IOFactory.php");
require_once("Classes/PHPExcel.php");
$obj=new CLS_MYSQL;
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
    ->setCreator("Tên người tạo")
    ->setLastModifiedBy("Tên người chỉnh sửa cuối cùng")
    ->setTitle("Tiêu đề file");
$sheet = $objPHPExcel->getActiveSheet();
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(20);
$index_worksheet = 0;
$style = array(
    'font' => array('bold' => true),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$sheet->getStyle('A1:P1')->applyFromArray($style);

$objPHPExcel->setActiveSheetIndex($index_worksheet)
    ->setCellValue('A1', 'STT')
    ->setCellValue('B1', 'Tên đăng nhập')
    ->setCellValue('C1', 'Họ và tên')
    ->setCellValue('D1', 'Chủ tài khoản')
    ->setCellValue('E1', 'Số tài khoản')
    ->setCellValue('F1', 'Tại ngân hàng')
    ->setCellValue('G1', 'Account')
    ->setCellValue('H1', 'Level1')
    ->setCellValue('I1', 'Level2')
    ->setCellValue('J1', 'Level3')
    ->setCellValue('K1', 'Level4')
    ->setCellValue('L1', 'Level5')
    ->setCellValue('M1', 'Level6')
    ->setCellValue('N1', 'Tổng tiền');
$hang = 2;


$sql="SELECT * FROM tbl_accounts ORDER BY `username`,`id` ASC";
$key='';
if(isset($_POST['txtsearch'])) {
    $key = addslashes($_POST['txtsearch']);
    $sql="SELECT * FROM tbl_accounts WHERE username='$key' OR account='$key' ORDER BY `id` ASC";
}
if(isset($_GET['key']) && $_GET['key']!='') {
    $key = addslashes($_GET['key']);
    $sql="SELECT * FROM tbl_accounts WHERE username='$key' OR account='$key' ORDER BY `username`,`id` ASC";
}
$obj->Query($sql);
$stt=0; $total=0;
while($row=$obj->Fetch_Assoc()){
    $stt++;
    $level1 = $level2 = $level3 = $level4 = $level5 = $level6 = $money = 0;
    $level = $row['level'];

    if($level==1) $level1=150000;
    if($level==2) { $level1=150000; $level2=500000; }
    if($level==3) { $level1=150000; $level2=500000; $level3=1000000;}
    if($level==4) { $level1=150000; $level2=500000; $level3=1000000; $level4=10000000;}
    if($level==5) { $level1=150000; $level2=500000; $level3=1000000; $level4=10000000; $level5=15000000;}
    if($level==6) { $level1=150000; $level2=500000; $level3=1000000; $level4=10000000; $level5=15000000; $level6=90000000;}
    $money = $level1 + $level2 + $level3 + $level4 + $level5 + $level6;
    $total+= $money;
    $username = $row['username'];
    $account_name = $row['account'];
    $sql="SELECT * FROM tbl_member_level WHERE username='$username'";
    $obj_m=new CLS_MYSQL;
    $obj_m->Query($sql);
    $row_m=$obj_m->Fetch_Assoc();
    $money_used=0;
    $money_have=0;

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $hang, $stt)
        ->setCellValue('B' . $hang, $username)
        ->setCellValue('C' . $hang, $row_m['fullname'])
        ->setCellValue('D' . $hang, $row_m['chutk'])
        ->setCellValue('E' . $hang, $row_m['stk'])
        ->setCellValue('F' . $hang, $row_m['bank'])
        ->setCellValue('G' . $hang, $account_name)
        ->setCellValue('H' . $hang, $level1)
        ->setCellValue('I' . $hang, $level2)
        ->setCellValue('J' . $hang, $level3)
        ->setCellValue('K' . $hang, $level4)
        ->setCellValue('L' . $hang, $level5)
        ->setCellValue('M' . $hang, $level6)
        ->setCellValue('N' . $hang, $money)
    ;
    $hang++;
}
$objPHPExcel->getActiveSheet()->setTitle('worksheet_0');
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_end_clean();
ob_start();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"hh_histories.xlsx\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save('php://output');
?>
