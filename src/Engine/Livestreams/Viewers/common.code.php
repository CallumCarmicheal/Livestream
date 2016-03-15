<?php
	if(!function_exists("countUsers")) {
        function countUsers($addUser, $file = "onlineUsers.bin") {
            // Count users
            $timeout = 10; // Seconds
            $time = time();
            $ip = $_SERVER["REMOTE_ADDR"];
            $arr = file($file);
            $onlineUsers = 0; 
            $username = "NO USER";
            if($addUser) {
                for ($i = 0; $i < count($arr); $i++){
                    if ($time - intval(substr($arr[$i], strpos($arr[$i], "    ") + 4)) > $timeout){
                        unset($arr[$i]);
                        $arr = array_values($arr);
                        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
                    } $onlineUsers++;
                } for ($i = 0; $i < count($arr); $i++){
                    if (substr($arr[$i
                        ], 0, strlen($ip)) == $ip){
                        $arr[$i] = substr($arr[$i], 0, strlen($ip))."    ".$time."\n";
                        $arr = array_values($arr);
                        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
                        return $onlineUsers;
                    }
                } file_put_contents($file, $ip."    ".$time."\n", FILE_APPEND);
            } else {
                $onlineUsers = count($arr);
            }
			
            return $onlineUsers;
        }

        // Where is this saved to ?
        //countUsers(true);
    }

?>