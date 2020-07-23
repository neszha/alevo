<?php 

class AppBuild extends RenderEngine
{
    /**
     * summary
     */
    public function __construct()
    {
    	require_once 'system/lib/sysPath.php';
    	$this->sysPath = new sysPath();
    }

    public function build()
    {
    	$this->load_config();
    	$this->clear_build();
    	$this->scan_app('./app/');
    	// $this->scan_app('./');
    	$this->build_app();
    	// var_dump($this->file_array);
    }

    private function build_app()
    {
    	foreach ($this->file_array as $path) 
    	{
    		$this->render($path);
    	}
    }

    private function render($path)
    {
        if(is_file($path))
        {
            $this->ext     = $this->get_ext($path);
            $this->path    = $path;
            $this->content = file_get_contents($path);

            if($this->ext == 'php')
            {
                require_once 'system/development/cli/core/fileRender/phpRender.php';
                $obj = new phpRender();
                $this->content = $obj->main($this->content);
            }

            $this->set_build_path();
            $this->save_file($this->build_path, $this->content);
        }
    }

    private function set_build_path()
    {
        $key = 'build-to';
        $this->build_path = $this->config->$key . $this->path;
    }

    private function clear_build()
    {
        $key = 'build-to';
        $this->build_dir = $this->config->$key;
        $this->sysPath->remove_dir($this->build_dir);
    }

    private function scan_app($dir)
    {
        $data = $this->sysPath->scan_dir($dir);
        $this->set_except_build_regex();
        $this->file_array = [];
        foreach ($data->file as $path) 
        {
            $filter = preg_replace("/^.\//", null, $path);

            if(!$this->except_build_filter($filter))
            {
                $this->file_array[] = $filter;
                var_dump($path);
            }
        }
    }

    private function except_build_filter($path)
    {
        if(is_file($path))
        {
            foreach ($this->exc_build->dir as $x) 
            {
                if(preg_match("/{$x}/", $path)) return true;
            }

            foreach ($this->exc_build->file as $x) 
            {
                // var_dump($path);
                if(preg_match("/{$x}/", $path)) return true;
            }
        }
    }

    private function set_except_build_regex()
    {
        $key = 'except-build';
        $array = $this->config->$key;
        $dir = [];
        $file = [];
        foreach ($array as $x) 
        {
            if(is_file($x))
            {
                $x = preg_quote($x, '/');
                $file[] = "^$x$";
            }
            if(is_dir($x))
            {
                $x = preg_quote($x, '/');
                $dir[] = "^$x";
            }
        }
        $this->exc_build = (object) ['dir' => $dir, 'file' => $file];
    }

    private function load_config()
    {
       $file = 'build.json';
       $json_str = file_get_contents($file);
       $this->config = json_decode($json_str);
   }

}