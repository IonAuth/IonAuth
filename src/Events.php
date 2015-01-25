<?php namespace IonAuth\IonAuth\Events;

class Events
{
	protected $hooks;

	public function __construct() {
		$this->hooks = new stdClass;
	}

	public function register($event, $name, $class, $method, $arguments)
	{
		$this->hooks->{$event}[$name] = new stdClass;
		$this->hooks->{$event}[$name]->class     = $class;
		$this->hooks->{$event}[$name]->method    = $method;
		$this->hooks->{$event}[$name]->arguments = $arguments;
	}

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


	protected function _call($event, $name)
	{
		if (isset($this->hooks->{$event}[$name]) && method_exists($this->hooks->{$event}[$name]->class, $this->hooks->{$event}[$name]->method)) {
			$hook = $this->hooks->{$event}[$name];

			return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
		}

		return FALSE;
	}

}