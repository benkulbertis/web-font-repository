<?php
ob_start();
if(isset($_GET['file'])) {
$dir='fonts/'; // Change this to something difficult to guess, you don't have to remember it so make it gibberish. LEAVE THE TRAILING SLASH.
if ((!$file=realpath($dir.$_GET['file']))
    || strpos($file,realpath($dir))!==0 || substr($file,-4)=='.php'){
  ob_end_clean();
  header('HTTP/1.0 404 Not Found');
  exit();
}
$ref=$_SERVER['HTTP_REFERER'];
if (
// List sites in the format below, no limit to amount of sites
strpos($ref,'http://example.com/')===0 ||
strpos($ref,'http://another-example.org/')===0 ||
strpos($ref,'http')!==0){ // Don't touch this entry
  $mime=array(
    'woff'=>'font/x-woff',
    'svg'=>'image/svg-xml',
    'ttf'=>'font/ttf',
    'otf'=>'font/opentype',
    'eot'=>'application/vnd.ms-fontobject',
    'css'=>'text/css',
    'js'=>'text/javascript'
  );
  $stat=stat($file);
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: '.$mime[substr($file,-3)]);
  header('Content-Length: '.$stat[7]);
  header('Last-Modified: '.gmdate('D, d M Y H:i:s',$stat[9]).' GMT');
  ob_clean();
  flush();
  readfile($file);
  exit();
}
}
ob_end_clean();
header('Pragma: no-cache');
header('Cache-Control: no-cache, no-store, must-revalidate');
include('default.html'); // Optional, Something to show if there is no $_GET['file'] instead of a white page.
?>
