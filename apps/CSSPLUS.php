<?php


if(!file_exists("styles")){
	mkdir("styles");
}
if(!file_exists("styles/style.css")){
	$data = 
'/* AUTO GENERATED CSS BY CSSPLUS */
def $bgcolor black

*{
	margin:0;
	padding:0;
}

html{
	background-color: $bgcolor;
}
';
	file_put_contents("styles/style.css", $data);
}

echo "<link rel='stylesheet' type='text/css' href='styles/temp.css'>";

$vars = [];
$handle = fopen("styles/style.css", "r");
$linecount = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
       if(startsWith($line,"def")){
       		$args = explode(" ", $line);
       		$varname = $args[1];
       		$varvalue = $args[2];

       		if(!startsWith($varname,"$")){
       			exit("error at line $linecount, expected '$' at variable name!");
       		}

       		array_push($vars, "$varname:$varvalue");
       		$linecount++;
       }
    }

    fclose($handle);
}



$content = "";
$handle = fopen("styles/style.css", "r");
$linecount = 0;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
       if(startsWith($line,"def")){
       		$line = "";
       }
       $content .= $line;
    }

    fclose($handle);
}

file_put_contents("styles/temp.css", $content);



$parsing = file_get_contents("styles/temp.css");
foreach($vars as $v){

	$varname = explode(":", $v)[0];
	$value = getVarValue($vars,$varname);
	$value = str_replace("\n", "", $value);
	$parsing = str_replace($varname, $value, $parsing);
}

file_put_contents("styles/temp.css", $parsing);











function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}


function getVarValue($vars, $varname){
	foreach($vars as $v){
		$args = explode(":", $v);
		$vname = $args[0];
		if($vname == $varname){
			return $args[1];
		}
		
	}
}


?>