<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\FirewallRule;


trait ManagesSecurity
{


	/**
	 * Create a new Firewall Rule
	 *
	 * @param int    $serverId
	 * @param array $data
	 * @return FirewallRule
	 *
	 */
	public function createFirewallRule(int $serverId, array $data)
	{
		$rule = $this->post("servers/{$serverId}/security/firewalls", $data);
		return new FirewallRule($rule, $this);
	}


	/**
	 * List Firewall Rules
	 *
	 * @param int    $serverId
	 * @return FirewallRule[]
	 *
	 */
	public function firewallRules(int $serverId)
	{
		$data = $this->getAllData("servers/{$serverId}/security/firewalls");
		return $this->transformCollection($data, FirewallRule::class);
	}


	/**
	 * Get Firewall Rule
	 *
	 * @param int    $serverId
	 * @param int    $ruleId
	 * @return FirewallRule
	 *
	 */
	public function firewallRule(int $serverId, int $ruleId)
	{
		$rule = $this->get("servers/{$serverId}/security/firewalls/{$ruleId}");
		return new FirewallRule($rule);
	}


	/**
	 * Delete Firewall Rule
	 *
	 * @param int    $serverId
	 * @param int    $ruleId
	 * @return FirewallRule
	 *
	 */
	public function deleteFirewallRule(int $serverId, int $ruleId)
	{
		$rule = $this->delete("servers/{$serverId}/security/firewalls/{$ruleId}");
		return new FirewallRule($rule);
	}


	/**
	 * Deploy firewall rules to server
	 *
	 * @param  int    $serverId
	 * @return string
	 *
	 */
	public function deployFirewall(int $serverId)
	{
		$response = $this->put("servers/{$serverId}/security/firewalls");
		return $response;
	}


	/**
	 * List blocked IP addresses
	 *
	 * @param int    $serverId
	 * @return []
	 *
	 */
	public function blockedIPs(int $serverId)
	{
		$response = $this->get("servers/{$serverId}/security/fail2ban/blockedip");
		return $response;
	}


	/**
	 * Delete blocked IP address
	 *
	 * @param int    $serverId
	 * @return []
	 *
	 */
	public function deleteBlockedIP(int $serverId, string $ip)
	{
		$data = compact('ip');
		$response = $this->delete("servers/{$serverId}/security/fail2ban/blockedip", $data);
		return $response;
	}


}
