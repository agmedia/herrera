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

/* extension/module/basel_products.twig */
class __TwigTemplate_44579b0895d35c9a8654d9ec73bce59e05641c2d68c4f2a41dbae3175e0eea0e extends \Twig\Template
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
        <button type=\"submit\" form=\"form-banner\" data-toggle=\"tooltip\" title=\"";
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
            echo "    <div class=\"alert alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ";
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
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-banner\" class=\"form-horizontal\">
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 29
        echo ($context["entry_name"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"name\" value=\"";
        // line 31
        echo ($context["name"] ?? null);
        echo "\" placeholder=\"";
        echo ($context["entry_name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
              ";
        // line 32
        if (($context["error_name"] ?? null)) {
            // line 33
            echo "              <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
              ";
        }
        // line 35
        echo "            </div>
          </div>
          
         \t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 39
        echo ($context["entry_status"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 41
        if (($context["status"] ?? null)) {
            // line 42
            echo "            <label><input type=\"radio\" name=\"status\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"status\" value=\"1\" checked=\"checked\" /><span>";
            // line 43
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 45
            echo "            <label><input type=\"radio\" name=\"status\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"status\" value=\"1\" /><span>";
            // line 46
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 48
        echo "            </div>                   
            </div>
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 52
        echo ($context["entry_contrast"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 54
        if (($context["contrast"] ?? null)) {
            // line 55
            echo "            <label><input type=\"radio\" name=\"contrast\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"contrast\" value=\"1\" checked=\"checked\" /><span>";
            // line 56
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 58
            echo "            <label><input type=\"radio\" name=\"contrast\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"contrast\" value=\"1\" /><span>";
            // line 59
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 61
        echo "            </div>                   
            </div>            
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 65
        echo ($context["text_use_block_title"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 67
        if (($context["use_title"] ?? null)) {
            // line 68
            echo "            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"1\" checked=\"checked\" /><span>";
            // line 69
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 71
            echo "            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"title_select\" name=\"use_title\" value=\"1\" /><span>";
            // line 72
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 74
        echo "            </div>                   
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 77
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 78
        echo ($context["text_block_pre_line"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 81
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 82
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 82);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 82);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 82);
            echo "\" /></span>
            <input type=\"text\" name=\"title_pl[";
            // line 83
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83);
            echo "]\" value=\"";
            echo (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["title_pl"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83)] ?? null) : null)) ? ((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["title_pl"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 83)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "            </div>
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 89
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 90
        echo ($context["text_block_title"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 92
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 93
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 94
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 94);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 94);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 94);
            echo "\" /></span>
            <input type=\"text\" name=\"title_m[";
            // line 95
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95);
            echo "]\" value=\"";
            echo (((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["title_m"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null)) ? ((($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["title_m"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 95)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\" />
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "            </div>
            </div>
            
            <div class=\"form-group title_field\" style=\"display:";
        // line 101
        if (($context["use_title"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 102
        echo ($context["text_block_sub_line"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
            ";
        // line 104
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 105
            echo "            <div class=\"input-group\">
            <span class=\"input-group-addon\"><img src=\"language/";
            // line 106
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 106);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 106);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 106);
            echo "\" /></span>
            <textarea type=\"text\" name=\"title_b[";
            // line 107
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107);
            echo "]\" class=\"form-control\">";
            echo (((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["title_b"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107)] ?? null) : null)) ? ((($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = ($context["title_b"] ?? null)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 107)] ?? null) : null)) : (""));
            echo "</textarea>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 110
        echo "            </div>
            </div>
    

          <div class=\"form-group clearfix\">
            <label class=\"col-sm-2 control-label\" for=\"input-name\"><span data-toggle=\"tooltip\" title=\"";
        // line 115
        echo ($context["entry_tabs_help"] ?? null);
        echo "\">";
        echo ($context["entry_tabs"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
            <div class=\"well well-sm\" style=\"height: 150px; overflow: auto;margin-bottom:10px;\">
            ";
        // line 118
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["keytab"] => $context["tab"]) {
            // line 119
            echo "            ";
            if (twig_in_filter($context["keytab"], twig_get_attribute($this->env, $this->source, ($context["selected_tabs"] ?? null), "tabs", [], "any", false, false, false, 119))) {
                // line 120
                echo "            <label><input type=\"checkbox\" name=\"selected_tabs[tabs][]\" value=\"";
                echo $context["keytab"];
                echo "\" checked=\"checked\" />
            ";
                // line 121
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_title", [], "any", false, false, false, 121);
                echo "</label><br />
            ";
            } else {
                // line 123
                echo "            <label><input type=\"checkbox\" name=\"selected_tabs[tabs][]\" value=\"";
                echo $context["keytab"];
                echo "\" />
            ";
                // line 124
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_title", [], "any", false, false, false, 124);
                echo "</label><br />
            ";
            }
            // line 126
            echo "           ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['keytab'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        echo "                    
           </div>           
            <a href=\"";
        // line 129
        echo ($context["groups_url"] ?? null);
        echo "\" target=\"_blank\">";
        echo ($context["groups_text"] ?? null);
        echo "</a>
            </div>
          </div>
          

          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 135
        echo ($context["entry_tabstyle_help"] ?? null);
        echo "\">";
        echo ($context["entry_tabstyle"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <select name=\"tabstyle\" class=\"form-control\">
                
                ";
        // line 139
        if ((($context["tabstyle"] ?? null) == "")) {
            // line 140
            echo "                <option value=\"0\" selected=\"selected\">";
            echo ($context["text_tabs_default"] ?? null);
            echo "</option>
                ";
        } else {
            // line 142
            echo "                <option value=\"0\">";
            echo ($context["text_tabs_default"] ?? null);
            echo "</option>
                ";
        }
        // line 144
        echo "                
                ";
        // line 145
        if ((($context["tabstyle"] ?? null) == "nav-tabs-sm text-center")) {
            // line 146
            echo "                <option value=\"nav-tabs-sm text-center\" selected=\"selected\">";
            echo ($context["text_tabs_floating"] ?? null);
            echo "</option>
                ";
        } else {
            // line 148
            echo "                <option value=\"nav-tabs-sm text-center\">";
            echo ($context["text_tabs_floating"] ?? null);
            echo "</option>
                ";
        }
        // line 150
        echo "                
                ";
        // line 151
        if ((($context["tabstyle"] ?? null) == "nav-tabs-lg text-center")) {
            // line 152
            echo "                <option value=\"nav-tabs-lg text-center\" selected=\"selected\">";
            echo ($context["text_tabs_floating_lg"] ?? null);
            echo "</option>
                ";
        } else {
            // line 154
            echo "                <option value=\"nav-tabs-lg text-center\">";
            echo ($context["text_tabs_floating_lg"] ?? null);
            echo "</option>
                ";
        }
        // line 156
        echo "
              </select>
            </div>
          </div>
          
          
           <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-limit\"><span data-toggle=\"tooltip\" title=\"";
        // line 163
        echo ($context["entry_limit_help"] ?? null);
        echo "\">";
        echo ($context["entry_limit"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"limit\" value=\"";
        // line 165
        echo ($context["limit"] ?? null);
        echo "\"  id=\"input-limit\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_width\">";
        // line 169
        echo ($context["entry_width"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_width\" value=\"";
        // line 171
        echo ($context["image_width"] ?? null);
        echo "\" id=\"input-image_width\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-image_height\">";
        // line 175
        echo ($context["entry_height"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"image_height\" value=\"";
        // line 177
        echo ($context["image_height"] ?? null);
        echo "\" id=\"input-image_height\" class=\"form-control\" />
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-columns\">";
        // line 181
        echo ($context["entry_columns"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"columns\" id=\"input-columns\" class=\"form-control\">
               
                
                ";
        // line 186
        if ((($context["columns"] ?? null) == "5")) {
            // line 187
            echo "                <option value=\"5\" selected=\"selected\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        } else {
            // line 189
            echo "                <option value=\"5\">";
            echo ($context["text_grid5"] ?? null);
            echo "</option>
                ";
        }
        // line 191
        echo "                
                ";
        // line 192
        if ((($context["columns"] ?? null) == "4")) {
            // line 193
            echo "                <option value=\"4\" selected=\"selected\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        } else {
            // line 195
            echo "                <option value=\"4\">";
            echo ($context["text_grid4"] ?? null);
            echo "</option>
                ";
        }
        // line 197
        echo "                
                ";
        // line 198
        if ((($context["columns"] ?? null) == "3")) {
            // line 199
            echo "                <option value=\"3\" selected=\"selected\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        } else {
            // line 201
            echo "                <option value=\"3\">";
            echo ($context["text_grid3"] ?? null);
            echo "</option>
                ";
        }
        // line 203
        echo "                
                ";
        // line 204
        if ((($context["columns"] ?? null) == "2")) {
            // line 205
            echo "                <option value=\"2\" selected=\"selected\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        } else {
            // line 207
            echo "                <option value=\"2\">";
            echo ($context["text_grid2"] ?? null);
            echo "</option>
                ";
        }
        // line 209
        echo "                
                ";
        // line 210
        if ((($context["columns"] ?? null) == "1")) {
            // line 211
            echo "                <option value=\"1\" selected=\"selected\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
                ";
        } else {
            // line 213
            echo "                <option value=\"1\">";
            echo ($context["text_grid1"] ?? null);
            echo "</option>
                ";
        }
        // line 215
        echo "                
                ";
        // line 216
        if ((($context["columns"] ?? null) == "list")) {
            // line 217
            echo "                <option value=\"list\" selected=\"selected\">";
            echo ($context["text_gridz"] ?? null);
            echo "</option>
                ";
        } else {
            // line 219
            echo "                <option value=\"list\">";
            echo ($context["text_gridz"] ?? null);
            echo "</option>
                ";
        }
        // line 221
        echo "                
              </select>
            </div>
          </div>
          
          
          \t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 228
        echo ($context["entry_carousel"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 230
        if (($context["carousel"] ?? null)) {
            // line 231
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" checked=\"checked\" /><span>";
            // line 232
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 234
            echo "            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"carousel_select\" name=\"carousel\" value=\"1\" /><span>";
            // line 235
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 237
        echo "            </div>                   
            </div>
          
           <div class=\"form-group carousel_field\" style=\"display:";
        // line 240
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\" for=\"input-carousel\">";
        // line 241
        echo ($context["entry_rows"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"rows\" value=\"";
        // line 243
        echo ($context["rows"] ?? null);
        echo "\"  id=\"input-rows\" class=\"form-control\" />
            </div>
          </div>
          
          
          \t<div class=\"form-group carousel_field\" style=\"display:";
        // line 248
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 249
        echo ($context["entry_carousel_a"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 251
        if (($context["carousel_a"] ?? null)) {
            // line 252
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" checked=\"checked\" /><span>";
            // line 253
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 255
            echo "            <label><input type=\"radio\" name=\"carousel_a\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_a\" value=\"1\" /><span>";
            // line 256
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 258
        echo "            </div>                   
            </div>
          
            <div class=\"form-group carousel_field\" style=\"display:";
        // line 261
        if (($context["carousel"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 262
        echo ($context["entry_carousel_b"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 264
        if (($context["carousel_b"] ?? null)) {
            // line 265
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" checked=\"checked\" /><span>";
            // line 266
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 268
            echo "            <label><input type=\"radio\" name=\"carousel_b\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"carousel_b\" value=\"1\" /><span>";
            // line 269
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 271
        echo "            </div>                   
            </div>
          

          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"";
        // line 277
        echo ($context["entry_countdown_h"] ?? null);
        echo "\">";
        echo ($context["entry_countdown"] ?? null);
        echo "</span></label>
            <div class=\"col-sm-10 toggle-btn\">
\t\t\t";
        // line 279
        if (($context["countdown"] ?? null)) {
            // line 280
            echo "            <label><input type=\"radio\" name=\"countdown\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"countdown\" value=\"1\" checked=\"checked\" /><span>";
            // line 281
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 283
            echo "            <label><input type=\"radio\" name=\"countdown\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" name=\"countdown\" value=\"1\" /><span>";
            // line 284
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 286
        echo "            </div>                   
            </div>
            
            
            <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 291
        echo ($context["text_use_button"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 293
        if (($context["use_button"] ?? null)) {
            // line 294
            echo "            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"1\" checked=\"checked\" /><span>";
            // line 295
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 297
            echo "            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"button_select\" name=\"use_button\" value=\"1\" /><span>";
            // line 298
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 300
        echo "            </div>                   
            </div>

            <div class=\"form-group button_field\" style=\"display:";
        // line 303
        if (($context["use_button"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 304
        echo ($context["entry_link_title"] ?? null);
        echo "</label>
                <div class=\"col-sm-10\">
                ";
        // line 306
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 307
            echo "                <div class=\"input-group\">
                <span class=\"input-group-addon\"><img src=\"language/";
            // line 308
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 308);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 308);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 308);
            echo "\" /></span>
                 <input type=\"text\" name=\"link_title[";
            // line 309
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 309);
            echo "]\" value=\"";
            echo (((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["link_title"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 309)] ?? null) : null)) ? ((($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["link_title"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 309)] ?? null) : null)) : (""));
            echo "\" class=\"form-control\"/>
                 </div>
                 ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 312
        echo "                </div>
            </div>
            
            <div class=\"form-group button_field\" style=\"display:";
        // line 315
        if (($context["use_button"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 316
        echo ($context["entry_link_href"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"link_href\" value=\"";
        // line 318
        echo ($context["link_href"] ?? null);
        echo "\" class=\"form-control\" />
            </div>
          </div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\">";
        // line 323
        echo ($context["text_use_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10 toggle-btn\">
            ";
        // line 325
        if (($context["use_margin"] ?? null)) {
            // line 326
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" checked=\"checked\" /><span>";
            // line 327
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        } else {
            // line 329
            echo "            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"0\" checked=\"checked\" /><span>";
            echo ($context["text_disabled"] ?? null);
            echo "</span></label>
            <label><input type=\"radio\" class=\"margin_select\" name=\"use_margin\" value=\"1\" /><span>";
            // line 330
            echo ($context["text_enabled"] ?? null);
            echo "</span></label>
            ";
        }
        // line 332
        echo "            </div>                   
            </div>
          
          <div class=\"form-group margin_field\" style=\"display:";
        // line 335
        if (($context["use_margin"] ?? null)) {
            echo "block";
        } else {
            echo "none";
        }
        echo "\">
            <label class=\"col-sm-2 control-label\">";
        // line 336
        echo ($context["text_margin"] ?? null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"margin\" value=\"";
        // line 338
        echo ($context["margin"] ?? null);
        echo "\" class=\"form-control\" />
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>

<script type=\"text/javascript\">
\$('.title_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.title_field').css('display', 'block');
\t} else {
\t\t\$('.title_field').css('display', 'none');
\t}
});
\$('.carousel_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.carousel_field').css('display', 'block');
\t} else {
\t\t\$('.carousel_field').css('display', 'none');
\t}
});
\$('.button_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.button_field').css('display', 'block');
\t} else {
\t\t\$('.button_field').css('display', 'none');
\t}
});
\$('.margin_select').on('change', function() {
  \tif (\$(this).val() == '1') {
\t\t\$('.margin_field').css('display', 'block');
\t} else {
\t\t\$('.margin_field').css('display', 'none');
\t}
});
</script>
<style>
.toggle-btn {
\tfont-size:0;
}
.toggle-btn label {
\tmargin-bottom:0px;
}
.toggle-btn input[type=\"radio\"] {
\tdisplay:none;
}
.toggle-btn span {
\tfont-size:12px;
\tbackground:#f5f5f5;
\tfont-weight:normal;
\tcursor:pointer;
\tpadding:8px 12px;
\tdisplay:inline-block;
\tbackground:#fafafa;
   color:#666666;
    -webkit-box-shadow: inset 0 1px 4px rgba(41, 41, 41, 0.15);
    -moz-box-shadow: inset 0 1px 4px 0 rgba(41, 41, 41, 0.15);
    box-shadow: inset 0 1px 4px rgba(41, 41, 41, 0.15);
\t-webkit-text-shadow:1px 1px 0 #ffffff;
\t-moz-text-shadow:1px 1px 0 #ffffff;
\ttext-shadow:1px 1px 0 #ffffff;
}
.toggle-btn label:first-child span {
\tborder-radius:3px 0 0 3px
}
.toggle-btn label:last-child span {
\tborder-radius:0 3px 3px 0;
}
.toggle-btn input[type=\"radio\"]:checked + span {
   background:#1e91cf;
   color:#ffffff;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
\t-webkit-text-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
\t-moz-text-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
\ttext-shadow:1px 1px 0 rgba(0, 0, 0, 0.3);
}
.toggle-btn label:first-child input[type=\"radio\"]:checked + span {
   background:#9f9f9f;
}
.title_field, .carousel_field, .button_field, .margin_field {
\tbackground:#fafafa;
}
</style>
</div>
";
        // line 427
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "extension/module/basel_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1046 => 427,  954 => 338,  949 => 336,  941 => 335,  936 => 332,  931 => 330,  926 => 329,  921 => 327,  916 => 326,  914 => 325,  909 => 323,  901 => 318,  896 => 316,  888 => 315,  883 => 312,  872 => 309,  864 => 308,  861 => 307,  857 => 306,  852 => 304,  844 => 303,  839 => 300,  834 => 298,  829 => 297,  824 => 295,  819 => 294,  817 => 293,  812 => 291,  805 => 286,  800 => 284,  795 => 283,  790 => 281,  785 => 280,  783 => 279,  776 => 277,  768 => 271,  763 => 269,  758 => 268,  753 => 266,  748 => 265,  746 => 264,  741 => 262,  733 => 261,  728 => 258,  723 => 256,  718 => 255,  713 => 253,  708 => 252,  706 => 251,  701 => 249,  693 => 248,  685 => 243,  680 => 241,  672 => 240,  667 => 237,  662 => 235,  657 => 234,  652 => 232,  647 => 231,  645 => 230,  640 => 228,  631 => 221,  625 => 219,  619 => 217,  617 => 216,  614 => 215,  608 => 213,  602 => 211,  600 => 210,  597 => 209,  591 => 207,  585 => 205,  583 => 204,  580 => 203,  574 => 201,  568 => 199,  566 => 198,  563 => 197,  557 => 195,  551 => 193,  549 => 192,  546 => 191,  540 => 189,  534 => 187,  532 => 186,  524 => 181,  517 => 177,  512 => 175,  505 => 171,  500 => 169,  493 => 165,  486 => 163,  477 => 156,  471 => 154,  465 => 152,  463 => 151,  460 => 150,  454 => 148,  448 => 146,  446 => 145,  443 => 144,  437 => 142,  431 => 140,  429 => 139,  420 => 135,  409 => 129,  405 => 127,  399 => 126,  394 => 124,  389 => 123,  384 => 121,  379 => 120,  376 => 119,  372 => 118,  364 => 115,  357 => 110,  346 => 107,  338 => 106,  335 => 105,  331 => 104,  326 => 102,  318 => 101,  313 => 98,  302 => 95,  294 => 94,  291 => 93,  287 => 92,  282 => 90,  274 => 89,  269 => 86,  258 => 83,  250 => 82,  247 => 81,  243 => 80,  238 => 78,  230 => 77,  225 => 74,  220 => 72,  215 => 71,  210 => 69,  205 => 68,  203 => 67,  198 => 65,  192 => 61,  187 => 59,  182 => 58,  177 => 56,  172 => 55,  170 => 54,  165 => 52,  159 => 48,  154 => 46,  149 => 45,  144 => 43,  139 => 42,  137 => 41,  132 => 39,  126 => 35,  120 => 33,  118 => 32,  112 => 31,  107 => 29,  102 => 27,  96 => 24,  92 => 22,  84 => 18,  82 => 17,  76 => 13,  65 => 11,  61 => 10,  56 => 8,  50 => 7,  46 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/module/basel_products.twig", "");
    }
}
