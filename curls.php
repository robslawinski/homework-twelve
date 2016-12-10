<?php
class Curls
{
	function httpGet($url)
	{
		$ch = curl_init();
	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($ch,CURLOPT_HEADER, false);
	
		$output=curl_exec($ch);
		try {
			if(curl_errno($ch))
			{
				throw new Exception(curl_error($ch));
			}
		}
		catch(Exception $e)
		{
				echo $e->getMessage(); 				
		}
		curl_close($ch);
		
		return $output;
		
	}
	
	function httpPost($url,$params)
	{
		$postData = '';
		//create name value pairs seperated by &
		foreach($params as $k => $v)
		{
			$postData .= $k . '='.$v.'&';
		}
		$postData = rtrim($postData, '&');
	
		$ch = curl_init();
	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	
		$output=curl_exec($ch);
		try {
			if(curl_errno($ch))
			{
				throw new Exception(curl_error($ch));
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		curl_close($ch);
		return $output;
		
	}
	
}
echo Curls::httpGet("https://web.njit.edu/~rjs59/");

$params = array(
		"name" => "Rob Slawinski",
		"age" => "20",
		"location" => "The Greatest Country on Earth"
);

echo Curls::httpPost("https://web.njit.edu/~rjs59/homework12/curls.php",$params);
?>