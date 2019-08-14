<?php

namespace OnHover\RunCloud\Actions;


trait ManagesStaticData
{


	/**
	 * Get the Database collations
	 *
	 * @return []
	 *
	 */
	public function getDatabaseCollations()
	{
		$data = $this->get("static/databases/collations");
		return $data;
	}


	/**
	 * Get the Timezones
	 *
	 * @return []
	 *
	 */
	public function getTimezones()
	{
		$data = $this->get("static/timezones");
		return $data;
	}


	/**
	 * Get the available script installers
	 *
	 * @return []
	 *
	 */
	public function getScriptInstallers()
	{
		$data = $this->get("static/webapps/installers");
		return $data;
	}


}
