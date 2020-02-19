<?php
///////////////////////////////
//                           //
//    JSON-P Example         //
//      v1.0                 //
//    Mike Gieson            //
//    www.wimpyplayer.com    // 
//                           //
///////////////////////////////.

$array = array(
	array(
			"file" 		=> "http://www.wimpyplayer.com/media/audio/song1.mp3"
			, "kind" 	=> "mp3"
			, "title" 	=> "Song 1"
			, "image" 	=> "http://www.wimpyplayer.com/media/audio/song1.jpg"
	),
    array(
			"file" 		=> "http://www.wimpyplayer.com/media/audio/song2.mp3"
			, "kind" 	=> "mp3"
			, "title" 	=> "Song 2"
			, "image" 	=> "http://www.wimpyplayer.com/media/audio/song2.jpg"
	),
    array(
			"file" 		=> "http://www.wimpyplayer.com/media/audio/song3.mp3"
			, "kind" 	=> "mp3"
			, "title" 	=> "Song 3"
			, "image" 	=> "http://www.wimpyplayer.com/media/audio/song3.jpg"
	),
);

$data = json_encode($array);


function is_valid_callback($subject) {
	$identifier_expr = '/^[$_\p{L}][$_\p{L}\p{Mn}\p{Mc}\p{Nd}\p{Pc}\x{200C}\x{200D}]*+$/u';

	$reserved_words = array('break', 'do', 'instanceof', 'typeof', 'case',
		'else', 'new', 'var', 'catch', 'finally', 'return', 'void', 'continue', 
		'for', 'switch', 'while', 'debugger', 'function', 'this', 'with', 
		'default', 'if', 'throw', 'delete', 'in', 'try', 'class', 'enum', 
		'extends', 'super', 'const', 'export', 'import', 'implements', 'let', 
		'private', 'public', 'yield', 'interface', 'package', 'protected', 
		'static', 'null', 'true', 'false');
		
	
	/*
	// ensure input is a string
	$subject = (string)$subject;
	for ($i=0; $i<strlen($orig); $i++) {
		$o = ord($orig{$i});
		if( ! ( 
					(($o>=48) && ($o<=57))	// numbers
				||	(($o>=97) && ($o<=122))	// lowercase
				||	(($o>=65) && ($o<=90))	// uppercase
				||	($subject{$i}=='_')		// underscore
				)
			){       
		}
		$subject{$i} = $replace;        // check failed, use replacement
	}
	*/

	return preg_match($identifier_expr, $subject)
		&& ! in_array(mb_strtolower($subject, 'UTF-8'), $reserved_words);
}



// JSON if no callback
if( ! isset($_GET['callback']) ) {
	header('Content-Type: text/plain; charset=utf8');
	exit( $json );
}

// JSONP if valid callback
if( is_valid_callback($_GET['callback']) ) {
	header('Content-Type: text/javascript; charset=utf8');
	header('Access-Control-Max-Age: 3628800');
	header('Access-Control-Allow-Origin: *'); 		// header('Access-Control-Allow-Origin: http://www.example.com/');
	header('Access-Control-Allow-Methods: GET'); 	// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	exit( $_GET['callback']."('".$data."');" );
}

// Otherwise, bad request
header( 'status: 400 Bad Request', true, 400 );


?>