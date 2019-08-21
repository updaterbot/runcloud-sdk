<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\SSHKey;


trait ManagesSSHKeys
{


	/**
	 * Add SSH Key for a user.
	 *
	 * @param int    $serverId
	 * @param string $label
	 * @param string $username
	 * @param string $publicKey
	 * @return SSHKey
	 *
	 */
	public function addSSHKey(int $serverId, string $label, string $username, string $publicKey)
	{
		$data = compact('label', 'username', 'publicKey');
		$sshKey = $this->post("servers/{$serverId}/sshcredentials", $data);
		return new SSHKey($sshKey, $this);
	}


	/**
	 * List all SSH Keys
	 *
	 * @param  int $serverId
	 * @param  string $search
	 * @return SSHKey[]
	 *
	 */
	public function SSHKeys(int $serverId, string $search = '')
	{
		$data = $this->getAllData("servers/{$serverId}/sshcredentials", ['search' => $search]);
		return $this->transformCollection($data, SSHKey::class);
	}


	/**
	 * Get single SSH Key
	 *
	 * @param  int $serverId
	 * @param  int $sshKeyId
	 * @return SSHKey
	 *
	 */
	public function SSHKey(int $serverId, int $sshKeyId)
	{
		$sshKey = $this->get("servers/{$serverId}/sshcredentials/{$sshKeyId}");
		return new SSHKey($sshKey, $this);
	}


	/**
	 * Delete SSH Key
	 *
	 * @param  int $serverId
	 * @param  int $sshKeyId
	 * @return SSHKey
	 *
	 */
	public function deleteSSHKey(int $serverId, int $sshKeyId)
	{
		$sshKey = $this->delete("servers/{$serverId}/sshcredentials/{$sshKeyId}");
		return new SSHKey($sshKey, $this);
	}


}
