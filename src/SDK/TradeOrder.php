<?php

declare(strict_types=1);

namespace eMU\SDK;

use Exception;
use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;
use eMU\Traits\MessagesEditor;
use eMU\Traits\TableQuery;

class TradeOrder extends Core {

	use ElementEditor;
	use AttachmentsEditor;
	use MessagesEditor;
	use TableQuery;
	
	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->setHeader($auth);
		$this->api_url = "$this->app_url/emu/tradeorder";
	}

	public function open(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/open", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	public function close(int $id) : array|false {
		$this->set_response($this->request->post("$this->api_url/close", ['id' => $id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

	/**
	 * @deprecated "Operacja delete nie jest obsługiwany dla tego typu elementu"
	 *
	 * @return $this
	 */
	public function delete(int $id) : array|false {
		throw new Exception("Operacja ".static::class."::delete nie jest obsługiwany dla tego typu elementu");
	}

	/**
	 * @deprecated "Operacja restore nie jest obsługiwany dla tego typu elementu"
	 *
	 * @return $this
	 */
	public function restore(int $id) : array|false {
		throw new Exception("Operacja ".static::class."::restore nie jest obsługiwany dla tego typu elementu");
	}

}

?>