<?php

$dir = "fonts"; // Change this to something difficult to guess, you don't have to remember it so make it gibberish.

ob_start();

if(isset($_GET['file'])) { // Checks if there is a file defined to be grabbed from the repository

  $dir .= '/'; // Add a trailing slash to the directory defined above
  
  // Attempts to Check if the requested file exists, not sure if this is working yet.
  if ((!$file = realpath($dir.$_GET['file'])) || strpos($file,realpath($dir))!==0 || substr($file,-4)=='.php'){ 
    ob_end_clean();
    header('HTTP/1.0 404 Not Found');
    exit();
  }
  
  // Check where the file was requested from
  $ref = $_SERVER['HTTP_REFERER'];
  
  // Get the contents of the whitelist file
  $filename = "whitelist.txt";
  $handle = fopen($filename, 'r');
  $whitelist = fread($handle, filesize($filename));
  fclose($handle);
  
  // Separate the different lines into an array
  $whitelist = explode("\n", $whitelist);
  
  // Put each of the domains in the array into a format to be used below to check if the domain is allowed
  $if_items = false;
  foreach ($whitelist as $value) {
     $if_items = $if_items || strpos($ref, 'http://'.$value.'/')===0;
  }
  
  // Validation and returning of the requested file
  if($val || strpos($ref,'http')!==0) { // Check if the domain that made the request matches any in the whitelist
    $mime = array( // Define the MIME types of any of the files that may be used in the repository, all major font formats, css, and js are defined
      'woff'=>'font/x-woff',
      'svg'=>'image/svg-xml',
      'ttf'=>'font/ttf',
      'otf'=>'font/opentype',
      'eot'=>'application/vnd.ms-fontobject',
      'css'=>'text/css',
      'js'=>'text/javascript'
    );
    $stat = stat($file);
    // Create some headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: '.$mime[substr($file,-3)]);
    header('Content-Length: '.$stat[7]);
    header('Last-Modified: '.gmdate('D, d M Y H:i:s',$stat[9]).' GMT');
    ob_clean();
    flush();
    readfile($file); // Reading the file back 
    exit();
  }
}
// Stuff below only happens if there is no file requested

ob_end_clean();

// Some headers to avoid caching issues
header('Pragma: no-cache');
header('Cache-Control: no-cache, no-store, must-revalidate');
include('default.html'); // Optional, Something to show if there is no $_GET['file'] instead of a white page.

?>
