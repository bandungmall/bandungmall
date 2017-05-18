<?php
return array(

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session',

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Google
         */
        'Google' => array(
            'client_id'     => '548867088298-g9tcevg4fvpiqvm9n6kee0rukv1t01sk.apps.googleusercontent.com',
            'client_secret' => 'c0A9OWNvhagQQGmGAF8QDeaT',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),
        'Facebook' => array(
            'client_id'     => '323942177986542',
            'client_secret' => 'fc5a64b093e11c99c67052041167c778',
            'scope'         => array('email', 'public_profile'),
        ),
    )

);