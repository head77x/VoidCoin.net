/**
	 * Prepare to request parameters.	
	 */
	 
	$params=array();
	$params['appid']=''; // 와라페이 앱의 내정보>APPID에서 확인
	$params['callback']='json';//Return type
	$params['point_type']='1';//Point type
	$params['interval_time']='10';//10 minutes
	$params['point']='10';//Get Point

	$params['password']='';//warapay Get

	/**
	 * These are the necessary parameters
	 * For more parameters, please read the API document.
	 */

	/**
	 * Start the request
	 */	 
	
	$url="http://wara-kr.quickget.co/pay/request_point.html";
	$result=file_get_contents($url."?".http_build_query($params));
