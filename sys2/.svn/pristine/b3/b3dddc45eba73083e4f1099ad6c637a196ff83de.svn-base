<?php
/**
 * Cache class
 *
 * @author   Avenger <avenger@php.net>
 * @version  1.0
 * @update   2003-04-29 12:12:37
 
 */
#example:
  
# run this scrpt,at the currerent dir,u will see a new folder names' "cache1"  
# in the "cache1" folder will have a file.the file's contents will be:  
#  
# This is a Cache test line 1 ...  
# This is a Cache test line 2 ...  
# This is a Cache test line 3 ...  
#  
# And if u wanta del all cache file,u will use:  
# $c->flush();  
#  
# It's very easily to use,isn't it? :)  
# If u find a bug plz report to me: avenger@php.net  
# Read and learn!!  :)  
# */ 
#  
# require_once 'cache.inc.php';  
#  
# // Create Object  
# $c = new cache('cache1/',120); // The cache path and cache time  
#  
# // Start,All the word between the start functon and the end function will be cached  
# $c->start();  
#  
# echo "This is a Cache test line 1 ...\n";  
# echo "This is a Cache test line 2 ...\n";  
# echo "This is a Cache test line 3 ...\n";  
#  
# // End and output  
# $c->end(); 


class cache {

	/**
     * url wanta cached
     *
     * @var string
     */
	var $cached_file;

	/**
     * path to the cache save
     *
     * @var string
     */
	var $cached_path;

	/**
     * cached limit time
     *
     * @var string
     */
	var $cached_time;

	/**
     * expire time
     *
     * @var string
     */
	var $cached_modtime;

	/**
     * Construct function
     *
     * @access public
     * @param string $path Cached path
     * @param int $time Cached time
     * @return void
     */
	function cache($path='cache/',$time=120) {
		global $HTTP_SERVER_VARS;
		$query_str = preg_replace('/(&submit\.[x|y]=[0-9]+)+$/','',$HTTP_SERVER_VARS['REQUEST_URI']);
		$this->cached_file = md5($query_str).'.cache';
		$this->cached_path = $path;
		$this->cached_time = $time * 3600;
		if (is_dir($this->cached_path)===false) {
			mkdir($this->cached_path,0777);
		}
		if (file_exists($this->cached_path.$this->cached_file)) {
			$this->cached_modtime = date(time()-filemtime($this->cached_path.$this->cached_file));
		}
	}

	/**
     * Start the cache
     *
     * @access public
     */
	function start() {
		global $HTTP_GET_VARS;
		if ( ($HTTP_GET_VARS['update']!="") || (!file_exists($this->cached_path.$this->cached_file)) || ($this->chched_modtime > $this->cached_time) ) {
			ob_start();
		} else {
			readfile($this->cached_path.$this->cached_file);
			exit();
		}
	}

	/**
     * End the cache
     *
     * @access public
     */
	function end() {
		global $HTTP_GET_VARS;
		if ( ($HTTP_GET_VARS['update']!="") || (!file_exists($this->cached_path.$this->cached_file)) || ($this->chched_modtime > $this->cached_time) ) {
			$contents = ob_get_contents();
			ob_end_clean();
			$HTTP_GET_VARS['update']!="" ? chmod($this->cached_path.$this->cached_file,0777) : '';
			$fp = fopen($this->cached_path.$this->cached_file,'w');
			fputs($fp,$contents);
			fclose($fp);
			echo $contents;
		}
	}

	/**
     * Flush all cache
     *
     * @access public
     */
	function flush() {
		if (function_exists('exec')) {
			if (strpos(strtoupper(PHP_OS),'WIN') !== false) {
				$cmd = 'del /s '.str_replace('/','\\',$this->cached_path).'*.cache';
			} else {
				$cmd = 'rm -rf '.$ADODB_CACHE_DIR.'/*.cache';
			}
			exec($cmd);
		} else {
			$d = dir($this->cached_path);
			while ($entry = $d->read()) {
				$modtime = date(time()-filemtime($this->cached_path.$entry));
				// if (($entry != ".") && ($entry != "..") && ($modtime > $this->cached_time)) {
				if (($entry != ".") && ($entry != "..")) {
					chmod($this->cached_path.$entry,0777);
					unlink($this->cached_path.$entry);
				}
			}
			$d->close();
		}
		return;
	}

} //End Class
?>