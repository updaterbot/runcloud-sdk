<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\CronJob;


trait ManagesCronJobs
{


	/**
	 * Create cron job
	 *
	 * @param int    $serverId
	 * @param array  $params
	 * @return CronJob
	 *
	 */
	public function createCronJob(int $serverId, array $data)
	{
		$job = $this->post("servers/{$serverId}/cronjobs", $data);
		return new CronJob($job, $this);
	}


	/**
	 * List cron joba
	 *
	 * @param  int $serverId
	 * @param  string $search
	 * @return CronJob[]
	 *
	 */
	public function cronJobs(int $serverId, string $search = '')
	{
		$data = $this->getAllData("servers/{$serverId}/cronjobs", ['search' => $search]);
		return $this->transformCollection($data, CronJob::class);
	}


	/**
	 * Get single Cron Job
	 *
	 * @param  int $serverId
	 * @param  int $jobId
	 * @return CronJob
	 *
	 */
	public function cronJob(int $serverId, int $jobId)
	{
		$job = $this->get("servers/{$serverId}/cronjobs/{$jobId}");
		return new CronJob($job, $this);
	}


	/**
	 * Delete Cron Job
	 *
	 * @param  int $serverId
	 * @param  int $jobId
	 * @return CronJob
	 *
	 */
	public function deleteCronJob(int $serverId, int $jobId)
	{
		$job = $this->delete("servers/{$serverId}/cronjobs/{$jobId}");
		return new CronJob($job, $this);
	}


	/**
	 * Rebuild Cron Jobs
	 *
	 * @param  int $serverId
	 * @return string
	 *
	 */
	public function rebuildCronJobs(int $serverId)
	{
		$response = $this->post("servers/{$serverId}/cronjobs/rebuild");
		return $response;
	}


}
