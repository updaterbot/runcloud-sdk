<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\User;


trait ManagesUsers
{


	/**
	 * Create a new system user.
	 *
	 * @param  int $serverId
	 * @param  string $username
	 * @param  string $password
	 * @return User
	 *
	 */
	public function createUser(int $serverId, string $username, string $password = '')
	{
		$data = compact('username', 'password');
		$data = array_filter($data, 'strlen');

		$user = $this->post("servers/{$serverId}/users", $data);

		return new User($user, $this);
	}


	/**
	 * Get the collection of users.
	 *
	 * @param int $serverId
	 * @return User[]
	 *
	 */
	public function users(int $serverId, string $search = '')
	{
		$query = ['search' => $search];
		$query = array_filter($query, 'strlen');

		$response = $this->getAllData("servers/{$serverId}/users", $query);
		return $this->transformCollection($response, User::class);
	}


	/**
	 * Set user password.
	 *
	 * @param  int $serverId
	 * @param  int $userId
	 * @param  string $password
	 * @return User
	 *
	 */
	public function setUserPassword(int $serverId, int $userId, string $password)
	{
		$user = $this->patch("servers/{$serverId}/users/{$userId}/password", [
			'password' => $password
		]);

		return new User($user, $this);
	}


	/**
	 * Generate Git Deployment Key.
	 *
	 * @param  int $serverId
	 * @param  int $userId
	 * @return User
	 *
	 */
	public function generateGitDeploymentKey(int $serverId, int $userId)
	{
		$user = $this->patch("servers/{$serverId}/users/{$userId}/deploymentkey");

		return new User($user, $this);
	}


	/**
	 * Delete system user.
	 *
	 * @param  int $serverId
	 * @param  int $userId
	 * @return User
	 *
	 */
	public function deleteUser(int $serverId, int $userId)
	{
		$user = $this->delete("servers/{$serverId}/users/{$userId}");

		return new User($user, $this);
	}


}
