<?php namespace Foinikas\Gravatar;

use URL;
use Exception;

class Gravatar {
	
	/**
	 * Gravatar Base Url
	 * 
	 * @var string
	 */
	protected $url = 'http://www.gravatar.com/avatar/';

	/**
	 * Gravatar Secure Base Url
	 * 
	 * @var string
	 */
	protected $secureUrl = 'https://www.gravatar.com/avatar/';

	/**
	 * Gravatar's Default images options
	 * @var array
	 */
	protected $defaults = ['404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'];

	/**
	 * Create a gravatar url
	 * 
	 * @param  string  $email  User's email address
	 * @param  integer $s      Gravatar size
	 * @param  string  $d      Gravatar default option
	 * @param  string  $r      Gravatar rating
	 * @param  bool    $secure Select secure or not gravatar image url
	 * @return string          Gravatar image url
	 */
	public function url($email, $size = 50, $default = null, $r = 'g', $secure = false)
	{
		return "{$this->callUrl($secure)}{$this->hash($email)}?s={$size}&d={$this->filterDefaults($default)}&r={$r}";
	}
	/**
	 * Create a gravatar image
	 * 
	 * @param  string  $email  User's email address
	 * @param  array   $attrs  Attributes for the gravatar image
	 * @param  integer $s      Gravatar size
	 * @param  string  $d      Gravatar default option
	 * @param  string  $r      Gravatar rating
	 * @param  bool    $secure Select secure or not gravatar image url
	 * @return string          Gravatar image
	 */
	public function image($email, array $attrs = null, $size = 50, $default = null, $r = 'g', $secure = false)
	{
		return $this->passAttrs($this->url($email, $size, $default, $r, $secure), $attrs);
	}

	/**
	 * Create the right Gravatar's base url
	 * 
	 * @param  bool $secure Secure base url selection
	 * @return string       Gravatar's base url
	 */
	protected function callUrl($secure)
	{
		return $secure ? $this->secureUrl : $this->url;
	}

	/**
	 * Create an image tag
	 * 
	 * @param  string $url   Image's url
	 * @param  array $attrs Image's attributes
	 * @return string        Image element
	 */
	protected function passAttrs($url, $attrs)
	{
		$parsed = $attrs ? $this->fixAttrs($attrs) : '';

		return '<img src="'.$url.'"'.$parsed.'/>';
	}

	/**
	 * Parse array with attributes
	 * 
	 * @param  array  $attrs Image's attributes
	 * @return string Image's attributes string
	 */
	protected function fixAttrs(array $attrs)
	{
		$parsed = '';

		foreach ( $attrs as $key => $value )
		{
			$parsed .= " {$key}='{$value}'";
		}

		return $parsed;
	}

	/**
	 * Hash user's email for before gravatar request
	 * 
	 * @param  string $email User's email
	 * @return string        Hashed user's email
	 */
	protected function hash($email)
	{
		return md5(strtolower(trim($this->filterEmail($email))));
	}

	/**
	 * Check if user's email is valid
	 * 
	 * @param  string $email User's email
	 * @return string        User's email
	 */
	protected function filterEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
		{
			throw new Exception("Gravatar failure: {$email} is not a valid email address");
		}

		return $email;
	}

	/**
	 * Return a full path image if default option is not in Gravatar's default image options
	 * 
	 * @param  string $default Default image
	 * @return string          Default image
	 */
	protected function filterDefaults($default)
	{
		if (in_array($default, $this->defaults) or is_null($default))
		{
			return $default;
		}

		return URL::asset($default);
	}

	protected function filterImages($image)
	{
		$parts = pathinfo($image);

		$ext = $parts['extension'];

		if ( ! is_null($ext) or in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
		{
			return $image;			
		}

		throw new Exception("Gravatar failure: {$image} is not a valid image");
	}
}