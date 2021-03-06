<?php
/**
 * @package  ISN Learning
 */
namespace Inc;

use Inc\Quiz\Admin;
use Inc\Quiz\Component;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		return [
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
			Base\LoginController::class,
			Base\MembershipController::class,
			Base\CourseController::class,
			Base\CustomFieldController::class,
			Base\CertificateController::class,
			Base\TemplateController::class,
			Base\WidgetController::class			
			
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return void
	 */
	public static function register_services()  : void
	{
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}

        ( new Component() )->init();
	}

	/**
	 * Initialize the class
	 * @param  class $class    class from the services array
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class )
	{
		$service = new $class();

		return $service;
	}

}

