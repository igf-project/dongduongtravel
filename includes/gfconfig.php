<?php
// define path to dirs
    define('ROOTHOST','http://'.$_SERVER["SERVER_NAME"].'/dongduongtravel/');
	define('WEBSITE','http://'.$_SERVER['HTTP_HOST'].'/dongduongtravel/');
	define('BASEVIRTUAL0',ROOTHOST.'images/');
	define('ROOT_PATH',''); 
	define('TEM_PATH',ROOT_PATH.'templates/');
	define('COM_PATH',ROOT_PATH.'components/');
	define('MOD_PATH',ROOT_PATH.'modules/');
	define('LAG_PATH',ROOT_PATH.'languages/');
	define('EXT_PATH',ROOT_PATH.'extensions/');
	define('EDI_PATH',EXT_PATH.'editor/');
	define('DOC_PATH',ROOT_PATH.'documents/');
	define('DAT_PATH',ROOT_PATH.'databases/');
	define('IMG_PATH',ROOT_PATH.'images/');
	define('MED_PATH',ROOT_PATH.'media/');
	define('LIB_PATH',ROOT_PATH.'libs/');
	define('JSC_PATH',ROOT_PATH.'js/');
	define('LOG_PATH',ROOT_PATH.'logs/');
	 define('PATH_GALLERY','uploads/gallery/');/* ding nghia url upload*/
    define('PATH_VIDEO','uploads/video/');/* ding nghia url upload*/
    define('PATH_THUMB','uploads/thumb/');/* ding nghia url upload*/
    define('PATH_AVATAR','uploads/avatar/');/* ding nghia url luu anh dai dien cua position contact*/
    define('THUMB_DEFAULT','images/thumb_default.png');/* ding nghia ảnh mặc định khi khong load được ảnh*/
    define('PATH_NEWS','uploads/news/');/* */

	define('MAX_ROWS','12');
	define('MAX_ITEM','60'); // số bản ghi trên 1 trang
	define('LOGIN_TIME_OUT','60');
	define('URL_REWRITE','1');
	define('MAX_ROWS_INDEX',40);
	
	define('THUMB_WIDTH',285);
	define('THUMB_HEIGHT',285);
	
	$LANG_CODE='vi';
	/*define message respon*/

    define('EMPTY_DATA','Hệ thống đang cập nhật. Vui lòng quay lại sau!');

	define('SMTP_SERVER','mail.igf.com.vn.com');
	define('SMTP_PORT','25');
	define('SMTP_USER','nxtuyen@igf.com.vn');
	define('SMTP_PASS','123456');
	define('SMTP_MAIL','nxtuyen@igf.com.vn');
	define('IGF_LICENSE','585dd5f8e38061c5186b42c6e0b5ff41');
	
	define('SHOP_CODE','TD');//hàng tiêu dùng
	define('SITE_NAME','igf.com.vn');
	define('SITE_TITLE','');
	define('SITE_DESC','');
	define('SITE_KEY','');
	define('COM_CONTACT','Địa chỉ: 128 Xuân Thủy- Cầu Giấy - Hà Nội<br/>
			Điện thoại: (04) 6 329 4036 | Hotline:0984 486 830 - 0936 831 277<br/>
			Email: info@igf.com.vn | Website: http://igf.com.vn');
			
	define('ARR_TYPEPOSITION','69, 60, 62, 63, 67');/* danh sách dạng position là dạng có thực đơn, dịch vụ*/
?>