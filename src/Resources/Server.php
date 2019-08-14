<?php

namespace OnHover\RunCloud\Resources;


class Server extends Resource
{

	public $id;
	public $userId;
	public $serverId;
	public $serverName;
	public $ipAddress;
	public $serverProvider;
	public $connected;
	public $online;
	public $createdAt;
	public $createdAtHumanize;
	public $agentVersion;
	public $phpVersion;
	public $autoUpdate;

}
