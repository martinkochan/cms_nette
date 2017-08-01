<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Contact/default.latte

use Latte\Runtime as LR;

class Template4ba09dece5 extends Latte\Runtime\Template
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
		?>Kontaktní formulář<?php
	}


	function blockDescription($_args)
	{
		?>Kontaktní formulář.<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="col-sm-8 blog-main">
    <div class="blog-post">
    <p>Please contact us with the form below:</p>
    </div>

<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["contactForm"];
		?>    <form class="form"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), FALSE) ?>>
        <div class="blog-post">


            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Your email address:</label>
                <div class="col-sm-8">
                    <input class="form-control col-6" type="text"<?php
		$_input = end($this->global->formsStack)["email"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                </div>

            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["y"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Insert actual year: </label>
                <div class="col-sm-3">
                    <input class="form-control" type="text"<?php
		$_input = end($this->global->formsStack)["y"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["message"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Message: </label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5"<?php
		$_input = end($this->global->formsStack)["message"];
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
?>    </form>
</div><!-- /.blog-main -->



<?php
	}

}
