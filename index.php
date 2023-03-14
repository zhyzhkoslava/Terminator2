 <?php

spl_autoload_register(function ($class_name)
{
    require_once $class_name . '.php';
});

$jun = new Junior();
$tl = new TeamLead('good');
$tl->junior = $jun;

$jun->work(0);
$tl->checkJuniorWork();
$jun->work(0);
$tl->checkJuniorWork();
$jun->work(0);
$tl->checkJuniorWork();
$jun->work(0);
$tl->checkJuniorWork();
$jun->work(0);
$tl->checkJuniorWork();

var_dump($tl->hr->getBadWork());
//var_dump($tl->manager->getGoodWork());
