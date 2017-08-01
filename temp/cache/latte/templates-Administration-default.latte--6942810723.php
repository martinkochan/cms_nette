<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Administration/default.latte

use Latte\Runtime as LR;

class Template6942810723 extends Latte\Runtime\Template
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
		?>Web administration<?php
	}


	function blockDescription($_args)
	{
		?>Web administration.<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="col-sm-8 blog-main">
    <p>Vítejte v administraci, jste příhlášen/a jako <b><?php echo LR\Filters::escapeHtmlText($username) /* line 5 */ ?></b>.</p>
<?php
		if (!$admin) {
?>    <p>Nemáte administrátorská oprávnění.</p>
<?php
		}
		?>    <h2><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:editor")) ?>">Article editor</a></h2>
    <h2><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:list")) ?>">List of articles</a></h2>
    <h2><a  href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Administration:logout")) ?>">Logout</a></h2>
</div><!-- /.blog-main -->
<?php
	}

}
