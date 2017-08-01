<?php

namespace App\CoreModule\Presenters;

use App\CoreModule\Model\ArticleManager;
use App\CoreModule\Presenters\BaseCorePresenter;
use Nette\Application\BadRequestException;
use Nette\Application\UI\Form;
use Nette\Database\UniqueConstraintViolationException;
use Nette\Utils\ArrayHash;

/**
 * Processes rendering of articles
 * @package App\CoreModule\Presenters
 */
class ArticlePresenter extends BaseCorePresenter
{
    /** constant with URL of default article */
    const DEFAULT_ARTICLE_URL = 'uvod';
   
    /**
     * @var ArticleManager Instance of model class for work with articles
     */
    protected $articleManager;
    
    /**
     * Constructor with injected model for work with Articles
     * @param ArticleManager $articleManager automatically injected model class for work with articles
     */
    public function __construct(ArticleManager $articleManager)
    {
        parent::__construct();
        $this->articleManager = $articleManager;
    }
    
    /**
     * Function loads and render article into the view by his URL.
     * @param string $url URL of article
     * @throws BadRequestException If article was not found
     */
    public function renderDefault($url)
    {
        if (!$url)
            $url = self::DEFAULT_ARTICLE_URL;
        if (!($article = $this->articleManager->getArticle($url)))
                throw new BadRequestException();
        $this->template->article = $article;
    }
    /** Renders list of articles to view */
    public function renderList()
    {
            $this->template->articles = $this->articleManager->getArticles();
    }
    
    /** Removes an article and redirect to list of articles 
     * @param string $url URL of article
     */
    public function actionRemove($url)
    {
        $this->articleManager->removeArticle($url);
        $this->flashMessage('Článek byl odstraněn.');
        $this->redirect(':Core:Article:list');
    }
    
    /** 
     * If $url is set, fills the edit form with its values.
     * @param string $url URL of article, which we edit. If there is none, empty form will show to save new article.
     */
    public function actionEditor($url)
    {
        if ($url)
        {
            ($article = $this->articleManager->getArticle($url)) ? $this['editorForm']->setDefaults($article) : $this->flashMessage('Článek nebyl nalezen.') ;
        }
    }
    
    /**
     * Form for editing and adding articles.
     * @return Form form for article editor
     */
    protected function createComponentEditorForm()
    {
        $form = new Form;
        $form->addHidden('article_id');
        $form->addText('title', 'Titulek')->setRequired();
        $form->addText('url', 'URL')->setRequired();
        $form->addText('description', 'Popisek')->setRequired();
        $form->addTextArea ('content', 'Obsah');
        $form->addSubmit('submit', 'Uložit článek');
        $form->onSuccess[] = [$this, 'editorFormSucceeded'];
        return $form;
    }
    
    /**
     * Function is executed when form is succesfully sent. Processes values from form.
     * @param Form $form editor form from createComponentEditorForm
     * @param ArrayHash $values sent values from editor form
     */
    public function editorFormSucceeded($form, $values)
    {
        try
        {
            $this->articleManager->saveArticle($values);
            $this->flashMessage('Článek byl úspěšně uložen');
            $this->redirect(':Core:Article:', $values->url);
        } 
        catch (UniqueConstraintViolationException $ex) 
        {
            $this->flashMessage('Článek s touto URL adresou již existuje.');
        }
    }
}