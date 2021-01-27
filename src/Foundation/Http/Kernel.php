<?php
namespace Yaya\TinyLaravel\Foundation\Http;

use Yaya\TinyLaravel\Contracts\Http\Kernel as Contracts;
use Yaya\TinyLaravel\Controller\IndexController;
use Yaya\TinyLaravel\Foundation\Application;

/**
* 
*/
class Kernel implements Contracts
{
	protected $app;
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function handler(Application $app)
	{
		$index = new  IndexController();
		return $index->index();
	}

	public function dispatchToRoute($rquest)
    {
        $this->app->make('route')->dispatch($request);

    }
}