<?php

declare(strict_types=1);

namespace eMU\SDK;

use eMU\Schema\MessageImageTransfer;

class Task extends Core {

	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->setHeader($auth);
		$this->api_url = "$this->app_url/emu/task";
	}

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

	public function attachment_list(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/attachment_list", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function attachment_upload(int $id, string $name, string $path) : array|false {
		if(!file_exists($path)) return false;
		$this->set_response($this->request->post("$this->api_url/attachment_upload", ['id' => $id, 'name' => $name, 'content' => base64_encode(file_get_contents($path))]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function attachment_create(int $id, string $name, string $content) : array|false {
		$this->set_response($this->request->post("$this->api_url/attachment_upload", ['id' => $id, 'name' => $name, 'content' => base64_encode($content)]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}
	
	public function attachment_delete(int $id, int|array $attachment_id) : array|false {
		$this->set_response($this->request->post("$this->api_url/attachment_delete", ['id' => $id, 'attachment_id' => $attachment_id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function message_list(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/message_list", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function message_create(int $id, ?string $message, ?MessageImageTransfer $photos = null) : array|false {
		$this->set_response($this->request->post("$this->api_url/message_create", ['id' => $id, 'message' => $message, 'photos' => $photos->getRequest()]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>