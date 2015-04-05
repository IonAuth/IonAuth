<?php
namespace IonAuth\IonAuth\Email;

interface EmailAdapterInterface
{
    /**
     * Send Email
     *
     * @access public
     * @param  array  $fields
     * @return bool
     */
    public function send($fields);
}
