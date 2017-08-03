<?php
	include "dbcon.php";
	include "simple_html_dom.php";
	include "function.php";
		$sql = "select * from truyen";
		$result = $conn->query($sql);
		 if ($result->num_rows > 0){
			while ($row = $result->fetch_assoc()){
				$id = $row['id'];
				$name = changeTitle($row['ten']);
				$link = $row['link'];
				$html1 = file_get_html($link);
				mkdir( "uploads/".$name );
		        foreach ($html1->find('span.numbpage') as $elm){
		        	$numbpage = $elm->innertext;		        	
		        	$num = substr($numbpage,10,2);

		        }
		       	
		        for ($i=1;$i<=$num;$i++){
		        		$html2 = file_get_html($link.$i);
		        		foreach($html2->find('div#divtab ul li h4 a') as $el2){
		        			$chap = $el2->innertext;
		        			$slug_chap = changeTitle($chap);
		        			$link_chap = $el2->href;

		        			
		        			//$html3 = str_get_html(file_get_contents($link_chap));
		        			$url = "uploads/".$name."/".$slug_chap.".txt";							
		        			$qr1 = "insert into chuong values(null,'$chap','$link_chap','$url','$id')";
		        			$conn->query($qr1);
		        			if (!empty($link_chap)){
		        			$html3 = file_get_html($link_chap);
		        			foreach ($html3->find('div#content') as $elm3){
		        				$content = $elm3->innertext;
		        				$content = str_replace( '<!-- ADS CHAPTER 1 --><!--<p>--><div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;"><h4>A PHP Error was encountered</h4><p>Severity: Notice</p><p>Message: Undefined index: HTTP_USER_AGENT</p><p>Filename: libraries/AdsManager.php</p><p>Line Number: 330</p><p>Backtrace:</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/libraries/AdsManager.php<br />Line: 330<br />Function: _error_handler</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/views/frontend/content.php<br />Line: 153<br />Function: insertAd</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/libraries/My_layout.php<br />Line: 24<br />Function: view</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/controllers/Story.php<br />Line: 886<br />Function: view</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/public_html/index.php<br />Line: 315<br />Function: require_once</p></div><div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;"><h4>A PHP Error was encountered</h4><p>Severity: Notice</p><p>Message: Undefined index: HTTP_USER_AGENT</p><p>Filename: libraries/AdsManager.php</p><p>Line Number: 330</p><p>Backtrace:</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/libraries/AdsManager.php<br />Line: 330<br />Function: _error_handler</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/views/frontend/content.php<br />Line: 154<br />Function: insertAd</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/libraries/My_layout.php<br />Line: 24<br />Function: view</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/v2.4/application/controllers/Story.php<br />Line: 886<br />Function: view</p><p style="margin-left:10px">File: /home/doctruyen/domains/doctruyen.info/public_html/index.php<br />Line: 315<br />Function: require_once</p></div>', '', $content );
		        			}
							$myfile = fopen($url, "w+") or die("Unable to open file!");
							fwrite($myfile, $content);
							fclose($myfile);
						}
		        			 echo $chap." ".$link_chap."<br>";
						 }
		        		
		        		}
		       
			}
		 }
		



 ?>