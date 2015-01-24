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
     * @var  array 
     */
    protected $config;

    /**
     * Driver Container
     * @var IonAuth\IonAuth\Email\EmailAdapterInterface
     */
    protected $driver;

    /**
     * Class Constructor
     * @param  array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->buildAdapter();
    }

    /**
     * Build the Email Adapter
     * @return EmailManager
     * @todo Obviously some work needs to be done in here to find the appropriate values
     */
    protected function buildAdapter()
    {
        $adapter = 'native';
        $this->driver = $this->buildDriver($adapter);

        return $this
    }

    /**
     * Build driver based upon adapter value
     * @param  string $adapter 
     * @return IonAuth\IonAuth\EmailAdapterInterface          
     */
    protected function buildDriver($adapter)
    {
        switch ($apater) {
            case "native" : 
                return $this->createNativeAdapter();

            default :
                throw new DomainException("Desired driver is not available");
                break;
        }
    }

    /**
     * Create Native Email Adapter
     * @return NativeAdapter 
     */
    protected function createNativeAdapter()
    {
        return new NativeAdapter();
    }

    /**
     * Call the method on the driver without an intermediary
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