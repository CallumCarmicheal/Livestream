<?php
/**
 * Created by PhpStorm.
 * User: callu
 * Date: 05/03/2019
 * Time: 23:29
 */

/**
 * Recursively require's files in a directory
 * @param $dir string
 * @param int $depth int
 */
function _require_all($dir, $depth=0) {
	// Check if the folder depth is more than 50
	// if so then just return.
	//
	// CHANGE THIS FOR A BIGGER DEPTH
	if ($depth > 50)
		return;

	// require all php files
	$scan = glob("$dir/*");
	foreach ($scan as $path) {
		if (preg_match('/\.php$/', $path)) {
//			echo "Included $path <br>";
			require_once $path;
		} else if (is_dir($path)) {
			_require_all($path, $depth+1);
		}
	}
}

_require_all(__DIR__. "/../library");