<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;
use eMU\Traits\SimpleList;
use eMU\Traits\TableQuery;
use eMU\Traits\GetFields;

class Product extends Core {

	use SimpleList;
	use GetFields;
	use ElementEditor;
	use AttachmentsEditor;
	use TableQuery;
	
	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->set_header($auth);
		$this->api_url = "$this->app_url/emu/product";
	}

}

?>