<?php 

/*
|--------------------------------------------------------------------------
| Database System
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod
| aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
| cupidatat non proident, sunt in culpa qui officia deserunt.
|
*/

class DB
{
	public static $db;
	public static $connection;

	/**
	 * +++++++++++++++++++ Databse use checking.
	 */

	private function main()
	{
		self::$db = $_ENV['database'];
		self::$connection = $_ENV['database']['DATABASE_CONNECTION'];
		if (self::$db['DATABASE'] != true) 
		{
			require_once 'system\development\debug\init.php';
			alevoDebug::database_is_off();
			exit();
		}
	}

	/**
	 *	+++++++++++++++++++ Manual Query SQL.
	 */

	/*
	| $this->query('sql_syntax')...
	|
	| Main method to write SQL Syntax
	| 
	*/
	public function query($sql)
	{
		$this->main();
		if (self::$connection == 'mysql') 
		{
			require_once 'database/mysql.php';
			self::$db = new mysql();
			self::$db->db_mysql_query($sql);
			return new static;
		}
	}

	/*
	| ...()->execute()
	|
	| To execute SQL Query | update | delete | insert
	| 
	*/
	public function execute()
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_query_execute();
	}

	/**
	 *	+++++++++++++++++++ Query Builder.
	 */

	/*
	| $this->table('table_name')...
	|
	| Main method to select table name
	| 
	*/
	public function table($table)
	{
		$this->main();
		if (self::$connection == 'mysql') 
		{
			require_once 'database/mysql.php';
			self::$db = new mysql();
			self::$db->db_mysql_table($table);
			return new static;
		}
	}

	/*
	| $this->show_sql()
	|
	| Show SQL Syntax in alevo debuging.
	| 
	*/
	public function show_sql()
	{
		$this->main();
		if (self::$connection == 'mysql')
		{
			require_once 'database/mysql.php';
			self::$db = new mysql();
			self::$db->db_mysql_show_sql();
		}
	}

	/*
	| $this->select('column_name')...
	| $this->select('id, name, class, city, ...')...
	|f
	| If you can get all data in this column, you can use column_name '*' for get this.
	| 
	*/
	public function select($str = '*')
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_select($str);
			return new static;
		}
	}

	/*
	| ...()->where('column_name', 'value')...
	| 
	| # Use ->and() & ->or()
	| ...()->where('id', 2)->or()->where('name', 'ady')...
	|
	| You can use '->or()' || '->and()' in where method.
	| 
	*/
	public function where($param1, $param2, $param3 = null)
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_where($param1, $param2, $param3);
			return new static;
		}
	}

	/*
	| ...()->like('column_name', 'value')...
	|
	| # Use ->and() & ->or()
	| ...()->like('name', '*a')->and()->like('address', 'as*')...
	|
	| You can use '->or()' || '->and()' in like method.
	| 
	*/
	public function like($param1, $param2)
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_like($param1, $param2);
			return new static;
		}
	}

	/*
	| # Single value
	| ...()->in(['column_name', 'value'])...
	| 
	| # Multiple value
	| ...()->in(['column_name', ['value1', 'value2', '...']])...
	| 
	| Find data in column_name.
	| 
	*/
	public function in($array) 
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_in($array);
			return new static;
		}
	}

	/*
	| ...()->between(['column_name', ['value1', 'value2']])...
	| 
	| Get data in between area.
	| 
	*/
	public function between($array)
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_between($array);
			return new static;
		}
	}

	/*
	| ...()->order_by('column_name', 'ASC')...
	| ...()->order_by(['column_name' => 'ASC', 'column_name' => 'DESC'])...
	| 
	| Result sort data. 
	| You can use '>' or '->' for sort ASC.
	| You can use '<' or '<-' for sort DESC.
	| 
	*/
	public function order_by(...$args)
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_order_by($args);
			return new static;
		}
	}

	/*
	| ...()->limit(records)...
	| ...()->limit(records, start)...
	| 
	| Limit data. 
	| 
	*/
	public function limit(...$args)
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_limit($args);
			return new static;
		}
	}

	/*
	| ...()->join('join', callback)... 
	| 
	*/
	public function join($param)
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_join($param);
			return new static;
		}
	}

	/*
	| # Single insert
	| ...()->insert(['column_name' => 'value', ... ])...
	| 
	| # Multiple insert
	| ...()->insert([
	| 	['column_name' => 'value 1', ...],
	| 	['column_name' => 'value 2', ...],
	| 	...
	| ])...
	| 
	*/
	public function insert($args, $html = false)
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_insert($args, $html);
			return new static;
		}
	}

	/*
	| # Update all
	| ...()->update(['column_name' => 'value', ... ])...
	| 
	| # Spesifik update
	| ...->where('...')->update(['column_name' => 'value', ... ])
	| 
	*/
	public function update($array, $html = false)
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_update($array, $html);
			return new static;
		}
	}

	/*
	| # Delete all
	| ...()->delete()
	| 
	| # Spesifik delete
	| ...->where('...')->delete()
	| 
	*/
	public function delete()
	{
		if (self::$connection == 'mysql')
		{
			self::$db->db_mysql_delete();
			return new static;
		}
	}

	/**
	 *	+++++++++++++++++++ Multiple data result.
	 */

	/*
	| ...()->get_all(option)
	|
	| Get multiple data.
	| The option default "object" and return object. If you can get
	| array data, you can use option "assoc".
	| 
	*/
	public function get_all($opt = 'object')
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_multiple_result($opt);
	}

	/**
	 *	+++++++++++++++++++ Single data result.
	 */

	/*
	| ...()->get(option)
	|
	| Get single data.
	| The option default "object" and return object. If you can get
	| array data, you can use option "assoc".
	| 
	*/
	public function get($opt = 'object')
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_single_result($opt);
	}

	/*
	| ...()->first(option)
	|
	| Get first data.
	| The option default "object" and return object. If you can get
	| array data, you can use option "assoc".
	| 
	*/
	public function first($opt = 'object')
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_first($opt);
	}

	/*
	| ...()->last(option)
	|
	| Get last data.
	| The option default "object" and return object. If you can get
	| array data, you can use option "assoc".
	| 
	*/
	public function last($opt = 'object')
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_last($opt);
	}

	/**
	 *	+++++++++++++++++++ Other data result.
	 */

	/*
	| ...()->rows()
	|
	| Count data in table dan return result count insert delete
	| 
	*/
	public function rows()
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_rows();
	}

	/*
	| ...()->get_id()
	|
	| Get Primary Key when insert to database.
	| 
	*/
	public function get_id()
	{
		if (self::$connection == 'mysql') return self::$db->db_mysql_get_insert_id();
	}
	

	/**
	 *	+++++++++++++++++++ Periperal method.
	 */

	public function and()
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_and();
			return new static;
		}
	}

	public function or()
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_or();
			return new static;
		}
	}

	public function on(...$args)
	{
		if (self::$connection == 'mysql') 
		{
			self::$db->db_mysql_join_on($args);
			return new static;
		}
	}

}