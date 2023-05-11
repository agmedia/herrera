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

/* basel/template/product/category.twig */
class __TwigTemplate_db93395ccdc0fe1274c0ef3c99c6fe2c8889e4ac6353335afc6f5e023a3e6903 extends \Twig\Template
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

   ";
        // line 10
        if (($context["short_description"] ?? null)) {
            // line 11
            echo "    
     <div class=\"row short-description\">
       <div class=\"col-md-12 mb-3\">
           ";
            // line 14
            echo ($context["short_description"] ?? null);
            echo "
        </div>
          </div>
           
         ";
        }
        // line 19
        echo "  
  <div class=\"row\">

     
  
  ";
        // line 24
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 25
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 26
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 27
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 28
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 29
            echo "    ";
        } else {
            // line 30
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 31
            echo "    ";
        }
        // line 32
        echo "    
    <div id=\"content\" class=\"";
        // line 33
        echo ($context["class"] ?? null);
        echo "\">

      
    ";
        // line 36
        echo ($context["content_top"] ?? null);
        echo "
      <h1 id=\"page-title\">";
        // line 37
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      
    
      
      ";
        // line 41
        if ((($context["categories"] ?? null) && ($context["category_subs_status"] ?? null))) {
            // line 42
            echo "      <h3 class=\"lined-title hidden-xs\"><span>";
            echo ($context["text_refine"] ?? null);
            echo "</span></h3>
      \t<div style=\"margin-bottom:15px\" class=\"tag-cat hidden-xs\">
        \t";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 45
                echo "            <div class=\"item\" style=\"display:inline-block;margin-bottom:5px\">
           
            <a class=\"btn btn-default btn-sm\" href=\"";
                // line 47
                echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 47);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 47);
                echo "</a></div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "        </div>
     ";
        }
        // line 51
        echo "\t      
      ";
        // line 52
        if (($context["products"] ?? null)) {
            // line 53
            echo "      <div id=\"product-view\" class=\"grid\">
      
         <div class=\"table filter\">
      
          
         <div class=\"table-cell nowrap \">
         <span>";
            // line 59
            echo ($context["text_limit"] ?? null);
            echo "</span>
          <select id=\"input-limit\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
            ";
            // line 61
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["limits"]);
            foreach ($context['_seq'] as $context["_key"] => $context["limits"]) {
                // line 62
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["limits"], "value", [], "any", false, false, false, 62) == ($context["limit"] ?? null))) {
                    // line 63
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 63);
                    echo "\" selected=\"selected\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 63);
                    echo "</option>
            ";
                } else {
                    // line 65
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "href", [], "any", false, false, false, 65);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["limits"], "text", [], "any", false, false, false, 65);
                    echo "</option>
            ";
                }
                // line 67
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['limits'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo "          </select>
          </div> 
          
          <div class=\"table-cell w100\">
          <a href=\"";
            // line 72
            echo ($context["compare"] ?? null);
            echo "\" id=\"compare-total\" class=\"hidden-xs\">";
            echo ($context["text_compare"] ?? null);
            echo "</a>
          </div>
          
          <div class=\"table-cell nowrap text-right\">
          <div class=\"sort-select\">
          <span class=\"hidden-xs\">";
            // line 77
            echo ($context["text_sort"] ?? null);
            echo "</span>
          <select id=\"input-sort\" class=\"form-control input-sm inline\" onchange=\"location = this.value;\">
            ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["sorts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["sorts"]) {
                // line 80
                echo "            ";
                if ((twig_get_attribute($this->env, $this->source, $context["sorts"], "value", [], "any", false, false, false, 80) == sprintf("%s-%s", ($context["sort"] ?? null), ($context["order"] ?? null)))) {
                    // line 81
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 81);
                    echo "\" selected=\"selected\"> ";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 81);
                    echo "</option>
            ";
                } else {
                    // line 83
                    echo "            <option value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "href", [], "any", false, false, false, 83);
                    echo "\" >";
                    echo twig_get_attribute($this->env, $this->source, $context["sorts"], "text", [], "any", false, false, false, 83);
                    echo "</option>
            ";
                }
                // line 85
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sorts'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            echo "          </select>
          </div>
          </div>
          
         
      
      </div>
      
      <div class=\"grid-holder product-holder grid";
            // line 94
            echo ($context["basel_prod_grid"] ?? null);
            echo "\">
        ";
            // line 95
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
                // line 96
                echo "        ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/category.twig", 96)->display($context);
                // line 97
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
            // line 98
            echo "      </div>
      </div> <!-- #product-view ends -->
      
      <div class=\"row pagination-holder\">
        <div class=\"col-sm-6 xs-text-center pagination-navigation\">";
            // line 102
            echo ($context["pagination"] ?? null);
            echo "</div>
        <div class=\"col-sm-6 text-right xs-text-center\"><span class=\"pagination-text\">";
            // line 103
            echo ($context["results"] ?? null);
            echo "</span></div>
      </div>
      
      ";
        }
        // line 107
        echo "      
      ";
        // line 108
        if ( !($context["products"] ?? null)) {
            // line 109
            echo "      <p>";
            echo ($context["text_empty"] ?? null);
            echo "</p>
      ";
        }
        // line 111
        echo "

       
      
      ";
        // line 115
        echo ($context["content_bottom"] ?? null);
        echo "</div>


    ";
        // line 118
        echo ($context["column_right"] ?? null);
        echo "</div>

</div>

  ";
        // line 122
        if (($context["description"] ?? null)) {
            // line 123
            echo "
<div class=\"container-fluid catdesc\">
  <div class=\"container\">
     <div class=\"row short-description\">
       <div class=\"col-md-12 mb-5\">
      ";
            // line 128
            echo ($context["description"] ?? null);
            echo "
       </div>
        </div>
      </div>

        </div>
      ";
        }
        // line 135
        echo ($context["footer"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "basel/template/product/category.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  370 => 135,  360 => 128,  353 => 123,  351 => 122,  344 => 118,  338 => 115,  332 => 111,  326 => 109,  324 => 108,  321 => 107,  314 => 103,  310 => 102,  304 => 98,  290 => 97,  287 => 96,  270 => 95,  266 => 94,  256 => 86,  250 => 85,  242 => 83,  234 => 81,  231 => 80,  227 => 79,  222 => 77,  212 => 72,  206 => 68,  200 => 67,  192 => 65,  184 => 63,  181 => 62,  177 => 61,  172 => 59,  164 => 53,  162 => 52,  159 => 51,  155 => 49,  145 => 47,  141 => 45,  137 => 44,  131 => 42,  129 => 41,  122 => 37,  118 => 36,  112 => 33,  109 => 32,  106 => 31,  103 => 30,  100 => 29,  97 => 28,  94 => 27,  91 => 26,  89 => 25,  85 => 24,  78 => 19,  70 => 14,  65 => 11,  63 => 10,  59 => 8,  48 => 6,  44 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/category.twig", "");
    }
}
