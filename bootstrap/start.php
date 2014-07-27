<?php

/*
|-------------------------------------------------------------------------
| Define Constanta
|-------------------------------------------------------------------------
*/

define('JENIS_KELAMIN', serialize(array('Laki-laki','Perempuan')));
define('PEKERJAAN', serialize(array('PNS','TNI/POLRI','BUMN','Wiraswasta','Dagang','Tani','Nelayan','Buruh','Lainnya')));
define('PENGHASILAN',serialize(array('< Rp 250.000','Rp 250.000 s.d Rp 500.000','Rp 500.000 s.d Rp 750.000','Rp 750.000 s.d 1 juta','Rp 1 juta s.d Rp 1.5 juta','Rp 2 juta atau lebih')));
define('TINGKAT_PRESTASI', serialize(array('Kecamatan','Kabupaten','Provinsi','Nasional')));
define('PROGRAM',serialize(array('Reguler','Fullday')));
define('JENIS_ASAL_SEKOLAH', serialize(array('MI','SD')));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application;

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/

$env = $app->detectEnvironment(array(

	'local' => array('homestead'),

));

/*
|--------------------------------------------------------------------------
| Bind Paths
|--------------------------------------------------------------------------
|
| Here we are binding the paths configured in paths.php to the app. You
| should not be changing these here. If you need to change these you
| may do so within the paths.php file and they will be bound here.
|
*/

$app->bindInstallPaths(require __DIR__.'/paths.php');

/*
|--------------------------------------------------------------------------
| Load The Application
|--------------------------------------------------------------------------
|
| Here we will load this Illuminate application. We will keep this in a
| separate location so we can isolate the creation of an application
| from the actual running of the application with a given request.
|
*/

$framework = $app['path.base'].
                 '/vendor/laravel/framework/src';

require $framework.'/Illuminate/Foundation/start.php';

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
