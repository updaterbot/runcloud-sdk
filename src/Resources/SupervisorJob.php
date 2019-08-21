<?php

namespace OnHover\RunCloud\Resources;


class SupervisorJob extends Resource
{

	public $id;
	public $label;
	public $username;
	public $numprocs;
	public $autoStart;
	public $autoRestart;
	public $directory;
	public $command;
	public $createdAt;

}
