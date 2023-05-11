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

/* extension/basel/panel_tabs/footer.twig */
class __TwigTemplate_849b23c4a37d8b79f7881851c47ba638b0ffba90e0a1f6d3651f3648a8120acd extends \Twig\Template
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
        echo "<legend>Footer</legend>

<legend class=\"sub\">Footer Custom Block (top)</legend>
<ul class=\"nav nav-tabs language-tabs\">
";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 6
            echo "<li><a href=\"#footer-block1";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 6);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 6);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 6);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 6);
            echo "</a></li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</ul>
<div class=\"tab-content\">
";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 11
            echo "<div class=\"tab-pane\" id=\"footer-block1";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 11);
            echo "\">
  <div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Custom block which will take place above the footer links\">Footer custom block (top)</span><br /><a class=\"editor-toggle\" id=\"enable-editor-footer1-";
            // line 13
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 13);
            echo "\" onclick=\"enable_editor('footer1','";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 13);
            echo "')\">Enable HTML editor</a></label>
    <div class=\"col-sm-10\">
      <textarea id=\"editor-textarea-footer1-";
            // line 15
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 15);
            echo "\" name=\"settings[basel][footer_block_1][";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 15);
            echo "]\" class=\"form-control code\">";
            echo (((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["footer_block_1"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 15)] ?? null) : null)) ? ((($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["footer_block_1"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 15)] ?? null) : null)) : (""));
            echo "</textarea>
    </div>
  </div>
 </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "</div>

          
<legend class=\"sub\">Footer Links</legend>
<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Enable to use custom footer links instead of the default ones in Opencart\">Overwrite default links</span></label>
    <div class=\"col-sm-10 toggle-btn\">
    <label><input type=\"radio\" name=\"settings[basel][overwrite_footer_links]\" class=\"footer-custom-links-select\" value=\"0\" ";
        // line 27
        if ((($context["overwrite_footer_links"] ?? null) == "0")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Disabled</span></label>
    <label><input type=\"radio\" name=\"settings[basel][overwrite_footer_links]\" class=\"footer-custom-links-select\" value=\"1\" ";
        // line 28
        if ((($context["overwrite_footer_links"] ?? null) == "1")) {
            echo " checked=\"checked\"";
        }
        echo " /><span>Enabled</span></label>
    </div>                   
</div>


<div id=\"custom_footer_links_holder\"";
        // line 33
        if (($context["overwrite_footer_links"] ?? null)) {
            echo " style=\"display:block\"";
        } else {
            echo " style=\"display:none\"";
        }
        echo ">
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"></label>
<div class=\"col-sm-10\">
<ul class=\"nav content-tabs\" id=\"footer-column-tabs\">
    ";
        // line 38
        $context["footer_column_row"] = 1;
        // line 39
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["basel_footer_columns"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["basel_footer_column"]) {
            // line 40
            echo "    <li><a href=\"#footer-column-";
            echo ($context["footer_column_row"] ?? null);
            echo "\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\"\$('a[href=\\'#footer-column-";
            echo ($context["footer_column_row"] ?? null);
            echo "\\']').parent().remove(); \$('#footer-column-";
            echo ($context["footer_column_row"] ?? null);
            echo "').remove(); \$('#footer-column-tabs a:first').tab('show');\"></i> Column ";
            echo ($context["footer_column_row"] ?? null);
            echo "</a></li>
    ";
            // line 41
            $context["footer_column_row"] = (($context["footer_column_row"] ?? null) + 1);
            // line 42
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_footer_column'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "    <li id=\"column-add\" style=\"cursor:pointer;\"><a onclick=\"addFooterColumn();\"><i class=\"fa fa-plus-circle\"></i> Add Column</a></li> 
</ul>
<div class=\"tab-content\" id=\"footer-columns-holder\">
";
        // line 46
        $context["footer_column_row"] = 1;
        // line 47
        if (array_key_exists("basel_footer_columns", $context)) {
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_footer_columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["basel_footer_column"]) {
                // line 49
                echo "<div class=\"tab-pane\" id=\"footer-column-";
                echo ($context["footer_column_row"] ?? null);
                echo "\">
<div class=\"tab-content\">
<table class=\"table table-clean table-footer-column\">
<thead>
  <tr>
    <td width=\"96%\"><h4>Column Heading</h4></td>
    <td width=\"4%\">Sort Order</td>
  </tr>
</thead>
<tbody>
  <tr id=\"column-row";
                // line 59
                echo ($context["footer_column_row"] ?? null);
                echo "\">
    <td class=\"first\">
    ";
                // line 61
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                    // line 62
                    echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\"><img src=\"language/";
                    // line 63
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 63);
                    echo "/";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 63);
                    echo ".png\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 63);
                    echo "\" /></span>
    <input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_footer_columns][";
                    // line 64
                    echo ($context["footer_column_row"] ?? null);
                    echo "][title][";
                    echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64);
                    echo "]\" value=\"";
                    echo (((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "title", [], "any", false, false, false, 64)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64)] ?? null) : null)) ? ((($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "title", [], "any", false, false, false, 64)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 64)] ?? null) : null)) : (""));
                    echo "\" />
    </div>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 67
                echo "    </td>
    <td class=\"text-right\">
    <input type=\"text\" class=\"form-control\" style=\"width:60px\" name=\"settings[basel][basel_footer_columns][";
                // line 69
                echo ($context["footer_column_row"] ?? null);
                echo "][sort]\" value=\"";
                echo ((twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "sort", [], "any", false, false, false, 69)) ? (twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "sort", [], "any", false, false, false, 69)) : ("99"));
                echo "\" />
    </td>
  </tr>
</tbody>
</table>
<table id=\"links-holder-";
                // line 74
                echo ($context["footer_column_row"] ?? null);
                echo "\" class=\"table table-clean\">
    <thead>
      <tr>
        <td width=\"48%\"><h4>Column Links</h4></td>
        <td width=\"48%\"><span data-toggle=\"tooltip\" title=\"Include http:// when linking to external targets\">Link Target</span></td>
        <td width=\"4%\"><span style=\"white-space:nowrap\">Sort Order</span></td>
      </tr>
    </thead>
    <tbody>
    <tr></tr>
    ";
                // line 84
                $context["footer_link_row"] = 1;
                // line 85
                echo "\t";
                if (twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "links", [], "any", true, true, false, 85)) {
                    // line 86
                    echo "\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["basel_footer_column"], "links", [], "any", false, false, false, 86));
                    foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                        // line 87
                        echo "    <tr id=\"footer-link-row-";
                        echo ($context["footer_column_row"] ?? null);
                        echo "-";
                        echo ($context["footer_link_row"] ?? null);
                        echo "\">
    <td class=\"first\">
    ";
                        // line 89
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
                            // line 90
                            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\"><img src=\"language/";
                            // line 91
                            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 91);
                            echo "/";
                            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 91);
                            echo ".png\" title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 91);
                            echo "\" /></span>
    <input class=\"form-control\" name=\"settings[basel][basel_footer_columns][";
                            // line 92
                            echo ($context["footer_column_row"] ?? null);
                            echo "][links][";
                            echo ($context["footer_link_row"] ?? null);
                            echo "][title][";
                            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 92);
                            echo "]\" value=\"";
                            echo (((($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = twig_get_attribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 92)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 92)] ?? null) : null)) ? ((($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = twig_get_attribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 92)) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 92)] ?? null) : null)) : (""));
                            echo "\" />
    </div>
    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 95
                        echo "    </td>
    <td class=\"first\">
    <input class=\"form-control\" name=\"settings[basel][basel_footer_columns][";
                        // line 97
                        echo ($context["footer_column_row"] ?? null);
                        echo "][links][";
                        echo ($context["footer_link_row"] ?? null);
                        echo "][target]\" value=\"";
                        echo ((twig_get_attribute($this->env, $this->source, $context["link"], "target", [], "any", false, false, false, 97)) ? (twig_get_attribute($this->env, $this->source, $context["link"], "target", [], "any", false, false, false, 97)) : (""));
                        echo "\" />
    </td>
    <td class=\"first\">
    <input type=\"text\" class=\"form-control\" style=\"width:60px\" name=\"settings[basel][basel_footer_columns][";
                        // line 100
                        echo ($context["footer_column_row"] ?? null);
                        echo "][links][";
                        echo ($context["footer_link_row"] ?? null);
                        echo "][sort]\" value=\"";
                        echo ((twig_get_attribute($this->env, $this->source, $context["link"], "sort", [], "any", false, false, false, 100)) ? (twig_get_attribute($this->env, $this->source, $context["link"], "sort", [], "any", false, false, false, 100)) : ("1"));
                        echo "\" />
    </td>
    <td class=\"text-right\">
    <button type=\"button\" onclick=\"\$('#footer-link-row-";
                        // line 103
                        echo ($context["footer_column_row"] ?? null);
                        echo "-";
                        echo ($context["footer_link_row"] ?? null);
                        echo "').remove();\" class=\"btn btn-danger\">Remove</button>
    </td>
    </tr>
";
                        // line 106
                        $context["footer_link_row"] = (($context["footer_link_row"] ?? null) + 1);
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 107
                    echo " <!-- foreach groups ends -->
";
                }
                // line 109
                echo "</tbody>
    <tfoot>
      <tr>
        <td colspan=\"3\"></td>
        <td class=\"text-right\"><button type=\"button\" onclick=\"addFooterLink(";
                // line 113
                echo ($context["footer_column_row"] ?? null);
                echo ");\" class=\"btn btn-primary\">Add Link</button></td>
      </tr>
    </tfoot>
  </table>
</div>
</div> <!-- #footer-columns--->
";
                // line 119
                $context["footer_column_row"] = (($context["footer_column_row"] ?? null) + 1);
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['basel_footer_column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 122
        echo "</div>  <!-- #footer-columns-holder-->
</div>                
</div>
</div>

<legend class=\"sub\">Footer Custom Block (right)</legend>
<ul class=\"nav nav-tabs language-tabs\">
";
        // line 129
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 130
            echo "<li><a href=\"#footer-block2-language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 130);
            echo "\" data-toggle=\"tab\"><img src=\"language/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 130);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 130);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 130);
            echo "\" /> ";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 130);
            echo "</a></li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "</ul>
<div class=\"tab-content\">
";
        // line 134
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 135
            echo "<div class=\"tab-pane\" id=\"footer-block2-language";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 135);
            echo "\">

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\">Heading</label>
<div class=\"col-sm-10\">
  <input class=\"form-control\" name=\"settings[basel][footer_block_title][";
            // line 140
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 140);
            echo "]\" value=\"";
            echo (((($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e = ($context["footer_block_title"] ?? null)) && is_array($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e) || $__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e instanceof ArrayAccess ? ($__internal_01c35b74bd85735098add188b3f8372ba465b232ab8298cb582c60f493d3c22e[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 140)] ?? null) : null)) ? ((($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 = ($context["footer_block_title"] ?? null)) && is_array($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52) || $__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52 instanceof ArrayAccess ? ($__internal_63ad1f9a2bf4db4af64b010785e9665558fdcac0e8db8b5b413ed986c62dbb52[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 140)] ?? null) : null)) : (""));
            echo "\" />
</div>
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Custom block which will take place as a column right by the footer links\">Footer custom block (top)</span><br /><a class=\"editor-toggle\" id=\"enable-editor-footer2-";
            // line 145
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 145);
            echo "\" onclick=\"enable_editor('footer2','";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 145);
            echo "')\">Enable HTML editor</a></label>
<div class=\"col-sm-10\">
  <textarea id=\"editor-textarea-footer2-";
            // line 147
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 147);
            echo "\" name=\"settings[basel][footer_block_2][";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 147);
            echo "]\" class=\"form-control code\">";
            echo (((($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 = ($context["footer_block_2"] ?? null)) && is_array($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136) || $__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136 instanceof ArrayAccess ? ($__internal_f10a4cc339617934220127f034125576ed229e948660ebac906a15846d52f136[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 147)] ?? null) : null)) ? ((($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 = ($context["footer_block_2"] ?? null)) && is_array($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386) || $__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386 instanceof ArrayAccess ? ($__internal_887a873a4dc3cf8bd4f99c487b4c7727999c350cc3a772414714e49a195e4386[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 147)] ?? null) : null)) : (""));
            echo "</textarea>
</div>
</div>

<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Contact detail lines will take place below the custom block\">Contact details</span></label>
<div class=\"col-sm-10\">
  <input class=\"form-control\" name=\"settings[basel][footer_infoline_1][";
            // line 154
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154);
            echo "]\" value=\"";
            echo (((($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 = ($context["footer_infoline_1"] ?? null)) && is_array($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9) || $__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9 instanceof ArrayAccess ? ($__internal_d527c24a729d38501d770b40a0d25e1ce8a7f0bff897cc4f8f449ba71fcff3d9[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154)] ?? null) : null)) ? ((($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae = ($context["footer_infoline_1"] ?? null)) && is_array($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae) || $__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae instanceof ArrayAccess ? ($__internal_f6dde3a1020453fdf35e718e94f93ce8eb8803b28cc77a665308e14bbe8572ae[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 154)] ?? null) : null)) : (""));
            echo "\" />
  <input class=\"form-control\" name=\"settings[basel][footer_infoline_2][";
            // line 155
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 155);
            echo "]\" value=\"";
            echo (((($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f = ($context["footer_infoline_2"] ?? null)) && is_array($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f) || $__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f instanceof ArrayAccess ? ($__internal_25c0fab8152b8dd6b90603159c0f2e8a936a09ab76edb5e4d7bc95d9a8d2dc8f[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 155)] ?? null) : null)) ? ((($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 = ($context["footer_infoline_2"] ?? null)) && is_array($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40) || $__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40 instanceof ArrayAccess ? ($__internal_f769f712f3484f00110c86425acea59f5af2752239e2e8596bcb6effeb425b40[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 155)] ?? null) : null)) : (""));
            echo "\" />
  <input class=\"form-control\" name=\"settings[basel][footer_infoline_3][";
            // line 156
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 156);
            echo "]\" value=\"";
            echo (((($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f = ($context["footer_infoline_3"] ?? null)) && is_array($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f) || $__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f instanceof ArrayAccess ? ($__internal_98e944456c0f58b2585e4aa36e3a7e43f4b7c9038088f0f056004af41f4a007f[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 156)] ?? null) : null)) ? ((($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 = ($context["footer_infoline_3"] ?? null)) && is_array($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760) || $__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760 instanceof ArrayAccess ? ($__internal_a06a70691a7ca361709a372174fa669f5ee1c1e4ed302b3a5b61c10c80c02760[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 156)] ?? null) : null)) : (""));
            echo "\" />
</div>
</div>
  
 </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 162
        echo "</div>

<div class=\"form-group\">
    <label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"If an image is uploaded, it will take place below the contact details\">Payment icons</span></label>
    <div class=\"col-sm-10\">
    <a href=\"\" id=\"thumb-payment-img\" data-toggle=\"image\" class=\"img-thumbnail\"><img src=\"";
        // line 167
        echo ($context["payment_thumb"] ?? null);
        echo "\" alt=\"\" title=\"\" data-placeholder=\"";
        echo ($context["placeholder"] ?? null);
        echo "\" /></a>
    <input type=\"hidden\" name=\"settings[basel][basel_payment_img]\" value=\"";
        // line 168
        echo ($context["basel_payment_img"] ?? null);
        echo "\" id=\"input-payment-img\" />
    </div>                   
</div>


<legend class=\"sub\">Footer Copyright Text</legend>
<div class=\"form-group\">
<label class=\"col-sm-2 control-label\"><span data-toggle=\"tooltip\" title=\"Use {year} to add the current year\">Footer Copyright Text</span></label>
    <div class=\"col-sm-10\">
    ";
        // line 177
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 178
            echo "    <div class=\"input-group\">
    <span class=\"input-group-addon\">
    <img src=\"language/";
            // line 180
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 180);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 180);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 180);
            echo "\" /></span>
    <input class=\"form-control\" name=\"settings[basel][basel_copyright][";
            // line 181
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 181);
            echo "]\" value=\"";
            echo (((($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce = ($context["basel_copyright"] ?? null)) && is_array($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce) || $__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce instanceof ArrayAccess ? ($__internal_653499042eb14fd8415489ba6fa87c1e85cff03392e9f57b26d0da09b9be82ce[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 181)] ?? null) : null)) ? ((($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b = ($context["basel_copyright"] ?? null)) && is_array($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b) || $__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b instanceof ArrayAccess ? ($__internal_ba9f0a3bb95c082f61c9fbf892a05514d732703d52edc77b51f2e6284135900b[twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 181)] ?? null) : null)) : (""));
            echo "\" />
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 184
        echo "    </div>
</div>

<script type=\"text/javascript\"><!--
\$('#footer-column-tabs a:first').tab('show');
var footer_column_row = ";
        // line 189
        echo ($context["footer_column_row"] ?? null);
        echo ";
function addFooterColumn() {
\thtml = '<div class=\"tab-pane\" id=\"footer-column-' + footer_column_row + '\">';
\thtml += '<div class=\"tab-content\">';
\thtml += '<table id=\"footer_column-' + footer_column_row + '\" class=\"table table-clean table-footer-column\">';
\thtml += '<thead>';
\thtml += '<tr>';
\thtml += '<td width=\"96%\"><h4>Column Heading</h4></td>';
\thtml += '<td width=\"4%\">Sort Order</td>';
\thtml += '</tr>';
\thtml += '</thead>';
\thtml += '<tbody>';
   \thtml += '<tr id=\"link-row' + footer_column_row + '\">';
\thtml += '<td class=\"first\">';
\t";
        // line 203
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 204
            echo "\thtml += '<div class=\"input-group\">';
\thtml += '<span class=\"input-group-addon\"><img src=\"language/";
            // line 205
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 205);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 205);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 205);
            echo "\" /></span>';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_footer_columns][' + footer_column_row + '][title][";
            // line 206
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 206);
            echo "]\" />';
\thtml += '</div>';
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        echo "\thtml += '</td>';
\thtml += '<td class=\"text-right\">';
\thtml += '<input type=\"text\" class=\"form-control\" style=\"width:60px\" value=\"' + footer_column_row + '\" name=\"settings[basel][basel_footer_columns][' + footer_column_row + '][sort]\" />';
\thtml += '</td>';
\thtml += '</tr>';
\thtml += '</tbody>';
\thtml += '</table>';
\thtml += '<table id=\"links-holder-' + footer_column_row  + '\" class=\"table table-clean\">';
    html += '<thead>';
\thtml += '<tr><td width=\"48%\"><h4>Column Links</h4></td>';
\thtml += '<td width=\"48%\"><span data-toggle=\"tooltip\" title=\"Include http:// when linking to external targets\">Link Target</span></td>';
\thtml += '<td width=\"4%\"><span style=\"white-space:nowrap\">Sort Order</span></td></tr>';
\thtml += '</thead>';
\thtml += '<tbody>';
\thtml += '<tr></tr>';
\thtml += '</tbody>';
\thtml += '<tfoot>';
\thtml += '<tr>';
\thtml += '<td colspan=\"3\"></td>';
\thtml += '<td class=\"text-right\"><button type=\"button\" onclick=\"addFooterLink(' + footer_column_row  + ');\" class=\"btn btn-primary\">Add Link</button></td>';
\thtml += '</tr>';
\thtml += '</tfoot>';
\thtml += '</table>';
\thtml += '</div>';
\thtml += '</div>';
\t\$('#footer-columns-holder').append(html);
\t\$('#column-add').before('<li><a href=\"#footer-column-' + footer_column_row + '\" data-toggle=\"tab\"><i class=\"fa fa-minus-circle\" onclick=\"\$(\\'a[href=\\\\\\'#footer-column-' + footer_column_row + '\\\\\\']\\').parent().remove(); \$(\\'#footer-column-' + footer_column_row + '\\').remove(); \$(\\'#footer-column-tabs a:first\\').tab(\\'show\\');\"></i> Column ' + footer_column_row + '</a></li>');
\t\$('#footer-column-tabs a[href=\\'#footer-column-' + footer_column_row + '\\']').tab('show');
\tfooter_column_row++;
\t\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
}
//--></script>

<script type=\"text/javascript\"><!--
function addFooterLink(footer_column_row) {
\tlink_row = \$('#links-holder-' + footer_column_row + ' tbody tr').length;
\thtml = '<tr id=\"footer-link-row-' + footer_column_row + '-' + link_row + '\">';
\thtml += '<td class=\"first\">';
\t";
        // line 247
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languages"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 248
            echo "\thtml += '<div class=\"input-group\">';
\thtml += '<span class=\"input-group-addon\"><img src=\"language/";
            // line 249
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 249);
            echo "/";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "code", [], "any", false, false, false, 249);
            echo ".png\" title=\"";
            echo twig_get_attribute($this->env, $this->source, $context["language"], "name", [], "any", false, false, false, 249);
            echo "\" /></span>';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_footer_columns][' + footer_column_row + '][links][' + link_row + '][title][";
            // line 250
            echo twig_get_attribute($this->env, $this->source, $context["language"], "language_id", [], "any", false, false, false, 250);
            echo "]\" />';
\thtml += '</div>';
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 253
        echo "\thtml += '</td>';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" class=\"form-control\" name=\"settings[basel][basel_footer_columns][' + footer_column_row + '][links][' + link_row + '][target]\" />';
\thtml += '</td>';
\thtml += '<td class=\"first\">';
\thtml += '<input type=\"text\" style=\"width:60px\" class=\"form-control\" name=\"settings[basel][basel_footer_columns][' + footer_column_row + '][links][' + link_row + '][sort]\" value=\"' + link_row + '\" />';
\thtml += '</td>';
\thtml += '<td class=\"text-right\">';
\thtml += '<button type=\"button\" onclick=\"\$(\\'#footer-link-row-' + footer_column_row  + '-' + link_row + '\\').remove();\" class=\"btn btn-danger\">Remove</button>';
\thtml += '</td>';
   \thtml += '</tr>';
\t\$('#links-holder-' + footer_column_row + ' tbody').append(html);
\tlink_row++;
}
//--></script>";
    }

    public function getTemplateName()
    {
        return "extension/basel/panel_tabs/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  630 => 253,  621 => 250,  613 => 249,  610 => 248,  606 => 247,  566 => 209,  557 => 206,  549 => 205,  546 => 204,  542 => 203,  525 => 189,  518 => 184,  507 => 181,  499 => 180,  495 => 178,  491 => 177,  479 => 168,  473 => 167,  466 => 162,  452 => 156,  446 => 155,  440 => 154,  426 => 147,  419 => 145,  409 => 140,  400 => 135,  396 => 134,  392 => 132,  375 => 130,  371 => 129,  362 => 122,  355 => 119,  346 => 113,  340 => 109,  336 => 107,  330 => 106,  322 => 103,  312 => 100,  302 => 97,  298 => 95,  283 => 92,  275 => 91,  272 => 90,  268 => 89,  260 => 87,  255 => 86,  252 => 85,  250 => 84,  237 => 74,  227 => 69,  223 => 67,  210 => 64,  202 => 63,  199 => 62,  195 => 61,  190 => 59,  176 => 49,  172 => 48,  170 => 47,  168 => 46,  163 => 43,  157 => 42,  155 => 41,  144 => 40,  139 => 39,  137 => 38,  125 => 33,  115 => 28,  109 => 27,  100 => 20,  85 => 15,  78 => 13,  72 => 11,  68 => 10,  64 => 8,  47 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "extension/basel/panel_tabs/footer.twig", "/home/herrera/public_html/upload/admin/view/template/extension/basel/panel_tabs/footer.twig");
    }
}
