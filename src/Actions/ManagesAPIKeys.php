<?php

namespace OnHover\RunCloud\Actions;

use OnHover\RunCloud\Resources\APIKey;
use OnHover\RunCloud\Exceptions\ValidationException;


trait ManagesAPIKeys
{


	/**
	 * List all 3rd Party API Key
	 *
	 * @param  string $search Optional search string
	 * @return APIKey[]
	 *
	 */
	public function getAPIKeys(string $search = '')
	{
		$data = $this->getAllData("settings/externalapi", ['search' => $search]);
		return $this->transformCollection($data, APIKey::class);
	}


	public function createAPIKey(string $service, string $label, string $secret, string $username = '')
	{
		$service = strtolower($service);

		if ($service === 'cloudflare' && ! strlen($username)) {
			throw new ValidationException("Username is required for Cloudflare service.");
		}

		$data = compact('label', 'service', 'secret', 'username');
		$data = array_filter($data, 'strlen');

		$apiKey = $this->post("settings/externalapi", $data);

		return new APIKey($apiKey, $this);
	}


	public function updateAPIKey(string $apiKeyId, string $label, string $secret, string $username = '')
	{
		$data = compact('label', 'secret', 'username');
		$data = array_filter($data, 'strlen');

		$apiKey = $this->patch("settings/externalapi/{$apiKeyId}", $data);

		return new APIKey($apiKey, $this);
	}


	public function deleteAPIKey(string $apiKeyId)
	{
		$apiKey = $this->delete("settings/externalapi/{$apiKeyId}");

		return new APIKey($apiKey, $this);
	}


}
