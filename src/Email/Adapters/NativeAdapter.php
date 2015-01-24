<?php 
namespace IonAuth\IonAuth\Email\Adapters;

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
     * @param  string $to      
     * @param  string $subject 
     * @param  string $body    
     * @param  array  $headers Optional headers
     * @return bool         
     * @todo Lots to consider and complete in here, but this is just a stub 
     */
    public function send($to, $subject, $body, $headers = array())
    {
        return mail($to, $subject, $body, $headers);
    }
}