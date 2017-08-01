<?php

namespace App\CoreModule\Model;

use App\Model\BaseManager;
use Nette\Database\Table\IRow;
use Nette\Database\Table\Selection;
use Nette\Utils\ArrayHash;

/**
 * Class contains methods for managing articles
 * @package App\CoreModule\Model
 */
class ArticleManager extends BaseManager
{
    const
                    TABLE_NAME = 'article',
                    COLUMN_ID = 'article_id',
                    COLUMN_URL = 'url';
    
    /**
     * @return Selection list of of articles in database
     */
    public function getArticles()
    {
        return $this->database->table(self::TABLE_NAME)->order(self::COLUMN_ID. ' DESC');
    }
    /**
     * Returns article from database by his URL.
     * @param string $url URL of article
     * @return mixed first article matching URL or false when unsuccessful
     */
    public function getArticle($url)
    {
        return $this->database->table(self::TABLE_NAME)->where(self::COLUMN_URL, $url)->fetch();
    }
    /**
     * Saves article in database. If there is no ID, saves new one, if there is, updates this existing one. 
     * @param array|arrayHash $article article
     */
    public function saveArticle($article)
    {
        if(!$article[self::COLUMN_ID])
            $this->database->table (self::TABLE_NAME)->insert ($article);
        else
            $this->database->table(self::TABLE_NAME)->where (self::COLUMN_ID, $article[self::COLUMN_ID])->update ($article);
    }
    /**
     * Deletes article.
     * @param string $url URL of article
     */
    public function removeArticle($url)
    {
        $this->database->table(self::TABLE_NAME)->where(self::COLUMN_URL, $url)->delete();
    }
}