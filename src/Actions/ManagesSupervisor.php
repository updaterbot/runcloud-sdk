<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\SupervisorJob;


trait ManagesSupervisor
{


	/**
	 * List binaries
	 *
	 * @param int    $serverId
	 * @return []
	 *
	 */
	public function supervisorBinaries(int $serverId)
	{
		$binaries = $this->get("servers/{$serverId}/supervisors/binaries");
		return $binaries;
	}


	/**
	 * Create new Supervisor job
	 *
	 * @param int  $serverId
	 * @param array  $data
	 * @return SupervisorJob
	 *
	 */
	public function createSupervisorJob(int $serverId, array $data)
	{
		$job = $this->post("servers/{$serverId}/supervisors", $data);
		return new SupervisorJob($job, $this);
	}


	/**
	 * List all jobs
	 *
	 * @param int    $serverId
	 * @param array  $params
	 * @return SupervisorJob[]
	 *
	 */
	public function supervisorJobs(int $serverId, string $search = '')
	{
		$data = $this->getAllData("servers/{$serverId}/supervisors", ['search' => $search]);
		return $this->transformCollection($data, SupervisorJob::class);
	}


	/**
	 * Get one job
	 *
	 * @param int  $serverId
	 * @param int  $jobId
	 * @return SupervisorJob
	 *
	 */
	public function supervisorJob(int $serverId, int $jobId)
	{
		$job = $this->get("servers/{$serverId}/supervisors/{$jobId}");
		return new SupervisorJob($job, $this);
	}


	/**
	 * Get job status
	 *
	 * @param int  $serverId
	 * @return []
	 *
	 */
	public function supervisorStatus(int $serverId)
	{
		$response = $this->get("servers/{$serverId}/supervisors/status");
		return $response;
	}


	/**
	 * Rebuild jobs
	 *
	 * @param int  $serverId
	 * @return string
	 *
	 */
	public function rebuildSupervisorJobs(int $serverId)
	{
		$response = $this->post("servers/{$serverId}/supervisors/rebuild");
		return $response;
	}


	/**
	 * Reload job
	 *
	 * @param int  $serverId
	 * @return SupervisorJob
	 *
	 */
	public function reloadSupervisorJob(int $serverId, int $jobId)
	{
		$job = $this->post("servers/{$serverId}/supervisors/{$jobId}/reload");
		return new SupervisorJob($job, $this);
	}


	/**
	 * Delete job
	 *
	 * @param int  $serverId
	 * @param int  $jobId
	 * @return SupervisorJob
	 *
	 */
	public function deleteSupervisorJob(int $serverId, int $jobId)
	{
		$job = $this->delete("servers/{$serverId}/supervisors/{$jobId}");
		return new SupervisorJob($job, $this);
	}


}
