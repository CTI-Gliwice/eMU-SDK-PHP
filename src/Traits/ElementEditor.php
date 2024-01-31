<?php

declare(strict_types=1);

namespace eMU\Traits;

trait ElementEditor {

	public function get(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/get", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function create(array $data) : array|false {
		$this->set_response($this->request->post("$this->api_url/create", $data));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function edit(int $id, array $data) : array|false {
		$data['id'] = $id;
		$this->set_response($this->request->post("$this->api_url/edit", $data));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function delete(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/delete", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function restore(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/restore", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>