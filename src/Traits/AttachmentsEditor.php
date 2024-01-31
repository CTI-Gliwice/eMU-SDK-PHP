<?php

declare(strict_types=1);

namespace eMU\Traits;

trait AttachmentsEditor {

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

}

?>