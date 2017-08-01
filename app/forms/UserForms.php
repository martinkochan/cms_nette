<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Object;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\Utils\ArrayHash;

class UserForms extends Object
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    private function login($form, $instructions, $register = false)
    {
        $presenter = $form->getPresenter();
        try
        {
            $username = $form->getValues()->username;
            $password = $form->getValues()->password;

            if ($register)
                $this->user->getAuthenticator()->register($username, $password);

            $this->user->login($username, $password);

            if ($instructions && $presenter)
            {
                if (isset($instructions->message))
                    $presenter->flashMessage($instructions->message);
                if (isset($instructions->redirection))
                    $presenter->redirect($instructions->redirection);
            }
        } catch (AuthenticationException $ex)
        {
            if ($presenter)
            {
                $presenter->flashMessage($ex->getMessage());
                $presenter->redirect('this');
            } else
                $form->addError($ex->getMessage());
        }
    }

    public function createBasicForm(Form $form = null)
    {
        $form = $form ? $form : new Form;
        $form->addText('username', 'Jméno')->setRequired();
        $form->addPassword('password', 'Heslo');
        return $form;
    }

    public function createLoginForm($instructions = null, Form $form = null)
    {
        $form = $this->createBasicForm($form);
        $form->addSubmit('submit', 'Přihlásit');
        $form->onSuccess[] = function (Form $form) use ($instructions)
        {
            $this->login($form, $instructions);
        };
        return $form;
    }

    public function createRegisterForm($instructions = null, Form $form = null)
    {
        $form = $this->createBasicForm($form);
        $form->addPassword('password_repeat', 'Heslo znovu')->setRequired()
                ->addRule(Form::EQUAL, 'Hesla nesouhlasí.', $form['password']);
        $form->addText('y', 'Zadejte aktuální rok (antispam)')->setType('number')->setRequired()
                ->addRule(Form::EQUAL, 'Špatně vyplněný antispam.', date("Y"));
        $form->addSubmit('register', 'Registrovat');
        $form->onSuccess[] = function(Form $form) use ($instructions)
        {
            $this->login($form, $instructions, true);
        };
        return $form;
    }

}
