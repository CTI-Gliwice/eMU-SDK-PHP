<?php

declare(strict_types=1);

namespace eMU\Schema;

class DataTransfer {

	protected array $files = [];

	public function load_file_from_path(string $file_name, string $path) : bool {
		if(!file_exists($path)) return false;
		array_push($this->files, [
			'name' => $file_name,
			'content' => base64_encode(file_get_contents($path)),
		]);
		return true;
	}

	public function load_file_from_string(string $file_name, string $content) : void {
		array_push($this->files, [
			'name' => $file_name,
			'content' => base64_encode($content),
		]);
	}

	public function getRequest() : array {
		return $this->files;
	}

}

?>
