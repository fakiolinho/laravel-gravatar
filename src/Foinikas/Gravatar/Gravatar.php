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
	protected $defaults = ['404', 'mm', 'identicon', 'monsterrid', 'wavatar', 'retro', 'blank'];

	/**
	 * Create a gravatar url
	 * 
	 * @param  string  $email  User's email address
	 * @param  array   $attrs  Attributes for the gravatar img
	 * @param  integer $s      Gravatar size
	 * @param  string  $d      Gravatar default option
	 * @param  string  $r      Gravatar rating
	 * @param  bool    $secure Select secure or not gravatar image
	 * @return string          Gravatar image url
	 */
	public function make($email, $attrs = [], $size = 50, $default = 'mm', $r = 'g', $secure = false)
	{
		return $this->gravatarize("{$this->callUrl($secure)}{$this->hash($email)}?s={$size}&d={$this->filter($default)}", $attrs);
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
	protected function gravatarize($url, array $attrs)
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
		return md5( strtolower( trim( $this->check($email) ) ) );
	}

	/**
	 * Check if user's email is valid
	 * 
	 * @param  string $email User's email
	 * @return string        User's email
	 */
	protected function check($email)
	{
		if( filter_var($email, FILTER_VALIDATE_EMAIL) === false )
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
	public function filter($default)
	{
		if ( ! in_array($default, $this->defaults) )
		{
			return URL::asset($default);
		}

		return $default;
	}
}