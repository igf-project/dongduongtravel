<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourpersonrequest.php');
$obj=new CLS_TOURPERSONREQUEST();
if(isset($_POST['txt_fullname'])){
    $obj->PersonTypeId='';
    $obj->Fullname=addslashes($_POST['txt_fullname']);
    $obj->Phone=addslashes($_POST['txt_phone']);
    $obj->Email=addslashes($_POST['txt_email']);
    $obj->Cmt=addslashes($_POST['txt_cmt']);
    $obj->Address=addslashes($_POST['txt_address']);
    $obj->NumberPerson=addslashes($_POST['txt_numperson']);
    $obj->NumberChild14=isset($_POST['txt_numchild14'])?addslashes($_POST['txt_numchild14']):'';
    $obj->NumberChild59=isset($_POST['txt_numchild59'])?addslashes($_POST['txt_numchild59']):'';
    $obj->NumDay=addslashes($_POST['txt_numday']);
    $obj->NumNight=addslashes($_POST['txt_numnight']);
    $obj->WhereStart=addslashes($_POST['txt_wherestart']);
    $obj->Position=addslashes($_POST['txt_position']);
    $obj->RankHotel=addslashes($_POST['txt_rankhotel']);
    $obj->Other=addslashes($_POST['txt_other']);
}
else
    echo "Not acset Program";
if(isset($_POST['txtid'])){
    $obj->ID=$_POST['txtid'];
    $obj->Update();
}
else{
    $obj->Add_new();
}
?>