<?php

namespace OnHover\RunCloud\Resources;


class APIKey extends Resource
{

	public $id;
	public $label;
	public $username;
	public $secret;
	public $service;
	public $createdAt;


	public function delete()
	{
		return $this->runcloud->deleteAPIKey($this->id);
	}


}
