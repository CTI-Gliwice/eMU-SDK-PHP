<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Traits\ElementEditor;
use eMU\Traits\TableQuery;

class TaxRate extends Core {

	use ElementEditor;
	use TableQuery;

	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->set_header($auth);
		$this->api_url = "$this->app_url/emu/tax_rate";
	}

	public function list(?string $search = null, bool $with_trashed = false, string $country_code = 'PL') : array|false {
		$this->set_response($this->request->post("$this->api_url/list", ['search' => $search, 'with_trashed' => $with_trashed, 'country_code' => $country_code]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>