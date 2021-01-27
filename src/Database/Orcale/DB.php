<?php
namespace Yaya\TinyLaravel\Database\Orcale;

use Yaya\TinyLaravel\Contracts\Database\DB as Contracts;

class DB implements Contracts
{
	
	public function select()
	{
		return "Orcale 的查询方法";
	}
}