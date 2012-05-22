<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                     // Expira en fecha pasada
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");        // Siempre página modificada
header("Cache-Control: no-cache, must-revalidate");                   // HTTP/1.1
header("Pragma: no-cache");
include('class.ezpdf.php');

$pdf =& new Cezpdf('a4');
$pdf->selectFont('./fonts/Helvetica');

$any1=date("Y");   /* any llarg 2009*/
$any2=date("y");   /*any petit 09*/
$mes=date("m");
$dia=date("d");
$diaris = array("lavanguardia","abc","elpais","elpunt_avui","elmundo","elperiodico_cat","larazon","publico","eleconomista","expansion","5dias","sport","marca","mundodeportivo","as","heraldo_aragon");


$k=0;
$i=0;
$n2=sizeof($urldiaris);

function image_exist1($url) {
	$AgetHeaders = @get_headers($url);
	if (preg_match("|200|", $AgetHeaders[0])) {
	$urlbones[]=$url;
	} else {
	$n3++;
	}
}

while($i<$n1)
  {
  $url="http://img.kiosko.net/" . $any1 . "/". $mes ."/" . $dia . "/es/" . $diaris[$i] .".750.jpg";
  
  	$AgetHeaders = @get_headers($url);
	if (preg_match("|200|", $AgetHeaders[0])) {
	$urlbones[]=$url;
	$i++;
	} else {
	$n3++;
	$i++;
	}
  }
  
$j=0;
while($j<$n2){
	$file = $urldiaris[$j];
	$AgetHeaders = @get_headers($file);
	if (preg_match("|200|", $AgetHeaders[0])) {
	// file exists
	$urlbones[]=$file;
	$j++;
	//echo "exist";
	} else {
	$n3++;
	$j++;
	}
}

foreach ($urlbones as $valor) {
   $pdf->ezText("\n",15);
   $pdf->ezImage($valor,2,490,'none');
   $pdf->ezText("\n",10);
   $pdf->ezImage("upload/uploads/img.jpg", 0, 'none', 'full', 'center');
   $pdf->ezNewPage();
   }
   

fwrite($fp,$pdfcode);
fclose($fp);
echo '<a href="http://www.qras.es/adminportimail/pro/docs/'. $any1 . '-'. $mes .'-' . $dia .'-pro.pdf">Clica per veure les portades</a>';

 
?>
