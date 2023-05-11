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

/* basel/template/information/contact.twig */
class __TwigTemplate_3e7e633c731b49e7a70d6e3932ab3f2b72b05c99702c1d16f5580d58a4d7ea48 extends \Twig\Template
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

";
        // line 3
        if (((($context["basel_map_lat"] ?? null) && ($context["basel_map_lon"] ?? null)) && (($context["basel_map_style"] ?? null) == "full_width"))) {
            // line 4
            echo "<div id=\"gmap\" class=\"map-full-width\">
    <div class=\"address-holder col-sm-5 col-md-4 col-lg-3\">
    <h3 class=\"contrast-heading\">";
            // line 6
            echo ($context["store"] ?? null);
            echo "</h3>
    <p>";
            // line 7
            echo ($context["address"] ?? null);
            echo "</p>
    <a class=\"uline_link to_form\">";
            // line 8
            echo ($context["heading_title"] ?? null);
            echo "</a>
    </div>
</div>
";
        }
        // line 12
        echo "    
    <div class=\"container\">
    
        <ul class=\"breadcrumb\">
        ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 17
            echo "        <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 17);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 17);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "        </ul>
  
  <div class=\"row\">
  
    ";
        // line 23
        if (((($context["basel_map_lat"] ?? null) && ($context["basel_map_lon"] ?? null)) && (($context["basel_map_style"] ?? null) == "inline"))) {
            // line 24
            echo "    <div id=\"gmap\" class=\"col-sm-12 map-inline\"></div>
    ";
        }
        // line 26
        echo "  
  ";
        // line 27
        echo ($context["column_left"] ?? null);
        echo "
    
    ";
        // line 29
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 30
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 31
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 32
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 33
            echo "    ";
        } else {
            // line 34
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 35
            echo "    ";
        }
        // line 36
        echo "    
    <div id=\"content\" class=\"";
        // line 37
        echo ($context["class"] ?? null);
        echo "\">
    ";
        // line 38
        echo ($context["content_top"] ?? null);
        echo "
      <h1 id=\"page-title\">";
        // line 39
        echo ($context["heading_title"] ?? null);
        echo "</h1>
      
      <div class=\"row\">
        
      <div class=\"col-sm-6 left-side\">
      \t<h3 class=\"lined-title lg margin-b35\"><span>";
        // line 44
        echo ($context["text_contact"] ?? null);
        echo "</span></h3>
        <form action=\"";
        // line 45
        echo ($context["action"] ?? null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" class=\"form-vertical\">

        <div class=\"row\">
        
        <div class=\"form-group col-sm-12 required\">
        <label for=\"input-name\">";
        // line 50
        echo ($context["entry_name"] ?? null);
        echo "</label>
        <input type=\"text\" name=\"name\" value=\"";
        // line 51
        echo ($context["name"] ?? null);
        echo "\" id=\"input-name\" class=\"form-control\" />
        ";
        // line 52
        if (($context["error_name"] ?? null)) {
            // line 53
            echo "        <div class=\"text-danger\">";
            echo ($context["error_name"] ?? null);
            echo "</div>
        ";
        }
        // line 55
        echo "        </div>
        
        <div class=\"form-group col-sm-12 required\">
        <label for=\"input-email\">";
        // line 58
        echo ($context["entry_email"] ?? null);
        echo "</label>
        <input type=\"text\" name=\"email\" value=\"";
        // line 59
        echo ($context["email"] ?? null);
        echo "\" id=\"input-email\" class=\"form-control\" />
        ";
        // line 60
        if (($context["error_email"] ?? null)) {
            // line 61
            echo "        <div class=\"text-danger\">";
            echo ($context["error_email"] ?? null);
            echo "</div>
        ";
        }
        // line 63
        echo "        </div>


        <div class=\"form-group col-sm-12 required\">
                <label for=\"input-email\">Telefon za kontakt</label>
                <input type=\"text\" name=\"telefon\" value=\"";
        // line 68
        echo ($context["telefon"] ?? null);
        echo "\" id=\"input-telefon\" class=\"form-control\" />
                ";
        // line 69
        if (($context["error_telefon"] ?? null)) {
            // line 70
            echo "                    <div class=\"text-danger\">";
            echo ($context["error_telefon"] ?? null);
            echo "</div>
                ";
        }
        // line 72
        echo "        </div>
        
        </div>

        
        <div class=\"form-group required\">
        <label for=\"input-enquiry\">";
        // line 78
        echo ($context["entry_enquiry"] ?? null);
        echo "</label>
        <textarea name=\"enquiry\" rows=\"10\" id=\"input-enquiry\" class=\"form-control\">";
        // line 79
        echo ($context["enquiry"] ?? null);
        echo "</textarea>
        ";
        // line 80
        if (($context["error_enquiry"] ?? null)) {
            // line 81
            echo "        <div class=\"text-danger\">";
            echo ($context["error_enquiry"] ?? null);
            echo "</div>
        ";
        }
        // line 83
        echo "        </div>
\t\t
        ";
        // line 85
        echo ($context["captcha"] ?? null);
        echo "
        
        <div class=\"form-group margin-b50\">
        <input class=\"btn btn-contrast\" type=\"submit\" value=\"";
        // line 88
        echo ($context["button_submit"] ?? null);
        echo "\" />
        </div>
        


        </form>
      </div>
      
      <div class=\"col-sm-6 right-side\">
       <h3 class=\"lined-title lg margin-b30\"><span>";
        // line 97
        echo ($context["heading_title"] ?? null);
        echo "</span></h3>
       
   
           <div class=\"grid-holder margin-b20\">
           
           <div class=\"item\">
           <p class=\"contact-detail\">
   
           ";
        // line 105
        echo ($context["address"] ?? null);
        echo "
        
           </p>
           </div>

               ";
        // line 110
        if (($context["open"] ?? null)) {
            // line 111
            echo "                   <div class=\"item\">

                       <p class=\"contact-detail\">
                       
                           ";
            // line 115
            echo ($context["telephone"] ?? null);
            echo "
                     
                       </p>

                
                       <p class=\"contact-detail\" >
                    
                           ";
            // line 122
            echo ($context["open"] ?? null);
            echo "
                       </p>

                  
                   </div>
               ";
        }
        // line 128
        echo "
           
           </div>
           
        ";
        // line 132
        if (($context["comment"] ?? null)) {
            // line 133
            echo "        <div class=\"margin-b45\">
        <h3 class=\"lined-title lg margin-b20\"><span>";
            // line 134
            echo ($context["text_comment"] ?? null);
            echo "</span></h3>
        ";
            // line 135
            echo ($context["comment"] ?? null);
            echo "
        </div>
        ";
        }
        // line 137
        echo "        
        
        ";
        // line 139
        if (($context["locations"] ?? null)) {
            // line 140
            echo "      <h3 class=\"lined-title lg margin-b15\"><span><b>";
            echo ($context["text_store"] ?? null);
            echo "</b></span></h3>
      <div class=\"panel-group\" id=\"accordion\">
        ";
            // line 142
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["location"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["locations"]) {
                // line 143
                echo "        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h4 class=\"panel-title\"><a href=\"#collapse-location";
                // line 145
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "location_id", [], "any", false, false, false, 145);
                echo "\" class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#accordion\">";
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "name", [], "any", false, false, false, 145);
                echo " <i class=\"fa fa-caret-down\"></i></a></h4>
          </div>
          <div class=\"panel-collapse collapse\" id=\"collapse-location";
                // line 147
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "location_id", [], "any", false, false, false, 147);
                echo "\">
            <div class=\"panel-body\">
              
              
             
                
                ";
                // line 153
                if (twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "image", [], "any", false, false, false, 153)) {
                    // line 154
                    echo "                <div class=\"contact-image margin-b25\">
                <img src=\"";
                    // line 155
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "image", [], "any", false, false, false, 155);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "name", [], "any", false, false, false, 155);
                    echo "\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "name", [], "any", false, false, false, 155);
                    echo "\" />
                </div>
                ";
                }
                // line 158
                echo "                
                ";
                // line 159
                if (twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "comment", [], "any", false, false, false, 159)) {
                    // line 160
                    echo "                <b>";
                    echo ($context["text_comment"] ?? null);
                    echo "</b><br />
                ";
                    // line 161
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "comment", [], "any", false, false, false, 161);
                    echo "<br /><br /><br />
                ";
                }
                // line 163
                echo "                
                <div class=\"grid-holder margin-b20\">

                <div class=\"item\">
                <p class=\"contact-detail\">
                <i class=\"icon-cursor icon\"></i>
                ";
                // line 169
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "name", [], "any", false, false, false, 169);
                echo "<br />
                ";
                // line 170
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "address", [], "any", false, false, false, 170);
                echo "
                ";
                // line 171
                if (twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "geocode", [], "any", false, false, false, 171)) {
                    // line 172
                    echo "                <br /><a href=\"https://maps.google.com/maps?q=";
                    echo twig_urlencode_filter(twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "geocode", [], "any", false, false, false, 172));
                    echo "&hl=";
                    echo ($context["geocode_hl"] ?? null);
                    echo "&t=m&z=15\" target=\"_blank\" class=\"btn btn-info\"><i class=\"fa fa-map-marker\"></i> ";
                    echo ($context["button_map"] ?? null);
                    echo "</a>
                ";
                }
                // line 174
                echo "                </p>
                </div>
                
                <div class=\"item\">
                <p class=\"contact-detail\">
                <i class=\"icon-phone icon\"></i>
                ";
                // line 180
                echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "telephone", [], "any", false, false, false, 180);
                echo "
                ";
                // line 181
                if (twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "fax", [], "any", false, false, false, 181)) {
                    // line 182
                    echo "                <br />";
                    echo ($context["text_fax"] ?? null);
                    echo ": ";
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "fax", [], "any", false, false, false, 182);
                    echo "
                ";
                }
                // line 184
                echo "                </p>
                </div>
                
                ";
                // line 187
                if (twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "open", [], "any", false, false, false, 187)) {
                    // line 188
                    echo "                <div class=\"item\">
                <p class=\"contact-detail\">
                <i class=\"icon-clock icon\"></i>
                  ";
                    // line 191
                    echo twig_get_attribute($this->env, $this->source, ($context["location"] ?? null), "open", [], "any", false, false, false, 191);
                    echo "
                </p>
                </div>
                ";
                }
                // line 195
                echo "                
                
              </div>

            </div>
          </div>
        </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['locations'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 203
            echo "      </div>
      ";
        }
        // line 205
        echo "      
      
       
       
      </div> <!-- .col-sm-6 ends -->
      
      </div> <!-- .row ends -->
      
      
      
      
      
      ";
        // line 217
        echo ($context["content_bottom"] ?? null);
        echo "</div>
    ";
        // line 218
        echo ($context["column_right"] ?? null);
        echo "</div>
</div>

";
        // line 221
        if (($context["basel_map_style"] ?? null)) {
            // line 222
            echo "<script>
\t\$(document).ready(function() {
\t\tnew Maplace({
\t\t\tlocations: [
\t\t\t\t{
\t\t\t\t\tlat: ";
            // line 227
            echo ($context["basel_map_lat"] ?? null);
            echo ",
\t\t\t\t\tlon: ";
            // line 228
            echo ($context["basel_map_lon"] ?? null);
            echo ",
\t\t\t\t}
\t\t\t],
\t\t\tcontrols_on_map: true,
\t\t\tstart: 1,
\t\t\tmap_options: {
\t\t\t\tzoom: 15,
\t\t\t\tscrollwheel: false}
\t\t}).Load();
\t\t
\t\t";
            // line 238
            if (((($context["basel_map_lat"] ?? null) && ($context["basel_map_lon"] ?? null)) && (($context["basel_map_style"] ?? null) == "full_width"))) {
                // line 239
                echo "\t\t\$('body').addClass('full-width-map');
\t\t";
            }
            // line 241
            echo "\t\t 
\t});
</script>
";
        }
        // line 245
        echo "

<script>
\t\$(document).ready(function() {
\$(\".to_form\").click(function() {
    \$('html, body').animate({
        scrollTop: (\$(\".form-vertical\").offset().top - 200)
    }, 1000);
});
});
</script>

";
        // line 257
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "basel/template/information/contact.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  552 => 257,  538 => 245,  532 => 241,  528 => 239,  526 => 238,  513 => 228,  509 => 227,  502 => 222,  500 => 221,  494 => 218,  490 => 217,  476 => 205,  472 => 203,  459 => 195,  452 => 191,  447 => 188,  445 => 187,  440 => 184,  432 => 182,  430 => 181,  426 => 180,  418 => 174,  408 => 172,  406 => 171,  402 => 170,  398 => 169,  390 => 163,  385 => 161,  380 => 160,  378 => 159,  375 => 158,  365 => 155,  362 => 154,  360 => 153,  351 => 147,  344 => 145,  340 => 143,  336 => 142,  330 => 140,  328 => 139,  324 => 137,  318 => 135,  314 => 134,  311 => 133,  309 => 132,  303 => 128,  294 => 122,  284 => 115,  278 => 111,  276 => 110,  268 => 105,  257 => 97,  245 => 88,  239 => 85,  235 => 83,  229 => 81,  227 => 80,  223 => 79,  219 => 78,  211 => 72,  205 => 70,  203 => 69,  199 => 68,  192 => 63,  186 => 61,  184 => 60,  180 => 59,  176 => 58,  171 => 55,  165 => 53,  163 => 52,  159 => 51,  155 => 50,  147 => 45,  143 => 44,  135 => 39,  131 => 38,  127 => 37,  124 => 36,  121 => 35,  118 => 34,  115 => 33,  112 => 32,  109 => 31,  106 => 30,  104 => 29,  99 => 27,  96 => 26,  92 => 24,  90 => 23,  84 => 19,  73 => 17,  69 => 16,  63 => 12,  56 => 8,  52 => 7,  48 => 6,  44 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/information/contact.twig", "");
    }
}
