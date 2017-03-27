<?php

/**
 * HTTP Headers configuration
 * Modify this will be change the http headers
 * that use by this framework
 */

return [
    'origin' => '*',
    'methods' => 'GET, POST, DELETE, PATCH, PUT',
    'headers' => 'Content-Type, Origin, X-Requested-With, Accept'
];