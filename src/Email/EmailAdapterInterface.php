<?php 
namespace IonAuth\IonAuth\Email;

interface EmailAdapterInterface
{
    /**
     * Send Email
<<<<<<< HEAD
     * @param  string $to      
     * @param  string $subject 
     * @param  string $body    
     * @param  array  $headers Optional headers
     * @return bool         
     */
    public function send($to, $subject, $body, $headers = array());
}
=======
     *
     * @param  array  $fields
     * @return bool
     */
    public function send($fields);
}
>>>>>>> c460266... Simplified class constructor and fixed parse error due to spelling stupidity on my part. Still need to decide the actual method signature for the send() method.  What I have right now is just a simple parameter with which to test.
