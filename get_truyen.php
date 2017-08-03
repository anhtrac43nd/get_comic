<?php
	include "dbcon.php";
	include "simple_html_dom.php";
	$html = file_get_html("http://webtruyen.com/all/");
	// $div = $html->find('div.list');
	// echo count($div);
	foreach($html->find('div.list h3 a') as $element){
		$name = $element->title;
		$link = $element->href;
		 $qr = "insert into truyen values(null,'$name','$link')";
         $conn->query($qr);
		echo $name."<br>";

    }

?>