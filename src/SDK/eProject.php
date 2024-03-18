<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;
use eMU\Traits\MessagesEditor;
use eMU\Traits\TableQuery;

class eProject extends Core {

	use ElementEditor;
	use AttachmentsEditor;
	use MessagesEditor;
	use TableQuery;
	
	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->set_header($auth);
		$this->api_url = "$this->app_url/emu/eproject";
	}

	public function item_list(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/item_list", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function item_add(int $id, int $element_id, string $project_element_type) : array|false {
		$this->set_response($this->request->post("$this->api_url/item_add", ['id' => $id, 'element_id' => $element_id, 'element_type' => $project_element_type]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function item_remove(int $id, int $element_id, string $project_element_type) : array|false {
		$this->set_response($this->request->post("$this->api_url/item_remove", ['id' => $id, 'element_id' => $element_id, 'element_type' => $project_element_type]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>