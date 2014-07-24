<?php

use Foinikas\Gravatar\Gravatar;

class GravatarTest extends PHPUnit_Framework_TestCase {

	protected $gravatar;

	public function setup()
	{
		$this->gravatar = new Gravatar();
	}

	public function test_it_validates_invalid_emails()
	{
		$email = 'myemail.com';

		try
		{
			$image = $this->gravatar->make($email);
		}
		catch (Exception $e)
		{
			$message = $e->getMessage();

			$this->assertEquals("Gravatar failure: {$email} is not a valid email address", $e->getMessage());			
		}
	}

	public function test_it_works_for_valid_emails()
	{
		$email = 'my@email.com';

		$image = $this->gravatar->make($email);
		
		$this->assertContains($this->hash($email), $image);
	}

	public function test_attributes_parse()
	{
		$email = 'my@email.com';

		$image = $this->gravatar->make($email, ['id' => 'faki', 'class' => 'myClass']);
		
		$this->assertContains("id='faki'", $image);
		$this->assertContains("class='myClass'", $image);
	}

	public function test_default_output()
	{
		$email = 'my@email.com';

		$image = $this->gravatar->make($email);

		$this->assertEquals('<img src="http://www.gravatar.com/avatar/4f384e9f3e8e625aae72b52658323d70?s=50&d=mm"/>', $image);
	}

	protected function hash($email)
	{
		return md5(strtolower(trim($email)));
	}

}