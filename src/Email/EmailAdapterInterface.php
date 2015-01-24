<?php
namespace IonAuth\IonAuth\Email;

interface EmailAdapterInterface
{
    /**
     * Send Email
     *
     * @param  string $to
     * @param  string $subject
     * @param  string $body
     * @param  array  $headers Optional headers
     * @return bool
     */
    public function send($to, $subject, $body, $headers = array());
}
