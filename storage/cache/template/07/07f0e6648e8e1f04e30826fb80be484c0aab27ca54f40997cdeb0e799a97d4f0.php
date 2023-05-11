<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* basel/template/common/basel_search_full.twig */
class __TwigTemplate_3aea553f4418b15efa1b60849332b36b9c9d86ebcf90720afc054b9d19116f89 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"full-search-wrapper\">
<div class=\"search-field search-main\">
<input type=\"text\" name=\"search\" value=\"";
        // line 3
        echo ($context["search"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["basel_text_search"] ?? null);
        echo "\" class=\"form-control main-search-input\" />
</div>
<div class=\"search-button do-search main\">
<a class=\"icon-magnifier icon\" title=\"Pretraga\"></a>
</div>
</div>
<script>
\$(document).ready(function() {
\$('.search-holder-mobile input[name=\\'search-mobile\\']').attr(\"placeholder\", \"";
        // line 11
        echo ($context["basel_text_search"] ?? null);
        echo "\").attr(\"value\", \"";
        echo ($context["search"] ?? null);
        echo "\");
});
</script>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/basel_search_full.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 11,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/basel_search_full.twig", "");
    }
}
