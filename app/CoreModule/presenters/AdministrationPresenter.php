<?php

namespace App\CoreModule\Presenters;

use App\Forms\UserForms;
use App\CoreModule\Presenters\BaseCorePresenter;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

/**
 * Processes rendering of administration section
 * @package App\CoreModule\Presenters
 */
class AdministrationPresenter extends BaseCorePresenter
{

    /** @var UserForms form factory */
    private $userFormsFactory;

    /** @array instructions for login and registration forms */
    private $instructions;

    /**
     * Constructor with injected factory for creating forms
     * @param UserForms $userForms form factory class
     */
    public function __construct(UserForms $userForms)
    {
        parent::__construct();
        $this->userFormsFactory = $userForms;
    }

    /** Inicialization of common variables */
    public function startup()
    {
        parent::startup();
        $this->instructions = array('message' => null, 'redirection' => ':Core:Administration:');
    }

    /** Redirect to administration, if user is already logged in */
    public function actionLogin()
    {
        if ($this->getUser()->isLoggedIn())
            $this->redirect(':Core:Administration:');
    }

    /** Logout of user */
    public function actionLogout()
    {
        $this->getUser()->logout();
        $this->redirect($this->loginPresenter);
    }

    /** Renders administration web page */
    public function renderDefault()
    {
        $identity = $this->getUser()->getIdentity();
        if ($identity)
            $this->template->username = $identity->getData()['username'];
    }

    /**
     * Returns component of login form from form factory.
     * @return Form login form
     */
    public function createComponentLoginForm()
    {
        $this->instructions['message'] = 'Přihlášení bylo úspěšné.';
        return $this->userFormsFactory->createLoginForm(ArrayHash::from($this->instructions));
    }

    /**
     * Returns component of registration form from form factory.
     * @return Form registration form
     */
    public function createComponentRegisterForm()
    {
        $this->instructions['message'] = 'Registrace proběhla úspěšně.';
        return $this->userFormsFactory->createRegisterForm(ArrayHash::from($this->instructions));
    }

}
