<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Article/default.latte

use Latte\Runtime as LR;

class Template547f386e69 extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'description' => 'blockDescription',
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'title' => 'html',
		'description' => 'html',
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		extract($_args);
		echo LR\Filters::escapeHtmlText($article->title) /* line 1 */;
	}


	function blockDescription($_args)
	{
		extract($_args);
		echo LR\Filters::escapeHtmlText($article->description) /* line 2 */;
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="col-sm-8 blog-main">

    <div class="blog-post">
        <h2 class="blog-post-title"><?php echo LR\Filters::escapeHtmlText($article->title) /* line 7 */ ?></h2>
        <p class="blog-post-meta"><?php echo LR\Filters::escapeHtmlText($article->created_at) /* line 8 */ ?></p>

        <?php echo $article->content /* line 10 */ ?>


    </div><!-- /.blog-post -->
</div><!-- /.blog-main -->
<?php
	}

}
