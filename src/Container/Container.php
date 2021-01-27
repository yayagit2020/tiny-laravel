<?php

namespace Yaya\TinyLaravel\Container;

use Exception;
use Closure;

/**
* 0. 单例
  1. 需要容器 共享容器
  2. 需要注册方法
  3. 需要解析
*/
class Container
{
	
	// 0. 单例
	protected static $instance;
	// 1. 需要容器
	protected $instances = [];
	// 共享容器
	protected $bindings = [];
	// 2. 需要注册方法

	public function bind($abstract, $object)
	{
		// 标识要绑定 1. 就是一个对象 2. 闭包的方式 3. 类对象的字符串 (类的地址)
		return $this->bindings[$abstract] = $object;
	}

	// 3. 需要解析
	public function make($abstract, $parameters = [])
	{
		return $this->resolve($abstract, $parameters = []);
	}

	protected function resolve($abstract, $parameters = [])
	{
		// 标识要绑定 1. 就是一个对象 2. 闭包的方式 3. 类对象的字符串 (类的地址)
		#判断共享容器中是否存在
		if (isset($this->instances[$abstract])) {
			return $this->instances[$abstract];
		}
		#判断是否存在
		if (!$this->has($abstract)) {
			// 如果不存在自行
            // 选择返回, 可以抛出一个异常
            throw new Exception('没有找到这个容器对象'.$abstract, 500);
		}
		$object = $this->bindings[$abstract];
		#判断是否为一个闭包函数
		if ($object instanceof Closure) {
			#直接执行闭包
			return $object();
		}
		/*#判断是否为一个对象
		if (is_object($object)) {
			return $object;
		}
		#是字符串（类的地址）*/
		 // 3. 类对象的字符串 (类的地址)
        return $this->instances[$abstract] = (is_object($object)) ? $object :  new $object(...$parameters) ;
	}

	// 判断是否在容器中
    // 1. 容器很多便于扩展
    // 2. 可能在其他场景中会用到
    public function has($abstract)
    {
        return isset($this->bindings[$abstract]);
    }

    // 单例创建
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }
    
    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }
}