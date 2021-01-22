<?php
interface iCookie
{
	static function get($name);
	static function set($name, $val, $time, $path = '/');
	static function clear($name, $path = '/');
	static function show();
}

class Cookie implements iCookie
{
	public $config;
	protected static $_obj;
	
    public static function instance()
	{
		if (! isset(self::$_obj)) {
			self::$_obj = new self();
		}
		return self::$_obj;
	}
	
	public function __construct()
	{
		return 0;
	}
	
	static function get($name)
	{
		if (isset($_COOKIE[$name])) {
			return $_COOKIE[$name];
		}
		return 0;
	}
	
	static function set($name, $val, $time, $path = '/')
	{
		if (null === $val) {
			self::clear($name);
		} else {
			self::clear($name);
			setcookie($name, $val, time() + $time, $path);
			return self::get($name);
		}
		return 0;
	}
	
	static function clear($name, $path = '/')
	{
		setcookie($name, '', time() - 42000, $path);
	}
	
	public static function show()
	{
	    Fnc::show_r($_COOKIE,"&#36;_COOKIE");
	}
}

?>
