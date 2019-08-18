<?php

namespace OnHover\RunCloud\Resources;


class SSL extends Resource
{

	public $id;
	public $method;
	public $privateKey;
	public $certificate;
	public $validUntil;
	public $renewalDate;
	public $enableHttp;
	public $enableHsts;
	public $authorizationMethod;
	public $staging;
	public $apiId;
	public $createdAt;

}