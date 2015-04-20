<?php

class User 
{
	private $firstName;
	private $lastName;
	private $id;
	private $link;
	private $name;
	
	public function User()
	{
		
	}
	
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	
	public function getFirstName()
	{
		return $this->firstName;
	}
	
	public function setLastName($lastName)
	{
		$this->lastName = $firstName;
	}
	
	public function getLastName()
	{
		return $this->lastName;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getId()
	{
		return $id->id;
	}
	
	public function setLink($link)
	{
		$this->link = $link;
	}
	
	public function getLink()
	{
		return $id->link;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $id->name;
	}	
	
}

?>