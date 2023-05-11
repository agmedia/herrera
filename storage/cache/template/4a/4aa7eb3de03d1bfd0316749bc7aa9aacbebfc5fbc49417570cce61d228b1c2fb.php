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

/* basel/template/product/special.twig */
class __TwigTemplate_a0bff999546c7c4878758e01e0059fd1106f048e95a640444a90c042ce77afd9 extends \Twig\Template
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
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 6
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 6);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 6);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "  </ul>
  
  <div class=\"row\">
  
  ";
        // line 12
        echo ($context["column_left"] ?? null);
        echo "
    
    ";
        // line 14
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 15
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 16
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 17
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 18
            echo "    ";
        } else {
            // line 19
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 20
            echo "    ";
        }
        // line 21
        echo "    <div id=\"content\" class=\"";
        echo ($context["class"] ?? null);
        echo "\">
    
    ";
        // line 23
        echo ($context["content_top"] ?? null);
        echo "
      <h1 id=\"page-title\">";
        // line 24
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      
      ";
        // line 26
        if (($context["products"] ?? null)) {
            // line 27
            echo "      <div id=\"product-view\" class=\"grid\">
      
      <div class=\"table filter\">
      
          
        <!--  <div class=\"table-cell nowrap hidden-xs\">
          <a id=\"grid-view\" class=\"view-icon grid\" data-toggle=\"tooltip\" data-title=\"";
            // line 33
            echo ($context["button_grid"] ?? null);
            echo "\"><i class=\"fa fa-th\"></i></a>
          <a id=\"list-view\" class=\"view-icon list\" data-toggle=\"tooltip\" data-title=\"";
            // line 34
            echo ($context["button_list"] ?? null);
            echo "\"><i class=\"fa fa-th-list\"></i></a>
          </div> -->
          
         <div class=\"table-cell nowrap \">
         <span>";
            // line 38
            echo ($context["text_limit"] ?? null);
            echo "</span>
          <select id=\"input-limit\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
            ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["limits"]);
            foreach ($context['_seq'] as $context["_key"] => $context["limits"]) {
                // line 41
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["limits"], "value", [], "any", false, false, false, 41) == ($context["limit"] ?? null))) {
                    // line 42
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 42);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 42);
                    echo "</option>
            ";
                } else {
                    // line 44
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 44);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 44);
                    echo "</option>
            ";
                }
                // line 46
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['limits'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "          </select>
          </div> 
          
          <div class=\"table-cell w100\">
          <a href=\"";
            // line 51
            echo ($context["compare"] ?? null);
            echo "\" id=\"compare-total\" class=\"hidden-xs\">";
            echo ($context["text_compare"] ?? null);
            echo "</a>
          </div>
          
          <div class=\"table-cell nowrap text-right\">
          <div class=\"sort-select\">
          <span class=\"hidden-xs\">";
            // line 56
            echo ($context["text_sort"] ?? null);
            echo "</span>
          <select id=\"input-sort\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
            ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["sorts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["sorts"]) {
                // line 59
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["sorts"], "value", [], "any", false, false, false, 59) == sprintf("%s-%s", ($context["sort"] ?? null), ($context["order"] ?? null)))) {
                    // line 60
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 60);
                    echo "\" selected=\"selected\"> ";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 60);
                    echo "</option>
            ";
                } else {
                    // line 62
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 62);
                    echo "\" >";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 62);
                    echo "</option>
            ";
                }
                // line 64
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sorts'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            echo "          </select>
          </div>
          </div>
          
      
      </div>

          <div class=\"grid-holder product-holder grid4\">
        ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 74
                echo "        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/special.twig", 74)->display($context);
                // line 75
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 76
            echo "      </div>
      </div> <!-- #product-view ends -->
      
      <div class=\"row pagination-holder\">
        <div class=\"col-sm-6 xs-text-center\">";
            // line 80
            echo ($context["pagination"] ?? null);
            echo "</div>
        <div class=\"col-sm-6 text-right xs-text-center\"><span class=\"pagination-text\">";
            // line 81
            echo ($context["results"] ?? null);
            echo "</span></div>
      </div>
      
      ";
        } else {
            // line 85
            echo "      \t<p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
      ";
        }
        // line 87
        echo "      
      ";
        // line 88
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 89
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>
";
        // line 91
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "basel/template/product/special.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  289 => 91,  284 => 89,  280 => 88,  277 => 87,  271 => 85,  264 => 81,  260 => 80,  254 => 76,  240 => 75,  237 => 74,  220 => 73,  210 => 65,  204 => 64,  196 => 62,  188 => 60,  185 => 59,  181 => 58,  176 => 56,  166 => 51,  160 => 47,  154 => 46,  146 => 44,  138 => 42,  135 => 41,  131 => 40,  126 => 38,  119 => 34,  115 => 33,  107 => 27,  105 => 26,  100 => 24,  96 => 23,  90 => 21,  87 => 20,  84 => 19,  81 => 18,  78 => 17,  75 => 16,  72 => 15,  70 => 14,  65 => 12,  59 => 8,  48 => 6,  44 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/special.twig", "");
    }
}
