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

/* basel/template/product/single_product.twig */
class __TwigTemplate_b4e3d204f483972ed4430578c2bfe53d555d2835a5db777b99696ecb2b3fff1d extends \Twig\Template
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
        echo "<div class=\"item single-product\">
    <div class=\"edge\">
<div class=\"image\" ";
        // line 3
        if ((($context["columns"] ?? null) == "list")) {
            echo "style=\"width:";
            echo ($context["img_width"] ?? null);
            echo "px\"";
        }
        echo ">
    <a href=\"";
        // line 4
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 4);
        echo "\">
    <img src=\"";
        // line 5
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb", [], "any", false, false, false, 5);
        echo "\" alt=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 5);
        echo "\" loading=\"lazy\" title=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 5);
        echo "\" />
    ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb2", [], "any", false, false, false, 6)) {
            // line 7
            echo "    <img class=\"thumb2\" src=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "thumb2", [], "any", false, false, false, 7);
            echo "\" loading=\"lazy\" alt=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 7);
            echo "\" title=\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 7);
            echo "\" />
    ";
        }
        // line 9
        echo "    </a>
";
        // line 10
        if (((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 10) && twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 10)) && ($context["salebadge_status"] ?? null))) {
            // line 11
            echo "    <div class=\"sale-counter id";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 11);
            echo "\"></div>
    <span class=\"badge sale_badge\"><i>";
            // line 12
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_badge", [], "any", false, false, false, 12);
            echo "</i></span>
";
        }
        // line 14
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "new_label", [], "any", false, false, false, 14)) {
            // line 15
            echo "    <span class=\"badge new_badge\"><i>";
            echo ($context["basel_text_new"] ?? null);
            echo "</i></span>
";
        }
        // line 17
        echo "
                 

";
        // line 20
        if (((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "quantity", [], "any", false, false, false, 20) < 1) && ($context["stock_badge_status"] ?? null))) {
            // line 21
            echo " <span class=\"badge out_of_stock_badge\"><i>";
            echo ($context["basel_text_out_of_stock"] ?? null);
            echo "</i></span>
    ";
            // line 22
            $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
        } else {
            // line 24
            echo "\t";
            $context["button_cart"] = ($context["default_button_cart"] ?? null);
        }
        // line 26
        echo "<a class=\"img-overlay\" title=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 26);
        echo "\" href=\"";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 26);
        echo "\"></a>

<div class=\"icons-wrapper\">
<a class=\"icon is_wishlist\" data-toggle=\"tooltip\" data-placement=\"";
        // line 29
        echo ($context["tooltip_align"] ?? null);
        echo "\"  data-title=\"";
        echo ($context["button_wishlist"] ?? null);
        echo "\" onclick=\"wishlist.add('";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 29);
        echo "');\"><span class=\"icon-heart\"></span></a>
<a class=\"icon is_compare\" onclick=\"compare.add('";
        // line 30
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 30);
        echo "');\" data-toggle=\"tooltip\" data-placement=\"";
        echo ($context["tooltip_align"] ?? null);
        echo "\" data-title=\"";
        echo ($context["button_compare"] ?? null);
        echo "\"><span class=\"icon-refresh\"></span></a>
<a class=\"icon is_quickview hidden-xs\" onclick=\"quickview('";
        // line 31
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 31);
        echo "');\" data-toggle=\"tooltip\" data-placement=\"";
        echo ($context["tooltip_align"] ?? null);
        echo "\" data-title=\"";
        echo ($context["basel_button_quickview"] ?? null);
        echo "\"><span class=\"icon-magnifier-add\"></span></a>
</div> <!-- .icons-wrapper -->
</div><!-- .image ends -->
<div class=\"caption\">
<h3 class=\"product-name\"><a href=\"";
        // line 35
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "href", [], "any", false, false, false, 35);
        echo "\">";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "name", [], "any", false, false, false, 35);
        echo "</a></h3>
";
        // line 36
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "rating", [], "any", false, false, false, 36)) {
            echo "      
    <div class=\"rating\">
    <span class=\"rating_stars rating r";
            // line 38
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "rating", [], "any", false, false, false, 38);
            echo "\">
    <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
    </span>
    </div>
";
        }
        // line 43
        echo "<div class=\"price-wrapper\">
";
        // line 44
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 44)) {
            // line 45
            echo "<div class=\"pwrap\">
  <div class=\"price\">
                                            ";
            // line 47
            if ( !twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 47)) {
                // line 48
                echo "                                                <span>";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 48);
                echo "</span>
                                            ";
            } else {
                // line 50
                echo "                                                <span class=\"price-old\">";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "price", [], "any", false, false, false, 50);
                echo "</span><span class=\"price-new\">";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 50);
                echo "</span>
                                            ";
            }
            // line 52
            echo "                                            ";
            if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "tax", [], "any", false, false, false, 52)) {
                // line 53
                echo "                                                <span class=\"price-tax\">";
                echo ($context["text_tax"] ?? null);
                echo " ";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "tax", [], "any", false, false, false, 53);
                echo "</span>
                                            ";
            }
            // line 55
            echo "                                        </div><!-- .price -->


 </div>

<!-- .price -->
";
        }
        // line 62
        echo "
<p class=\"model\">";
        // line 63
        echo ($context["text_model"] ?? null);
        echo " ";
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "model", [], "any", false, false, false, 63);
        echo "</p>
<p class=\"description\">";
        // line 64
        if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "description", [], "any", false, false, false, 64)) {
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "description", [], "any", false, false, false, 64);
        }
        echo "</p>
";
        // line 65
        if (($context["is_logged"] ?? null)) {
            // line 66
            echo "    ";
            if (((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "quantity", [], "any", false, false, false, 66) < 1) && ($context["stock_badge_status"] ?? null))) {
                // line 67
                echo "      <a class=\"btn  ";
                if ((($context["basel_list_style"] ?? null) == "6")) {
                    echo "btn-contrast";
                } else {
                    echo "btn-outline";
                }
                echo "\" title=\"";
                echo ($context["button_cart"] ?? null);
                echo "\" ><span class=\"global-cart\"></span> ";
                echo ($context["button_cart"] ?? null);
                echo "</a>
        ";
                // line 68
                $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
                // line 69
                echo "    ";
            } else {
                // line 70
                echo "     <a class=\"btn  ";
                if ((($context["basel_list_style"] ?? null) == "6")) {
                    echo "btn-contrast";
                } else {
                    echo "btn-outline";
                }
                echo "\" onclick=\"cart.add('";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 70);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "minimum", [], "any", false, false, false, 70);
                echo "');\"><span class=\"global-cart\"></span> ";
                echo ($context["button_cart"] ?? null);
                echo "</a>
    ";
            }
            // line 72
            echo "
";
        }
        // line 74
        echo "
<!-- .price-wrapper -->


</div>
    ";
        // line 79
        if (($context["is_logged"] ?? null)) {
            // line 80
            echo "        <span class=\"badge eur_badge\">
        
           ";
            // line 82
            if (twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "special", [], "any", false, false, false, 82)) {
                // line 83
                echo "               <small><s>";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "priceeur", [], "any", false, false, false, 83);
                echo "</s></small> <small> ";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "specialeur", [], "any", false, false, false, 83);
                echo "</small>
                    ";
            } else {
                // line 85
                echo "               <small> ";
                echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "priceeur", [], "any", false, false, false, 85);
                echo "</small>
           ";
            }
            // line 87
            echo "
        
        </span>

        ";
        }
        // line 92
        echo "<div class=\"plain-links\">
<a class=\"icon is_wishlist link-hover-color\" onclick=\"wishlist.add('";
        // line 93
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 93);
        echo "');\" title=\"";
        echo ($context["button_wishlist"] ?? null);
        echo "\"><span class=\"icon-heart\"></span> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a>
<a class=\"icon is_compare link-hover-color\" onclick=\"compare.add('";
        // line 94
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 94);
        echo "');\" title=\"";
        echo ($context["button_compare"] ?? null);
        echo "\"><span class=\"icon-refresh\"></span> ";
        echo ($context["button_compare"] ?? null);
        echo "</a>
<a class=\"icon is_quickview link-hover-color\" onclick=\"quickview('";
        // line 95
        echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 95);
        echo "');\"><span class=\"icon-magnifier-add\"></span> ";
        echo ($context["basel_button_quickview"] ?? null);
        echo "</a>
</div><!-- .plain-links-->
</div><!-- .caption-->
";
        // line 98
        if ((twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_end_date", [], "any", false, false, false, 98) && ($context["countdown_status"] ?? null))) {
            // line 99
            echo "<script>
  \$(function() {
\t\$(\".sale-counter.id";
            // line 101
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "product_id", [], "any", false, false, false, 101);
            echo "\").countdown(\"";
            echo twig_get_attribute($this->env, $this->source, ($context["product"] ?? null), "sale_end_date", [], "any", false, false, false, 101);
            echo "\").on('update.countdown', function(event) {
  var \$this = \$(this).html(event.strftime(''
    + '<div>'
    + '%D<i>";
            // line 104
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
    + '%H <i>";
            // line 105
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
    + '%M <i>";
            // line 106
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
    + '%S <i>";
            // line 107
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
});
});
</script>
";
        }
        // line 112
        echo "
   </div>
</div><!-- .single-product ends -->";
    }

    public function getTemplateName()
    {
        return "basel/template/product/single_product.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  370 => 112,  362 => 107,  358 => 106,  354 => 105,  350 => 104,  342 => 101,  338 => 99,  336 => 98,  328 => 95,  320 => 94,  312 => 93,  309 => 92,  302 => 87,  296 => 85,  288 => 83,  286 => 82,  282 => 80,  280 => 79,  273 => 74,  269 => 72,  253 => 70,  250 => 69,  248 => 68,  235 => 67,  232 => 66,  230 => 65,  224 => 64,  218 => 63,  215 => 62,  206 => 55,  198 => 53,  195 => 52,  187 => 50,  181 => 48,  179 => 47,  175 => 45,  173 => 44,  170 => 43,  162 => 38,  157 => 36,  151 => 35,  140 => 31,  132 => 30,  124 => 29,  115 => 26,  111 => 24,  108 => 22,  103 => 21,  101 => 20,  96 => 17,  90 => 15,  88 => 14,  83 => 12,  78 => 11,  76 => 10,  73 => 9,  63 => 7,  61 => 6,  53 => 5,  49 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/single_product.twig", "/home/herrera/public_html/upload/catalog/view/theme/basel/template/product/single_product.twig");
    }
}
