<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../libs/cls.member_level.php');
require_once("Classes/PHPExcel/IOFactory.php");
require_once("Classes/PHPExcel.php");
$obj=new CLS_MYSQL;
$objmem=new CLS_MEMBER_LEVEL();
$sql="SELECT * FROM tbl_member_level";
if(isset($_GET['key']) && $_GET['key']!='') {
    $key = addslashes($_GET['key'] && $_GET['key']!='');
    $sql="SELECT * FROM tbl_member_level WHERE username='$key'";
}

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
   ->setCellValue('D1', 'Chủ tài khoản')
   ->setCellValue('E1', 'Số tài khoản')
   ->setCellValue('F1', 'Tại ngân hàng')
   ->setCellValue('G1', 'Số mã giới thiệu')
   ->setCellValue('H1', 'Thưởng / mã')
   ->setCellValue('I1', 'Tổng tiền')
   ->setCellValue('J1', 'Đã chi')
   ->setCellValue('K1', 'Công nợ');
   $hang = 2;

$obj->Query($sql);
$str_data="BẢNG THỐNG KÊ HOA HỒNG TRỰC TIẾP\n";

$stt=0; $total=0;
while($row=$obj->Fetch_Assoc()){
    $stt++;
    $numberAcc = $objmem->numberAccount($row['username']);
    $totalMoney = $objmem->Count_money_tt(1,$row['username']);
    $money_used = $objmem->Count_money_tt(2,$row['username']);
    $money_have = $totalMoney - $money_used;
    $str_data.="$stt,";
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $hang, $stt)
        ->setCellValue('B' . $hang, $row['username'])
        ->setCellValue('C' . $hang, $row['fullname'])
        ->setCellValue('D' . $hang, $row['chutk'])
        ->setCellValue('E' . $hang, $row['stk'])
        ->setCellValue('F' . $hang, $row['bank'])
        ->setCellValue('G' . $hang, $numberAcc)
        ->setCellValue('H' . $hang, '700000')
        ->setCellValue('I' . $hang, $totalMoney)
        ->setCellValue('J' . $hang, $money_used)
        ->setCellValue('K' . $hang, $money_have);
    $hang++;
}

$objPHPExcel->getActiveSheet()->setTitle('worksheet_0');
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_end_clean();
ob_start();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"hh_tructiep.xlsx\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save('php://output');


?>