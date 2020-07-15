<?php 

class TemplateEngine extends App
{
    private $file_array = [];
    private $minify_string = null;
    private $template_data_array = [];

    /*
    |--------------------------------------------------------------------------
    | Render View Development Mode
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */

    public function render_view()
    {
        $_ENV['run'] = 'render_view';
        render_log('VIEW');
        $this->save_view_path('');
        $this->get_view_path();
        $this->clear_rendered_view();
        $this->render_and_make_view_path(); 
        $this->save_view_path();
        die();
        if ($this->from_cli()) $this->loop_line_string("\n\t--> Render View : 100% Complete! <--\n");
        die();
    }

    private function get_view_path()
    {
        $dir = $_ENV['path']['VIEWS_DIR'];
        delay_proccess("\t >>> Get View Path <<< \n\n");
        $this->get_file_array($dir);
        loop_log($this->file_array, "-> View path : @\n");
    }

    private function clear_rendered_view()
    {
        $render_dir = $_ENV['path']['VIEW_RENDER_DIR'];
        $this->make_dir($render_dir);
        $dir_open   = opendir($render_dir);
        delay_proccess("\n\t >>> Clear View File <<< \n\n");
        $loop = 0;
        while (($name = readdir($dir_open)) != false) 
        {
            $path = $render_dir . $name;
            if (is_file($path))
            {
                unlink($path);
                string_log("-> Remove file : {$path}\n");
                $loop++;
            }
        }
        if($loop == 0) string_log("-> Remove file : Is empty...\n");
        if ($this->from_cli()) usleep(400*1000);
        closedir($dir_open);
    }

    private function render_and_make_view_path()
    {
        delay_proccess("\n\t >>> Render View <<< \n\n");
        $dir        = $_ENV['path']['VIEWS_DIR'];
        $this->make_dir($dir);
        $extention  = '.php';
        foreach ($this->file_array as $x)
        {
            $replace           = [$dir => '', $extention => ''];
            $key               = str_replace(array_keys($replace), array_values($replace), $x);
            $value             = $x;
            $this->render_views_file($key, $value);
        }
        $this->template_data_json = json_encode($this->template_data_array);
    }

    private function render_views_file($key, $value)
    {
        $render_dir       = $_ENV['path']['VIEW_RENDER_DIR'];
        $view_name        = str_replace('/', '.', $key);
        $template_string  = file_get_contents($value);
        $rendered_string  = $this->render_string_engine($template_string);
        var_dump($rendered_string);
        $extention        = '.php';
        $path             = $render_dir . $this->string_random(25) . $extention;
        if ($this->dev()) $path = $render_dir . '@dev__' . $this->string_random(7, true) . '__' . $view_name . $extention;
        $template_path                   = $view_name . '/@/' . $path;
        $this->template_data_array[$key] = $template_path;
        $this->save_file($path, $rendered_string);
        string_log("-> Rendered path : {$path}\n");
    }

    /*
    |--------------------------------------------------------------------------
    | Render view template for Web Development User
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */

    public function render_view_template($view, $path)
    {
        $view_path           = str_replace('.', '/', $view);
        $view_dir            = $_ENV['path']['VIEWS_DIR'];
        $this->make_dir($view_dir);
        $this->template_path = $view_dir . $view_path . '.php';
        $this->rendered_path = $path;
        $this->check_file_exists();
        $this->render_single_template_view();
    }

    private function check_file_exists()
    {
        if (!file_exists($this->template_path))
        {
            require_once 'system\development\debug\init.php';
            alevoDebug::file_not_exists($this->template_path);
            exit();
        }
        if (!file_exists($this->rendered_path))
        {
            require_once 'system\development\debug\init.php';
            alevoDebug::file_not_exists($this->rendered_path);
            exit();
        }
    }

    private function render_single_template_view()
    {
        $_ENV['run']         = 'render_view';
        $replace             = $_ENV['templateEngine'];
        $template_string     = file_get_contents($this->template_path);
        $rendered_string     = file_get_contents($this->rendered_path);
        $new_rendered_string = $this->render_string_engine($template_string);
        if ($rendered_string != $new_rendered_string) $this->save_file($this->rendered_path, $new_rendered_string);
    }

    /*
    |--------------------------------------------------------------------------
    | Render Resource Development Mode
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */

    public function render_resource()
    {
        $_ENV['run'] = 'render_resource';
        $this->view_log_render('RESOURCE');
        $this->save_resource_path('');
        $this->get_resource_path();
        $this->clear_rendered_resource();
        $this->render_and_make_resource_path();
        $this->save_resource_path();
        if ($this->from_cli()) $this->loop_line_string("\n\t--> Render Resource : 100% Complete! <--\n");
    }

    private function get_resource_path()
    {
        $dir = $_ENV['path']['RESOURCES_DIR'];
        $this->make_dir($dir);
        if ($this->from_cli())
        {
            $this->loop_line_string("\t >>> Get Resource Path <<< \n\n");
            usleep(400*1000);
        }
        $this->get_file_array($dir);
        if ($this->from_cli())
        {
            foreach ($this->file_array as $x)
            {
                usleep(20*1000);
                echo "-> Resource path : {$x}\n";
            }
            usleep(400*1000);
        }
    }

    private function clear_rendered_resource()
    {
        $render_dir = $_ENV['path']['RECOURCE_RENDER_DIR'];
        $this->make_dir($render_dir);
        $dir_open   = opendir($render_dir);
        if ($this->from_cli())
        {
            $this->loop_line_string("\n\t >>> Clear Resource File <<< \n\n");
            usleep(400*1000);
        }
        $loop = 0;
        while (($name = readdir($dir_open)) != false) 
        {
            $path = $render_dir . $name;
            if (is_file($path))
            {   
                unlink($path);
                if ($this->from_cli())
                {
                    usleep(10*1000);
                    echo "-> Remove file : {$path}\n";
                }
                $loop++;
            }
        }
        if($loop == 0) 
        {
            if ($this->from_cli())
            {
                usleep(10*1000);
                echo "-> Remove file : Is Empty\n";
            }
        }
        closedir($dir_open);
    }

    private function render_and_make_resource_path()
    {
        if ($this->from_cli()) 
        {
            $this->loop_line_string("\n\t >>> Render Resource <<< \n\n");
            usleep(400*1000);
        }
        $dir = $_ENV['path']['RESOURCES_DIR'];
        $this->make_dir($dir);
        foreach ($this->file_array as $x)
        {
            $key   = str_replace($dir, '', $x);
            $value = $x;
            $this->render_resource_file($key, $value);
        }
        $this->template_data_json = json_encode($this->template_data_array);
    }

    private function render_resource_file($key, $value)
    {
        $render_dir      = $_ENV['path']['RECOURCE_RENDER_DIR'];
        $template_string = file_get_contents($value);
        $this->minify_engine($template_string);
        $file_name_array = explode('/', $value);
        $file_name       = end($file_name_array);
        $extention_array = explode('.', $value);
        $extention       = end($extention_array);
        $path            = $render_dir . $this->string_random(20) . '.' . $extention;
        if ($this->dev()) $path = $render_dir . '@dev__' . $this->string_random(7, true) . '__' . $file_name;
        $value = ['path' => $path, 'cache' => $this->string_random()];
        $this->template_data_array[$key] = $value;
        $this->minify_engine($template_string);
        $rendered_string = $this->minify_string;
        $this->save_file($path, $rendered_string);
        if ($this->from_cli())
        {
            usleep(10*1000);
            echo "-> Rendered path : {$path}\n";
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Save Method
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */
   
   private function save_view_path($data = null)
    {
        if (is_null($data)) $data = $this->template_data_json;
        $path = $_ENV['path']['STORAGE_VIEW_PATH'];
        $this->make_file($path);
        $open_file = fopen($path, 'w', 1);
        fwrite($open_file, $data);
        fclose($open_file);
    }

    public function save_resource_path($data = null)
    {
        if (is_null($data)) $data = $this->template_data_json;
        $path = $_ENV['path']['STORAGE_RESOURCE_PATH'];
        $this->make_file($path);
        $open_file = fopen($path, 'w', 1);
        fwrite($open_file, $data);
        fclose($open_file);
    }

    public function save_file($path, $string)
    {
        $open_file = fopen($path, 'w', 1);
        fwrite($open_file, $string);
        fclose($open_file);
    }

    /*
    |--------------------------------------------------------------------------
    | Template Engine Render
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */

    private function render_string_engine($string)
    {
        if ($_ENV['templateEngine']['USE_TEMPLATE_ENGINE'])
        {
            $this->set_template_engine_configuration();
            $string = $this->render_core($string);
        }
        return $string;
    }

    private function set_template_engine_configuration()
    {

        $template_replace = $_ENV['templateEngine']['REPLACE'];
        $regex            = '/__@__/';
        $this->template_replace = [];
        foreach ($template_replace as $key => $value) 
        {
            if (preg_match('/(?<=.)__@__(?=.)/', $key)) 
            {
                $key_array = explode('__@__', $key, 2);
                $value_array = explode('__@__', $value, 2);
                $this->template_replace['r-3'][$key_array[0]] = $value_array[0]; 
                $this->template_replace['r-3'][$key_array[1]] = $value_array[1]; 
            }elseif (preg_match('/(__@__)+$/', $key)) 
            {
                $key_array = explode('__@__', $key, 2);
                $this->template_replace['r-2'][] = [
                    'key'        => [$key_array[0], $key_array[1]],
                    'key_real'   => $key,
                    'value_real' => $value,
                ];
            } else{
                $this->template_replace['r-1'][$key] = $value;
            }

        }
    }

    private function render_core($string)
    {
        $string_render = [];
        $line_string = explode("\n", $string);
        foreach ($line_string as $x => $string)
        {
            $string = $this->render_string($string, 'r-3');
            $string = $this->render_string($string, 'r-2');
            $string = $this->render_string($string, 'r-1');
            $string_render[] = $string;

        }
        $string = implode("\n", $string_render);
        return $this->minify_engine($string);
    }

    private function render_string($string, $key)
    {
        if ($key == 'r-2') 
        {
            foreach ($this->template_replace[$key] as $a => $b) 
            {
                $regex = "/(?<={$b['key'][0]}).*(?={$b['key'][1]})/";
                $match = preg_match_all($regex, $string, $select);
                if ($match) 
                {
                    $string_select   = $select[0][0];
                    $result['key']   = str_replace('__@__', $string_select, $b['key_real']);
                    $result['value'] = str_replace('__@__', $string_select, $b['value_real']);
                    $string          = str_replace($result['key'], $result['value'], $string);
                    $string          = str_replace("\r", null, $string);
                }
            }
        }

        if ($key == 'r-1' || $key == 'r-3') 
        {
            foreach ($this->template_replace[$key] as $a => $b)
            {
                $string = str_replace($a, $b, $string);
            }
        }

        return $string;
    }

    public function minify_engine($string)
    {
        $this->minify_string = $string;
        $regex               = [];
        if ($_ENV['templateEngine']['REMOVE_COMMNET']) // Remove Comment
        {
            $regex[] = '/<!--[\s\t\n]?([\w\W][^-]+)+-->/';              // HTML Commnet
            $regex[] = '/\/\*[\s\t\n]?[\w\W][^\*]+../';                 // CSS 1 Comment
            $regex[] = '/[^\:]\/\/.+/';                                 // JavaScript Commnet
        }
        $this->minify_string = preg_replace(array_values($regex), '', $this->minify_string);
        $this->remove_null_line();
        if (($_ENV['templateEngine']['MINIFY_VIEW'] AND $_ENV['run'] == 'render_view') OR ($_ENV['templateEngine']['MINIFY_RESOURCE'] AND $_ENV['run'] == 'render_resource'))
        {
            $array   = explode("\n", $this->minify_string);
            $new_str = '';
            foreach ($array as $line)
            {
                $line    = preg_replace(['/[^\S ]+/', '/\t/'], '', $line);
                $new_str = $new_str . $line;
            }
            $this->minify_string = $new_str;
        }
        return $this->minify_string;
    }

    private function remove_null_line()
    {
        $str            = $this->minify_string;
        $line_array     = explode("\n", $str);
        $new_line_array = [];
        foreach ($line_array as $line)
        {
            $preg = preg_match('/\S/', $line);
            if ($preg ==  1) $new_line_array[] = $line;
        }
        $this->minify_string = implode("\n", $new_line_array);
    }


    /*
    |--------------------------------------------------------------------------
    | Other Method
    |--------------------------------------------------------------------------
    |
    | Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    |
    */

    private function make_dir($path)
    {
        require_once 'system/lib/sysPath.php';
        $object = new sysPath();
        $object->make_file($path);
    }

    private function make_file($path)
    {
        require_once 'system/lib/sysPath.php';
        $object = new sysPath();
        $object->make_file($path);
    }

    private function get_file_array($dir)
    {
        $dir_open = opendir($dir);
        while (($name = readdir($dir_open)) != false) 
        {
            $path = $dir . $name;
            if (is_file($path)) 
            {
                $this->file_array[] = $path;
            }else{
                if ($name !== '.' AND $name !== '..') $this->get_file_array($path . '/');
            }
        }
        closedir($dir_open);
    }

    private function loop_line_string($string, $delay = 10000)
    {
        $array = str_split($string);
        foreach ($array as $x)
        {
            echo $x;
            usleep($delay);
        }
    }
}