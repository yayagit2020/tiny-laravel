<?php

require './vendor/autoload.php';

use Yaya\TinyLaravel\Foundation\Application;
use Yaya\TinyLaravel\Foundation\Http\Kernel;
use Yaya\TinyLaravel\Contracts\Http\Kernel\Kernel as KernelContarcts;
use Yaya\TinyLaravel\Support\Facades\DB;
use Yaya\TinyLaravel\Test;

$app = new Application();
$app->bind(KernelContarcts::class, Kernel::class);
$kernel = $app->make(KernelContarcts::class);
echo $kernel->handler();
//echo DB::select();

/*$app->bind('test', Test::class);
echo $app->make('test')->index();*/

/*$t = new Test();
echo $t->index();*/
