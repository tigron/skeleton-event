<?php

namespace Skeleton\Event;

class Dispatcher {

	/**
	 * Dispatcher
	 *
	 * @var
	 */
	private static $dispatcher = null;

	/**
	 * Events
	 *
	 * @var
	 */
	private $events = [];

	/**
	 * Construct
	 *
	 * @access private
	 */
	private function __construct() { }

	/**
	 * Get instance
	 *
	 * @access public
	 * @return Dispatcher
	 */
	public static function get() {
		if (self::$dispatcher === null) {
			self::$dispatcher = new Dispatcher();
		}

		return self::$dispatcher;
	}

	/**
	 * Add listener
	 *
	 * @access public
	 * @param  string $event name
	 * @param  array $listener
	 */
    public function add_listener($event, $listener) {
        $this->events[$event] = $listener;
    }

	/**
	 * Dispatch
	 *
	 * @access public
	 * @param  string $event name
	 */
    public function dispatch($event, $data) {
		if (!is_array($data)) {
			$data = [ $data ];
		}
        call_user_func_array($this->events[$event], $data);
    }

	public function has_listener($event) {
		if (isset($this->events[$event])) {
			return true;
		}

		return false;
	}
}
