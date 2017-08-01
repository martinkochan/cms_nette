<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use App\Model;

/**
 * Base presenter for all application presenters.
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter
{

    /** @var null|string Presenter address for login of user */
    protected $loginPresenter = null;

    /**
     * Controls user rights for current action. Called with every action.
     * @throws BadRequestException if user logged in, but does not have rights.
     */
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isAllowed($this->getName(), $this->getAction()))
        {
            $this->flashMessage('Nejste přihlášený/á či nemáte dostatečné oprávnění.');
            if ($this->loginPresenter)
                $this->redirect($this->loginPresenter);
        }
    }

    /**
     * Adds universal variables from every presenter to layout/templates.
     */
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->admin = $this->getUser()->isInRole('admin');
       $this->template->loggedIn = $this->getUser()->isLoggedIn();
    }

}
