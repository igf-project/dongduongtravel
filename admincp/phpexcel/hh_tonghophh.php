<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
require_once("Classes/PHPExcel/IOFactory.php");
require_once("Classes/PHPExcel.php");
$strWhere=$strWhereMem="";
$obj=new CLS_MYSQL;
/*lấy tháng năm hiện tại*/
$month_now=date('m');
$year_now=date('Y');
if(isset($_POST['export_excel'])){
    $keyword = addslashes($_POST['txtkeyword']);
    $month = isset($_POST['txt_month']) ? addslashes($_POST['txt_month']): $month_now;
    $year = isset($_POST['txt_year']) ? addslashes($_POST['txt_year']): $year_now;
}
if($keyword!="" && $keyword!="Keyword")
    $strWhereMem=" AND ( `username` like '%$keyword%' OR `fullname` like '%$keyword%')";
if($month!=$month_now) $strWhere.="AND MONTH(cdate)='$month'";
else $strWhere.=" AND MONTH(cdate)='$month_now'";
if($year!=$year_now) $strWhere.="AND YEAR(cdate)='$year'";
else $strWhere.=" AND YEAR(cdate)='$year_now'";

function money_hh($table,$username, $strWhere){
    $sql="SELECT sum(`money`) as sum FROM $table WHERE username='$username' AND money>0 $strWhere";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $rw=$objdata->Fetch_Assoc();
    return $rw['sum']+'0';
}
function dachi($username, $strWhere){
    $sql="SELECT sum(`money`) as sum FROM tbl_wallet WHERE username='$username' AND `money`<0 AND `status`='1' $strWhere";
    $objdata=new CLS_MYSQL();
    $objdata->Query($sql);
    $rw=$objdata->Fetch_Assoc();
    return $rw['sum']+'0';
}


$sql="SELECT * FROM tbl_member_level WHERE isactive=1 $strWhereMem";
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
   ->setCellValue('B1', 'Họ và tên')
   ->setCellValue('C1', 'Tên đăng nhập')
   ->setCellValue('D1', 'HH thoát cung')
   ->setCellValue('E1', 'HH tư vấn')
   ->setCellValue('F1', 'HH hoàn vốn')
   ->setCellValue('G1', 'HH chia lãi định kỳ')
   ->setCellValue('H1', 'Tổng tiền HH');
   $hang = 2;

$obj->Query($sql);
$str_data="BẢNG THỐNG KÊ TỔNG HỢP HOA HỒNG\n";

$stt=0; $total=0;
while($rows=$obj->Fetch_Assoc()){
    $stt++;
    $fullname=$rows["fullname"];
    $username=$rows["username"];
    $hh_thoatcung=money_hh('tbl_hh_histories', $username, $strWhere);
    $hh_tructiep=money_hh('tbl_hh_tructiep', $username, $strWhere);
    $hh_hoanvon=money_hh('tbl_hh_hoanvon', $username, $strWhere);
    $hh_chilaidinhky=money_hh('tbl_hh_laidinhky', $username, $strWhere);
    $total=$hh_thoatcung+$hh_tructiep+$hh_hoanvon+$hh_chilaidinhky;

    $str_data.="$stt,";
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $hang, $stt)
        ->setCellValue('B' . $hang, $fullname)
        ->setCellValue('C' . $hang, $username)
        ->setCellValue('D' . $hang, $hh_thoatcung)
        ->setCellValue('E' . $hang, $hh_hoanvon)
        ->setCellValue('F' . $hang, $hh_tructiep)
        ->setCellValue('G' . $hang, $hh_chilaidinhky)
        ->setCellValue('H' . $hang, $total);
    $hang++;
}

$objPHPExcel->getActiveSheet()->setTitle('worksheet_0');
$objPHPExcel->setActiveSheetIndex(0);
ob_clean();
ob_end_clean();
ob_start();
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"thongke_tonghophh.xlsx\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save('php://output');


?>