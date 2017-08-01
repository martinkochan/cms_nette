<?php
// source: C:\xampp\htdocs\cms-nette\app\CoreModule/templates/Administration/register.latte

use Latte\Runtime as LR;

class Template4ade7bd34e extends Latte\Runtime\Template
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
		?>Registrace<?php
	}


	function blockDescription($_args)
	{
		?>Registrace nového uživatelského účtu.<?php
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<div class="col-sm-8 blog-main">
    <div class="blog-post">
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["registerForm"];
		?>        <form class="form"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), FALSE) ?>>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Username: </label>
                <div class="col-sm-8">
                    <input class="form-control col-6" type="text"<?php
		$_input = end($this->global->formsStack)["username"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		'type' => NULL,
		))->attributes() ?>>
                </div>

            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["password"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Password: </label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" type="text"<?php
		$_input = end($this->global->formsStack)["password"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
		))->attributes() ?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"<?php
		$_input = end($this->global->formsStack)["password_repeat"];
		echo $_input->getLabelPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>Password again: </label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" type="text"<?php
		$_input = end($this->global->formsStack)["password_repeat"];
		echo $_input->getControlPart()->addAttributes(array (
		'type' => NULL,
		'class' => NULL,
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
            <button type="submit" class="btn btn-primary">Register</button>

<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), FALSE);
?>        </form>
    </div>
</div><?php
	}

}
