<?php
namespace IonAuth\IonAuth\Email\Adapters;

use IonAuth\IonAuth\Email\EmailAdapterInterface;

class NativeAdapter implements EmailAdapterInterface
{
    /**
     * Container for Config values
     *
     * @access protected
     * @var    array
     */
    protected $config;

    /**
     * Class Constructor
     *
     * @access public
     * @param  array $config
     * @todo   Passing another array config may not be the best way
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Send Email
     *
     * @access public
     * @param  string $to
     * @param  string $subject
     * @param  string $body
     * @param  array  $headers Optional headers
     * @return bool
     * @todo Lots to consider and complete in here, but this is just a stub
     *
     * @param  array  $fields
     * @return bool
     * @todo Lots to consider and complete in here, but this is just a stub
     */
    public function send($fields)
    {
        return true;
    }
}
