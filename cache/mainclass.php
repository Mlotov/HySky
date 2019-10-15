<?php
class Caching {
	public $cachefilename = 'auctions.html'; //Directory you want to save the cache file to 

	function __construct() {
		//Lets check if the cache file exists
		if(file_exists($this->cachefilename)) {
			
			//Yea, the cache file of the page really exist, but lets check if it has reached its expiring time
			if($this->_checkTime(filemtime($this->cachefilename))==true)
				{
					//Seriously it has :/, Delete it :)
					unlink($this->cachefilename);	
				}
				
			//Assuming its existing and it has not expired
			else 
				{
					//Load the cache and leave your db and other things to rest
					include($this->cachefilename);
					die();
				}
		}
	}

	function __deconstruct() 
		{
			ob_end_flush();
		}

	function SaveCache() {
		$file = fopen($this->cachefilename, 'w');
		fwrite($file, ob_get_contents());
		fclose($file);
	}
	
	function _checkTime($filetime,$time = 1) // $time value is in minutes, the default is 3 minutes
		{
			$t = time() - $filetime;
			if($t/60>$time)
				{
					return true;
				}
			else
				{
					return false;
				}
		}
}
?>