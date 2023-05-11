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

/* basel/template/common/language.twig */
class __TwigTemplate_daeaf8528fcaec1be95271aed6ff9bb9db9afd76dbde569db02824439f4d2133 extends \Twig\Template
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
        if ((twig_length_filter($this->env, ($context["languages"] ?? null)) > 1)) {
            // line 2
            echo "<div class=\"option\">
<h4>";
            // line 3
            echo ($context["text_language"] ?? null);
            echo "</h4>
";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 5
                if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 5) == ($context["code"] ?? null))) {
                    // line 6
                    echo "<p><span class=\"anim-underline active\">";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
                    echo "</span></p>
";
                } else {
                    // line 8
                    echo "<p><a class=\"anim-underline\" onclick=\"\$('input[name=\\'code\\']').attr('value', '";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 8);
                    echo "'); \$('#form-language').submit();\">
";
                    // line 9
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 9);
                    echo "</a></p>
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 12
            echo "<select name=\"language-select\" id=\"language-select\" class=\"-hidden-md -hidden-lg\">
";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                // line 14
                if ((twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 14) == ($context["code"] ?? null))) {
                    // line 15
                    echo "<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 15);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 15);
                    echo "</option>
";
                } else {
                    // line 17
                    echo "<option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 17);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 17);
                    echo "</option>
";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "</select>
<form action=\"";
            // line 21
            echo ($context["action"] ?? null);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-language\">
<input type=\"hidden\" name=\"code\" id=\"lang-code\" value=\"\" />
<input type=\"hidden\" name=\"redirect\" value=\"";
            // line 23
            echo ($context["redirect"] ?? null);
            echo "\" />
</form>
<script>
\$(document).ready(function() {
\$('.mobile-lang-curr').addClass('has-l');
\$('#language-select').appendTo('.mobile-lang-curr');
});
</script>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/common/language.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 23,  104 => 21,  101 => 20,  89 => 17,  81 => 15,  79 => 14,  75 => 13,  72 => 12,  63 => 9,  58 => 8,  52 => 6,  50 => 5,  46 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/language.twig", "");
    }
}
