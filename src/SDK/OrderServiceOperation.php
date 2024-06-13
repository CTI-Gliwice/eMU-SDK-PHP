<?php

declare(strict_types=1);

namespace eMU\SDK;

use Exception;
use eMU\Traits\ElementEditor;
use eMU\Traits\AttachmentsEditor;

class OrderServiceOperation extends Core {

	use ElementEditor;
	use AttachmentsEditor;

	protected string $api_url;

	public function __construct(string $app_url, ?array $auth = null){
		parent::__construct($app_url);
		if(!is_null($auth)) $this->request->set_header($auth);
		$this->api_url = "$this->app_url/emu/orderserviceoperation";
	}

	/**
	 * @deprecated "Operacja restore nie jest obsługiwana dla tego typu elementu"
	 *
	 * @return $this
	 */
	public function restore(int $id) : array|false {
		throw new Exception("Operacja ".static::class."::restore nie jest obsługiwana dla tego typu elementu");
	}

	public function list(int $order_id) : array|false {
		$this->set_response($this->request->post("$this->api_url/list", ['order_id' => $order_id]));
		if($this->get_response_code() != 200) return false;
		return $this->get_response_data();
	}

}

?>