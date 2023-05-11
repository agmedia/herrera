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

/* extension/basel/productgroups.twig */
class __TwigTemplate_681f7d6e4d7f05632b57f48812ecf5b46d89b0f9e76825bc0050acffea4d1d2d extends \Twig\Template
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
        <a class=\"btn btn-primary\" onclick=\"\$('#save').val('stay');\$('#form-showintabs').submit();\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo ($context["button_save"] ?? null);
        echo "\"><i class=\"fa fa-save\"></i></a>
        </div>
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
            echo "  <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["error_warning"] ?? null);
            echo "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 22
        echo "  ";
        if (($context["success"] ?? null)) {
            // line 23
            echo "  <div class=\"alert alert-success\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo ($context["success"] ?? null);
            echo "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  </div>
  ";
        }
        // line 27
        echo "  
  <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\">";
        // line 30
        echo ($context["heading_title"] ?? null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
      <div class=\"row\">
      
      <div class=\"col-sm-12\">
      <div class=\"bs-callout bs-callout-info\">
      ";
        // line 37
        echo ($context["text_info"] ?? null);
        echo "
      <a href=\"";
        // line 38
        echo ($context["modules_url"] ?? null);
        echo "\" target=\"_blank\">";
        echo ($context["text_to_modules"] ?? null);
        echo "</a>
      </div>
      </div>
      
      <form action=\"";
        // line 42
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-showintabs\" class=\"form-vertical\">
        <div class=\"col-sm-2\">
      \t\t<ul class=\"nav nav-pills nav-stacked\" id=\"tab\" data-tabs=\"tabs\">
                ";
        // line 45
        $context["tab_row"] = 1;
        // line 46
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["keyTab"] => $context["tab"]) {
            // line 47
            echo "                ";
            $context["tab_row"] = (($context["tab_row"] ?? null) + 1);
            // line 48
            echo "        \t\t<li><a href=\"#tab-tab-";
            echo $context["keyTab"];
            echo "\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\"\$('a[href=\\'#tab-tab-";
            echo $context["keyTab"];
            echo "\\']').parent().remove(); \$('#tab-tab-";
            echo $context["keyTab"];
            echo "').remove(); \$('#tab a:first').tab('show');\"></i> ";
            echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_title", [], "any", false, false, false, 48);
            echo "</a></li>
        \t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['keyTab'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "                <li id=\"tab-add\" style=\"cursor:pointer\"><a onclick=\"addTab();\"><i class=\"fa fa-plus-circle\"></i> ";
        echo ($context["button_add_tab"] ?? null);
        echo "</a></li>        \t</ul>
        </div> <!-- col-sm-2 -->
     <div class=\"col-sm-10\">
        <div class=\"tab-content first\">
        ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["keyTab"] => $context["tab"]) {
            // line 55
            echo "        ";
            $context["tab_row"] = (($context["tab_row"] ?? null) + 1);
            // line 56
            echo "        <div class=\"tab-pane\" id=\"tab-tab-";
            echo $context["keyTab"];
            echo "\">
        
        <h4>";
            // line 58
            echo ($context["entry_title"] ?? null);
            echo "</h4>
            <div class=\"form-group\">
            ";
            // line 60
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                echo "<div class=\"input-group\">
            <span class=\"input-group-addon\">
            <img src=\"language/";
                // line 62
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 62);
                echo "/";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 62);
                echo ".png\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 62);
                echo "\" />
            </span>
            <input class=\"form-control\" type=\"text\" name=\"showintabs_tab[";
                // line 64
                echo $context["keyTab"];
                echo "][title][";
                echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64);
                echo "]\" value=\"";
                echo (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = twig_get_attribute($this->env, $this->source, $context["tab"], "title", [], "any", false, false, false, 64)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64)] ?? null) : null);
                echo "\" class=\"";
                if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64) == ($context["language_admin_id"] ?? null))) {
                    echo "language-title";
                }
                echo "\" />
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "            </div>
        
                     <h4 class=\"source\">";
            // line 69
            echo ($context["entry_source"] ?? null);
            echo "</h4>          
                                <fieldset>
                                  <legend>
                                    <input type=\"radio\" id=\"select_product";
            // line 72
            echo $context["keyTab"];
            echo "\" name=\"showintabs_tab[";
            echo $context["keyTab"];
            echo "][data_source]\" value=\"SP\" 
                                    ";
            // line 73
            if ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 73)) || (twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 73) == "SP"))) {
                echo " checked=\"checked\"";
            }
            echo " />
                                    <label for=\"select_product";
            // line 74
            echo $context["keyTab"];
            echo "\" >";
            echo ($context["header_products_select"] ?? null);
            echo "</label>
                                  </legend>
                                  <div class=\"field_cont\"";
            // line 76
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 76) && (twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 76) != "SP"))) {
                echo " style=\"display:none\"";
            }
            echo ">
                                      <label>";
            // line 77
            echo ($context["entry_products"] ?? null);
            echo "</label>
                                      <input type=\"text\" class=\"form-control\" name=\"products\" value=\"\" id=\"";
            // line 78
            echo $context["keyTab"];
            echo "\"/>
                                    <div id=\"products-tabs-";
            // line 79
            echo $context["keyTab"];
            echo "\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\">
                                    ";
            // line 80
            if (twig_get_attribute($this->env, $this->source, $context["tab"], "products", [], "any", false, false, false, 80)) {
                // line 81
                echo "                                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tab"], "products", [], "any", false, false, false, 81));
                foreach ($context['_seq'] as $context["_key"] => $context["product_tab"]) {
                    // line 82
                    echo "                                    <div id=\"product-tabs-";
                    echo $context["keyTab"];
                    echo "-";
                    echo twig_get_attribute($this->env, $this->source, $context["product_tab"], "product_id", [], "any", false, false, false, 82);
                    echo "\"><i class=\"fa fa-minus-circle\"></i> ";
                    echo twig_get_attribute($this->env, $this->source, $context["product_tab"], "name", [], "any", false, false, false, 82);
                    echo "
                                    <input type=\"hidden\" name=\"showintabs_tab[";
                    // line 83
                    echo $context["keyTab"];
                    echo "][products][";
                    echo twig_get_attribute($this->env, $this->source, $context["product_tab"], "product_id", [], "any", false, false, false, 83);
                    echo "][product_id]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product_tab"], "product_id", [], "any", false, false, false, 83);
                    echo "\" />
                                    </div>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product_tab'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 86
                echo "                                    ";
            }
            // line 87
            echo "                                    </div>
                                  </div>
                                </fieldset>
                                <fieldset>
                                  
                                  <legend>
                                    <input type=\"radio\" id=\"predef_groups";
            // line 93
            echo $context["keyTab"];
            echo "\" name=\"showintabs_tab[";
            echo $context["keyTab"];
            echo "][data_source]\" value=\"PG\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 93) == "PG")) {
                echo " checked=\"checked\"";
            }
            echo " />
                                    <label for=\"predef_groups";
            // line 94
            echo $context["keyTab"];
            echo "\">";
            echo ($context["header_predefined_groups"] ?? null);
            echo "</label>
                                  </legend>
                                  <div class=\"field_cont\" ";
            // line 96
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 96) && (twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 96) != "PG"))) {
                echo " style=\"display:none\"";
            }
            echo " >
                                    <label>";
            // line 97
            echo ($context["entry_group"] ?? null);
            echo "</label>
                                    <select name=\"showintabs_tab[";
            // line 98
            echo $context["keyTab"];
            echo "][product_group]\" class=\"form-control\">
                                      <option value=\"BS\" ";
            // line 99
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 99) && (twig_get_attribute($this->env, $this->source, $context["tab"], "product_group", [], "any", false, false, false, 99) == "BS"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_best_seller"] ?? null);
            echo "</option>
                                      <option value=\"LA\" ";
            // line 100
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 100) && (twig_get_attribute($this->env, $this->source, $context["tab"], "product_group", [], "any", false, false, false, 100) == "LA"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_latest_products"] ?? null);
            echo "</option>
                                      <option value=\"SP\" ";
            // line 101
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 101) && (twig_get_attribute($this->env, $this->source, $context["tab"], "product_group", [], "any", false, false, false, 101) == "SP"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_special_products"] ?? null);
            echo "</option>
                                      <option value=\"PP\" ";
            // line 102
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 102) && (twig_get_attribute($this->env, $this->source, $context["tab"], "product_group", [], "any", false, false, false, 102) == "PP"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_popular_products"] ?? null);
            echo "</option>
                                    </select>
                                  </div>
                                </fieldset>
                                <fieldset>
                                
                                  <legend>
                                    <input type=\"radio\" id=\"custom_query";
            // line 109
            echo $context["keyTab"];
            echo "\" name=\"showintabs_tab[";
            echo $context["keyTab"];
            echo "][data_source]\" value=\"CQ\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 109) && (twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 109) == "CQ"))) {
                echo " checked=\"checked\" ";
            }
            echo "/>
                                    <label for=\"custom_query";
            // line 110
            echo $context["keyTab"];
            echo "\">";
            echo ($context["header_custom_query"] ?? null);
            echo "</label>
                                  </legend>
                                  
                                  <div class=\"field_cont\" ";
            // line 113
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", true, true, false, 113) && (twig_get_attribute($this->env, $this->source, $context["tab"], "data_source", [], "any", false, false, false, 113) != "CQ"))) {
                echo " style=\"display:none\"";
            }
            echo " >
                                    <label>";
            // line 114
            echo ($context["text_category"] ?? null);
            echo "</label>
                                      <select name=\"showintabs_tab[";
            // line 115
            echo $context["keyTab"];
            echo "][filter_category]\" class=\"form-control\">
                                          <option value=\"ALL\">";
            // line 116
            echo ($context["text_all_categories"] ?? null);
            echo "</option>
                                        ";
            // line 117
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 118
                echo "                                          <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 118);
                echo "\" ";
                if ((twig_get_attribute($this->env, $this->source, $context["tab"], "filter_category", [], "any", true, true, false, 118) && (twig_get_attribute($this->env, $this->source, $context["tab"], "filter_category", [], "any", false, false, false, 118) == twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 118)))) {
                    echo " selected=\"selected\"";
                }
                echo " >";
                echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 118);
                echo "</option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 120
            echo "                                      </select>
                                      
                                      <label>";
            // line 122
            echo ($context["text_manufacturer"] ?? null);
            echo "</label>
                                      <select name=\"showintabs_tab[";
            // line 123
            echo $context["keyTab"];
            echo "][filter_manufacturer]\" class=\"form-control\">
                                          <option value=\"ALL\">";
            // line 124
            echo ($context["text_all_manufacturer"] ?? null);
            echo "</option>
                                        ";
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["manufacturers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["manufacturer"]) {
                // line 126
                echo "                                          <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "manufacturer_id", [], "any", false, false, false, 126);
                echo "\" ";
                if ((twig_get_attribute($this->env, $this->source, $context["tab"], "filter_manufacturer", [], "any", true, true, false, 126) && (twig_get_attribute($this->env, $this->source, $context["tab"], "filter_manufacturer", [], "any", false, false, false, 126) == twig_get_attribute($this->env, $this->source, $context["manufacturer"], "manufacturer_id", [], "any", false, false, false, 126)))) {
                    echo " selected=\"selected\"";
                }
                echo " >";
                echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 126);
                echo "</option>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['manufacturer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 128
            echo "                                      </select>
                                      
                                      <label>";
            // line 130
            echo ($context["entry_sort_query"] ?? null);
            echo "</label>
                                      <select class=\"margin_top form-control\" name=\"showintabs_tab[";
            // line 131
            echo $context["keyTab"];
            echo "][sort]\">
                                          <option value=\"pd.name\" ";
            // line 132
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", true, true, false, 132) && (twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", false, false, false, 132) == "pd.name"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_sort_name"] ?? null);
            echo "</option>
                                          <option value=\"rating\" ";
            // line 133
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", true, true, false, 133) && (twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", false, false, false, 133) == "rating"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_sort_rating"] ?? null);
            echo "</option>
                                          <option value=\"sort_order\" ";
            // line 134
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", true, true, false, 134) && (twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", false, false, false, 134) == "sort_order"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_sort_sort_order"] ?? null);
            echo "</option>
                                          <option value=\"p.price\" ";
            // line 135
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", true, true, false, 135) && (twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", false, false, false, 135) == "p.price"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_sort_price"] ?? null);
            echo "</option>
                                          <option value=\"p.date_added\" ";
            // line 136
            if ((twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", true, true, false, 136) && (twig_get_attribute($this->env, $this->source, $context["tab"], "sort", [], "any", false, false, false, 136) == "p.date_added"))) {
                echo " selected=\"selected\"";
            }
            echo " >";
            echo ($context["text_sort_added"] ?? null);
            echo "</option>  
                                      </select>
                                   </div>
                                </fieldset>
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['keyTab'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "      </form>
    </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

";
        // line 151
        echo ($context["footer"] ?? null);
        echo "<script type=\"text/javascript\"><!--
function addTab(){
  //Caculamos numero de pestaña es valor de ultima + 1
  if(! \$('input[name=\\'products\\']').last().attr('id')){
    var tab_row = 1;
  }else{
    var tab_row = parseInt(\$('input[name=\\'products\\']').last().attr('id'), 10) + 1;
  }

  //COmponemos html de una pestaña
  var html = '';
  
  html  = '<div class=\"tab-pane\" id=\"tab-tab-' + tab_row + '\">';
  html += '<h4>";
        // line 164
        echo ($context["entry_title"] ?? null);
        echo "</h4>';
  html += '<div class=\"form-group\">';
  
  ";
        // line 167
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 168
            echo "  html += '<div class=\"input-group\">';
  html += '<span class=\"input-group-addon\">';
  html += '<img src=\"language/";
            // line 170
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 170);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 170);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 170);
            echo "\" /></span>';
  html += '</span>';
  html += '<input class=\"form-control\" type=\"text\" name=\"showintabs_tab[' + tab_row + '][title][";
            // line 172
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 172);
            echo "]\" value=\"\" ";
            if ((twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 172) == ($context["language_admin_id"] ?? null))) {
                echo " class=\"language-title\"";
            }
            echo " />';
  html += '</div>';
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 175
        echo "  html += '</div>';
  html += '<h4 class=\"source\">";
        // line 176
        echo ($context["entry_source"] ?? null);
        echo "</h4>';
  html += '<fieldset><legend>';
  html += '<input type=\"radio\" id=\"select_product' + tab_row + '\" name=\"showintabs_tab[' + tab_row + '][data_source]\" value=\"SP\" checked=\"checked\"/> <label for=\"select_product' + tab_row + '\">";
        // line 178
        echo ($context["header_products_select"] ?? null);
        echo "</label> </legend>';
  html += '<div class=\"field_cont\">';
  html += '<label>";
        // line 180
        echo ($context["entry_products"] ?? null);
        echo "</label>';
  html += '<input type=\"text\" class=\"form-control\" name=\"products\" value=\"\" id=\"' + tab_row + '\"/>';
  html += '<div id=\"products-tabs-' + tab_row + '\" class=\"well well-sm\" style=\"height: 150px; overflow: auto;\"></div>';
  html += '</div>';
  html += '</fieldset><fieldset><legend>';
  
  html += '<input type=\"radio\" id=\"predef_groups' + tab_row + '\" name=\"showintabs_tab[' + tab_row + '][data_source]\" value=\"PG\" /> <label for=\"predef_groups' + tab_row + '\">";
        // line 186
        echo ($context["header_predefined_groups"] ?? null);
        echo "</label></legend>';
  html += '<div class=\"field_cont\" style=\"display:none\" >';
  html += '<label>";
        // line 188
        echo ($context["entry_group"] ?? null);
        echo "</label>';
  html += '<select class=\"form-control\" name=\"showintabs_tab[' + tab_row + '][product_group]\">';
  html += '<option value=\"BS\" >";
        // line 190
        echo ($context["text_best_seller"] ?? null);
        echo "</option>';
  html += '<option value=\"LA\" >";
        // line 191
        echo ($context["text_latest_products"] ?? null);
        echo "</option>';
  html += '<option value=\"SP\" >";
        // line 192
        echo ($context["text_special_products"] ?? null);
        echo "</option>';
  html += '<option value=\"PP\" >";
        // line 193
        echo ($context["text_popular_products"] ?? null);
        echo "</option>';
  html += '</select></div></fieldset><fieldset>';
  
  html += '<legend>';                  
  html += '<input type=\"radio\" id=\"custom_query' + tab_row + '\" name=\"showintabs_tab[' + tab_row + '][data_source]\" value=\"CQ\" /> <label for=\"custom_query' + tab_row + '\"> ";
        // line 197
        echo ($context["header_custom_query"] ?? null);
        echo "</label> </legend>';
  html += '<div class=\"field_cont\" style=\"display:none\">';
  
  html += '<label>";
        // line 200
        echo ($context["text_category"] ?? null);
        echo "</label>';
  html += '<select class=\"form-control\" name=\"showintabs_tab[' + tab_row + '][filter_category]\">';
  html += '<option value=\"ALL\">";
        // line 202
        echo ($context["text_all_categories"] ?? null);
        echo "</option>';
  ";
        // line 203
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 204
            echo "  html += '<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["category"], "category_id", [], "any", false, false, false, 204);
            echo "\" >";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 204), "js");
            echo "</option>';
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 206
        echo "  html += '</select>';

  html += '<label>";
        // line 208
        echo ($context["text_manufacturer"] ?? null);
        echo "</label>';
  html += '<select name=\"showintabs_tab[' + tab_row + '][filter_manufacturer]\" class=\"form-control\">';
  html += '<option value=\"ALL\">";
        // line 210
        echo ($context["text_all_manufacturer"] ?? null);
        echo "</option>';
  ";
        // line 211
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["manufacturers"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["manufacturer"]) {
            // line 212
            echo "  html += '<option value=\"";
            echo twig_get_attribute($this->env, $this->source, $context["manufacturer"], "manufacturer_id", [], "any", false, false, false, 212);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["manufacturer"], "name", [], "any", false, false, false, 212), "js");
            echo "</option>';
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['manufacturer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 214
        echo "  html += '</select>';
  html += '<label>";
        // line 215
        echo ($context["entry_sort_query"] ?? null);
        echo "</label>';
  html += '<select class=\"form-control\" name=\"showintabs_tab[' + tab_row + '][sort]\">';
  html += '<option value=\"pd.name\" >";
        // line 217
        echo ($context["text_sort_name"] ?? null);
        echo "</option>';
  html += '<option value=\"rating\" >";
        // line 218
        echo ($context["text_sort_rating"] ?? null);
        echo "</option>';
  html += '<option value=\"sort_order\" >";
        // line 219
        echo ($context["text_sort_sort_order"] ?? null);
        echo "</option>';
  html += '<option value=\"p.price\" >";
        // line 220
        echo ($context["text_sort_price"] ?? null);
        echo "</option>';
  html += '<option value=\"p.date_added\" >";
        // line 221
        echo ($context["text_sort_added"] ?? null);
        echo "</option>';  
  html += '</select></div></fieldset>';
  html += '</div>';

  \$('.tab-content.first').append(html);
  
  \$('#tab-add').before('<li><a href=\"#tab-tab-' + tab_row + '\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\"\$(\\'a[href=\\\\\\'#tab-tab-' + tab_row + '\\\\\\']\\').parent().remove(); \$(\\'#tab-tab-' + tab_row + '\\').remove(); \$(\\'#tab a:first\\').tab(\\'show\\');\"></i> ' + '";
        // line 227
        echo ($context["text_tab"] ?? null);
        echo "' + tab_row + '</a></li>');
\t
  \$('#tab a[href=\\'#tab-tab-' + tab_row + '\\']').tab('show');
  
  //Enable autocomplete
  \$('input[name=\\'products\\']').autocomplete(autocomp_cfg);
  
  //Remove products from individual list
  \$('.well').delegate('.fa-minus-circle', 'click', function() {
  \$(this).parent().remove();
  });

  //open/close the filter methods
  \$('legend > input').on('change', function() {
  \$(this).closest('div').find('div.field_cont').hide();
  \$(this).closest('fieldset').find('div.field_cont').fadeIn();
  });
}

// show first tab on page load
\$('#tab li:first-child a').tab('show');
//Autocomplete
var autocomp_cfg = {
  delay: 500,
  source: function(request, response) {
    \$.ajax({
      url: 'index.php?route=extension/basel/productgroups/autocomplete&user_token=";
        // line 253
        echo ($context["token"] ?? null);
        echo "&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {   
        response(\$.map(json, function(item) {
          return {
            label: item.name,
            value: item.product_id
          }
        }));
      }
    });
  }, 
  
  select: function(item) {
    var tab_row = \$(this).attr('id');

    \$('#product-tabs-' + tab_row + '-' + item.value).remove();

    var prodElement = '';
    prodElement += '<div id=\"product-tabs-' + tab_row + '-' + item.value + '\">' + '<i class=\"fa fa-minus-circle\"></i> ' + item.label ;
    prodElement += '  <input type=\"hidden\" name=\"showintabs_tab[' + tab_row + '][products][' + item.value + '][product_id]\" value=\"' + item.value + '\" />';
    prodElement += '</div>';

    \$('#products-tabs-' + tab_row).append(prodElement);
        
    return false;
  },
  focus: function(event, ui) {
      return false;
  }
};
// Autocomplet de productos
\$('input[name=\\'products\\']').autocomplete(autocomp_cfg);

//Delete de productos
\$('.well').delegate('.fa-minus-circle', 'click', function() {
\t\$(this).parent().remove();
});
//--></script>
<script type=\"text/javascript\"><!--
//open/close the filter methods
\$('legend > input').on('change', function() {
  \$(this).closest('div').find('div.field_cont').hide();
  \$(this).closest('fieldset').find('div.field_cont').fadeIn();
});
//--></script> 
<script type=\"text/javascript\"><!--
//cambio de titulo de pestaña cuando escribe el user
\$('.language-title').on('keyup input paste', function() {
  var href = \$(this).closest('div').attr('id');
  \$('a[href=\"#' + href + '\"] > div').text(\$(this).val());
});
//--></script> 
<script type=\"text/javascript\"><!--
//control delete pestañas
function removeTab(TabId) {
  \$('#tab-' + TabId ).remove(); 
  \$('#tab-tab-' + TabId).remove(); 
  \$('.vtabs a:first').trigger('click');
  \$('input[value=\"' + TabId + '\"]:checkbox').parent().remove(); 
}
//--></script>
<style>
.panel-body {
    padding-bottom: 35px;
}
legend {
\tborder-bottom:none;
\tbackground:#f3f3f3;
\tline-height:20px;
\tpadding:10px;
\tborder-radius:5px;
\tborder:1px solid #dddddd;
\tmargin-bottom:10px;
}
legend label {
\tfont-size:14px;
\tfont-weight:bold;
\tcursor:pointer;
\tcolor:#888888;
\tmargin:0px;
\tpadding-bottom:5px;
\tvertical-align:top;
}
legend input[type=\"radio\"]:checked+label { 
\tcolor:#222222;
}
.field_cont {
\tpadding-bottom:20px;
}
label {
\tfont-weight:normal;
\tfont-size:14px;
\tmargin-top:10px;
}
h4 {
\tfont-size:18px;
}
h4.source {
\tmargin-top:25px;
}
.well {
\tmargin-bottom:0;
}
.form-group {
\tpadding-top:0;
}
.bs-callout {
    padding: 20px;
    margin: 5px 0 25px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}
.bs-callout h4 {
    margin-top: 0;
    margin-bottom: 5px;
}
.bs-callout-info {
    border-left-color: #5bc0de;
}
.bs-callout-info h4 {
    color: #5bc0de;
}
</style>";
    }

    public function getTemplateName()
    {
        return "extension/basel/productgroups.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  756 => 253,  727 => 227,  718 => 221,  714 => 220,  710 => 219,  706 => 218,  702 => 217,  697 => 215,  694 => 214,  683 => 212,  679 => 211,  675 => 210,  670 => 208,  666 => 206,  655 => 204,  651 => 203,  647 => 202,  642 => 200,  636 => 197,  629 => 193,  625 => 192,  621 => 191,  617 => 190,  612 => 188,  607 => 186,  598 => 180,  593 => 178,  588 => 176,  585 => 175,  572 => 172,  563 => 170,  559 => 168,  555 => 167,  549 => 164,  533 => 151,  522 => 142,  506 => 136,  498 => 135,  490 => 134,  482 => 133,  474 => 132,  470 => 131,  466 => 130,  462 => 128,  447 => 126,  443 => 125,  439 => 124,  435 => 123,  431 => 122,  427 => 120,  412 => 118,  408 => 117,  404 => 116,  400 => 115,  396 => 114,  390 => 113,  382 => 110,  372 => 109,  358 => 102,  350 => 101,  342 => 100,  334 => 99,  330 => 98,  326 => 97,  320 => 96,  313 => 94,  303 => 93,  295 => 87,  292 => 86,  279 => 83,  270 => 82,  265 => 81,  263 => 80,  259 => 79,  255 => 78,  251 => 77,  245 => 76,  238 => 74,  232 => 73,  226 => 72,  220 => 69,  216 => 67,  199 => 64,  190 => 62,  183 => 60,  178 => 58,  172 => 56,  169 => 55,  165 => 54,  157 => 50,  142 => 48,  139 => 47,  134 => 46,  132 => 45,  126 => 42,  117 => 38,  113 => 37,  103 => 30,  98 => 27,  90 => 23,  87 => 22,  79 => 18,  77 => 17,  71 => 13,  60 => 11,  56 => 10,  51 => 8,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/productgroups.twig", "");
    }
}
