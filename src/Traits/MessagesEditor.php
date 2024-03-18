<?php

declare(strict_types=1);

namespace eMU\Traits;

use eMU\Schema\MessageImageTransfer;

trait MessagesEditor {

	public function message_list(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/message_list", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function message_create(int $id, ?string $message, ?MessageImageTransfer $photos = null) : array|false {
		$this->set_response($this->request->post("$this->api_url/message_create", ['id' => $id, 'message' => $message, 'photos' => $photos->get_request()]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>