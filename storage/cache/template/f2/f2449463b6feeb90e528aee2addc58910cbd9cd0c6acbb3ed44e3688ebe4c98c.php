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

/* extension/captcha/google.twig */
class __TwigTemplate_b17e0d0115c96c46bc5b2fac9787ea918d4ec3db807b47751462bab5a49a1073 extends \Twig\Template
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
        echo ($context["header"] ?? null);
        echo ($context["column_left"] ?? null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-captcha\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo ($context["cancel"] ?? null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo ($context["button_cancel"] ?? null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 11);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 11);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 17
        if (($context["error_warning"] ?? null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 24
        echo ($context["text_edit"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-captcha\" class=\"form-horizontal\">
          <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
        // line 28
        echo ($context["text_signup"] ?? null);
        echo "</div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-key\">";
        // line 30
        echo ($context["entry_key"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"captcha_google_key\" value=\"";
        // line 32
        echo ($context["captcha_google_key"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_key"] ?? null);
        echo "\" id=\"input-key\" class=\"form-control\" />
              ";
        // line 33
        if (($context["error_key"] ?? null)) {
            // line 34
            echo "              <div class=\"text-danger\">";
            echo ($context["error_key"] ?? null);
            echo "</div>
              ";
        }
        // line 36
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-secret\">";
        // line 39
        echo ($context["entry_secret"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"captcha_google_secret\" value=\"";
        // line 41
        echo ($context["captcha_google_secret"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_secret"] ?? null);
        echo "\" id=\"input-secret\" class=\"form-control\" />
              ";
        // line 42
        if (($context["error_secret"] ?? null)) {
            // line 43
            echo "              <div class=\"text-danger\">";
            echo ($context["error_secret"] ?? null);
            echo "</div>
              ";
        }
        // line 45
        echo "            </div>
          </div>


          \t<div class=\"form-group\">
            \t<label class=\"col-sm-2 control-label\" for=\"input-score\">
            \t\t<span data-toggle=\"tooltip\" title=\"";
        // line 51
        echo ($context["help_score"] ?? null);
        echo "\">";
        echo ($context["entry_score"] ?? null);
        echo "</span>
            \t</label>
            \t<div class=\"col-sm-10\">
              \t\t<input type=\"text\" name=\"captcha_google_score\" value=\"";
        // line 54
        echo ($context["captcha_google_score"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_score"] ?? null);
        echo "\" id=\"input-score\" class=\"form-control\" />
              \t</div>
            </div>
            
\t\t\t
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 60
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"captcha_google_status\" id=\"input-status\" class=\"form-control\">
                ";
        // line 63
        if (($context["captcha_google_status"] ?? null)) {
            // line 64
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\">";
            // line 65
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        } else {
            // line 67
            echo "                <option value=\"1\">";
            echo ($context["text_enabled"] ?? null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 68
            echo ($context["text_disabled"] ?? null);
            echo "</option>
                ";
        }
        // line 70
        echo "              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 78
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "extension/captcha/google.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  219 => 78,  209 => 70,  204 => 68,  199 => 67,  194 => 65,  189 => 64,  187 => 63,  181 => 60,  170 => 54,  162 => 51,  154 => 45,  148 => 43,  146 => 42,  140 => 41,  135 => 39,  130 => 36,  124 => 34,  122 => 33,  116 => 32,  111 => 30,  106 => 28,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/captcha/google.twig", "");
    }
}
