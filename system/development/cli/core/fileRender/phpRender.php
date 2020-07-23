<?php 


class phpRender extends RenderEngine
{

	public function main($str)
	{
		$this->str = $str;
		$this->get_render_config('PHP');

		if($this->render_config->remove_comment) $this->remove_comment();
		if($this->render_config->remove_null_line) $this->remove_null_line();
		if($this->render_config->minify) $this->minify_code();

		return $this->str;
	}

	private function remove_comment()
	{
		$regex   = [];
		$regex[] = "/<!--[\s\t\n]?([\w\W][^-]+)+-->/"; // HTML
		$regex[] = "/\/\*[\s\t\n]?[\w\W]+\*\//"; // CSS & PHP
		$regex[] = "/\/\*[\s\t\n]?[\w\W][^\*]+../"; // CSS & PHP
		$regex[] = "/[^\:]\/\/.+/"; // JavaScript & PHP
		$this->str = preg_replace(array_values($regex), '', $this->str);
	}

	private function remove_null_line()
	{
		$str_line = explode("\n", $this->str);
		$str_line_array = [];
		foreach ($str_line as $str)
		{
			$preg = preg_match('/\S/', $str);
			if ($preg ==  1) $str_line_array[] = $str;
		}
		$this->str = implode("\n", $str_line_array);
	}

	private function minify_code()
	{
		$str_line = explode("\n", $this->str);
		$str_minify = '';
		foreach ($str_line as $str)
		{
			$str    = preg_replace(['/^\s+/', '/\t/', '/\s+$/'], '', $str);
			if($str == '<?php') $str .= ' ';
			$str_minify .=  $str;
		}
		$this->str = $str_minify;
	}

}

