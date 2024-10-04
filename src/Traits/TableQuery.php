<?php

declare(strict_types=1);

namespace eMU\Traits;

trait TableQuery {

	public function query(array $filter = [], int $offset = 0, int $limit = 100, array $extra_data = []) : array|false {
		$this->set_response($this->request->post("$this->api_url/query", ['filter' => $filter, 'offset' => $offset, 'limit' => $limit, 'extra_data' => $extra_data]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>