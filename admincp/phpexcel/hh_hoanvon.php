<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../libs/cls.member_level.php');
require_once("Classes/PHPExcel/IOFactory.php");
require_once("Classes/PHPExcel.php");
$obj=new CLS_MYSQL;
$objmem=new CLS_MEMBER_LEVEL();
$strWhere='';
if(isset($_GET['key']) && $_GET['key']!='') {
    $key = addslashes($_GET['key'] && $_GET['key']!='');
    $strWhere.=" AND username='$key'";
}
$table='tbl_hh_hoanvon';
$sql="SELECT * FROM $table WHERE 1=1 $strWhere GROUP BY `username`";
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
   ->setCreator("Tên người tạo")
   ->setLastModifiedBy("Tên người chỉnh sửa cuối cùng")
   ->setTitle("Tiêu đề file");
   $index_worksheet = 0;
$sheet = $objPHPExcel->getActiveSheet();
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(30);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(20);

$style = array(
    'font' => array('bold' => true),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$sheet->getStyle('A1:m1')->applyFromArray($style);

$objPHPExcel->setActiveSheetIndex($index_worksheet)
   ->setCellValue('A1', 'STT')
   ->setCellValue('B1', 'Tên đăng nhập')
   ->setCellValue('C1', 'Họ và tên')
   ->setCellValue('D1', 'Mã số')
   ->setCellValue('E1', 'Thưởng / mã')
   ->setCellValue('F1', 'Tổng tiền');
   $hang = 2;

$obj->Query($sql);
$str_data="BẢNG THỐNG KÊ HOA HỒNG HOÀN VỐN\n";

$stt=0; $total=0;
while($row=$obj->Fetch_Assoc()){
    $stt++;
    $code =$row['code'];
    $username = $objmem->getNameByUser($row['username']);
    $totalMoney = $objmem->Count_money_hh_wallet(1,$table,$row['username']);
/*    $money_used = $objmem->Count_money_hh_wallet(2,$table,$row['username']);
    $money_have = $totalMoney - $money_used;*/
    $str_data.="$stt,";
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $hang, $stt)
        ->setCellValue('B' . $hang, $row['username'])
        ->setCellValue('C' . $hang, $username)
        ->setCellValue('D' . $hang, $code)
        ->setCellValue('E' . $hang, '50 - 70k')
        ->setCellValue('F' . $hang, number_format($totalMoney));
    $hang++;
}

$objPHPExcel->getActiveSheet()->setTitle('worksheet_0');
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_end_clean();
ob_start();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"hh_hoanvon.xlsx\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save('php://output');


?>