<?php

namespace OnHover\RunCloud;

use GuzzleHttp\Client as HttpClient;


class RunCloud
{


	use MakesHttpRequests,
		Actions\ManagesServers,
		Actions\ManagesUsers,
		Actions\ManagesWebApps,
		Actions\ManagesDatabases,
		Actions\ManagesAPIKeys,
		Actions\ManagesSSHKeys,
		Actions\ManagesCronJobs,
		Actions\ManagesSupervisor,
		Actions\ManagesServices,
		Actions\ManagesSecurity,
		Actions\ManagesStaticData;


	/**
	 * The Runcloud API Key.
	 *
	 * @var string
	 *
	 */
	public $apiKey;


	 /**
	 * The Runcloud API Secret.
	 *
	 * @var string
	 *
	 */
	public $apiSecret;

	/**
	 * The Guzzle HTTP Client instance.
	 *
	 * @var \GuzzleHttp\Client
	 *
	 */
	public $guzzle;

	/**
	 * Number of seconds a request is retried.
	 *
	 * @var int
	 *
	 */
	public $timeout = 30;


	/**
	 * Create a new RunCloud instance.
	 *
	 * @param  string $apiKey
	 * @param  string $apiSecret
	 * @param  \GuzzleHttp\Client $guzzle
	 * @return void
	 *
	 */
	public function __construct(string $apiKey, string $apiSecret, HttpClient $guzzle = null)
	{
		$this->apiKey = $apiKey;

		$this->apiSecret = $apiSecret;

		$this->guzzle = $guzzle ?: new HttpClient([
			'base_uri' => 'https://manage.runcloud.io/api/v2/',
			'auth' => [$this->apiKey, $this->apiSecret],
			'headers' => [
			  'Content-Type' => 'application/json',
			  'Accept' => 'application/json',
			],
			'allow_redirects' => false
		]);
	}


	/**
	 * Transform the items of the collection to the given class.
	 *
	 * @return array
	 *
	 */
	protected function transformCollection(array $collection, string $class, array $extraData = []): array
	{
		return array_map(function ($data) use ($class, $extraData) {
			return new $class($data + $extraData, $this);
		}, $collection);
	}


	/**
	 * Transform the item to the given class.
	 *
	 * @return object
	 *
	 */
	protected function transformItem(array $item, string $class, array $extraData = []): object
	{
		return new $class($item + $extraData, $this);
	}


	protected function getAllData(string $path, array $query = [])
	{
		$page_data = $this->get($path, $query);
		$data_all = $page_data['data'];

		if (array_key_exists('meta', $page_data)) {

			$page = $page_data['meta']['pagination']['current_page'];
			$total_pages = $page_data['meta']['pagination']['total_pages'];

			 while ($page < $total_pages) {
				$page++;
				$page_query = array_merge($query, ['page' => $page]);
				$data = $this->get($path, $page_query)['data'];
				$data_all = array_merge($data_all, $data);
			}

		}

		return $data_all;
	}


	/**
	 * Set a new timeout
	 *
	 * @param  int $timeout
	 * @return $this
	 *
	 */
	public function setTimeout(int $timeout)
	{
		$this->timeout = $timeout;
		return $this;
	}


	/**
	 * Get the timeout
	 *
	 * @return  int
	 *
	 */
	public function getTimeout(): int
	{
		return $this->timeout;
	}


	public function ping()
	{
		return $this->get("ping")['message'];
	}


}