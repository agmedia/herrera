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

/* basel/template/blog/blog_home.twig */
class __TwigTemplate_8e83ed213977536e631458da2fb1155e9f2607960716b90cba6e2272e516de4e extends \Twig\Template
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
        echo "
<div class=\"container\">
  <ul class=\"breadcrumb\">
    ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 5
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 5);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 5);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "  </ul>
  <div class=\"row\">";
        // line 8
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 9
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 10
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 11
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 12
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 13
            echo "    ";
        } else {
            // line 14
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 15
            echo "    ";
        }
        // line 16
        echo "    <div id=\"content\" class=\"";
        echo ($context["class"] ?? null);
        echo "\">";
        echo ($context["content_top"] ?? null);
        echo "
      <div class=\"blog\">
      
      <h1 id=\"page-title\">";
        // line 19
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      
      ";
        // line 21
        if (($context["description"] ?? null)) {
            // line 22
            echo "      <div class=\"main_description\">
      ";
            // line 23
            echo ($context["description"] ?? null);
            echo "
      </div>
      ";
        }
        // line 26
        echo "  \t
    ";
        // line 27
        if (($context["blogs"] ?? null)) {
            // line 28
            echo "\t\t<div class=\"grid-holder grid";
            echo ($context["list_columns"] ?? null);
            echo "\">
\t\t\t
            ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["blogs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["blog"]) {
                // line 31
                echo "\t\t\t\t<div class=\"item single-blog\">
                
                ";
                // line 33
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 33)) {
                    // line 34
                    echo "                <div class=\"banner_wrap hover-zoom hover-darken\">
\t\t\t\t<img class=\"zoom_image\" src=\"";
                    // line 35
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "image", [], "any", false, false, false, 35);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 35);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 35);
                    echo "\" />
                <a href=\"";
                    // line 36
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 36);
                    echo "\" class=\"effect-holder\"></a>
                ";
                    // line 37
                    if (($context["date_added_status"] ?? null)) {
                        // line 38
                        echo "                <div class=\"date_added\">
                <span class=\"day\">";
                        // line 39
                        echo twig_get_attribute($this->env, $this->source, $context["blog"], "date_added_day", [], "any", false, false, false, 39);
                        echo "</span>
                <b class=\"month\">";
                        // line 40
                        echo twig_get_attribute($this->env, $this->source, $context["blog"], "date_added_month", [], "any", false, false, false, 40);
                        echo "</b>
                </div>
                ";
                    }
                    // line 43
                    echo "                ";
                    if (twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 43)) {
                        // line 44
                        echo "                <div class=\"tags-wrapper\">
                <div class=\"tags primary-bg-color\">
                ";
                        // line 46
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["blog"], "tags", [], "any", false, false, false, 46), 0, 2));
                        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                            // line 47
                            echo "                <a href=\"index.php?route=extension/blog/home&tag=";
                            echo twig_trim_filter($context["tag"]);
                            echo "\">";
                            echo twig_trim_filter($context["tag"]);
                            echo "</a>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 49
                        echo "                </div>
                </div>
                ";
                    }
                    // line 52
                    echo "
                </div>
\t\t\t\t";
                }
                // line 55
                echo "                
                <div class=\"summary\">
                <h3 class=\"blog-title\"><a href=\"";
                // line 57
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "href", [], "any", false, false, false, 57);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["blog"], "title", [], "any", false, false, false, 57);
                echo "</a></h3>
                
                <div class=\"blog_stats\">
          
                </div>
                ";
                // line 62
                if (twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 62)) {
                    // line 63
                    echo "                <p class=\"short-description\">";
                    echo twig_get_attribute($this->env, $this->source, $context["blog"], "short_description", [], "any", false, false, false, 63);
                    echo "</p>
                ";
                }
                // line 65
                echo "                </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['blog'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "          </div>
\t\t<div class=\"row pagination-holder\">
        <div class=\"col-sm-6 xs-text-center\">
\t\t";
            // line 71
            echo twig_replace_filter(($context["pagination"] ?? null), ["&gt;|" => "&gt;&gt", "|&lt;" => "&lt;&lt"]);
            echo "
\t\t</div>
        <div class=\"col-sm-6 text-right xs-text-center\"><span class=\"pagination-text\">";
            // line 73
            echo ($context["results"] ?? null);
            echo "</span></div>
      </div>
\t";
        } else {
            // line 76
            echo "\t\t<div>";
            echo ($context["text_no_blog_posts"] ?? null);
            echo "</div>
\t";
        }
        // line 78
        echo "    </div>
      ";
        // line 79
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 80
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 82
        echo ($context["footer"] ?? null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "basel/template/blog/blog_home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 82,  252 => 80,  248 => 79,  245 => 78,  239 => 76,  233 => 73,  228 => 71,  223 => 68,  215 => 65,  209 => 63,  207 => 62,  197 => 57,  193 => 55,  188 => 52,  183 => 49,  172 => 47,  168 => 46,  164 => 44,  161 => 43,  155 => 40,  151 => 39,  148 => 38,  146 => 37,  142 => 36,  134 => 35,  131 => 34,  129 => 33,  125 => 31,  121 => 30,  115 => 28,  113 => 27,  110 => 26,  104 => 23,  101 => 22,  99 => 21,  94 => 19,  85 => 16,  82 => 15,  79 => 14,  76 => 13,  73 => 12,  70 => 11,  67 => 10,  65 => 9,  61 => 8,  58 => 7,  47 => 5,  43 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/blog/blog_home.twig", "");
    }
}
