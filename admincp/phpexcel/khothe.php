<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../libs/cls.member_level.php');
include_once('../libs/cls.card.php');
require_once("Classes/PHPExcel/IOFactory.php");
require_once("Classes/PHPExcel.php");
$obj=new CLS_MYSQL;
$objmem=new CLS_MEMBER_LEVEL();
$objcard=new CLS_CARD();
$where='';
$sql="SELECT * FROM tbl_card $where";
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
   ->setCreator("Tên người tạo")
   ->setLastModifiedBy("Tên người chỉnh sửa cuối cùng")
   ->setTitle("Tiêu đề file");
   $index_worksheet = 0;
$sheet = $objPHPExcel->getActiveSheet();
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(12);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(25);
$sheet->getColumnDimension('F')->setWidth(20);

$style = array(
    'font' => array('bold' => true),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);
$sheet->getStyle('A1:m1')->applyFromArray($style);

$objPHPExcel->setActiveSheetIndex($index_worksheet)
   ->setCellValue('A1', 'STT')
   ->setCellValue('B1', 'Mã PIN')
   ->setCellValue('C1', 'Gói')
   ->setCellValue('D1', 'Kiểu gói')
   ->setCellValue('E1', 'Ngày tạo')
   ->setCellValue('F1', 'Người tạo mã')
   ->setCellValue('G1', 'Trạng thái')
   ->setCellValue('H1', 'Tình trạng sửa dụng')
   ->setCellValue('I1', 'Ngày sử dụng')
   ->setCellValue('J1', 'Sử dụng bởi');
   $hang = 2;

$obj->Query($sql);
$str_data="BẢNG MÃ THẺ\n";

$stt=1; $total=0;
while($r=$obj->Fetch_Assoc()){
	$id=" ".$r['cardcode'];
	$packet=$r['packet'];
	$cdate=date('h:i:s d/m/Y',$r['cdate']);
	$udate='';
	if($r['udate']!='')
	$udate=date('h:i:s d/m/Y',$r['udate']);
	$author=$r['author'];
	$type=$r['type'];
	$status=$r['status']==0?"Chưa sử dụng":($r['status']==1?"Đã sử dụng":"Đã hủy");
	$buy=$r['user_buy']==''?"Chưa mua":'Đã mua bởi '.$r['user_buy'];
	$member = $objcard->getMemberUsed($id);
    $str_data.="$stt,";
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $hang, $stt)
        ->setCellValue('B' . $hang, $id)
        ->setCellValue('C' . $hang, $packet)
        ->setCellValue('D' . $hang, $type)
        ->setCellValue('E' . $hang, $cdate)
        ->setCellValue('F' . $hang, $author)
        ->setCellValue('G' . $hang, $buy)
        ->setCellValue('H' . $hang, $status)
        ->setCellValue('I' . $hang, $udate)
        ->setCellValue('J' . $hang, $member);
    $hang++;
}

$objPHPExcel->getActiveSheet()->setTitle('worksheet_0');
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_end_clean();
ob_start();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"kho_the.xlsx\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save('php://output');


?>