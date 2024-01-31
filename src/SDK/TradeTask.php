<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;
use eMU\Traits\MessagesEditor;
use eMU\Traits\TableQuery;

class TradeTask extends Core {

	use ElementEditor;
	use AttachmentsEditor;
	use MessagesEditor;
	use TableQuery;
	
	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->setHeader($auth);
		$this->api_url = "$this->app_url/emu/tradetask";
	}

}

?>