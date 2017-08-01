<?php
// source: C:\xampp\htdocs\cms-nette\app/templates/@layout.latte

use Latte\Runtime as LR;

class Templatec9f96d5aab extends Latte\Runtime\Template
{
	public $blocks = [
		'css' => 'blockCss',
		'head' => 'blockHead',
		'scripts' => 'blockScripts',
	];

	public $blockTypes = [
		'css' => 'html',
		'head' => 'html',
		'scripts' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="<?php
		$this->renderBlock('description', $this->params, function ($s, $type) {
			$_fi = new LR\FilterInfo($type);
			return LR\Filters::convertTo($_fi, 'htmlAttr', $this->filters->filterContent('striptags', $_fi, $s));
		});
?>">

        <title><?php
		$this->renderBlock('title', $this->params, function ($s, $type) {
			$_fi = new LR\FilterInfo($type);
			return LR\Filters::convertTo($_fi, 'html', $this->filters->filterContent('striptags', $_fi, $s));
		});
?></title>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('css', get_defined_vars());
		?>        <?php
		$this->renderBlock('head', get_defined_vars());
?>
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:")) ?>">Nette cms</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:")) ?>">Home</a></li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:list")) ?>">List of articles</a></li>
                        <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Contact:")) ?>">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li><?php
		if ($loggedIn) {
			?><a href=":Core:Administration:logout">Logout</a><?php
		}
?>
</li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="blog-header">
                <h1 class="blog-title">Simple CMS built on Nette </h1>
                <p class="lead blog-description">Website with best articles in the world.</p>
            </div>

<?php
		$iterations = 0;
		foreach ($flashes as $flash) {
			?>            <div class="alert alert-info" role="alert"><?php echo LR\Filters::escapeHtmlText($flash->message) /* line 60 */ ?></div>
<?php
			$iterations++;
		}
?>

            <div class="row">
<?php
		$this->renderBlock('content', $this->params, 'html');
?>
                <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset">
                        <h4>About</h4>
                        <p>This site is work in progress. Please keep this in mind. There is still a lot to do.</p>
                    </div>
                    <div class="sidebar-module">
                        <h4>Archives</h4>
                        <ol class="list-unstyled">
                            <li><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Article:list")) ?>">All (for now)</a></li>

                        </ol>
                    </div>
                </div><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </div><!-- /.container -->

        <footer class="blog-footer">
            <p>Simple CMS site built on Nette developed by Donnie.<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link(":Core:Administration:")) ?>"> Administration</a></p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </footer>

<?php
		$this->renderBlock('scripts', get_defined_vars());
?>
    </body>
</html>
<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['flash'])) trigger_error('Variable $flash overwritten in foreach on line 60');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockCss($_args)
	{
		extract($_args);
?>

        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 14 */ ?>/css/blog.css">
        <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 15 */ ?>/css/navbar-fixed-top.css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<?php
	}


	function blockHead($_args)
	{
		
	}


	function blockScripts($_args)
	{
?>        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="jquery.min.js"><\/script>')</script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php
	}

}
