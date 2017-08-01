<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Article/editor.latte

use Latte\Runtime as LR;

class Template1ecffeb0da extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'description' => 'blockDescription',
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'title' => 'html',
		'description' => 'html',
		'content' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>

<?php
		$this->renderBlock('scripts', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockTitle($_args)
	{
		?>Editor<?php
	}


	function blockDescription($_args)
	{
		?>Editor článků.<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    <div class="col-sm-8 blog-main">

<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["editorForm"];
		?>        <form class="form"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), FALSE) ?>>
            <div class="blog-post">


                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"<?php
		$_input = end($this->global->formsStack)["title"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Title</label>
                    <div class="col-sm-9">
                        <input class="form-control col-6" type="text"<?php
		$_input = end($this->global->formsStack)["title"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"<?php
		$_input = end($this->global->formsStack)["url"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>URL</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text"<?php
		$_input = end($this->global->formsStack)["url"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"<?php
		$_input = end($this->global->formsStack)["description"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Description </label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text"<?php
		$_input = end($this->global->formsStack)["description"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Content </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10"<?php
		$_input = end($this->global->formsStack)["content"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'rows' => NULL,
		))->attributes() ?>><?php echo $_input->getControl()->getHtml() ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>


            </div><!-- /.blog-post -->
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), FALSE);
?>        </form>
    </div><!-- /.blog-main -->
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
		$this->renderBlockParent('scripts', get_defined_vars());
?>
<script type="text/javascript" src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea[name=content]",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        entities: "160,nbsp",
        entity_encoding: "named",
        entity_encoding: "raw"
});
</script>
<?php
	}

}
