<?php
/**
 * Mailer Configuration
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


return array(
    'driver' => 'smtp',
    'host'   => 'mail.africanvalues.org',
    'port'   => 465,
    'from'   => array(
        'address' => 'accounts@africanvalues.org',
        'name'    => 'African Values Network',
    ),
    'encryption' => 'ssl',
    'username'   => 'accounts@africanvalues.org',
    'password'   => 'VlOngPass458',
    'sendmail'   => '/usr/sbin/sendmail -bs',

    // Whether or not the Mailer will pretend to send the messages.
    'pretend' => false,
);
