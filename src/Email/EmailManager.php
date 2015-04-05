<?php
namespace IonAuth\IonAuth\Email;

use DomainException;
use BadMethodCallException;
use UnexpectedValueException;
use IonAuth\IonAuth\Email\Adapters\NativeAdapter;

class EmailManager
{
    /**
     * Config Container
     *
     * @access protected
     * @var    array
     */
    protected $config;

    /**
     * Driver Container
     *
     * @access protected
     * @var    IonAuth\IonAuth\Email\EmailAdapterInterface
     */
    protected $driver;

    /**
     * Class Constructor
     *
     * @access public
     * @param  string $driver The name of the mail driver
     * @param  array $config  The array of config values
     * @return void
     */
    public function __construct($driver, array $config)
    {
        $this->config = $config;

        $this->driver = $this->buildDriver($driver);
    }

    /**
     * Get instantiated mail driver
     *
     * @access public
     * @return IonAuth\IonAuth\Email\EmailAdapterInterface
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Build driver based upon adapter value
     *
     * @access protected
     * @param  string $adapter
     * @return IonAuth\IonAuth\EmailAdapterInterface
     */
    protected function buildDriver($adapter)
    {
        switch ($adapter) {
            case "native" :
                return $this->createNativeAdapter();

            default :
                throw new DomainException("Desired driver is not available");
                break;
        }
    }

    /**
     * Create Native Email Adapter
     *
     * @access protected
     * @return NativeAdapter
     */
    protected function createNativeAdapter()
    {
        return new NativeAdapter($this->config);
    }

    /**
     * Call the method on the driver without an intermediary
     *
     * @access public
     * @param  string $method
     * @param  mixed $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        if (! method_exists($this->driver, $method)) {
            $message = sprintf(
                "%s does not exist in %s",
                $method,
                get_class($this->driver)
            );
            throw new BadMethodCallException($message);
        }

        return call_user_func([$this->driver, $method], $args);
    }
}
