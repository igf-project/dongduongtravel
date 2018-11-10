// JavaScript Document
function showCombobox(){
	var value = document.getElementById("style").value; //alert(value);
	var title =''; var input ='';
	
	switch(value) {
		case 'blog': 
		case 'list':
			title ="Chủ đề :";
			input = document.getElementById("cbo_showCateID").innerHTML;
			break;
		case 'detail': {
			title ="Bài viết :";
			input ='<input name="con_id" id="con_id" type="text" size="30" value="Chọn bài viết" readonly=""/><input type="button" name="choice_Content" value="Lựa chọn" onclick="javascript:popup_choiceContent();" />';
			break;}
		case 'link': {
			title ="Liên kết :";
			input ='<input name="link" type="text" id="link" size="30" value="Nhập đường dẫn..." onfocus="'+"javascript:this.value=''"+';"/>';
			break;}
	}
	document.getElementById("rowChoice1").innerHTML = title;
	document.getElementById("rowChoice2").innerHTML = input;
	
}
function popup_choiceContent(){
	window.open("contents_manager/list_choice.php","LIST CHOICE","top=200,left=250,height=400,width=500,status=0,toolbar=0,scrollbars=1");
}

function close_ChoiceContent(str,title) {
	//alert(str);
	window.opener.document.getElementById('txtcontentID').value = str;
	window.opener.document.getElementById('con_id').value = title;
	window.close();
}


function explode (delimiter, string, limit) {
     var emptyArray = { 0: '' };
    
    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined' ) {
        return null;
    }
 
    if ( delimiter === '' ||        delimiter === false ||
        delimiter === null ) {
        return false;
    }
     if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||
        typeof string == 'object' ) {
        return emptyArray;    }
 
    if ( delimiter === true ) {
        delimiter = '1';
    }    
    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;    }
}

function choose_showon(str,ids){
	var cbo = document.getElementById("mnu_id[]");
	var ctr ='';
	switch (str) {
		case 'all': {
			cbo.disabled=true;
			ctr = cbo.getElementsByTagName("option");
			for(var i=0;i<ctr.length;i++) {
				ctr[i].selected="selected";
			}
			break; }
		case 'none': {
			cbo.disabled=true;
			ctr = cbo.getElementsByTagName("option");
			for(var i=0;i<ctr.length;i++) {
				ctr[i].selected=false;
			}
			break;}
		case 'multi': {
			ctr = cbo.getElementsByTagName("option");
			cbo.disabled=false;
			if(ids!='0') {
				var id= new Array();
				id= explode(',',ids);
				j=0;
				for(var i=0;i<ctr.length;i++) {
					if(id[j]==ctr[i].value){
						ctr[i].selected="selected"; j++;
					}
				}
			}
			break;}
	}
}
// JavaScript Document
function docheckall(name,status){
	var objs=document.getElementsByName(name);
	for(i=0;i<objs.length;i++)
		objs[i].checked=status;
	getIDchecked(name);
}
function docheckonce(name){
	var objs=document.getElementsByName(name);
	var flag=true;
	for(i=0;i<objs.length;i++)
		if(objs[i].checked!=true)
		{
			flag=false;
			break;
		}
	document.getElementById("chkall").checked=flag;
	getIDchecked(name);
}
function getIDchecked(name){
	var objs=document.getElementsByName(name);
	var strids="";
	for(i=0;i<objs.length;i++)
		if(objs[i].checked==true)
		{
			strids+=objs[i].value+",";
		}
	document.getElementById("txtids").value=strids;
	activeTr();
}
function activeTr(){
	var Trs=document.getElementsByName("trow");
	for(i=0;i<Trs.length;i++)
	{
		var check=Trs[i].getElementsByTagName("input");
		if(check[0].checked==true)
			Trs[i].className="active";
		else
			Trs[i].className="";
	}
}

function dosubmitAction(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true){
		if(frmID=="frm_action")
		document.getElementById("cmdsave").click();
		else
		document.frm_menu.submit();
	}
}
function dosubmitActionEdit(frmID,action){
    if(document.getElementById("txtaction"))
        document.getElementById("txtaction").value=action;
    if(checkinput()==true){
        if(frmID=="frm_action_edit")
            document.getElementById("cmdsave").click();
        else
            document.frm_menu.submit();
    }
}
function saveOrder(){
    var ids = document.getElementsByName("chk"); 
	var orders= document.getElementsByName("txt_order");
    var strids ='';
    var strorder ='';
    
    for (var i=0;i<ids.length;i++) {
        strids  += ids[i].value+",";
        strorder  += orders[i].value+",";        
    }
    document.getElementById("txtids").value = strids;
    document.getElementById("txtorders").value = strorder;
	document.getElementById("txtaction").value='order';
    document.frm_menu.submit(); 
}

function doSave(frmID,action){
	if(document.getElementById("txtaction"))
		document.getElementById("txtaction").value=action;
	if(checkinput()==true)
	{
		if(frmID=="frm_action")
			document.getElementById("cmdsave").click();
		else
			document.frm_menu.submit();
	}
}

function gotopage(page)
{
	document.getElementById("txtCurnpage").value=page;
	document.frmpaging.submit();
}
function openlink(url)
{
	window.location=url;
}
function onsearch(thisitem,type){
	var str=thisitem.value;
	if(type==0 && str=="")
		thisitem.value="Keyword";
	if(type==1)
		thisitem.value="";
}
function cbo_Selected(id,value)
{
	var obj=document.getElementById(id);
	for(i=0;i<obj.length;i++)
		if(obj[i].value==value)
			obj.selectedIndex=i;
}
function OpenPopup(url){
	myWindow=window.open(url,'_blank','width=750,height=400');
}
function openBox(url)
{
	
	var xmlhttp;
	if (url.length==0)
	  {
	  document.getElementById("shopcart").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("shopcart").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
function showdate(){
	var mydate=new Date()
	var year = mydate.getYear()
	if (year < 1000)
		year += 1900
	var month = mydate.getMonth() + 1
	if (month < 10)
		month = "0" + month
	var day = mydate.getDate()
	if (day < 10)
		day = "0" + day
	var dayw = mydate.getDay()
	var hour = mydate.getHours()
	if (hour < 10)
		hour = "0" + hour
	var minute=mydate.getMinutes()
	if (minute < 10)
		minute = "0" + minute
	var second=mydate.getSeconds()
	if (second < 10)
		second = "0" + second
	var dayarray=new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var strtime="<span class=date>"+dayarray[dayw]+", "+day+"/"+month+"/"+year+" "+hour+":"+minute+":"+minute+"</span>"
	document.getElementById("gf-clock").innerHTML=strtime;
	id=setTimeout("showdate()",1000);
}
function clock(){
	var now=new Date();
	var year=now.getFullYear();
	var month=now.getMonth();
	var date=now.getDate();
	var day=now.getDay();
	var hour=now.getHours();
	var minute=now.getMinutes();
	var second=now.getSeconds();
	var montharray=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
	var dayarray=new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var disptime=dayarray[day]+", "+date+"/"+montharray[month]+"/"+year+" ";
	disptime+=((hour>12) ? hour-12 : hour)+((minute<10)?":0":":")+minute;
	disptime+=((second<10)? ":0":":")+second+((hour>=12) ? " PM" : " AM");
	document.getElementById("datetime").innerHTML=disptime;
	// getElementById(String elementId);
	id=setTimeout("clock()",1000);
}
function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,9}$/;
   if(!re.test(phone.value)){alert("Số điện thoại của bạn không hợp lệ. Số điện thoại chỉ bao gồm số từ 0 đến 9.");return false;}
   return true;
}
function checkField(field,name){
   if(field.value == ""){
      alert(name + ' không được bỏ trống');
      field.focus();
   }
}
function checkEmail(email){
   re=/^(([a-zA-Z0-9])+\.?)*([a-zA-Z0-9])+@(([a-zA-Z0-9])+\.)+[a-zA-Z]{2,4}$/;
   if(!re.test(email.value)){return false;}
   return true;
}
function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,9}$/;
   if(!re.test(phone.value)){return false;}
   return true;
}
 function slider_item(index){
    var mySwiper=[];
    var elem = document.getElementById('slider-item' + index);
    mySwiper[index] = new Swiper(elem, {
        // pagination: '.swiper-pagination'+ index,
        nextButton: '.swiper-button-next'+ index,
        prevButton: '.swiper-button-prev'+ index,
        loop: true,
        speed: 600,
        autoplay: false
    });
}
function slider_main(){
    var elem_main = document.getElementById('slider-main');
    var swiper = new Swiper(elem_main, {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        speed: 600,
        autoplay: 4000,
        loop: true,
        autoplayDisableOnInteraction: false
        /*onSlideChangeStart: function (s) {
         var activeSlideHeight = s.slides.eq(s.activeIndex).height();
         $(elem_main).css({height: activeSlideHeight+'px'});
         }	*/
    });
}


/*scroll to div*/

function scrollToBox(objId, toClassDiv){
    $('#'+objId+'').click(function() {
        $('html,body').animate({
                scrollTop: $('.'+toClassDiv+'').offset().top},
            'slow');
    });
}


function readMore(obj, showChar){
    var ellipsestext = "...";
    var moretext = "Đọc thêm >";
    var lesstext = "< Rút gọn";
    $('.'+obj+'').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $('.'+obj+' .morelink').click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
}


