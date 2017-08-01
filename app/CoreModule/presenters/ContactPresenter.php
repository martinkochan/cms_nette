<?php

namespace App\CoreModule\Presenters;

use App\CoreModule\Presenters\BaseCorePresenter;
use Nette\Application\UI\Form;
use Nette\InvalidStateException;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\Utils\ArrayHash;

/**
 * Presenter processes contact forms.
 * @package App\CoreModule\Presenters
 */
class ContactPresenter extends BaseCorePresenter
{
    /**admin email where all mails will be sent from contact form */
    const EMAIL = 'abc@localhost.cz';
    
    /**
     * Creates and returns contact form
     * @return Form contact form
     */
    protected function createComponentContactForm()
    {
        $form = new Form;
        $form->addText('email','Vaše emailová adresa')->setType('email')->setRequired();
        $form->addText('y','Zadejte aktuální rok')->setRequired()->addRule(Form::EQUAL, 'Chybně vyplněný antispam', date('Y'));
        $form->addTextArea('message', 'Zpráva')->setRequired()->addRule(Form::MIN_LENGTH, 'Zpráva musí být minimálně %d znaků dlouhá.', 10);
        $form->addSubmit('submit','Odeslat');
        $form->onSuccess[] = [$this, 'contactFormSucceeded'];
        return $form;
    }
    
    /**
     * Function is executed when form is succesfully sent. Sends email.
     * @param Form $form contact form
     * @param ArrayHash $values sent values from Contact form
     */
    public function contactFormSucceeded($form, $values)
    {
        try
        {
            $mail = new Message;
            $mail->setFrom($values->email)->addTo(self::EMAIL)->setSubject('Email z webu')->setBody($values->message);
            $mailer = new SendmailMailer;
            $mailer = send($mail);
            $this->flashMessage('Email byl úspěšně odeslán.');
            $this->redirect('this');
        } 
        
        catch (InvalidStateException $ex) 
        {
            $this->flashMessage('Email se nepodařilo odeslat.');
        }
    }
    
}
