# Livestream
A php backend for nginx rtmp module.

# Notice
This project is currently being rewritten from scratch to be used as a library. 
[if you are looking for a the old version, please click here](https://github.com/CallumCarmicheal/Livestream/tree/487cf9b876d7a4e9087ab30246a9dd87fd1a50fe)

# Example configuration
```
rtmp {
	server {
		# Rtmp Listen Port
		listen 1935;
		
		# Application, this defines the specific streaming settings for each type
		#   This means you can have a branch that will save and record live streams and 
		#   a branch for single one off live streams for low latency etc.
		#
		# In obs this is the url like: rtmp://ip_or_url/live
		#   rtmp://localhost/live
		#
		application live {
			# Allow anyone to publish/watch a stream (this can be used to
			#   limit the viewers to a subnet, ip. If you plan on doing this
			#   in code it might be more beneficial to set this option instead
			#   as it will increase performance and decrease load).
		
			# Allow anyone to publish a stream
			allow publish all;
			
			# Allow anyone to play / watch a stream
			allow play all;
			
			# Enable Live streaming
			live on;
			
			# https://github.com/arut/nginx-rtmp-module/wiki/Directives#meta
			meta copy; 
			
			# We want to attach our events, if you don't want to subscribe to an event just
			#   comment it out with a hash-tag (#). 
			on_publish 			http://localhost/app/RtmpEndpoint.php;
			on_publish_done 	http://localhost/app/RtmpEndpoint.php;
			on_done 			http://localhost/app/RtmpEndpoint.php;
			on_play 			http://localhost/app/RtmpEndpoint.php;
			on_play_done 		http://localhost/app/RtmpEndpoint.php;
			on_update 			http://localhost/app/RtmpEndpoint.php;
			
			# Send the on_update event every 10 seconds, this as of right now 
			# might be the only way to cut a stream midway as i am currently 
			# looking into it.
			notify_update_timeout 10s;
			
			# Send all information as a get request
			notify_method get;
			
			#
			# See more advanced options at https://github.com/arut/nginx-rtmp-module/wiki/Directives
			#
		}
	}
}```

# Setup and Development
...

# Security
...