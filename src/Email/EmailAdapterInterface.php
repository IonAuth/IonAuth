<?php 
namespace IonAuth\IonAuth\Email;

interface EmailAdapterInterface
{
    /**
     * Send Email
     *
     * @param  array  $fields
     * @return bool
     */
    public function send($fields);
}