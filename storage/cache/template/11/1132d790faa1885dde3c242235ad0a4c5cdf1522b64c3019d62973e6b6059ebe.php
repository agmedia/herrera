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

/* basel/template/common/mobile-nav.twig */
class __TwigTemplate_f7533863150d4a4d597e566fc305c4b5f9c161e92e2e2100beac0f25048bcc38 extends \Twig\Template
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
        echo "<div class=\"main-menu-wrapper hidden-md hidden-lg\">


    <div class=\"closemenu\">
        <div class=\"icon-element mnu\">

            <a class=\"shortcut-wrapper menu-closer hidden-md hidden-lg\" title=\"Navigacija\">
                <i class=\"icon-line-cross icon\"></i>
            </a>

        </div>
    </div>
<ul class=\"mobile-top\">

    ";
        // line 15
        if (($context["header_search"] ?? null)) {
            // line 16
            echo "    <li class=\"search\">
        <div class=\"search-holder-mobile\">
        <input type=\"text\" name=\"search-mobile\" value=\"\" placeholder=\"\" class=\"form-control\" /><a class=\"fa fa-search\" title=\"Pretraga\"></a>
        </div>
    </li>
    ";
        }
        // line 22
        echo "      
</ul>
<ul class=\"mobile-top lang\">
     <li class=\"mobile-lang-curr \"></li>
    </ul>

";
        // line 28
        if (($context["secondary_menu"] ?? null)) {
            // line 29
            echo "<ul class=\"categories\">
    ";
            // line 30
            if ((($context["secondary_menu"] ?? null) == "oc")) {
                // line 31
                echo "        <!-- Default menu -->
        ";
                // line 32
                echo ($context["default_menu"] ?? null);
                echo "
    ";
            } elseif (            // line 33
array_key_exists("secondary_menu", $context)) {
                // line 34
                echo "        <!-- Mega menu -->
        ";
                // line 35
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["secondary_menu_mobile"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["key"] => $context["row"]) {
                    // line 36
                    echo "            ";
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/mobile-nav.twig", 36)->display($context);
                    // line 37
                    echo "        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 38
                echo "    ";
            }
            // line 39
            echo "</ul>
";
        }
        // line 41
        echo "<ul class=\"categories\">
    ";
        // line 42
        $this->loadTemplate("basel/template/common/static_links.twig", "basel/template/common/mobile-nav.twig", 42)->display($context);
        // line 43
        echo "</ul>

";
        // line 45
        if (($context["primary_menu"] ?? null)) {
            // line 46
            echo "<ul class=\"categories\">
";
            // line 47
            if ((($context["primary_menu"] ?? null) == "oc")) {
                // line 48
                echo "<!-- Default menu -->
";
                // line 49
                echo ($context["default_menu"] ?? null);
                echo "
";
            } elseif (            // line 50
array_key_exists("primary_menu", $context)) {
                // line 51
                echo "<!-- Mega menu -->
";
                // line 52
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["primary_menu_mobile"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["key"] => $context["row"]) {
                    // line 53
                    $this->loadTemplate("basel/template/common/menus/mega_menu.twig", "basel/template/common/mobile-nav.twig", 53)->display($context);
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 56
            echo "</ul>
";
        }
        // line 58
        echo "</div>
<span class=\"body-cover menu-closer\"></span>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/mobile-nav.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 58,  191 => 56,  176 => 53,  159 => 52,  156 => 51,  154 => 50,  150 => 49,  147 => 48,  145 => 47,  142 => 46,  140 => 45,  136 => 43,  134 => 42,  131 => 41,  127 => 39,  124 => 38,  110 => 37,  107 => 36,  90 => 35,  87 => 34,  85 => 33,  81 => 32,  78 => 31,  76 => 30,  73 => 29,  71 => 28,  63 => 22,  55 => 16,  53 => 15,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/mobile-nav.twig", "/home/herrera/public_html/upload/catalog/view/theme/basel/template/common/mobile-nav.twig");
    }
}
