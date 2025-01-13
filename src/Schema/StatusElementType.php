<?php

declare(strict_types=1);

namespace eMU\Schema;

abstract class StatusElementType {

	public const All = 'all';
	public const Task = 'tasks';
	public const Order = 'orders';
	public const TradeTask = 'trade_tasks';
	public const TradeOrder = 'trade_orders';
	public const Event = 'events';
	public const Project = 'projects';
	public const Offer = 'offers';
	public const SalesOrder = 'sales_orders';
	public const PurchaseOrder = 'purchase_orders';
	public const FileManager = 'disk';

}

?>