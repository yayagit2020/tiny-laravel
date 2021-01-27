<?php

namespace Yaya\TinyLaravel\Foundation;

use Yaya\TinyLaravel\Container\Container;
use Yaya\TinyLaravel\Database\Mysql\DB as MysqlDB;
use Yaya\TinyLaravel\Database\Orcale\DB as OrcaleDB;
use Yaya\TinyLaravel\Request \Request;
use Yaya\TinyLaravel\Route\Route;

/**
* 
*/
class Application extends Container
{

	public function __construct()
	{
		$this->registerBaseBindings();
		$this->registerCoreContainerAliases();
	}

	public function registerBaseBindings()
	{
		static::setInstance($this);
		$this->instances['app'] = $this;
	}
	// 核心容器注册方法
    // 用注册小laravel运行中所需要的服务
	public function registerCoreContainerAliases(){
		$bind = [
			'mysql' => MysqlDB::class,
			'orcale' => OrcaleDB::class,
			'db'	=> MysqlDB::class, //默认的
			'route' => Route::class,
			'request'	=> Request::class, //默认的
		];
		foreach ($bind as $key => $value) {
			$this->bind($key, $value);
		}
	}

}