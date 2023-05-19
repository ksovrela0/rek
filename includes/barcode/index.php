<?php
$title = $_REQUEST['title'];
require_once('barcode/BCGFontFile.php');
require_once('barcode/BCGColor.php');
require_once('barcode/BCGDrawing.php');

require_once('barcode/BCGcode128.barcode.php');

header('Content-Type: image/png');

$color_white = new BCGColor(255, 255, 255);

$code = new BCGcode128();
$code->setScale(1);
$code->parse($title);

$drawing = new BCGDrawing('', $color_white);
$drawing->setBarcode($code);

$drawing->draw();
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);


?>