<?php

/**
 * Model type for manage the database
 * Using this as the base model
 */

namespace Vendor\Database;

class Model extends Builder
{
    /**
     * @var string
     */
    protected $table = '';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = [];

    public function __construct()
    {
        parent::__construct($this->table);
    }
}