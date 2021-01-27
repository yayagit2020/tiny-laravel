<?php
namespace Yaya\TinyLaravel\Support\Facades;

use Yaya\TinyLaravel\Foundation\Application;

/**
 * 具体的功能是 让子类可以代理其他类的操作; 可以以静态方式调用其他对象的方法
 */
abstract class Facade
{
	#已经解析过的对象
	protected static $resolvedInstances = [];

	// 1. 指定代理对象
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }

    // 2. 解析代理对象
    public static function getFacadeRoot()
    {
    	$class = static::getFacadeAccessor();
    	#判断是否为一个对象
    	if (is_object($class)) {
    		return $class;
    	}

    	#是否已经解析过的
    	if (isset(static::$resolvedInstances[$class])) {
    		return static::$resolvedInstances[$class];
    	}
    	#都没有，需要通过容器解析
    	return static::$resolvedInstances[$class] = Application::getInstance()->make($class);
    }


    // 3. 调用 __callStatic
    public static function __callStatic($method, $args)
    {
    	// 解析代理的对象
        $object = static::getFacadeRoot();
        if ($object) {
        	throw new Exception("没有找到这个类", 1);
        }
        //执行对应的方法
        return $object->{$method}(...$args);
    }
}

