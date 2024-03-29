<?php 

class RenderEngine
{
    public function __construct()
    {
    	require_once 'system/lib/sysPath.php';
        require_once 'system/development/cli/core/Effects.php';
    	$this->sysPath = new sysPath();
        if(!isset($_ENV['templateEngine'])) $_ENV['templateEngine'] = require_once 'app/config/TemplateEngine.php';
    }

    public function render_view()
    {
    	require_once 'system/development/cli/core/actions/RenderView.php';
    	$obj = new RenderView();
    	$obj->main();
    }

    public function update_render_view($view, $path)
    {
        require_once 'system/development/cli/core/actions/RenderView.php';
        $obj = new RenderView();
        $obj->update_view_file($view, $path);
    }

    public function new_render_view($path)
    {
        require_once 'system/development/cli/core/actions/RenderView.php';
        $obj = new RenderView();
        $obj->new_render($path);
    }

    public function render_resource()
    {
        require_once 'system/development/cli/core/actions/RenderResource.php';
        $obj = new RenderResource();
        $obj->main();
    }

    private function check_extention($path)
    {
    	$ext = null;
    	$array = explode('.', $path);
    	if(count($array) != 0) $ext = end($array);
    	return strtolower($ext);
    }

    public function except_format($path)
    {
    	$eff = $_ENV['templateEngine']['EXCEPT_FILE_FORMAT'];
    	$ext = $this->get_ext($path);
    	$regex = "/@{$eff}.{$ext}$/";
    	$match = preg_match($regex, $path);
    	if($match) return true;
    	return false;
    }

    public function template_code_replace()
    {
    	$replace = $_ENV['templateEngine']['CODE_REPLACE'];
    	$regex = '/__@__/';
    	$this->replace = [];
    	foreach ($replace as $key => $value) 
    	{
    		if (preg_match('/(?<=.)__@__(?=.)/', $key)) 
    		{
    			$key_array = explode('__@__', $key, 2);
    			$value_array = explode('__@__', $value, 2);
    			$this->replace['r-3'][$key_array[0]] = $value_array[0]; 
    			$this->replace['r-3'][$key_array[1]] = $value_array[1]; 
    		}elseif (preg_match('/(__@__)+$/', $key)) 
    		{
    			$key_array = explode('__@__', $key, 2);
    			$this->replace['r-2'][] = [
    				'key'        => [$key_array[0], $key_array[1]],
    				'key_real'   => $key,
    				'value_real' => $value,
    			];
    		} else{
    			$this->replace['r-1'][$key] = $value;
    		}
    	}
    }

    public function random($x = 10, $number_only = false)
    {
    	$array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
    	if ($number_only) $array = array_merge(range(0, 9));
    	$new = [];
    	for ($i=0; $i < $x; $i++)
    	{
    		$index = array_rand($array);
    		$new[] = $array[$index];
    	}
    	$string = implode(null, $new);
    	return $string;
    }

    public function save_file($path, $str_data)
    {
    	$this->sysPath->make_file($path);
    	$open = fopen($path, 'w', 1);
    	fwrite($open, $str_data);
    	fclose($open);
    }

    public function get_ext($str)
    {
        $array = explode('.', $str);
        if(count($array) == 1) return null;
        return strtolower(end($array));
    }

    public function get_render_config($type)
    {
        $data = $_ENV['templateEngine']['MINIFY_FILE_ON_RENDER'][$type];
        $this->render_config = (object) $data;
    }

}
