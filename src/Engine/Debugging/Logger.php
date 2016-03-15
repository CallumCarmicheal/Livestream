<?php
	namespace Livestream\Engine\Debugging;
	
	
	// Why is this not following the namespace?
	class Logger {
	
		function LogCalls($filePrepend = "", $folderLocation = "GETME") {
			// Get current working directory
			if(\strcmp($folderLocation, "GETME") == 0)
				$folderLocation = getcwd(). "/debug.output/";
			
			$fileName = "";
			/* Generate File Location */ {
				// Check if directory exists
				if(!\file_exists($folderLocation))  {
					\mkdir($folderLocation, 0777);
					
					// Add our htAccess so no one can view the files
					$hta = '
						<Files ~ "\.bin$">
							Order Allow,Deny
							Deny from all
						</Files>
						
						<Files ~ "\.dbg$">
							Order Allow,Deny
							Deny from all
						</Files>';
					
					file_put_contents($folderLocation. ".htaccess", $hta);
				}
				
				// Append fileName to FolderLocation
				$fileName = $folderLocation. $filePrepend . ".";
			}
			
			/* Count files in Directory */ {
				$files = new \FilesystemIterator($folderLocation, \FilesystemIterator::SKIP_DOTS);
				$fileName .= \iterator_count($files);
			}
			
			$reqMethod = $_SERVER['REQUEST_METHOD'];
			/* Append The Request */ {
				$fileName .= ".". $reqMethod;
			}
			
			/* Append file extension */ {
				$fileName .= ".bin";
			}
			
			$fileBuffer = "";
			/* Generate File Contents */ {
				ob_start();
				
				echo "REQUEST TIME: "; {
					// Set default timezone -.-
					date_default_timezone_set("EUROPE/London");
					echo date("Y-m-d H:i:s\n\n");
				}
				
				echo "SERVER DATA: \n"; {
					print_r($_SERVER);
				}
				
				echo "REQUEST DATA: \n"; {
					if($reqMethod == "GET") 
						print_r($_GET);
					if ($reqMethod == "POST")
						print_r($_POST);
					if ($reqMethod == "REQUEST")
						print_r($_POST);
				}
				
				$fileBuffer = ob_get_clean();
			}
			
			/* Finally write to the File */ {
				if(!file_exists($fileName)) {
					$fp = fopen($fileName,"w");
					fwrite($fp, ""); fclose($fp);
				}
				
				file_put_contents($fileName, $fileBuffer);
			}
		}
		
		function LogCallsIF($condition, $filePrepend = "", $folderLocation = "GETME") {
			if($condition) {
				$this->LogCalls($filePrepend, $folderLocation);
			}
		}
		
		function LogText($folderLocation, $fileLocation, $isAppend, $msg, $appendDate = true) {
			/* Create the folder if it does not exist (ADD HTACCESS) */ {
				if(!\file_exists($folderLocation))
					\mkdir($folderLocation, 0777);
					
				// Add our htAccess so no one can view the files
				$hta = '<Files ~ "\.bin$">
							Order Allow,Deny
							Deny from all
						</Files>
						
						<Files ~ "\.dbg$">
							Order Allow,Deny
							Deny from all
						</Files>';
					
				file_put_contents($folderLocation. "/.htaccess", $hta);
			}
			
			$fileName = "";
			/* Generate file Name */ {
				$fileName = $folderLocation. "/". $fileLocation. ".dbg";
			}
			
			$fileData = "";
			/* Generate our Data for the File */ {
				if($appendDate) {
					date_default_timezone_set("EUROPE/London");
					$fileData .= date("[Y-m-d H:i:s] ");
				} 
				
				$fileData .= $msg;
			}
			
			/* Now write our data to the File */ {
				if(!file_exists($fileName)) {
					$fp = fopen($fileName,"w");
					fwrite($fp, $fileData); fclose($fp);
				} else {
					if($isAppend) {
						$tmpFileData = $fileData;
						$fileData = file_get_contents($fileName);
						$fileData .= "\n";
						$fileData .= $tmpFileData;
						file_put_contents($fileName, $fileData, FILE_APPEND);
					} else {
						file_put_contents($fileName, $fileData);
					}
				}
			}
		}
	}
?>