<?php

use Foinikas\Gravatar\Gravatar;

class GravatarTest extends PHPUnit_Framework_TestCase {

	protected $gravatar;

	protected $valid_email = 'my@email.com';

	protected $invalid_email = 'myemail.com';

	public function setup()
	{
		$this->gravatar = new Gravatar();
	}

	public function test_it_validates_invalid_emails()
	{
		$email = $this->invalid_email;

		try
		{
			$image = $this->gravatar->url($this->invalid_email);
		}
		catch (Exception $e)
		{
			$this->assertEquals("Gravatar failure: {$email} is not a valid email address", $e->getMessage());			
		}
	}

	public function test_it_works_for_valid_emails()
	{
		$email = $this->valid_email;

		$image = $this->gravatar->image($email);
		
		$this->assertContains($this->gravatar->hash($email), $image);
	}

	public function test_attributes_parse()
	{
		$email = $this->valid_email;

		$image = $this->gravatar->image($email, ['id' => 'faki', 'class' => 'myClass']);
		
		$this->assertContains("id='faki'", $image);

		$this->assertContains("class='myClass'", $image);
	}

	public function test_default_url_output()
	{
		$email = $this->valid_email;

		$url = $this->gravatar->url($email);

		$this->assertEquals('http://www.gravatar.com/avatar/4f384e9f3e8e625aae72b52658323d70?s=50&d=&r=g', $url);
	}

	public function test_default_image_output()
	{
		$email = $this->valid_email;

		$image = $this->gravatar->image($email);

		$this->assertEquals('<img src="http://www.gravatar.com/avatar/4f384e9f3e8e625aae72b52658323d70?s=50&d=&r=g"/>', $image);
	}

	public function test_default_hash_output()
	{
		$email = $this->valid_email;

		$hash = $this->gravatar->hash($email);

		$this->assertEquals(md5(strtolower(trim($email))), $hash);
	}

	public function test_secure_url_output()
	{
		$email = $this->valid_email;

		$url = $this->gravatar->url($email, 100, 'wavatar', 'r', true);

		$this->assertEquals('https://www.gravatar.com/avatar/4f384e9f3e8e625aae72b52658323d70?s=100&d=wavatar&r=r', $url);
	}
}