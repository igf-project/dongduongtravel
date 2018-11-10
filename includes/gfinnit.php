<?php
	define('HOSTNAME','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');
	define('DB_DATANAME','db_dongduong_travel');
	// innit com_language
	define('IS_ACTIVE_LANG',true);

	$AR_COUNTRY = array(
		array('id'=>57, 'name'=>'Việt Nam')
	);

	$AR_POSITION_GROUP = array(
		array('id'=>63, 'name'=>'Ẩm thực', 'code'=>'an-gi'),
		array('id'=>62, 'name'=>'Địa điểm', 'code'=>'di-dau'),
		array('id'=>64, 'name'=>'Ngủ nghỉ', 'code'=>'ngu-o-dau')
	);

	$AR_TOUR_TYPE = array(
		array('id'=>1, 'name'=>'Du lịch trải nghiệm khám phá', 'code'=>'du-lich-trai-nghiem-kham-pha'),
		array('id'=>6, 'name'=>'Du lịch nghỉ dưỡng', 'code'=>'du-lich-nghi-duong'),
		array('id'=>7, 'name'=>'Du lịch đào tạo tri thức', 'code'=>'du-lich-dao-tao-tri-thuc'),
		array('id'=>8, 'name'=>'Du lịch doanh nhân', 'code'=>'du-lich-doanh-nhan'),
		array('id'=>9, 'name'=>'Tour Du Lịch Tâm Linh', 'code'=>'tour-du-lich-tam-linh')
	);

	$AR_EXPEDIENCY = array(
		array('id'=>1, 'name'=>'Ô tô', 'code'=>'oto'),
		array('id'=>2, 'name'=>'Máy bay', 'code'=>'may-bay'),
		array('id'=>3, 'name'=>'Tàu hỏa', 'code'=>'tau-hoa'),
		array('id'=>4, 'name'=>'Tàu thủy', 'code'=>'tau-thuy')
	);

	$AR_HOTEL_STAR = array(
		array('id'=>6, 'name'=>'Tiêu chuẩn'),
		array('id'=>1, 'name'=>'1 sao'),
		array('id'=>2, 'name'=>'2 sao'),
		array('id'=>3, 'name'=>'3 sao'),
		array('id'=>4, 'name'=>'4 sao'),
		array('id'=>5, 'name'=>'5 sao')
	);

	$AR_CATE_CONTENT = array(
		array('id'=>1, 'name'=>'Lịch sử', 'code'=>'lich-su'),
		array('id'=>2, 'name'=>'Văn hóa', 'code'=>'van-hoa'),
		array('id'=>3, 'name'=>'Lễ hội', 'code'=>'le-hoi')
	);
?>