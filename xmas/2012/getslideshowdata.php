<?php
	
	$data = array();
	
	//Get directory listing
	/*$handle = opendir("images/") or die("Error opening directory");
	
	$folderCounter = 0;
	
	while ($direntry = readdir($handle)) {
	
		if ($direntry != ".." && $direntry != ".") {
			$path = "images/" . $direntry;
			$subhandle = opendir("images/" . $direntry);
			//$imageString = "";
			$folderImageArr = array();
			
			while ($imageentry = readdir($subhandle)) {
			
				if ($imageentry != ".." && $imageentry != ".") {
					//echo $path . "/" . $imageentry . '<br >';
					//$imageString .= $path . "/" . $imageentry . ";";
					array_push($folderImageArr, $path . "/" . $imageentry);
				}
			}
			
			$data[$folderCounter] = array(
				"images" => $folderImageArr,
				"caption" => "captionimages/" . ($folderCounter + 1) . ".png",
				"length" => 5000 //30000
			);
			$folderCounter++;
		}
	}*/
	
	//-----------------
	
	$folders = scandir("images/");
	sort($folders, SORT_NUMERIC);
	
	$data = array();
	
	foreach ($folders as $folderName) {
		if ($folderName != ".." && $folderName != ".") {
			
			$tmpPictures = scandir("images/" . $folderName . "/");
			sort($tmpPictures, SORT_NUMERIC);
			
			$pictures = array();
			
			foreach ($tmpPictures as $picture) {
				if ($picture != ".." && $picture != ".") {
					array_push($pictures, "images/" . $folderName . "/" . $picture);
				}
			}
			
			array_push($data, array(
				"images" => $pictures,
				"caption" => "captionimages/" . $folderName . ".png",
				"length" => 15000
			));
		}
	}
	
	//dump($data);
	echo json_encode($data);
	
	//For debugging, found here: http://www.bin-co.com/php/scripts/dump/
	/** Function : dump()
	 * Arguments : $data - the variable that must be displayed
	 * Prints a array, an object or a scalar variable in an easy to view format.
	 */
	function dump($data) {
		if(is_array($data)) { //If the given variable is an array, print using the print_r function.
			print "<pre>-----------------------\n";
			print_r($data);
			print "-----------------------</pre>";
		} elseif (is_object($data)) {
			print "<pre>==========================\n";
			var_dump($data);
			print "===========================</pre>";
		} else {
			print "=========&gt; ";
			var_dump($data);
			print " &lt;=========";
		}
	} 
?>