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
     * @var  array
     */
    protected $config;

    /**
     * Driver Container
     *
     * @var IonAuth\IonAuth\Email\EmailAdapterInterface
     */
    protected $driver;

    /**
     * Class Constructor
     *
     * @param  string $driver The name of the mail driver
     * @param  array $config  The array of config values
     */
    public function __construct($driver, array $config)
    {
        $this->config = $config;

        $this->driver = $this->buildDriver($driver);
    }

    /**
     * Build driver based upon adapter value
     *
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
     * @return NativeAdapter
     */
    protected function createNativeAdapter()
    {
        return new NativeAdapter($this->config);
    }

    /**
     * Call the method on the driver without an intermediary
     *
     * @param  string $method
     * @param  mixed $args
     * @return mixed
     * @todo I'm sure there is probably a better way to handle calling the method
     */
    public function __call($method, $args)
    {
        if (! method_exists($this->driver, $method)) {
            $message = sprintf("%s does not exist in %s", $method, get_class($this->driver));
            throw new BadMethodCallException($message);
        }

        return $this->driver->$method($args);
    }
}
