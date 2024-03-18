<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;
use eMU\Traits\MessagesEditor;
use eMU\Traits\TableQuery;

class Customer extends Core {

	use ElementEditor;
	use AttachmentsEditor;
	use MessagesEditor;
	use TableQuery;
	
	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->set_header($auth);
		$this->api_url = "$this->app_url/emu/customer";
	}

	public function get_by_nip(string $nip){
		$this->set_response($this->request->post("$this->api_url/get_by_nip", ['nip' => $nip]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>