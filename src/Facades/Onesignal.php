<?php

namespace greedchikara\Onesignal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Package Facade
 *
 * @package Onesignal
 * @author Shanky
 */
class Onesignal extends Facade
{
	/**
	 * Get the registered name of the component.
	 * 
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'greedchikara\Onesignal\Onesignal';
	}
}