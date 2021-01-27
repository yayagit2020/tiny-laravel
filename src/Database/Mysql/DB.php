<?php
namespace Yaya\TinyLaravel\Database\Mysql;

use Yaya\TinyLaravel\Contracts\Database\DB as Contracts;
/**
* 
*/
class DB implements Contracts
{

	public function select()
	{
		return "mysql 的查询方法";
	}
}