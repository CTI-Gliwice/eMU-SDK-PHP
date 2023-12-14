<?php

declare(strict_types=1);

use App\Services\Request;

class DiskEMU {

	public string $version = "1.0.0";
	private string $api_url;
	private Request $request;
	private bool $is_logged = false;
	private int $last_response_code = 0;
	private array $last_response_data;

	public function __construct(string $api_url){
		$this->api_url = "$api_url/public/api/filemanager";
		$this->request = new Request();
	}

	public function is_logged() : bool {
		return $this->is_logged;
	}

	private function set_response(array $response) : void {
		$this->last_response_code = $response['code'] ?? 0;
		$this->last_response_data = $response['data'] ?? [];
	}

	public function get_error() : string {
		if($this->last_response_data['error'] ?? false && isset($this->last_response_data['message'])) return $this->last_response_data['message'];
		return '#'.$this->last_response_code.':'.print_r($this->last_response_data, true);
	}

	public function get_response_code() : int {
		return $this->last_response_code;
	}

	public function get_response_data() : array {
		return $this->last_response_data;
	}

	public function login(string $login, string $password) : bool {
		$this->set_response($this->request->post("$this->api_url/login", ['email' => $login, 'password' => $password]));
		if($this->get_response_code() != 200) return false;
		$this->request->setHeader(["Authorization: Bearer ".$this->get_response_data()['token']]);
		$this->is_logged = true;
		return true;
	}

	public function logout() : bool {
		$this->set_response($this->request->post("$this->api_url/logout"));
		if($this->get_response_code() != 200) return false;
		$this->request->setHeader([]);
		return true;
	}

	public function delete(string $path) : array|false {
		$this->set_response($this->request->post("$this->api_url/delete", ['path' => $path]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function create_folder(string $path, string $name, bool|null $inherited = null, bool $shared = false, ?string $shared_name = null, ?string $valid_from = null, ?string $valid_until = null, array $permissions = []) : array|false {
		$data = ['path' => "$path", 'name' => $name];
		if(!is_null($inherited)) $data['inherited'] = $inherited;
		if($shared){
			$data['shared'] = true;
			$data['shared_name'] = $shared_name;
		}
		if(!is_null($valid_from)) $data['valid_from'] = $valid_from;
		if(!is_null($valid_until)) $data['valid_until'] = $valid_until;
		if(!empty($permissions)) $data['permissions'] = $permissions;
		$this->set_response($this->request->post("$this->api_url/create_folder", $data));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function download_file(string $path, string $file) : bool {
		$file_info = $this->get_file_info($path);
		if(!$file_info) return false;
		$content = file_get_contents($file_info['url']);
		if(!$content) return false;
		file_put_contents($file, $content);
		return true;
	}

	public function get_file_blob(string $path) : string|false {
		$file_info = $this->get_file_info($path);
		if(!$file_info) return false;
		return file_get_contents($file_info['url']);
	}
	
	public function create_file(string $path, string $name, string $content, string $content_type, bool $shared = false, ?string $shared_name = null, ?string $valid_from = null, ?string $valid_until = null) : array|false {
		$data = ['path' => "$path", 'name' => $name, 'content' => $content, 'content_type' => $content_type];
		if($shared){
			$data['shared'] = true;
			$data['shared_name'] = $shared_name;
		}
		if(!is_null($valid_from)) $data['valid_from'] = $valid_from;
		if(!is_null($valid_until)) $data['valid_until'] = $valid_until;
		$this->set_response($this->request->post("$this->api_url/create_file", $data));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}
	public function send_file(string $path, string $name, string $file, bool $shared = false, ?string $shared_name = null, ?string $valid_from = null, ?string $valid_until = null) : array|false {
		$data = ['path' => "$path", 'name' => $name, 'content' => base64_encode(file_get_contents($file)), 'content_type' => 'base64'];
		if($shared){
			$data['shared'] = true;
			$data['shared_name'] = $shared_name;
		}
		if(!is_null($valid_from)) $data['valid_from'] = $valid_from;
		if(!is_null($valid_until)) $data['valid_until'] = $valid_until;
		$this->set_response($this->request->post("$this->api_url/create_file", $data));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function exists(string $path) : array|false {
		$this->set_response($this->request->post("$this->api_url/exists", ['path' => $path]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function get_file_info(string $path) : array|false {
		$this->set_response($this->request->post("$this->api_url/get_file_info", ['path' => $path]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}
	
	public function get_folder_items(string $path) : array|false {
		$this->set_response($this->request->post("$this->api_url/get_folder_items", ['path' => $path]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function get_tree() : array|false {
		$this->set_response($this->request->post("$this->api_url/get_tree"));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function get_users() : array|false {
		$this->set_response($this->request->post("$this->api_url/get_users"));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function get_groups() : array|false {
		$this->set_response($this->request->post("$this->api_url/get_groups"));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}
	
}

?>