<?
require 'lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
  'cache'       => 'compilation_cache',
  'auto_reload' => true
));
$img = scandir("img/small");
unset($img[0]);
unset($img[1]);
echo $twig->render('img_small.twig', array('picture'=>$img));
?>