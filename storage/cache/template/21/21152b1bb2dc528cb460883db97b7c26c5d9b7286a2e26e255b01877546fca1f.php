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

/* basel/template/extension/module/basel_categories.twig */
class __TwigTemplate_0d08f47cf14dfbe7ba5ac1a350a186f99dd484e9ccb09ac7b428c755c150ae3d extends \Twig\Template
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
        echo "<div class=\"widget category-widget grid";
        if (($context["contrast"] ?? null)) {
            echo " contrast-bg";
        }
        echo "\" ";
        if (($context["use_margin"] ?? null)) {
            echo "style=\"padding-bottom:80px;margin-bottom:";
            echo ($context["margin"] ?? null);
            echo "\"";
        }
        echo ">
    ";
        // line 2
        if (($context["block_title"] ?? null)) {
            // line 3
            echo "    <div class=\"widget-title\">
        ";
            // line 4
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 5
            echo "        ";
            if (($context["title"] ?? null)) {
                echo " 
            <p class=\"main-title\"><span>";
                // line 6
                echo ($context["title"] ?? null);
                echo "</span></p>
            <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
        ";
            }
            // line 9
            echo "        ";
            if (($context["title_subline"] ?? null)) {
                // line 10
                echo "        <p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
        ";
            }
            // line 12
            echo "    </div>
\t";
        }
        // line 14
        echo "
    ";
        // line 15
        if (($context["categories"] ?? null)) {
            // line 16
            echo "        <div class=\"grid-holder category grid";
            echo ($context["columns"] ?? null);
            echo " ";
            if (($context["carousel"] ?? null)) {
                echo "carousel";
            }
            echo " module";
            echo ($context["module"] ?? null);
            echo "\">
        
        ";
            // line 18
            if (($context["view_subs"] ?? null)) {
                // line 19
                echo "        
              ";
                // line 20
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 21
                    echo "
                <div class=\"item single-category has-subs\">
                <div class=\"table\">
                <div class=\"table-cell v-top img-cell\"><img src=\"";
                    // line 24
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 24);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 24);
                    echo "\" /></div>
                
                <div class=\"table-cell w100 v-top\">
                <h5><b><a href=\"";
                    // line 27
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 27);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 27);
                    echo "</a></b></h5>
                ";
                    // line 28
                    if (twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 28)) {
                        // line 29
                        echo "                <ul class=\"list-unstyled\">
                ";
                        // line 30
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "children", [], "any", false, false, false, 30));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 31
                            echo "                <li><a class=\"hover_uline\" href=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["child"], "href", [], "any", false, false, false, 31);
                            echo "\">";
                            echo twig_get_attribute($this->env, $this->source, $context["child"], "name", [], "any", false, false, false, 31);
                            echo "</a></li>
                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 33
                        echo "                </ul>
                ";
                    }
                    // line 35
                    echo "                </div>
                </div>
                </div><!-- .single-category ends -->
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                echo "              
        ";
            } else {
                // line 41
                echo "        \t  
              ";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                    // line 43
                    echo "                <div class=\"item single-category no-subs\">
                <div class=\"banner_wrap hover-zoom\">
\t\t\t\t<a href=\"";
                    // line 45
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 45);
                    echo "\"><img class=\"zoom_image\" src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "thumb", [], "any", false, false, false, 45);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 45);
                    echo "\" /></a>
\t\t\t\t\t";
                    // line 46
                    if (($context["count"] ?? null)) {
                        // line 47
                        echo "\t\t\t\t\t<div class=\"overlay\">
\t\t\t\t\t<a class=\"table w100 h100\" href=\"";
                        // line 48
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 48);
                        echo "\">
\t\t\t\t\t<b class=\"table-cell text-center\">";
                        // line 49
                        echo twig_get_attribute($this->env, $this->source, $context["category"], "products", [], "any", false, false, false, 49);
                        echo "</b>
\t\t\t\t\t</a>
\t\t\t\t\t</div>
\t\t\t\t\t";
                    }
                    // line 53
                    echo "                </div>
                <p class=\"name contrast-heading\">";
                    // line 54
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 54);
                    echo "</p>
                <a class=\"u-lined\" href=\"";
                    // line 55
                    echo twig_get_attribute($this->env, $this->source, $context["category"], "href", [], "any", false, false, false, 55);
                    echo "\">";
                    echo ($context["basel_text_view_products"] ?? null);
                    echo "</a>
                </div><!-- .single-category ends -->
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 58
                echo "              
        ";
            }
            // line 60
            echo "          
        </div> <!-- .grid-holder ends -->
    ";
        }
        // line 63
        echo "    
    <div class=\"clearfix\"></div>
</div>

";
        // line 67
        if (($context["carousel"] ?? null)) {
            // line 68
            echo "<script>
\$('.grid-holder.category.module";
            // line 69
            echo ($context["module"] ?? null);
            echo "').slick({
";
            // line 70
            if (($context["carousel_a"] ?? null)) {
                // line 71
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 74
                echo "arrows: false,
";
            }
            // line 76
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 77
                echo "rtl: true,
";
            }
            // line 79
            if (($context["carousel_b"] ?? null)) {
                // line 80
                echo "dots:true,
";
            }
            // line 82
            echo "respondTo:'min',
rows:";
            // line 83
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 84
            if ((($context["columns"] ?? null) == "6")) {
                // line 85
                echo "slidesToShow:6,slidesToScroll:6,responsive:[{breakpoint:1100,settings:{slidesToShow:5,slidesToScroll:5}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 86
($context["columns"] ?? null) == "5")) {
                // line 87
                echo "slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 88
($context["columns"] ?? null) == "4")) {
                // line 89
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 90
($context["columns"] ?? null) == "3")) {
                // line 91
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 92
($context["columns"] ?? null) == "2")) {
                // line 93
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 94
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 95
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 97
            echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
]
});
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_categories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  305 => 97,  301 => 95,  299 => 94,  296 => 93,  294 => 92,  291 => 91,  289 => 90,  286 => 89,  284 => 88,  281 => 87,  279 => 86,  276 => 85,  274 => 84,  270 => 83,  267 => 82,  263 => 80,  261 => 79,  257 => 77,  255 => 76,  251 => 74,  246 => 71,  244 => 70,  240 => 69,  237 => 68,  235 => 67,  229 => 63,  224 => 60,  220 => 58,  209 => 55,  205 => 54,  202 => 53,  195 => 49,  191 => 48,  188 => 47,  186 => 46,  178 => 45,  174 => 43,  170 => 42,  167 => 41,  163 => 39,  154 => 35,  150 => 33,  139 => 31,  135 => 30,  132 => 29,  130 => 28,  124 => 27,  116 => 24,  111 => 21,  107 => 20,  104 => 19,  102 => 18,  90 => 16,  88 => 15,  85 => 14,  81 => 12,  75 => 10,  72 => 9,  66 => 6,  61 => 5,  55 => 4,  52 => 3,  50 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_categories.twig", "");
    }
}
