<?php 
namespace IonAuth\IonAuth\Email\Adapters;

use IonAuth\IonAuth\Email\EmailAdapterInterface;

class NativeAdapter implements EmailAdapterInterface
{
    /**
     * Container for Config values
     * @var array
     */
    protected $config;

    /**
     * Class Constructor
     * @param array $config 
     * @todo  Passing another array config may not be the best way
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Send Email
<<<<<<< HEAD
     * @param  string $to      
     * @param  string $subject 
     * @param  string $body    
     * @param  array  $headers Optional headers
     * @return bool         
     * @todo Lots to consider and complete in here, but this is just a stub 
=======
     *
     * @param  array  $fields
     * @return bool
     * @todo Lots to consider and complete in here, but this is just a stub
>>>>>>> c460266... Simplified class constructor and fixed parse error due to spelling stupidity on my part. Still need to decide the actual method signature for the send() method.  What I have right now is just a simple parameter with which to test.
     */
    public function send($fields)
    {
        print_r($fields[0]);
    }
}
