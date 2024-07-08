<?php

declare(strict_types=1);

namespace eMU\Traits;

trait GetFields {

	public function get_fields(array $columns, bool $with_trashed = false) : array|false {
		$this->set_response($this->request->post("$this->api_url/get_fields", ['columns' => $columns, 'with_trashed' => $with_trashed]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>