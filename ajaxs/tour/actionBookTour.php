<?php
include_once('../../includes/gfinnit.php');
include_once('../../includes/gffunction.php');
include_once('../../includes/gfconfig.php');
include_once('../../libs/cls.mysql.php');
include_once('../../libs/cls.tourperson.php');
$obj=new CLS_TOURPERSON();
if(isset($_POST['txt_fullname'])){
    $obj->TourId=(int)$_POST['txt_tourid'];
    $obj->PersonTypeId='';
    $obj->Fullname=addslashes($_POST['txt_fullname']);
    $obj->Phone=addslashes($_POST['txt_phone']);
    $obj->Email=addslashes($_POST['txt_email']);
    $obj->Cmt=addslashes($_POST['txt_cmt']);
    $obj->Address=addslashes($_POST['txt_address']);
    $obj->NumberPerson=addslashes($_POST['txt_numperson']);
    $obj->NumberChild14=isset($_POST['txt_numchild14'])?addslashes($_POST['txt_numchild14']):'';
    $obj->NumberChild59=isset($_POST['txt_numchild59'])?addslashes($_POST['txt_numchild59']):'';
    $obj->Type=(int)$_POST['txt_type'];
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
