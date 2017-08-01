<?php

namespace App\CoreModule\Presenters;

use App\Presenters\BasePresenter;

abstract class BaseCorePresenter extends BasePresenter
{
    protected $loginPresenter = ':Core:Administration:login';
}
