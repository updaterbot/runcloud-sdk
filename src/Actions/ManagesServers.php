<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\Server;
use OnHover\RunCloud\Resources\ServerUser;
use OnHover\RunCloud\Resources\Service;


trait ManagesServers
{


	/**
	 * Create a new server.
	 *
	 * @param  array $data
	 * @param  string $redirect (return redirect for activation)
	 * @return Server
	 *
	 */
	public function createServer(string $name, string $ipAddress, string $provider = '')
	{
		$data = compact('name', 'ipAddress', 'provider');
		$data = array_filter($data, 'strlen');

		$server = $this->post('servers', $data);

		return new Server($server, $this);
	}


	/**
	 * Get the collection of servers.
	 *
	 * @return Server[]
	 *
	 */
	public function servers(string $search = '')
	{
		$query = ['search' => $search];
		$query = array_filter($query, 'strlen');

		$response = $this->getAllData('servers', $query);
		return $this->transformCollection($response, Server::class);
	}


	/**
	 * Get the collection of shared servers.
	 *
	 * @return Server[]
	 *
	 */
	public function sharedServers(string $search = '')
	{
		$query = ['search' => $search];
		$query = array_filter($query, 'strlen');

		$response = $this->getAllData('servers/shared', $query);
		return $this->transformCollection($response, Server::class);
	}


	/**
	 * Get a server instance.
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function server(int $serverId)
	{
		$response = $this->get("servers/$serverId");
		return new Server($response, $this);
	}


	/**
	 * Get a server installation script.
	 *
	 * @param  int $serverId
	 * @return string
	 *
	 */
	public function installationScript(int $serverId)
	{
		return $this->get("servers/$serverId/installationscript")['script'];
	}


	/**
	 * Get server stats.
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function serverStats(int $serverId)
	{
		return $this->get("servers/$serverId/stats");
	}


	/**
	 * Get server hardware info.
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function serverHardware(int $serverId)
	{
		return $this->get("servers/$serverId/hardwareinfo");
	}


	/**
	 * Get server PHP versions
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function serverPHPVersions(int $serverId)
	{
		return $this->get("servers/$serverId/php/version");
	}


	/**
	 * Change PHP CLI version
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function changeServerPHPVersion(int $serverId, string $phpVersion)
	{
		$data = compact('phpVersion');
		$response = $this->patch("servers/$serverId/php/cli", $data);
		return new Server($response, $this);
	}


	/**
	 * Update metadata
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function updateServerMetadata(int $serverId, string $name, string $provider = '')
	{
		$data = compact('name', 'provider');
		$response = $this->patch("servers/$serverId/settings/meta", $data);
		return new Server($response, $this);
	}


	/**
	 * Get server SSH config
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function serverSSHConfiguration(int $serverId)
	{
		return $this->get("servers/$serverId/settings/ssh");
	}


	/**
	 * Update server SSH config
	 *
	 * @param  int $serverId
	 * @param  array $data
	 * @return Server
	 *
	 */
	public function updateServerSSHConfiguration(int $serverId, array $data = [])
	{
		return $this->patch("servers/$serverId/settings/ssh", $data);
	}


	/**
	 * Update server autoupdate settings
	 *
	 * @param  int $serverId
	 * @param  array $data
	 * @return Server
	 *
	 */
	public function updateServerAutoupdate(int $serverId, array $data = [])
	{
		return $this->patch("servers/$serverId/settings/autoupdate", $data);
	}


	/**
	 * Delete server
	 *
	 * @param  int $serverId
	 * @return Server
	 *
	 */
	public function deleteServer(int $serverId)
	{
		return $this->delete("servers/$serverId");
	}


	/**
	 * Get latest health
	 *
	 * @param  int $serverId
	 * @return []
	 *
	 */
	public function serverHealth(int $serverId)
	{
		return $this->get("servers/$serverId/health/latest");
	}


	/**
	 * Disk cleanup
	 *
	 * @param  int $serverId
	 * @return bool
	 *
	 */
	public function serverDiskCleanup(int $serverId)
	{
		return ($this->post("servers/$serverId/health/diskcleaner") == '');
	}


}
