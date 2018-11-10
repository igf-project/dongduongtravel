<?php
include_once('../includes/gfinnit.php');
include_once('../includes/gfconfig.php');
include_once('../libs/cls.mysql.php');
include_once('../libs/cls.positioncontact.php');
$objPoContact=new CLS_POSITIONCONTACT();
if(isset($_POST['txt_position_id'])){
    $objPoContact->positionId=$_POST['txt_position_id'];
    var_dump($_POST['txt_position_id']);
}

$objPoContact->countryId=$_POST['cbo_countries'];
$objPoContact->locationId=$_POST['cbo_location'];
$objPoContact->contactName=addslashes($_POST['txt_contact_name']);
$objPoContact->Phone=addslashes($_POST['txt_phone']);
$objPoContact->Address=addslashes($_POST['txt_address']);
$objPoContact->Email=addslashes($_POST['txt_email']);
$objPoContact->Website=addslashes($_POST['txt_website']);
$objPoContact->Latlng=addslashes($_POST['txt_latlng']);
$objPoContact->isActive='1';
$objPoContact->Order=0;
if(isset($_POST['txt_id'])){
    $objPoContact->ID=$_POST['txt_id'];
    $objPoContact->Update();
}
else{
    $objPoContact->Add_new();
    var_dump('addnew');
}
$ajax='';
$str="AND `tbl_position_contact`.`position_id`=".$objPoContact->positionId;
$objPoContact->listTable($str, $ajax=true); /*load list width call ajax*/
?>

<script>
    $('.actAjax').click(function(){
        var data = {
            'val': $(this).attr('value'),
            'posId': $(this).attr('posId'),
            'act': $(this).attr('act')
        }
        $.post('ajaxs/comAction.php',data,function(response_data){
            $("#tr-"+ data['val']).html(response_data);
        })
        //console.log('aa');
    });
    $('.actEdit').click(function(){
        var txt_position_id=$('#txt_position_id').val();
        var val=$(this).attr('value');
        $.get('ajaxs/actionFormEdit.php',{val, txt_position_id},function(response_data){
            $('#myModal').modal('show');
            $('#data-frm').html(response_data);
        })
    });
</script>
<?php unset($objPoContact);?>