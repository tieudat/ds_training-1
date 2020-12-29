<?php
/**
 * Image Library
 * For get and upload images
 * @author LUCTV
 * 20/05/2016
 *
 */
class vsc_image extends Zebra {

	public $img_type;
	public $_dir;
	
	function __construct(){
		$this->img_type = array("image/gif", "image/jpg", "image/jpeg", "image/png");
		$this->_dir = "../upload/";
		$this->folder = "images/";
		$this->thumbnail = "thumb/";
		
	}
	
	
	public function get_image($folder, $imgname){
	    $result = NO_IMG;
	    if(!in_array(DOMAIN, ['https://v2.daisan.vn/','https://daisan.vn/'])&&!is_localhost()){
	        $folder = URL_UPLOAD.$folder;
	    }else $folder = URL_IMAGE.$folder;
	    if($imgname!='') $result = $folder.$imgname;
// 	    if($imgname!=''){
// 	        if(!is_localhost()) $result = URL_IMAGE.$folder.$imgname;
// 	        elseif(is_localhost() && is_file(DIR_UPLOAD.$folder.$imgname)) $result = URL_UPLOAD.$folder.$imgname;
// 	    }
	    return $result;
	}
	
	public function get_image_post($image, $type=0, $return_null=0){
	    $result = NO_IMG;
	    
	    $dir = $this->thumbnail;
	    if($type==1) $dir = $this->folder;
	    $dir = $this->_dir . $dir;
	    
	    $convert_arr_dir = explode("/", $dir);
	    if($convert_arr_dir[0]==".."){
	        $dir_get = implode("/", $convert_arr_dir);
	        unset($convert_arr_dir[0]);
	        unset($convert_arr_dir[1]);
	        $dir_show = implode("/", $convert_arr_dir);
	    }
	    else {
	        $dir_get = "../" . implode("/", $convert_arr_dir);
	        unset($convert_arr_dir[1]);
	        $dir_show = implode("/", $convert_arr_dir);
	    }
	    
	    if(is_file($dir_get . $image)){
	        $result = URL_UPLOAD . $dir_show . $image;
	    }else {
	        if($return_null==1)
	            return false;
	    }
	    
	    return $result;
	}
	
	
    function check_image($img, $w=200, $h=200, $size=5) {
        list($width, $height) = getimagesize($img['tmp_name']);
        if ($img["error"] > 0) {
            lib_alert("Image correct !");
            return false;
        } elseif (!in_array($img["type"], $this->img_type)) {
            lib_alert("Image correct !");
            return false;
        } elseif (($img["size"] / 1024) > ($size*1024)) {
            lib_alert("Invalid: Size of image > 5Mb !");
            return false;
        } elseif ($height < $h || $width < $w) {
            lib_alert("Invalid: Size of image is so small !");
            return false;
        } else {
            return true;
        }
    }

    
    function upload($folder, $img, $max_width=null, $resize=-1) {
    	$folder = DIR_UPLOAD.$folder;
        $imgname = $this->get_imgname_upload($img);
        if (!is_dir($folder)) {
            @mkdir($folder, 0775);
            @chmod($folder, 0775);
        }
        
        list($width, $height) = getimagesize($img['tmp_name']);
        if (move_uploaded_file($img['tmp_name'], $folder.$imgname)) {
            @chmod($folder.$imgname, 0755);
            if($max_width!=null && intval($max_width)>10){
            	if($resize>0) $new_height = $max_width/$resize;
            	else $new_height = $height * ($max_width/$width);
            	$this->resize_image($folder.$imgname, $max_width, $new_height);
            	@chmod($folder.$imgname, 0755);
            }
            return $imgname;
        }
        return false;
    }

    
    function upload_image_base64_v1($folder, $img, $imgname=null, $max_width=null, $resize=1){
    	if(!is_dir($folder)) $folder = DIR_UPLOAD.$folder;

    	list(, $img)      = explode(',', $img);

    	if(!is_dir($folder)){
            if (!mkdir($folder, 0777, true) && !is_dir($folder)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $folder));
            }
//    		mkdir($folder, 0777);
//    		chmod($folder, 0777);
    	}
    	$rt = false;
    	if(@file_put_contents($folder.$imgname, base64_decode($img))){
    		$rt = $imgname;
    		if($max_width!=null && intval($max_width)>30){
    		    list($width, $height) = getimagesize($folder.$imgname);
    		    if($resize>0) $new_height = $max_width/$resize;
    		    else $new_height = $height * ($max_width/$width);
    		    $this->resize_image($folder.$imgname, $max_width, $new_height);
    		}
    		chmod($folder.$imgname, 0755);
    	}
    	return $rt;
    }
    function upload_image_base64($folder, $img, $imgname=null, $max_width=null, $resize=1){
    	if(!is_dir($folder)) $folder = DIR_UPLOAD.$folder;
        echo "<pre>";
        print_r('$imgname -----'.$imgname);
        echo "</pre>";
    	list($type, $img) = explode(';', $img);
    	list(, $img)      = explode(',', $img);
    	list(, $type)	= explode("/", $type);
    	$imgname = ($imgname==null||$imgname=='') ? 'hodine_img' : $imgname;
    	$imgname = time()."_".md5($imgname).".".$type;

    	if(!is_dir($folder)){
            if (!mkdir($folder, 0777, true) && !is_dir($folder)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $folder));
            }
//    		mkdir($folder, 0777);
//    		chmod($folder, 0777);
    	}
    	$rt = false;
    	if(@file_put_contents($folder.$imgname, base64_decode($img))){
    		$rt = $imgname;
    		if($max_width!=null && intval($max_width)>30){
    		    list($width, $height) = getimagesize($folder.$imgname);
    		    if($resize>0) $new_height = $max_width/$resize;
    		    else $new_height = $height * ($max_width/$width);
    		    $this->resize_image($folder.$imgname, $max_width, $new_height);
    		}
    		chmod($folder.$imgname, 0755);
    	}
    	return $rt;
    }

    function upload_image_fromurl($folder, $url, $max_width=null, $resize=1){
        if(!is_dir($folder)) $folder = DIR_UPLOAD.$folder;
        $img = @file_get_contents($url);
        $a_type = explode('.', $url);
        $type = @end($a_type);
        $imgname = time()."_".md5($url).".".$type;
        
        if(!is_dir($folder)){
            mkdir($folder, 0777);
            chmod($folder, 0777);
        }
        
        $rt = false;
        if(@file_put_contents($folder.$imgname, $img)){
            $rt = $imgname;
            if($max_width!=null && intval($max_width)>30){
                list($width, $height) = getimagesize($folder.$imgname);
                if($resize>0) $new_height = $max_width/$resize;
                else $new_height = $height * ($max_width/$width);
                $this->resize_image($folder.$imgname, $max_width, $new_height);
            }
            chmod($folder.$imgname, 0755);
        }
        
        return $rt;
    }
    
    
    function make_image_thumb($path_img, $thumbsize=240, $thumbratio=1) {
    	if ($thumbratio == 0) {
    		$thumbheight = $thumbsize;
    		$thumbposition = 1;
    	}else {
    		$thumbheight = intval(intval($thumbsize) / floatval($thumbratio));
    		$thumbposition = 6;
    	}
    
    	$this->resize_image($path_img, $thumbsize, $thumbheight, $thumbposition);
    }
    
    
    function resize_image($image, $width, $height, $thumbposition=6){
    	$this->source_path = $image;
    	$this->preserve_aspect_ratio = true;
    	$this->enlarge_smaller_images = true;
    	$this->preserve_time = true;
    	
    	$this->target_path = $image;
    	$this->jpeg_quality = 70;
    	$this->png_compression = 8;
    	
    	$this->resize($width, $height, $thumbposition, -1);
    }
    
    
    /**
     * Remover images
     * @param string $dir
     * @param string $imgname
     */
    function remove($imgname=null){
    	$rt = true;
    	if($imgname != null || $imgname != ''){
    		if(is_file($this->_dir . $this->folder . $imgname)){
		    	@unlink($this->_dir . $this->folder . $imgname);
		    	@unlink($this->_dir . $this->thumbnail . $imgname);
    		}else $rt = false;
    	}else $rt = false;
    	return $rt;
    }
    
    
    function get_imgname_upload($img){
    	list(, $type)	= explode("/", $img['type']);
    	return time()."_".md5($img['name']).".".$type;
    }
    
}


define('ZEBRA_IMAGE_BOXED', 0);
define('ZEBRA_IMAGE_NOT_BOXED', 1);
define('ZEBRA_IMAGE_CROP_TOPLEFT', 2);
define('ZEBRA_IMAGE_CROP_TOPCENTER', 3);
define('ZEBRA_IMAGE_CROP_TOPRIGHT', 4);
define('ZEBRA_IMAGE_CROP_MIDDLELEFT', 5);
define('ZEBRA_IMAGE_CROP_CENTER', 6);
define('ZEBRA_IMAGE_CROP_MIDDLERIGHT', 7);
define('ZEBRA_IMAGE_CROP_BOTTOMLEFT', 8);
define('ZEBRA_IMAGE_CROP_BOTTOMCENTER', 9);
define('ZEBRA_IMAGE_CROP_BOTTOMRIGHT', 10);
ini_set('gd.jpeg_ignore_warning', true);

class Zebra{

	public $source_transparent_color_index;
	public $source_transparent_color;
	public $source_identifier;
	public $source_width;
	public $source_height;
	public $source_type;
	public $source_image_time;
	public $target_type;
	public $chmod_value;
	public $enlarge_smaller_images;
	public $error;
	public $auto_handle_exif_orientation;
	public $jpeg_quality;
	public $png_compression;
	public $preserve_aspect_ratio;
	public $preserve_time;
	public $sharpen_images;
	public $source_path;
	public $target_path;

	function __construct() {
		$this->chmod_value = 0755;

		$this->error = 0;

		$this->jpeg_quality = 85;

		$this->png_compression = 9;

		$this->preserve_aspect_ratio = $this->preserve_time = $this->enlarge_smaller_images = true;

		$this->sharpen_images = $this->auto_handle_exif_orientation = false;

		$this->source_path = $this->target_path = '';
	}

	public function apply_filter($filter, $arg1 = '', $arg2 = '', $arg3 = '', $arg4 = ''){
		if (function_exists('imagefilter'))
		if ($this->_create_from_source()) {
			$target_identifier = $this->_prepare_image($this->source_width, $this->source_height, -1);
			imagecopyresampled(
			$target_identifier,
			$this->source_identifier,
			0,
			0,
			0,
			0,
			$this->source_width,
			$this->source_height,
			$this->source_width,
			$this->source_height
			);

			if (is_array($filter)) {
				foreach ($filter as $arguments)
				if (defined('IMG_FILTER_' . strtoupper($arguments[0]))) {
					if (!@call_user_func_array('imagefilter', array_merge(array($target_identifier, constant('IMG_FILTER_' . strtoupper($arguments[0]))), array_slice($arguments, 1))))
						trigger_error('Invalid arguments used for "' . strtoupper($arguments[0]) . '" filter', E_USER_WARNING);
				} else trigger_error('Filter "' . strtoupper($arguments[0]) . '" is not available', E_USER_WARNING);

			} elseif (defined('IMG_FILTER_' . strtoupper($filter))) {
				$arguments = func_get_args();
				if (!@call_user_func_array('imagefilter', array_merge(array($target_identifier, constant('IMG_FILTER_' . strtoupper($filter))), array_slice($arguments, 1))))
					trigger_error('Invalid arguments used for "' . strtoupper($arguments[0]) . '" filter', E_USER_WARNING);
			} else trigger_error('Filter "' . strtoupper($arguments[0]) . '" is not available', E_USER_WARNING);
			return $this->_write_image($target_identifier);
		}

		return false;
	}

	public function crop($start_x, $start_y, $end_x, $end_y){
		$args = func_get_args();
		if (isset($args[4]) && is_resource($args[4])) {
			$this->source_identifier = $args[4];
			$result = true;
		} else $result = $this->_create_from_source();
		if ($result !== false) {
			$target_identifier = $this->_prepare_image($end_x - $start_x, $end_y - $start_y, -1);
			imagecopyresampled(
			$target_identifier,
			$this->source_identifier,
			0,
			0,
			$start_x,
			$start_y,
			$end_x - $start_x,
			$end_y - $start_y,
			$end_x - $start_x,
			$end_y - $start_y
			);
			return $this->_write_image($target_identifier);
		}

		return false;
	}

	public function flip_both(){
		return $this->_flip('both');
	}

	public function flip_horizontal(){
		return $this->_flip('horizontal');
	}

	public function flip_vertical(){
		return $this->_flip('vertical');
	}

	public function resize($width = 0, $height = 0, $method = ZEBRA_IMAGE_CROP_CENTER, $background_color = '#FFFFFF'){
		if ($this->_create_from_source()) {
			if ($width == 0 || $height == 0) $auto_preserve_aspect_ratio = true;
			if ($this->preserve_aspect_ratio || isset($auto_preserve_aspect_ratio)) {
				if ($width == 0 && $height > 0) {
					$aspect_ratio = $this->source_width / $this->source_height;
					$target_height = $height;
					$target_width = round($height * $aspect_ratio);
				} elseif ($width > 0 && $height == 0) {
					$aspect_ratio = $this->source_height / $this->source_width;
					$target_width = $width;
					$target_height = round($width * $aspect_ratio);
				} elseif ($width > 0 && $height > 0 && ($method == 0 || $method == 1)) {
					$vertical_aspect_ratio = $height / $this->source_height;
					$horizontal_aspect_ratio = $width / $this->source_width;
					if (round($horizontal_aspect_ratio * $this->source_height < $height)) {
						$target_width = $width;
						$target_height = round($horizontal_aspect_ratio * $this->source_height);
					} else {
						$target_height = $height;
						$target_width = round($vertical_aspect_ratio * $this->source_width);
					}
				} elseif ($width > 0 && $height > 0 && $method > 1 && $method < 11) {
					$vertical_aspect_ratio = $this->source_height / $height;
					$horizontal_aspect_ratio = $this->source_width /  $width;
					$aspect_ratio =
					$vertical_aspect_ratio < $horizontal_aspect_ratio ?
					$vertical_aspect_ratio :
					$horizontal_aspect_ratio;
					$target_width = round($this->source_width / $aspect_ratio);
					$target_height = round($this->source_height / $aspect_ratio);
				} else {
					$target_width = $this->source_width;
					$target_height = $this->source_height;
				}
			} else {
				$target_width = ($width > 0 ? $width : $this->source_width);
				$target_height = ($height > 0 ? $height : $this->source_height);
			}

			if (
			$this->enlarge_smaller_images ||
			($width > 0 && $height > 0 ?
					($this->source_width > $width || $this->source_height > $height) :
					($this->source_width > $target_width || $this->source_height > $target_height)
			)
			) {
				if (
				($this->preserve_aspect_ratio || isset($auto_preserve_aspect_ratio)) &&
				($width > 0 && $height > 0) &&
				($method > 1 && $method < 11)
				) {
					$target_identifier = $this->_prepare_image($target_width, $target_height, $background_color);
					imagecopyresampled(
					$target_identifier,
					$this->source_identifier,
					0,
					0,
					0,
					0,
					$target_width,
					$target_height,
					$this->source_width,
					$this->source_height
					);

					switch ($method) {
						case ZEBRA_IMAGE_CROP_TOPLEFT:
							return $this->crop(
							0,
							0,
							$width,
							$height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_TOPCENTER:
							return $this->crop(
							floor(($target_width - $width) / 2),
							0,
							floor(($target_width - $width) / 2) + $width,
							$height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_TOPRIGHT:
							return $this->crop(
							$target_width - $width,
							0,
							$target_width,
							$height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_MIDDLELEFT:
							return $this->crop(
							0,
							floor(($target_height - $height) / 2),
							$width,
							floor(($target_height - $height) / 2) + $height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_CENTER:
							return $this->crop(
							floor(($target_width - $width) / 2),
							floor(($target_height - $height) / 2),
							floor(($target_width - $width) / 2) + $width,
							floor(($target_height - $height) / 2) + $height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_MIDDLERIGHT:
							return $this->crop(
							$target_width - $width,
							floor(($target_height - $height) / 2),
							$target_width,
							floor(($target_height - $height) / 2) + $height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_BOTTOMLEFT:
							return $this->crop(
							0,
							$target_height - $height,
							$width,
							$target_height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_BOTTOMCENTER:
							return $this->crop(
							floor(($target_width - $width) / 2),
							$target_height - $height,
							floor(($target_width - $width) / 2) + $width,
							$target_height,
							$target_identifier // crop this resource instead
							);
							break;
						case ZEBRA_IMAGE_CROP_BOTTOMRIGHT:
							return $this->crop(
							$target_width - $width,
							$target_height - $height,
							$target_width,
							$target_height,
							$target_identifier // crop this resource instead
							);
							break;
					}

				} else {
					$target_identifier = $this->_prepare_image(
							($width > 0 && $height > 0 && $method != ZEBRA_IMAGE_NOT_BOXED ? $width : $target_width),
							($width > 0 && $height > 0 && $method != ZEBRA_IMAGE_NOT_BOXED ? $height : $target_height),
							$background_color
					);
					imagecopyresampled(
					$target_identifier,
					$this->source_identifier,
					($width > 0 && $height > 0 && $method != ZEBRA_IMAGE_NOT_BOXED ? ($width - $target_width) / 2 : 0),
					($width > 0 && $height > 0 && $method != ZEBRA_IMAGE_NOT_BOXED ? ($height - $target_height) / 2 : 0),
					0,
					0,
					$target_width,
					$target_height,
					$this->source_width,
					$this->source_height
					);

					return $this->_write_image($target_identifier);
				}

			} else return $this->_write_image($this->source_identifier);
		}

		return false;
	}

	public function rotate($angle, $background_color = -1){
		$arguments = func_get_args();
		$use_existing_source = (isset($arguments[2]) && $arguments[2] === false);
		if ($use_existing_source || $this->_create_from_source()) {
			$angle = -$angle;
			if ($this->source_type == IMAGETYPE_PNG && $background_color == -1) {
				if (!($target_identifier = imagerotate($this->source_identifier, $angle, -1))) {
					$background_color = imagecolorallocate($this->source_identifier, 255, 255, 255);
					$target_identifier = imagerotate($this->source_identifier, $angle, $background_color);
				}
			} elseif ($this->source_type == IMAGETYPE_GIF && $this->source_transparent_color_index >= 0) {
				$background_color = $this->_hex2rgb($background_color);
				$background_color = imagecolorallocate(
						$this->source_identifier,
						$background_color['r'],
						$background_color['g'],
						$background_color['b']
				);

				$this->source_identifier = imagerotate($this->source_identifier, $angle, $background_color);
				$width = imagesx($this->source_identifier);
				$height = imagesy($this->source_identifier);
				$target_identifier = $this->_prepare_image($width, $height, -1);
				imagecopyresampled($target_identifier, $this->source_identifier, 0, 0, 0, 0, $width, $height, $width, $height);
			} else {
				$background_color = $this->_hex2rgb($background_color);
				$background_color = imagecolorallocate(
						$this->source_identifier,
						$background_color['r'],
						$background_color['g'],
						$background_color['b']
				);
				$target_identifier = imagerotate($this->source_identifier, $angle, $background_color);
			}

			if ($use_existing_source) {
				$this->source_identifier = $target_identifier;
				$this->source_width = imagesx($target_identifier);
				$this->source_height = imagesy($target_identifier);
				return true;
			} else return $this->_write_image($target_identifier);
		}

		return false;
	}

	private function _create_from_source(){
		if (!function_exists('gd_info')) {
			$this->error = 7;
			return false;
		} elseif (!is_file($this->source_path)) {
			$this->error = 1;
			return false;
		} elseif (!is_readable($this->source_path)) {
			$this->error = 2;
			return false;
		} elseif ($this->target_path == $this->source_path && !is_writable($this->source_path)) {
			$this->error = 3;
			return false;
		} elseif (!list($this->source_width, $this->source_height, $this->source_type) = @getimagesize($this->source_path)) {
			$this->error = 4;
			return false;
		} else {
			$this->target_type = strtolower(substr($this->target_path, strrpos($this->target_path, '.') + 1));
			switch ($this->source_type) {
				case IMAGETYPE_GIF:
					$identifier = imagecreatefromgif($this->source_path);
					if (($this->source_transparent_color_index = imagecolortransparent($identifier)) >= 0)
						$this->source_transparent_color = @imagecolorsforindex($identifier, $this->source_transparent_color_index);
					break;
				case IMAGETYPE_JPEG:
					$identifier = @imagecreatefromjpeg($this->source_path);
					break;
				case IMAGETYPE_PNG:
					$identifier = @imagecreatefrompng($this->source_path);
					imagealphablending($identifier, false);
					break;
				default:
					$this->error = 4;
					return false;
			}
		}
		if ($this->preserve_time) $this->source_image_time = filemtime($this->source_path);
		$this->source_identifier = $identifier;
		if ($this->auto_handle_exif_orientation)
		if (!function_exists('exif_read_data')) {
			$this->error = 9;
			return false;
		} elseif (($exif = exif_read_data($this->source_path)) && isset($exif['Orientation']) && in_array($exif['Orientation'], array(3, 6, 8))) {
			switch ($exif['Orientation']) {
				case 3:
					$this->rotate(180, -1, false);
					break;
				case 6:
					$this->rotate(90, -1, false);
					break;
				case 8:
					$this->rotate(-90, -1, false);
					break;
			}
		}
		return true;
	}

	private function _flip($orientation){
		if ($this->_create_from_source()) {
			$target_identifier = $this->_prepare_image($this->source_width, $this->source_height, -1);
			switch ($orientation) {
				case 'horizontal':
					imagecopyresampled(
					$target_identifier,
					$this->source_identifier,
					0,
					0,
					($this->source_width - 1),
					0,
					$this->source_width,
					$this->source_height,
					-$this->source_width,
					$this->source_height
					);
					break;
				case 'vertical':
					imagecopyresampled(
					$target_identifier,
					$this->source_identifier,
					0,
					0,
					0,
					($this->source_height - 1),
					$this->source_width,
					$this->source_height,
					$this->source_width,
					-$this->source_height
					);
					break;
				case 'both':
					imagecopyresampled(
					$target_identifier,
					$this->source_identifier,
					0,
					0,
					($this->source_width - 1),
					($this->source_height - 1),
					$this->source_width,
					$this->source_height,
					-$this->source_width,
					-$this->source_height
					);
					break;
			}

			return $this->_write_image($target_identifier);
		}

		return false;
	}

	private function _hex2rgb($color, $default_on_error = '#FFFFFF'){
		if (preg_match('/^#?([a-f]|[0-9]){3}(([a-f]|[0-9]){3})?$/i', $color) == 0) $color = $default_on_error;
		$color = ltrim($color, '#');
		if (strlen($color) == 3) {
			$tmp = '';
			for ($i = 0; $i < 3; $i++) $tmp .= str_repeat($color[$i], 2);
			$color = $tmp;
		}
		$int = hexdec($color);

		return array(
				'r' =>  0xFF & ($int >> 0x10),
				'g' =>  0xFF & ($int >> 0x8),
				'b' =>  0xFF & $int
		);
	}

	private function _prepare_image($width, $height, $background_color = '#FFFFFF') {
		$identifier = imagecreatetruecolor((int)$width <= 0 ? 1 : (int)$width, (int)$height <= 0 ? 1 : (int)$height);
		if ($this->target_type == 'png' && $background_color == -1) {
			imagealphablending($identifier, false);
			$transparent_color = imagecolorallocatealpha($identifier, 0, 0, 0, 127);
			imagefill($identifier, 0, 0, $transparent_color);
			imagesavealpha($identifier, true);
		} elseif ($this->target_type == 'gif' && $background_color == -1 && $this->source_transparent_color_index >= 0) {
			$transparent_color = imagecolorallocate(
					$identifier,
					$this->source_transparent_color['red'],
					$this->source_transparent_color['green'],
					$this->source_transparent_color['blue']
			);
			imagefill($identifier, 0, 0, $transparent_color);
			imagecolortransparent($identifier, $transparent_color);
		} else {
			if ($background_color == -1) $background_color = '#FFFFFF';
			$background_color = $this->_hex2rgb($background_color);
			$background_color = imagecolorallocate($identifier, $background_color['r'], $background_color['g'], $background_color['b']);
			imagefill($identifier, 0, 0, $background_color);
		}

		return $identifier;
	}

	private function _sharpen_image($image){
		if ($this->sharpen_images && version_compare(PHP_VERSION, '5.1.0') >= 0) {
			$matrix = array(
					array(-1.2, -1, -1.2),
					array(-1, 20, -1),
					array(-1.2, -1, -1.2),
			);

			$divisor = array_sum(array_map('array_sum', $matrix));
			$offset = 0;
			imageconvolution($image, $matrix, $divisor, $offset);
		}

		return $image;
	}

	private function _write_image($identifier) {
		$this->_sharpen_image($identifier);
		switch ($this->target_type) {
			case 'gif':
				if (!function_exists('imagegif')) {
					$this->error = 6;
					return false;
				} elseif (@!imagegif($identifier, $this->target_path)) {
					$this->error = 3;
					return false;
				}
				break;
			case 'jpg':
			case 'jpeg':
				if (!function_exists('imagejpeg')) {
					$this->error = 6;
					return false;
				} elseif (@!imagejpeg($identifier, $this->target_path, $this->jpeg_quality)) {
					$this->error = 3;
					return false;
				}
				break;
			case 'png':
				imagesavealpha($identifier, true);
				if (!function_exists('imagepng')) {
					$this->error = 6;
					return false;
				} elseif (@!imagepng($identifier, $this->target_path, $this->png_compression)) {
					$this->error = 3;
					return false;
				}
				break;
			default:
				$this->error = 5;
				return false;
		}

		$disabled_functions = @ini_get('disable_functions');
		if ($disabled_functions == '' || strpos('chmod', $disabled_functions) === false) {
			chmod($this->target_path, intval($this->chmod_value, 8));
		} else $this->error = 8;

		if ($this->preserve_time && isset($this->source_image_time)) {
			@touch($this->target_path, $this->source_image_time);
		}

		return true;
	}

}