<?php

namespace OnHover\RunCloud\Resources;


class FirewallRule extends Resource
{

	public $id;
	public $type;
	public $port;
	public $protocol;
	public $ipAddress;
	public $firewallAction;
	public $createdAt;

}
