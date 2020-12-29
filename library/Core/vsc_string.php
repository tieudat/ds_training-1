<?php
class vsc_string {
	/**
	 * Trim Slashes
	 *
	 * Removes any leading/trailing slashes from a string:
	 *
	 * /this/that/theother/
	 *
	 * becomes:
	 *
	 * this/that/theother
	 *
	 * @todo Remove in version 3.1+.
	 * @deprecated 3.0.0 This is just an alias for PHP's native trim()
	 *            
	 * @param
	 *        	string
	 * @return string
	 */
	function trim_slashes($str) {
		return trim ( $str, '/' );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Strip Slashes
	 *
	 * Removes slashes contained in a string or in an array
	 *
	 * @param
	 *        	mixed string or array
	 * @return mixed string or array
	 */
	function strip_slashes($str) {
		if (! is_array ( $str )) {
			return stripslashes ( $str );
		}
		
		foreach ( $str as $key => $val ) {
			$str [$key] = strip_slashes ( $val );
		}
		
		return $str;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Strip Quotes
	 *
	 * Removes single and double quotes from a string
	 *
	 * @param
	 *        	string
	 * @return string
	 */
	function strip_quotes($str) {
		return str_replace ( array (
				'"',
				"'" 
		), '', $str );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Quotes to Entities
	 *
	 * Converts single and double quotes to entities
	 *
	 * @param
	 *        	string
	 * @return string
	 */
	function quotes_to_entities($str) {
		return str_replace ( array (
				"\'",
				"\"",
				"'",
				'"' 
		), array (
				"&#39;",
				"&quot;",
				"&#39;",
				"&quot;" 
		), $str );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Reduce Double Slashes
	 *
	 * Converts double slashes in a string to a single slash,
	 * except those found in http://
	 *
	 * http://www.some-site.com//index.php
	 *
	 * becomes:
	 *
	 * http://www.some-site.com/index.php
	 *
	 * @param
	 *        	string
	 * @return string
	 */
	function reduce_double_slashes($str) {
		return preg_replace ( '#(^|[^:])//+#', '\\1/', $str );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Reduce Multiples
	 *
	 * Reduces multiple instances of a particular character. Example:
	 *
	 * Fred, Bill,, Joe, Jimmy
	 *
	 * becomes:
	 *
	 * Fred, Bill, Joe, Jimmy
	 *
	 * @param
	 *        	string
	 * @param
	 *        	string the character you wish to reduce
	 * @param
	 *        	bool TRUE/FALSE - whether to trim the character from the beginning/end
	 * @return string
	 */
	function reduce_multiples($str, $character = ',', $trim = FALSE) {
		$str = preg_replace ( '#' . preg_quote ( $character, '#' ) . '{2,}#', $character, $str );
		return ($trim === TRUE) ? trim ( $str, $character ) : $str;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Create a Random String
	 *
	 * Useful for generating passwords or hashes.
	 *
	 * @param
	 *        	string type of random string. basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
	 * @param
	 *        	int number of characters
	 * @return string
	 */
	function random_string($type = 'alnum', $len = 8) {
		switch ($type) {
			case 'basic' :
				return mt_rand ();
			case 'alnum' :
			case 'numeric' :
			case 'nozero' :
			case 'alpha' :
				switch ($type) {
					case 'alpha' :
						$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'alnum' :
						$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						break;
					case 'numeric' :
						$pool = '0123456789';
						break;
					case 'nozero' :
						$pool = '123456789';
						break;
				}
				return substr ( str_shuffle ( str_repeat ( $pool, ceil ( $len / strlen ( $pool ) ) ) ), 0, $len );
			case 'unique' : // todo: remove in 3.1+
			case 'md5' :
				return md5 ( uniqid ( mt_rand () ) );
			case 'encrypt' : // todo: remove in 3.1+
			case 'sha1' :
				return sha1 ( uniqid ( mt_rand (), TRUE ) );
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Add's _1 to a string or increment the ending number to allow _2, _3, etc
	 *
	 * @param
	 *        	string required
	 * @param
	 *        	string What should the duplicate number be appended with
	 * @param
	 *        	string Which number should be used for the first dupe increment
	 * @return string
	 */
	function increment_string($str, $separator = '_', $first = 1) {
		preg_match ( '/(.+)' . preg_quote ( $separator, '/' ) . '([0-9]+)$/', $str, $match );
		return isset ( $match [2] ) ? $match [1] . $separator . ($match [2] + 1) : $str . $separator . $first;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Repeater function
	 *
	 * @todo Remove in version 3.1+.
	 * @deprecated 3.0.0 This is just an alias for PHP's native str_repeat()
	 *            
	 * @param string $data
	 *        	String to repeat
	 * @param int $num
	 *        	Number of repeats
	 * @return string
	 */
	function repeater($data, $num = 1) {
		return ($num > 0) ? str_repeat ( $data, $num ) : '';
	}
	
	/**
	 * Word Limiter
	 *
	 * Limits a string to X number of words.
	 *
	 * @param
	 *        	string
	 * @param
	 *        	int
	 * @param
	 *        	string the end character. Usually an ellipsis
	 * @return string
	 */
	function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
		if (trim ( $str ) === '') {
			return $str;
		}
		
		preg_match ( '/^\s*+(?:\S++\s*+){1,' . ( int ) $limit . '}/', $str, $matches );
		
		if (strlen ( $str ) === strlen ( $matches [0] )) {
			$end_char = '';
		}
		
		return rtrim ( $matches [0] ) . $end_char;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Character Limiter
	 *
	 * Limits the string based on the character count. Preserves complete words
	 * so the character count may not be exactly as specified.
	 *
	 * @param
	 *        	string
	 * @param
	 *        	int
	 * @param
	 *        	string the end character. Usually an ellipsis
	 * @return string
	 */
	function character_limiter($str, $n = 500, $end_char = '&#8230;') {
		if (mb_strlen ( $str ) < $n) {
			return $str;
		}
		
		// a bit complicated, but faster than preg_replace with \s+
		$str = preg_replace ( '/ {2,}/', ' ', str_replace ( array (
				"\r",
				"\n",
				"\t",
				"\x0B",
				"\x0C" 
		), ' ', $str ) );
		
		if (mb_strlen ( $str ) <= $n) {
			return $str;
		}
		
		$out = '';
		foreach ( explode ( ' ', trim ( $str ) ) as $val ) {
			$out .= $val . ' ';
			
			if (mb_strlen ( $out ) >= $n) {
				$out = trim ( $out );
				return (mb_strlen ( $out ) === mb_strlen ( $str )) ? $out : $out . $end_char;
			}
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * High ASCII to Entities
	 *
	 * Converts high ASCII text and MS Word special characters to character entities
	 *
	 * @param string $str        	
	 * @return string
	 */
	function ascii_to_entities($str) {
		$out = '';
		for($i = 0, $s = strlen ( $str ) - 1, $count = 1, $temp = array (); $i <= $s; $i ++) {
			$ordinal = ord ( $str [$i] );
			
			if ($ordinal < 128) {
				/*
				 * If the $temp array has a value but we have moved on, then it seems only
				 * fair that we output that entity and restart $temp before continuing. -Paul
				 */
				if (count ( $temp ) === 1) {
					$out .= '&#' . array_shift ( $temp ) . ';';
					$count = 1;
				}
				
				$out .= $str [$i];
			} else {
				if (count ( $temp ) === 0) {
					$count = ($ordinal < 224) ? 2 : 3;
				}
				
				$temp [] = $ordinal;
				
				if (count ( $temp ) === $count) {
					$number = ($count === 3) ? (($temp [0] % 16) * 4096) + (($temp [1] % 64) * 64) + ($temp [2] % 64) : (($temp [0] % 32) * 64) + ($temp [1] % 64);
					
					$out .= '&#' . $number . ';';
					$count = 1;
					$temp = array ();
				}				// If this is the last iteration, just output whatever we have
				elseif ($i === $s) {
					$out .= '&#' . implode ( ';', $temp ) . ';';
				}
			}
		}
		
		return $out;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Entities to ASCII
	 *
	 * Converts character entities back to ASCII
	 *
	 * @param
	 *        	string
	 * @param
	 *        	bool
	 * @return string
	 */
	function entities_to_ascii($str, $all = TRUE) {
		if (preg_match_all ( '/\&#(\d+)\;/', $str, $matches )) {
			for($i = 0, $s = count ( $matches [0] ); $i < $s; $i ++) {
				$digits = $matches [1] [$i];
				$out = '';
				
				if ($digits < 128) {
					$out .= chr ( $digits );
				} elseif ($digits < 2048) {
					$out .= chr ( 192 + (($digits - ($digits % 64)) / 64) ) . chr ( 128 + ($digits % 64) );
				} else {
					$out .= chr ( 224 + (($digits - ($digits % 4096)) / 4096) ) . chr ( 128 + ((($digits % 4096) - ($digits % 64)) / 64) ) . chr ( 128 + ($digits % 64) );
				}
				
				$str = str_replace ( $matches [0] [$i], $out, $str );
			}
		}
		
		if ($all) {
			return str_replace ( array (
					'&amp;',
					'&lt;',
					'&gt;',
					'&quot;',
					'&apos;',
					'&#45;' 
			), array (
					'&',
					'<',
					'>',
					'"',
					"'",
					'-' 
			), $str );
		}
		
		return $str;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Word Censoring Function
	 *
	 * Supply a string and an array of disallowed words and any
	 * matched words will be converted to #### or to the replacement
	 * word you've submitted.
	 *
	 * @param
	 *        	string the text string
	 * @param
	 *        	string the array of censored words
	 * @param
	 *        	string the optional replacement value
	 * @return string
	 */
	function word_censor($str, $censored, $replacement = '') {
		if (! is_array ( $censored )) {
			return $str;
		}
		
		$str = ' ' . $str . ' ';
		
		// \w, \b and a few others do not match on a unicode character
		// set for performance reasons. As a result words like über
		// will not match on a word boundary. Instead, we'll assume that
		// a bad word will be bookeneded by any of these characters.
		$delim = '[-_\'\"`(){}<>\[\]|!?@#%&,.:;^~*+=\/ 0-9\n\r\t]';
		
		foreach ( $censored as $badword ) {
			$badword = str_replace ( '\*', '\w*?', preg_quote ( $badword, '/' ) );
			if ($replacement !== '') {
				$str = preg_replace ( "/({$delim})(" . $badword . ")({$delim})/i", "\\1{$replacement}\\3", $str );
			} elseif (preg_match_all ( "/{$delim}(" . $badword . "){$delim}/i", $str, $matches, PREG_PATTERN_ORDER | PREG_OFFSET_CAPTURE )) {
				$matches = $matches [1];
				for($i = count ( $matches ) - 1; $i >= 0; $i --) {
					$length = strlen ( $matches [$i] [0] );
					$str = substr_replace ( $str, str_repeat ( '#', $length ), $matches [$i] [1], $length );
				}
			}
		}
		
		return trim ( $str );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Code Highlighter
	 *
	 * Colorizes code strings
	 *
	 * @param
	 *        	string the text string
	 * @return string
	 */
	function highlight_code($str) {
		/*
		 * The highlight string function encodes and highlights
		 * brackets so we need them to start raw.
		 *
		 * Also replace any existing PHP tags to temporary markers
		 * so they don't accidentally break the string out of PHP,
		 * and thus, thwart the highlighting.
		 */
		$str = str_replace ( array (
				'&lt;',
				'&gt;',
				'<?',
				'?>',
				'<%',
				'%>',
				'\\',
				'</script>' 
		), array (
				'<',
				'>',
				'phptagopen',
				'phptagclose',
				'asptagopen',
				'asptagclose',
				'backslashtmp',
				'scriptclose' 
		), $str );
		
		// The highlight_string function requires that the text be surrounded
		// by PHP tags, which we will remove later
		$str = highlight_string ( '<?php ' . $str . ' ?>', TRUE );
		
		// Remove our artificially added PHP, and the syntax highlighting that came with it
		$str = preg_replace ( array (
				'/<span style="color: #([A-Z0-9]+)">&lt;\?php(&nbsp;| )/i',
				'/(<span style="color: #[A-Z0-9]+">.*?)\?&gt;<\/span>\n<\/span>\n<\/code>/is',
				'/<span style="color: #[A-Z0-9]+"\><\/span>/i' 
		), array (
				'<span style="color: #$1">',
				"$1</span>\n</span>\n</code>",
				'' 
		), $str );
		
		// Replace our markers back to PHP tags.
		return str_replace ( array (
				'phptagopen',
				'phptagclose',
				'asptagopen',
				'asptagclose',
				'backslashtmp',
				'scriptclose' 
		), array (
				'&lt;?',
				'?&gt;',
				'&lt;%',
				'%&gt;',
				'\\',
				'&lt;/script&gt;' 
		), $str );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Phrase Highlighter
	 *
	 * Highlights a phrase within a text string
	 *
	 * @param string $str
	 *        	the text string
	 * @param string $phrase
	 *        	the phrase you'd like to highlight
	 * @param string $tag_open
	 *        	the openging tag to precede the phrase with
	 * @param string $tag_close
	 *        	the closing tag to end the phrase with
	 * @return string
	 */
	function highlight_phrase($str, $phrase, $tag_open = '<mark>', $tag_close = '</mark>') {
		return ($str !== '' && $phrase !== '') ? preg_replace ( '/(' . preg_quote ( $phrase, '/' ) . ')/i' . (@UTF8_ENABLED ? 'u' : ''), $tag_open . '\\1' . $tag_close, $str ) : $str;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Word Wrap
	 *
	 * Wraps text at the specified character. Maintains the integrity of words.
	 * Anything placed between {unwrap}{/unwrap} will not be word wrapped, nor
	 * will URLs.
	 *
	 * @param string $str
	 *        	the text string
	 * @param int $charlim
	 *        	= 76 the number of characters to wrap at
	 * @return string
	 */
	function word_wrap($str, $charlim = 76) {
		// Set the character limit
		is_numeric ( $charlim ) or $charlim = 76;
		
		// Reduce multiple spaces
		$str = preg_replace ( '| +|', ' ', $str );
		
		// Standardize newlines
		if (strpos ( $str, "\r" ) !== FALSE) {
			$str = str_replace ( array (
					"\r\n",
					"\r" 
			), "\n", $str );
		}
		
		// If the current word is surrounded by {unwrap} tags we'll
		// strip the entire chunk and replace it with a marker.
		$unwrap = array ();
		if (preg_match_all ( '|\{unwrap\}(.+?)\{/unwrap\}|s', $str, $matches )) {
			for($i = 0, $c = count ( $matches [0] ); $i < $c; $i ++) {
				$unwrap [] = $matches [1] [$i];
				$str = str_replace ( $matches [0] [$i], '{{unwrapped' . $i . '}}', $str );
			}
		}
		
		// Use PHP's native function to do the initial wordwrap.
		// We set the cut flag to FALSE so that any individual words that are
		// too long get left alone. In the next step we'll deal with them.
		$str = wordwrap ( $str, $charlim, "\n", FALSE );
		
		// Split the string into individual lines of text and cycle through them
		$output = '';
		foreach ( explode ( "\n", $str ) as $line ) {
			// Is the line within the allowed character count?
			// If so we'll join it to the output and continue
			if (mb_strlen ( $line ) <= $charlim) {
				$output .= $line . "\n";
				continue;
			}
			
			$temp = '';
			while ( mb_strlen ( $line ) > $charlim ) {
				// If the over-length word is a URL we won't wrap it
				if (preg_match ( '!\[url.+\]|://|www\.!', $line )) {
					break;
				}
				
				// Trim the word down
				$temp .= mb_substr ( $line, 0, $charlim - 1 );
				$line = mb_substr ( $line, $charlim - 1 );
			}
			
			// If $temp contains data it means we had to split up an over-length
			// word into smaller chunks so we'll add it back to our current line
			if ($temp !== '') {
				$output .= $temp . "\n" . $line . "\n";
			} else {
				$output .= $line . "\n";
			}
		}
		
		// Put our markers back
		if (count ( $unwrap ) > 0) {
			foreach ( $unwrap as $key => $val ) {
				$output = str_replace ( '{{unwrapped' . $key . '}}', $val, $output );
			}
		}
		
		return $output;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Ellipsize String
	 *
	 * This function will strip tags from a string, split it at its max_length and ellipsize
	 *
	 * @param
	 *        	string string to ellipsize
	 * @param
	 *        	int max length of string
	 * @param
	 *        	mixed int (1|0) or float, .5, .2, etc for position to split
	 * @param
	 *        	string ellipsis ; Default '...'
	 * @return string ellipsized string
	 */
	function ellipsize($str, $max_length, $position = 1, $ellipsis = '&hellip;') {
		// Strip tags
		$str = trim ( strip_tags ( $str ) );
		
		// Is the string long enough to ellipsize?
		if (mb_strlen ( $str ) <= $max_length) {
			return $str;
		}
		
		$beg = mb_substr ( $str, 0, floor ( $max_length * $position ) );
		$position = ($position > 1) ? 1 : $position;
		
		if ($position === 1) {
			$end = mb_substr ( $str, 0, - ($max_length - mb_strlen ( $beg )) );
		} else {
			$end = mb_substr ( $str, - ($max_length - mb_strlen ( $beg )) );
		}
		
		return $beg . $ellipsis . $end;
	}
	
	function str_convert($str, $prefix="-"){
	    $str = preg_replace("/(à|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|A)/", 'a', $str);
	    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|E)/", 'e', $str);
	    $str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|I)/", 'i', $str);
	    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|O)/", 'o', $str);
	    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|U)/", 'u', $str);
	    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Y)/", 'y', $str);
	    $str = preg_replace("/(đ|Đ|D)/", 'd', $str);
	    $str = preg_replace("/(B)/", 'b', $str);
	    $str = preg_replace("/(%)/", '', $str);
	    $str = preg_replace("/( – )/", $prefix, $str);
	    $str = preg_replace("/( - )/", $prefix, $str);
	    $str = preg_replace("/( )/", $prefix, $str);
	    $str = preg_replace("/(  )/", $prefix, $str);
	    $str = preg_replace("/(   )/", $prefix, $str);
	    $str = preg_replace("/(    )/", $prefix, $str);
	    $str = preg_replace("/(C)/", 'c', $str);
	    $str = preg_replace("/(G)/", 'g', $str);
	    $str = preg_replace("/(L)/", 'l', $str);
	    $str = preg_replace("/(M)/", 'm', $str);
	    $str = preg_replace("/(N)/", 'n', $str);
	    $str = preg_replace("/(P)/", 'p', $str);
	    $str = preg_replace("/(Q)/", 'q', $str);
	    $str = preg_replace("/(H)/", 'h', $str);
	    $str = preg_replace("/(T)/", 't', $str);
	    $str = preg_replace("/(K)/", 'k', $str);
	    $str = preg_replace("/(S)/", 's', $str);
	    $str = preg_replace("/(R)/", 'r', $str);
	    $str = preg_replace("/(V)/", 'v', $str);
	    $str = preg_replace("/(Y)/", 'y', $str);
	    $str = preg_replace("/(W)/", 'w', $str);
	    $str = str_replace('"', "", $str);
	    $str = str_replace("?", "", $str);
	    $str = str_replace(',', "", $str);
	    $str = str_replace(':', "", $str);
	    $str = str_replace('/', $prefix, $str);
	    $str = str_replace('(', "", $str);
	    $str = str_replace(')', "", $str);
	    $str = str_replace('{', "", $str);
	    $str = str_replace('}', "", $str);
	    $str = str_replace('\'', "", $str);
	    $str = str_replace('`', "", $str);
	    $str = str_replace("/[\W]/", "", $str);
	    
	    return trim($str);
	}


	function del_danger($str) {
		$str = preg_replace("/[\\\'\"`{}<>]/", "", $str);
		return $str;
	}


	/**
	 * convert value of array to value of ini file
	 * @param array $a
	 * @param array $parent
	 * @return string
	 */
	function arr_to_ini(array $a, array $parent = array()){
		$out = '';
		foreach ($a as $k => $v){
			if (is_array($v)){
				$sec = array_merge((array) $parent, (array) $k);
				$out .= '[' . join(' : ', $sec) . ']' . PHP_EOL;
				$out .= $this->arr_to_ini($v, $sec);
			}
			else{
				$out .= $k . ' = ' . '"'.$v.'"' . PHP_EOL;
			}
		}
		return $out;
	}


	function convert_money_to_int($value){
		$value = str_replace(",", "", $value);
		$value = intval($value);
		return $value;
	}


	function encrypt_string($value) {
		if(!$value){return false;}
		$key = 'HLSCMS_by_HLStar';
		$text = $value;
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
		return trim(base64_encode($crypttext)); //encode for cookie
	}


	function decrypt_string($value) {
		if(!$value){return false;}
		$key = 'HLSCMS_by_HLStar';
		$crypttext = base64_decode($value); //decode cookie
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
		return trim($decrypttext);
	}
	
	
	function get_fcontent( $url,  $javascript_loop = 0, $timeout = 5 ) {
		$url = str_replace( "&amp;", "&", urldecode(trim($url)) );
	
		$cookie = tempnam ("/tmp", "CURLCOOKIE");
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
		//curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		$content = curl_exec( $ch );
		$response = curl_getinfo( $ch );
		curl_close ( $ch );
	
		if ($response['http_code'] == 301 || $response['http_code'] == 302) {
			ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
	
			if ( $headers = @get_headers($response['url']) ) {
				foreach( $headers as $value ) {
					if ( substr( strtolower($value), 0, 9 ) == "location:" )
						return $this->get_fcontent( trim( substr( $value, 9, strlen($value) ) ) );
				}
			}
		}
	
		if (( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) {
			return $this->get_fcontent( $value[1], $javascript_loop+1 );
		} else {
			return array( $content, $response );
		}
	}
	
	
	function get_client_ip() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP'])) $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED'])) $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])) $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED'])) $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR'])) $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
	
	
	function get_position_ofstr_byprefix($str, $prefix, $position=0){
		$a_ex_prefix = explode("|", $prefix);
		foreach ($a_ex_prefix AS $item){
			if(substr_count($str, $item)>0){
				$a_ex_str = explode($item, $str);
				$str = trim($a_ex_str[0]);
			}
		}
		return $str;
	}
	
	
	function get_value_of_endstr($str){
	    $a_str = explode(" ", $str);
	    return end($a_str);
	}
}