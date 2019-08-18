<?php

namespace OnHover\RunCloud\Resources;


class Git extends Resource
{

	public $id;
	public $provider;
	public $gitHost;
	public $gitUser;
	public $branch;
	public $repositoryData;
	public $atomic;
	public $atomicProjectId;
	public $autoDeploy;
	public $deployScript;
	public $createdAt;

}