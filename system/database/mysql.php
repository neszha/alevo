<?php 

class mysql extends DB
{
	private $use_where, $use_like, $get_rows_count, $use_sql_condition;
	private $bind  = [];
	private $table = null;

	private function db_mysql_connect()
	{
		$db            = $_ENV['database'];
		$db_connection = $db['DATABASE_CONNECTION'];
		$db_selected   = $db['CONNECTIONS'][$db_connection];
		$host          = $db_selected['host'];
		$username      = $db_selected['username'];
		$password      = $db_selected['password'];
		$db_name       = $db_selected['db_name'];

		$dsn = "mysql:host={$host};dbname={$db_name}";

		try {
			$this->dbh = new PDO($dsn, $username, $password);
		} catch (PDOException $error) {
			if (App::dev())
			{
				require_once 'system\development\debug\init.php';
				databaseDebug::db_mysql_database_off($error->getMessage(), 400);
				exit();
			}
			die($error->getMessage());
		}	
	}

	/**
	 *	Mysql query SQL syntac.
	 */

	public function db_mysql_query($sql)
	{
		$this->sql = $sql;
		$this->db_mysql_prepare();
	}

	public function db_mysql_query_execute()
	{
		if (!$this->stmt->execute())
		{
			if (App::dev())
			{
				if ($this->stmt->rowCount() == 0) 
				{
					require_once 'system\development\debug\init.php';
					databaseDebug::db_mysql_query_builder_error($this->result_method, $this->sql_real, 400);
					exit();
				}
			}
		}
	}

	/**
	 *	Mysql query builder.
	 */

	public function db_mysql_table($table)
	{
		$this->bind  = [];
		$this->table = $table;
		$this->sql   = "SELECT * FROM {$this->table}";
	}

	public function db_mysql_select($param)
	{
		$this->sql = "SELECT {$param} FROM {$this->table}";
	}

	public function db_mysql_where($param1, $param2, $param3)
	{
		$this->key = $param1;
		if (is_null($param3))
		{
			$this->operator = '=';
			$this->value    = $param2;
		}else{
			$this->operator = $param2;
			$this->value    = $param3;
		}
		$this->random        = $this->db_mysql_random();
		if ($this->use_where || $this->use_sql_condition)
		{
			$this->sql           = "{$this->sql} {$this->key} {$this->operator} :{$this->random}";
			$this->sql_condition = "{$this->sql_condition} {$this->key} {$this->operator} :{$this->random}";
		}else{
			$this->sql           = "{$this->sql} WHERE {$this->key} {$this->operator} :{$this->random}";
			$this->sql_condition = "WHERE {$this->key} {$this->operator} :{$this->random}";
		}
		$this->bind[]            = [$this->random, $this->value];
		$this->use_where         = true;
		$this->use_sql_condition = true;
	}

	public function db_mysql_like($param1, $param2)
	{
		$this->key           = $param1;
		$this->value         = str_replace('*', '%', $param2);
		$this->random        = $this->db_mysql_random();
		if ($this->use_like || $this->use_sql_condition)
		{
			$this->sql           = "{$this->sql} {$this->key} LIKE :{$this->random}";
			$this->sql_condition = "{$this->sql_condition} {$this->key} LIKE :{$this->random}";
		}else{
			$this->sql           = "{$this->sql} WHERE {$this->key} LIKE :{$this->random}";
			$this->sql_condition = "WHERE {$this->key} LIKE :{$this->random}";
		}
		$this->bind[]            = [$this->random, $this->value];
		$this->use_like          = true;
		$this->use_sql_condition = true;
	}

	public function db_mysql_in($array)
	{
		if (is_array($array))
		{
			$this->key   = array_keys($array)[0];
			$this->value = array_values($array)[0];
			if (!is_array($this->value))
			{
				$this->random        = $this->db_mysql_random();
				$this->sql           = "{$this->sql} WHERE {$this->key} IN (:{$this->random})";
				$this->sql_condition = "WHERE {$this->key} IN (:{$this->random})";
				$this->bind[]        = [$this->random, $this->value];
			}else{
				for ($i=0; $i < count($this->value); $i++)
				{
					$this->random = $this->db_mysql_random();
					$value        = $this->value[$i];
					if ($i == 0) {
						$_string = ":{$this->random}";
					}else{
						$_string = "{$_string}, :{$this->random}";
					}
					$this->bind[] = [$this->random, $value];
				}
				$this->sql           = "{$this->sql} WHERE {$this->key} IN ({$_string})";
				$this->sql_condition = "WHERE {$this->key} IN ({$_string})";
			}
			$this->use_sql_condition = true;
		}
	}

	public function db_mysql_between($array)
	{
		if (is_array($array))
		{
			$this->key      = array_keys($array)[0];
			$this->value    = array_values($array)[0];
			$this->random_0 = $this->db_mysql_random();
			$this->random_1 = $this->db_mysql_random();
			if (is_array($this->value) && count($this->value) > 1 )
			{
				$this->sql           = "{$this->sql} WHERE {$this->key} BETWEEN :{$this->random_0} AND :{$this->random_1}";
				$this->sql_condition = "WHERE {$this->key} BETWEEN :{$this->random_0} AND :{$this->random_1}";
				$this->bind[]        = [$this->random_0, $this->value[0]];
				$this->bind[]        = [$this->random_1, $this->value[1]];
			}
			$this->use_sql_condition = true;
		}
	}

	public function db_mysql_order_by($args)
	{
		$symb = ['->' => 'ASC', '>' => 'ASC', '<-' => 'DESC', '<' => 'DESC'];
		if(!isset($args[1])) $args[1] = 'ASC';
		if (!is_array($args[0]))
		{
			$this->key   = $args[0];
			$this->value = str_replace(array_keys($symb), array_values($symb), $args[1]);
			$this->sql   = "{$this->sql} ORDER BY {$this->key} {$this->value}";
		}else{
			$this->data = [];
			foreach (array_keys($args[0]) as $x)
			{
				$this->key    = $x;
				$this->value  = str_replace(array_keys($symb), array_values($symb), $args[0][$x]);
				$this->data[] = "{$this->key} {$this->value}";
			}
			$this->str = implode(', ', $this->data);
			$this->sql = "{$this->sql} ORDER BY {$this->str}";
		}
	}

	public function db_mysql_limit($args)
	{
		if (count($args) == 1) $this->sql = "{$this->sql} LIMIT {$args[0]}";
		if (count($args) == 2) $this->sql = "{$this->sql} LIMIT {$args[0]}, {$args[1]}";
	}

	public function db_mysql_join($join)
	{
		$this->sql = "{$this->sql} INNER JOIN {$join}";
	}

	public function db_mysql_join_on($args)
	{
		if (!is_array($args[0])) $this->sql = "{$this->sql} ON {$args[0]} = {$args[1]}";
	}

	public function db_mysql_insert($args, $html)
	{
		$this->result_method = '...insert()';
		$this->sql = "INSERT INTO {$this->table}";
		if (is_string(array_keys($args)[0]))
		{
			$this->insert_id = '';
			$this->insert_to_db($args, $html);
		}else{
			$this->insert_id = [];
			foreach ($args as $x)
			{
				$this->insert_to_db($x, $html);
			}
		}
		$this->get_rows_count = true;
	}

	public function db_mysql_update($array, $html)
	{
		$this->result_method = '...update()';
		$this->sql           = "UPDATE {$this->table} SET";
		$keys                = array_keys($array);
		$values              = array_values($array);
		$update_value        = [];
		$condition           = null;
		for ($i=0; $i < count($keys); $i++)
		{ 
			$this->random   = $this->db_mysql_random();
			$update_value[] = "{$keys[$i]} = :{$this->random}";
			$value          = $values[$i];
			if(!$html) $value = htmlspecialchars($value);
			$this->bind[]   = [$this->random, $value];
		}
		$set_value = implode(', ', $update_value);
		if ($this->use_sql_condition) $condition = " {$this->sql_condition}";
		$this->sql = "{$this->sql} {$set_value}{$condition}";
		$this->db_mysql_execute();
		$this->get_rows_count = true;
	}

	public function db_mysql_delete()
	{
		$this->result_method = '...delete()';
		$this->sql       = "DELETE FROM {$this->table}";
		if ($this->use_sql_condition) $condition = " {$this->sql_condition}";
		$this->sql = "{$this->sql}{$condition}";
		$this->db_mysql_execute();
		$this->get_rows_count = true;
	}

	public function db_mysql_and()
	{
		$this->sql           = "{$this->sql} AND";
		$this->sql_condition = "{$this->sql_condition} AND";
	}

	public function db_mysql_or()
	{
		$this->sql           = "{$this->sql} OR";
		$this->sql_condition = "{$this->sql_condition} OR";
	}

	/**
	 *	Mysql result data.
	 */

	public function db_mysql_multiple_result($opt)
	{
		$this->result_method = '...get_all()';
		$this->db_mysql_execute();
		if ($opt == 'assoc')
		{
			$this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}
		return $this->result;
	}

	public function db_mysql_single_result($opt)
	{
		$this->result_method = '...get()';
		$this->db_mysql_execute();
		if ($opt == 'assoc') 
		{
			$this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		return $this->result;
	}

	public function db_mysql_first($opt)
	{
		$this->result_method = '...first()';
		$this->db_mysql_limit([1]);
		$this->db_mysql_execute();
		if ($opt == 'assoc') 
		{
			$this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		return $this->result;
	}

	public function db_mysql_last($opt)
	{
		$this->result_method = '...last()';
		$this->db_mysql_order_by([0 => ['id' => '<']]);
		$this->db_mysql_limit([1]);
		$this->db_mysql_execute();
		if ($opt == 'assoc') 
		{
			$this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			$this->result = $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		return $this->result;
	}

	public function db_mysql_rows()
	{
		$this->result_method = '...rows()';
		if ($this->get_rows_count) return $this->stmt->rowCount();
		$this->db_mysql_execute();
		return $this->stmt->rowCount();
	}

	public function db_mysql_get_insert_id()
	{
		return $this->insert_id;
	}

	public function db_mysql_show_sql()
	{
		$_SESSION['user_show_sql'] = true;
	}

	/**
	 *	Periperal method => private.
	 */

	private function insert_to_db($args, $html)
	{
		$keys      = [];
		$keys_bind = [];
		foreach (array_keys($args) as $x)
		{
			$this->random = $this->db_mysql_random();
			$keys[]       = "{$x}";
			$keys_bind[]  = ":{$this->random}";
			$value        = $args[$x];
			if (!$html) $value = htmlspecialchars($value);
			if (is_null($value)) $value = '';
			$this->bind[] = [$this->random, $value];
		}
		$key_str   = implode(', ', $keys);
		$bind_str  = implode(', ', $keys_bind);
		$this->sql = "{$this->sql} ({$key_str}) VALUES ({$bind_str})";
		$this->db_mysql_execute();
		$id = $this->dbh->lastInsertId();
		if (is_array($this->insert_id)) $this->insert_id[] = $id;
		if (is_string($this->insert_id)) $this->insert_id  = $id;
	}

	private function db_mysql_prepare()
	{
		if (App::dev()) $this->db_mysql_show_real_sql();
		$this->db_mysql_connect();
		$this->stmt = $this->dbh->prepare($this->sql);
		$this->db_mysql_bind();
	}

	private function db_mysql_execute()
	{
		$this->db_mysql_prepare();
		if (App::dev() && isset($_SESSION['user_show_sql']))
		{
			require_once 'system\development\debug\init.php';
			databaseDebug::db_mysql_show_sql_syntax($this->sql_real, 400);
			unset($_SESSION['user_show_sql']);
			exit();
		}
		$exe = $this->stmt->execute();
		if (!$exe)
		{
			if (App::dev())
			{
				if ($this->stmt->rowCount() == 0) 
				{
					require_once 'system\development\debug\init.php';
					databaseDebug::db_mysql_query_builder_error($this->result_method, $this->sql_real, 400);
					exit();
				}
			}
		}
		$this->db_mysql_table_reset();
	}

	private function db_mysql_bind()
	{
		if (is_array($this->bind))
		{
			foreach ($this->bind as $x)
			{
				$key = $x[0];
				$value = $x[1];	
				switch (true)
				{
					case is_int($value) :
					$type = PDO::PARAM_INT;
					break;
					case is_bool($value) :
					$type = PDO::PARAM_BOOL;
					break;
					case is_null($value) :
					$type = PDO::PARAM_NULL;
					break;
					default :
					$type = PDO::PARAM_STR;
				}
				$this->stmt->bindValue($key, $value, $type); 
			}
		}
	}

	private function db_mysql_random()
	{
		return 'mysql_bind_' . md5(uniqid() . time());
	}

	private function db_mysql_table_reset()
	{
		$this->db_mysql_table($this->table);
	}

	private function db_mysql_show_real_sql()
	{
		$replace_keys   = [];
		$replace_values = [];
		if (count($this->bind) != 0)
		{
			foreach ($this->bind as $x)
			{
				$replace_keys[] = ":{$x[0]}";
				if (is_int($x[1])) $replace_values[] = $x[1];
				if (is_string($x[1])) $replace_values[] = "'{$x[1]}'";
			}
			$this->sql_real = str_replace($replace_keys, $replace_values, $this->sql);
		}else{
			$this->sql_real = $this->sql;
		}
	}

}