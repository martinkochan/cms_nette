<?php
namespace App\Model;

use Nette\Database\Context;
use Nette\Object;

/**
 * Base model for all application models.
 * Provides with access to database.
 * @package App\Model
 */

abstract class BaseManager extends Object
{
    /** @var Context Instance for work with database */
    protected $database;
    
    public function __construct(Context $database)
    {
        $this->database = $database;
    }
    
}