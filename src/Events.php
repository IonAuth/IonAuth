<?php namespace IonAuth\IonAuth\Events;

class Events
{
	protected $hooks;

	public function __construct() {
		$this->hooks = new stdClass;
	}

	/**
	 * register
	 *
	 * @access public
	 * @param  $event
	 * @param  $name
	 * @param  $class
	 * @param  $method
	 * @param  $arguments
	 */
	public function register($event, $name, $class, $method, $arguments)
	{
		$this->hooks->{$event}[$name] = new stdClass;
		$this->hooks->{$event}[$name]->class     = $class;
		$this->hooks->{$event}[$name]->method    = $method;
		$this->hooks->{$event}[$name]->arguments = $arguments;
	}

	/**
	 * remove
	 *
	 * @access public
	 * @param  $event
	 * @param  $name
	 */
	public function remove($event, $name=NULL)
	{

		//remove individual hook if it a name is passed
		if (isset($name) && isset($this->hooks->{$event}[$name])) {
			unset($this->hooks->{$event}[$name]);
		}
		else {
			if (isset($this->hooks->$event)) {
				unset($this->hooks->$event);
			}
		}

	}

	/**
	 * trigger
	 *
	 * @access public
	 * @param  $events
	 */
	public function trigger($events) {

		//if it's an array trigger each event
		if (is_array($events) && !empty($events)) {
			foreach ($events as $event) {
				$this->trigger($event);
			}
		}
		else {
			if (isset($this->hooks->$events) && !empty($this->hooks->$events)) {
				foreach ($this->hooks->$events as $name => $hook) {
					$this->_call($events, $name);
				}
			}
		}

	}

	/**
	 * _call
	 *
	 * @access protected
	 * @param  $name, string
	 * @param  $event, string
	 * @return bool
	 */
	protected function _call($event, $name)
	{
		if (isset($this->hooks->{$event}[$name]) && method_exists($this->hooks->{$event}[$name]->class, $this->hooks->{$event}[$name]->method)) {
			$hook = $this->hooks->{$event}[$name];

			return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
		}

		return FALSE;
	}

}
