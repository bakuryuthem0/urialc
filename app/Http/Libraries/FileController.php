<?php
	namespace Libraries;
	use Illuminate\Filesystem\Filesystem as File;
	use Intervention\Image\Facades\Image as Intervention;
	Class FileController
	{
		function __construct() {

		}
		public static function optimize($ruta, $miImg, $width, $height)
		{

			$img = Intervention::make($ruta.$miImg);
			if ($img->width() > $img->height()) {
				if ($img->width() > $width) {
					$img->widen($width);		
				}	
			}else
			{
				if ($img->height() > $height) {
					$img->heighten($height);
				}
			}
			$img->interlace();
			$img->save($ruta.$miImg);
		}
		public static function upload_image($file, $filename, $path, $type, $width, $height)
		{
			$sys = new File;
			$ruta 	 = $path;
			$extension = $sys->extension($filename);
			$time = time();
			$miImg = $time.'.'.$extension;
			while (file_exists($ruta.$miImg)) {
				$time = time();
				$miImg = $time.'.'.$extension;
			}
	        $file->move($ruta,$miImg);
	        if ($type == "image") {
	        	FileController::optimize($ruta, $miImg, $width, $height);
	        }
	        return $miImg;
		}
		public static function calcSize($bytes)
		{
		    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

		    for ($i = 0; $bytes > 1024; $i++) {
		        $bytes /= 1024;
		    }

		    return round($bytes, 2) . ' ' . $units[$i];
		}
	}