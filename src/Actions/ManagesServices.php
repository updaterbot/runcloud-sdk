<?php

namespace OnHover\RunCloud\Actions;


trait ManagesServices
{


	/**
	 * List binaries
	 *
	 * @param int    $serverId
	 * @return []
	 *
	 */
	public function services(int $serverId)
	{
		$response = $this->get("servers/{$serverId}/services");
		return $response;
	}


	/**
	 * Service systemctl command
	 *
	 * @param int    $serverId
	 * @param string $action
	 * @param string $realName
	 * @return []
	 *
	 */
	public function serviceCommand(int $serverId, string $action, string $realName)
	{
		$data = compact('action', 'realName');
		$response = $this->patch("servers/{$serverId}/services", $data);
		return $response;
	}


	/**
	 * Start a service
	 *
	 * @param  int    $serverId
	 * @param  string $name
	 * @return []
	 *
	 */
	public function startService(int $serverId, string $name)
	{
		return $this->serviceCommand($serverId, 'start', $name);
	}

	/**
	 * Stop a service
	 *
	 * @param  int    $serverId
	 * @param  string $name
	 * @return []
	 *
	 */
	public function stopService(int $serverId, string $name)
	{
		return $this->serviceCommand($serverId, 'stop', $name);
	}


	/**
	 * Restart a service
	 *
	 * @param  int    $serverId
	 * @param  string $name
	 * @return []
	 *
	 */
	public function restartService(int $serverId, string $name)
	{
		return $this->serviceCommand($serverId, 'restart', $name);
	}


	/**
	 * Reload a service
	 *
	 * @param  int    $serverId
	 * @param  string $name
	 * @return []
	 *
	 */
	public function reloadService(int $serverId, string $name)
	{
		return $this->serviceCommand($serverId, 'reload', $name);
	}


}
