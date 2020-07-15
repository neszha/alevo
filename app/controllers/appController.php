<?php
/**
 * @Controller  : appController made by .ALEVO.
 * @Date        : 2020-04-24 01:17:07
 * @Message     : Don't be lazy typing
 */
class appController extends Controller
{

	public function __construct()
	{
		// your_code
	}

	public function beauty_time($time)
	{
		$value = $this->get_obj();
		preg_match_all('/(?:\d)+/', $time, $match);
		$key_bulan = number_format($match[0][1]);
		$this->y   = $match[0][0];
		$this->m   = $value->bulan->$key_bulan;
		$this->d   = $match[0][2];
		$this->h   = $match[0][3];
		$this->i   = $match[0][4];
		$this->s   = $match[0][5];
		return $this;
	}

	public function beauty_time_complete($time)
	{
		$x = $this->beauty_time($time);
		return "{$x->d} {$x->m} {$x->y} {$x->h}:{$x->i}:{$x->s}";
	}

	public function get_obj()
	{
		$path = "storage/data/mainValue.json";
		$json = file_get_contents($path);
		$obj  = json_decode($json);
		return $obj;
	}
	
}