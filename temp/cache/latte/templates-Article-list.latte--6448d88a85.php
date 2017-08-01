<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Article/list.latte

use Latte\Runtime as LR;

class Template6448d88a85 extends Latte\Runtime\Template
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
?>


<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['art'])) trigger_error('Variable $art overwritten in foreach on line 6');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		?>List of articles<?php
	}


	function blockDescription($_args)
	{
		?>List of articles.<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="col-sm-8 blog-main">

<?php
		$iterations = 0;
		foreach ($articles as $art) {
?>    <div class="blog-post">
        <h2 class="blog-post-title"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:", [$art->url])) ?>"><?php
			echo LR\Filters::escapeHtmlText($art->title) /* line 7 */ ?></a></h2>
        <p class="blog-post-meta"><?php echo LR\Filters::escapeHtmlText($art->created_at) /* line 8 */ ?></p>
        <?php echo LR\Filters::escapeHtmlText($art->description) /* line 9 */ ?>

        <br>
<?php
			if ($admin) {
				?>            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:editor", [$art->url])) ?>">Edit</a>
            <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:remove", [$art->url])) ?>">Delete</a>
<?php
			}
?>

    </div><?php
			$iterations++;
		}
?>
<!-- /.blog-post -->
</div><!-- /.blog-main -->
<?php
	}

}
