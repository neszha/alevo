<?php
/**
 * @Controller  : siswa_dashboardController made by .ALEVO.
 * @Date        : 2020-04-20 02:47:28
 * @Message     : Don't be lazy typing
 */
class siswa_dashboardController extends Controller
{

	public function __construct()
	{
		$this->siswaAuth = $this->run('siswa_authController');
		$this->siswa     = $this->siswaAuth->auth();
	}

	public function index()
	{
		// your_code
	}

	public function other_method()
	{
		// your_code
	}
	
}