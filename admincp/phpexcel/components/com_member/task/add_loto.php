<?php
defined("ISHOME") or die("Can not acess this page, please come back!");
$id='';
if(isset($_GET['id'])){
	$id=addslashes($_GET['id']);
}
//kiểm tra xem user đã được add mã hay chưa
$sql="SELECT code FROM tbl_loto WHERE username='$id'";
$objdata=new CLS_MYSQL();
$objdata->Query($sql);
    if($objdata->Num_rows()==0){

    $obj->getList(" WHERE username='$id'");
    $r=$obj->Fetch_Assoc();

    $sql="SELECT code FROM tbl_loto WHERE active='0' ORDER BY RAND() LIMIT 0,1";

    $objdata->Query($sql);
    $code=$objdata->Fetch_Assoc();
    $rand_code=$code['code'];


    if(isset($_POST['cmd_addloto'])){
        $mem=addslashes($_POST['txt_username']);
        $code=(int)$_POST['txt_code'];
        $sql="UPDATE `tbl_loto` SET `username` = '$mem', `active`='1' WHERE `code`='$code'";
        $objdata=new CLS_MYSQL();
        $objdata->Query($sql);
        echo "<script language=\"javascript\">alert('Add mã thành công!')</script>";
        echo "<script language=\"javascript\">window.location='index.php?com=member'</script>";
    }


    ?>
    <div id="action">
    <form id="frm_action" name="frm_action" method="post" action="">
        <input type="hidden" class="txt_username" name="txt_username" value="<?php echo $id;?>"/>
        <fieldset>
        <legend><strong>Add mã</strong></legend>
            <h3>Add mã loto cho: <?php echo $r['fullname'];?></h3>
            <table style="float: left; margin-right: 50px; ">
            <tr>
                <td width="172" align="right" bgcolor="#EEEEEE"><strong>Mã Loto:<font color="red"> *</font></strong></td>
                <td>
                    <input type="radio" class="txt_action" name="txt_action" value="0" checked/>Số ngẫu nhiên
                    <input type="radio" class="txt_action" name="txt_action" value="1"/>Chọn cụ thể
                </td>
            </tr>
            <tr id="show-in">
                <td width="172" align="right"></td>
                <td>
                    <input type="text" id="txt_code" name="txt_code" value="<?php echo $rand_code;?>" readonly/>
                </td>
            </tr>
        </table>
            <div style="margin-top: 8px">
                <input type="submit" class="required" name="cmd_addloto" id="cmd_addloto" value="Xác nhận"/>
            </div>
        </fieldset>
      </form>
    </div>

<?php
}else{
    $row=$objdata->Fetch_Assoc();
   echo "<h3>User này đã được add mã Loto: ".$row['code']."</h3>";
}?>
<script>
    $('#frm_action').submit(function(){
        if($('#txt_code').val()==''){
            return false;
            $('#txt_code').focus();
        }
        else return true;
        return false;
    })
    $('.txt_action').click(function(){
        var val=$(this).attr('value');
        var input=' <td width="172" align="right" bgcolor="#EEEEEE"><strong>Nhập số:<font color="red"> *</font></strong></td><td class="tr-parent"><input type="text" class="required" name="txt_code" id="txt_code" value="" onkeyup="doSearch(this.value)"/><div id="data"></div></td>';
        var input2=' <td width="172" align="right" bgcolor="#EEEEEE"><strong>Nhập số:<font color="red"> *</font></strong></td><td class="tr-parent"><input type="text" class="required" name="txt_code" id="txt_code" value="<?php echo $rand_code;?>" readonly></td>';
        if(val==1){
            $('#show-in').html(input);
        }
        else{
            $('#show-in').html(input2);
        }
    })



    var delayTimer;
    function doSearch(txt) {
        $('#data').show();
        if(txt.length >=2){
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                $.post('<?php echo ROOTHOST;?>admincp/ajaxs/getCodeLoto.php',{txt},function(req){
                    $('#data').html(req);
                    /*$('#img-loading').hide();*/
                });
            }, 500);
        }
        else{
            return false;
        }

    }
</script>

