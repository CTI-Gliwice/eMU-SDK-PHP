<?php

declare(strict_types=1);

namespace eMU\SDK;

class EmJuJa extends Core {

	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->setHeader($auth);
		$this->api_url = "$this->app_url/emu/emjuja";
	}

	public function user_get_messages(int $user_id, int $last_message = 0, bool $fetch_all = false, bool $mark_as_read = false) : array|false {
		$this->set_response($this->request->post("$this->api_url/user/get_messages", ['user_id' => $user_id, 'last_message' => $last_message, 'fetch_all' => $fetch_all, 'mark_as_read' => $mark_as_read]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function user_send_message(int $user_id, string $message, array $files = []) : array|false {
		$this->set_response($this->request->post("$this->api_url/user/send_message", ['user_id' => $user_id, 'message' => $message, 'files' => $files]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function user_delete_message(int|array $message_id) : array|false {
		$this->set_response($this->request->post("$this->api_url/user/delete_message", ['message_id' => $message_id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function user_delete_conversation(int|array $user_id, ?string $date_from = null, ?string $date_until = null) : array|false {
		$this->set_response($this->request->post("$this->api_url/user/delete_conversation", ['user_id' => $user_id, 'date_from' => $date_from, 'date_until' => $date_until]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function group_get_messages(int $group_id, int $last_message = 0, bool $fetch_all = false, bool $mark_as_read = false) : array|false {
		$this->set_response($this->request->post("$this->api_url/group/get_messages", ['group_id' => $group_id, 'last_message' => $last_message, 'fetch_all' => $fetch_all, 'mark_as_read' => $mark_as_read]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function group_list(?string $search = null, bool $only_owned = false) : array|false {
		$this->set_response($this->request->post("$this->api_url/group/list", ['search' => $search, 'only_owned' => $only_owned]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function push_file_from_path(array &$files, string $file_name, string $path) : bool {
		if(!file_exists($path)) return false;
		array_push($files, [
			'name' => $file_name,
			'content' => base64_encode(file_get_contents($path)),
		]);
		return true;
	}

	public function push_file_from_string(array &$files, string $file_name, string $content) : void {
		array_push($files, [
			'name' => $file_name,
			'content' => base64_encode($content),
		]);
	}

}

?>