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

/* basel/template/extension/module/basel_products.twig */
class __TwigTemplate_4fb864531ca219dd21d87fac636d745a80d8e906f0b3b3b7e6af7e8d74e4dc5a extends \Twig\Template
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
        echo "<div class=\"widget module";
        echo ($context["module"] ?? null);
        echo " ";
        if ((($context["columns"] ?? null) != "list")) {
            echo " grid";
        }
        if (($context["contrast"] ?? null)) {
            echo " contrast-bg";
        }
        if ((($context["carousel"] ?? null) && (($context["rows"] ?? null) > 1))) {
            echo "  multiple-rows";
        }
        echo "\" ";
        if (($context["use_margin"] ?? null)) {
            echo "style=\"margin-bottom: ";
            echo ($context["margin"] ?? null);
            echo "\"";
        }
        echo "> 
";
        // line 2
        if (($context["block_title"] ?? null)) {
            // line 3
            echo "<!-- Block Title -->
<div class=\"widget-title\">
";
            // line 5
            if (($context["title_preline"] ?? null)) {
                echo "<p class=\"pre-line\">";
                echo ($context["title_preline"] ?? null);
                echo "</p>";
            }
            // line 6
            if (($context["title"] ?? null)) {
                echo " 
<p class=\"main-title\"><span>";
                // line 7
                echo ($context["title"] ?? null);
                echo "</span></p>
<p class=\"widget-title-separator\"></p>
";
            }
            // line 10
            if (($context["title_subline"] ?? null)) {
                // line 11
                echo "<p class=\"sub-line\"><span>";
                echo ($context["title_subline"] ?? null);
                echo "</span></p>
";
            }
            // line 13
            echo "</div>
";
        }
        // line 15
        if ((twig_length_filter($this->env, ($context["tabs"] ?? null)) > 1)) {
            // line 16
            echo "<!-- Tabs -->
<ul id=\"tabs-";
            // line 17
            echo ($context["module"] ?? null);
            echo "\" class=\"nav nav-tabs ";
            echo ($context["tabstyle"] ?? null);
            echo "\" data-tabs=\"tabs\" style=\"\">
    ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
            foreach ($context['_seq'] as $context["keyTab"] => $context["tab"]) {
                // line 19
                echo "        ";
                if (($context["keyTab"] == 0)) {
                    // line 20
                    echo "        <li class=\"active\"><a href=\"#tab";
                    echo ($context["module"] ?? null);
                    echo $context["keyTab"];
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tab"], "title", [], "any", false, false, false, 20);
                    echo "</a></li>
        ";
                } else {
                    // line 22
                    echo "        <li><a href=\"#tab";
                    echo ($context["module"] ?? null);
                    echo $context["keyTab"];
                    echo "\" data-toggle=\"tab\">";
                    echo twig_get_attribute($this->env, $this->source, $context["tab"], "title", [], "any", false, false, false, 22);
                    echo "</a></li>
        ";
                }
                // line 24
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['keyTab'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "</ul>
";
        }
        // line 27
        echo "<div class=\"tab-content has-carousel ";
        if ( !($context["carousel"] ?? null)) {
            echo "overflow-hidden";
        }
        echo "\">
<!-- Product Group(s) -->
";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["tab"]) {
            // line 30
            echo "<div class=\"tab-pane";
            if (($context["key"] == 0)) {
                echo " active in";
            }
            echo " fade\" id=\"tab";
            echo ($context["module"] ?? null);
            echo $context["key"];
            echo "\">
    <div class=\"grid-holder grid";
            // line 31
            echo ($context["columns"] ?? null);
            echo " prod_module";
            echo ($context["module"] ?? null);
            if (($context["carousel"] ?? null)) {
                echo " carousel";
            }
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                echo " sticky-arrows";
            }
            echo "\">
        ";
            // line 32
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["tab"], "products", [], "any", false, false, false, 32));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 33
                echo "            <div class=\"item single-product\">
                  <div class=\"edge\">
            <div class=\"image\"";
                // line 35
                if ((($context["columns"] ?? null) == "list")) {
                    echo " style=\"width:";
                    echo ($context["img_width"] ?? null);
                    echo "px\"";
                }
                echo ">
                <a href=\"";
                // line 36
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 36);
                echo "\">
                <img src=\"";
                // line 37
                echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb", [], "any", false, false, false, 37);
                echo "\" alt=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 37);
                echo "\" loading=\"lazy\" title=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 37);
                echo "\" />
                ";
                // line 38
                if (twig_get_attribute($this->env, $this->source, $context["product"], "thumb2", [], "any", false, false, false, 38)) {
                    // line 39
                    echo "                <img class=\"thumb2\" src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "thumb2", [], "any", false, false, false, 39);
                    echo "\" alt=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 39);
                    echo "\" loading=\"lazy\" title=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 39);
                    echo "\" />
                ";
                }
                // line 41
                echo "                </a>
            ";
                // line 42
                if (((twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 42) && twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 42)) && twig_get_attribute($this->env, $this->source, $context["product"], "sale_badge", [], "any", false, false, false, 42))) {
                    // line 43
                    echo "                <div class=\"sale-counter id";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 43);
                    echo "\"></div>
\t\t\t\t<span class=\"badge sale_badge\"><i>";
                    // line 44
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "sale_badge", [], "any", false, false, false, 44);
                    echo "</i></span>
            ";
                }
                // line 46
                echo "            ";
                if (twig_get_attribute($this->env, $this->source, $context["product"], "new_label", [], "any", false, false, false, 46)) {
                    // line 47
                    echo "                <span class=\"badge new_badge\"><i>";
                    echo ($context["basel_text_new"] ?? null);
                    echo "</i></span>
            ";
                }
                // line 49
                echo "
                            

         
\t\t\t";
                // line 53
                if (((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 53) < 1) && ($context["stock_badge_status"] ?? null))) {
                    // line 54
                    echo "\t\t\t
\t\t\t\t";
                    // line 55
                    $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
                    // line 56
                    echo "\t\t\t";
                } else {
                    // line 57
                    echo "\t\t\t\t";
                    $context["button_cart"] = ($context["default_button_cart"] ?? null);
                    // line 58
                    echo "\t\t\t";
                }
                // line 59
                echo "            <a class=\"img-overlay\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 59);
                echo "\"></a>
            <div class=\"btn-center catalog_hide\"><a class=\"btn btn-light-outline btn-thin\" onclick=\"cart.add('";
                // line 60
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 60);
                echo "', '";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "minimum", [], "any", false, false, false, 60);
                echo "');\">";
                echo ($context["button_cart"] ?? null);
                echo "</a></div>
            <div class=\"icons-wrapper\">
            <a class=\"icon is_wishlist\" data-toggle=\"tooltip\" data-placement=\"";
                // line 62
                echo ($context["tooltip_align"] ?? null);
                echo "\"  data-title=\"";
                echo ($context["button_wishlist"] ?? null);
                echo "\" onclick=\"wishlist.add('";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 62);
                echo "');\"><span class=\"icon-heart\"></span></a>
            <a class=\"icon is_compare\" onclick=\"compare.add('";
                // line 63
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 63);
                echo "');\" data-toggle=\"tooltip\" data-placement=\"";
                echo ($context["tooltip_align"] ?? null);
                echo "\" data-title=\"";
                echo ($context["button_compare"] ?? null);
                echo "\"><span class=\"icon-refresh\"></span></a>
            <a class=\"icon is_quickview hidden-xs\" onclick=\"quickview('";
                // line 64
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 64);
                echo "');\" data-toggle=\"tooltip\" data-placement=\"";
                echo ($context["tooltip_align"] ?? null);
                echo "\" data-title=\"";
                echo ($context["basel_button_quickview"] ?? null);
                echo "\"><span class=\"icon-magnifier-add\"></span></a>
            </div> <!-- .icons-wrapper -->
            </div><!-- .image ends -->
            <div class=\"caption\">
            <h3 class=\"product-name\"><a href=\"";
                // line 68
                echo twig_get_attribute($this->env, $this->source, $context["product"], "href", [], "any", false, false, false, 68);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "name", [], "any", false, false, false, 68);
                echo "</a></h3>
            ";
                // line 69
                if (twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 69)) {
                    echo "      
                <div class=\"rating\">
                <span class=\"rating_stars rating r";
                    // line 71
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "rating", [], "any", false, false, false, 71);
                    echo "\">
                <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
                </span>
                </div>
            ";
                }
                // line 76
                echo "            <div class=\"price-wrapper\">
            ";
                // line 77
                if (twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 77)) {
                    // line 78
                    echo "            <div class=\"pwrap\">
               <div class=\"price\">
                                            ";
                    // line 80
                    if ( !twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 80)) {
                        // line 81
                        echo "                                                <span>";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 81);
                        echo "</span>
                                            ";
                    } else {
                        // line 83
                        echo "                                                <span class=\"price-old\">";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "price", [], "any", false, false, false, 83);
                        echo "</span><span class=\"price-new\">";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 83);
                        echo "</span>
                                            ";
                    }
                    // line 85
                    echo "                                            ";
                    if (twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 85)) {
                        // line 86
                        echo "                                                <span class=\"price-tax\">";
                        echo ($context["text_tax"] ?? null);
                        echo " ";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "tax", [], "any", false, false, false, 86);
                        echo "</span>
                                            ";
                    }
                    // line 88
                    echo "                                        </div><!-- .price -->
            </div>
            ";
                }
                // line 91
                echo "            <p class=\"model\">";
                echo ($context["text_model"] ?? null);
                echo " ";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "model", [], "any", false, false, false, 91);
                echo "</p>
            <p class=\"description\">";
                // line 92
                if (twig_get_attribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 92)) {
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "description", [], "any", false, false, false, 92);
                }
                echo "</p>
              ";
                // line 93
                if (($context["is_logged"] ?? null)) {
                    echo "       
                    ";
                    // line 94
                    if (((twig_get_attribute($this->env, $this->source, $context["product"], "quantity", [], "any", false, false, false, 94) < 1) && ($context["stock_badge_status"] ?? null))) {
                        // line 95
                        echo "                      <a class=\"btn  btn-contrast\" ><span class=\"global-cart\"></span> ";
                        echo ($context["button_cart"] ?? null);
                        echo "</a>
                        ";
                        // line 96
                        $context["button_cart"] = ($context["basel_text_out_of_stock"] ?? null);
                        // line 97
                        echo "                    ";
                    } else {
                        // line 98
                        echo "                     <a class=\"btn  ";
                        if ((($context["basel_list_style"] ?? null) == "6")) {
                            echo "btn-contrast";
                        } else {
                            echo "btn-outline";
                        }
                        echo "\" onclick=\"cart.add('";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 98);
                        echo "', '";
                        echo twig_get_attribute($this->env, $this->source, $context["product"], "minimum", [], "any", false, false, false, 98);
                        echo "');\" title=\"";
                        echo ($context["button_cart"] ?? null);
                        echo "\"><span class=\"global-cart\"></span> ";
                        echo ($context["button_cart"] ?? null);
                        echo "</a>
                    ";
                    }
                    // line 100
                    echo "            ";
                }
                // line 101
                echo "
            </div><!-- .price-wrapper -->

              <span class=\"badge eur_badge\">
        
           ";
                // line 106
                if (twig_get_attribute($this->env, $this->source, $context["product"], "special", [], "any", false, false, false, 106)) {
                    // line 107
                    echo "               <small><s>";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "priceeur", [], "any", false, false, false, 107);
                    echo "</s></small> <small> ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "specialeur", [], "any", false, false, false, 107);
                    echo "</small>
                    ";
                } else {
                    // line 109
                    echo "               <small> ";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "priceeur", [], "any", false, false, false, 109);
                    echo "</small>
           ";
                }
                // line 111
                echo "
      
        </span>

            
            <div class=\"plain-links\">
            <a class=\"icon is_wishlist link-hover-color\" title=\"";
                // line 117
                echo ($context["button_wishlist"] ?? null);
                echo "\" onclick=\"wishlist.add('";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 117);
                echo "');\"><span class=\"icon-heart\"></span> ";
                echo ($context["button_wishlist"] ?? null);
                echo "</a>
            <a class=\"icon is_compare link-hover-color\" title=\"";
                // line 118
                echo ($context["button_compare"] ?? null);
                echo "\" onclick=\"compare.add('";
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 118);
                echo "');\"><span class=\"icon-refresh\"></span> ";
                echo ($context["button_compare"] ?? null);
                echo "</a>
            <a class=\"icon is_quickview link-hover-color\" onclick=\"quickview('";
                // line 119
                echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 119);
                echo "');\"><span class=\"icon-magnifier-add\"></span> ";
                echo ($context["basel_button_quickview"] ?? null);
                echo "</a>
            </div><!-- .plain-links-->
            </div><!-- .caption-->
            ";
                // line 122
                if ((twig_get_attribute($this->env, $this->source, $context["product"], "sale_end_date", [], "any", false, false, false, 122) && ($context["countdown_status"] ?? null))) {
                    // line 123
                    echo "            <script>
\t\t\t  \$(function() {
\t\t\t\t\$(\".module";
                    // line 125
                    echo ($context["module"] ?? null);
                    echo " .sale-counter.id";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "product_id", [], "any", false, false, false, 125);
                    echo "\").countdown(\"";
                    echo twig_get_attribute($this->env, $this->source, $context["product"], "sale_end_date", [], "any", false, false, false, 125);
                    echo "\").on('update.countdown', function(event) {
\t\t\t  var \$this = \$(this).html(event.strftime(''
\t\t\t\t+ '<div>'
\t\t\t\t+ '%D<i>";
                    // line 128
                    echo ($context["basel_text_days"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%H <i>";
                    // line 129
                    echo ($context["basel_text_hours"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%M <i>";
                    // line 130
                    echo ($context["basel_text_mins"] ?? null);
                    echo "</i></div><div>'
\t\t\t\t+ '%S <i>";
                    // line 131
                    echo ($context["basel_text_secs"] ?? null);
                    echo "</i></div></div>'));
\t\t\t});
\t\t\t  });
\t\t\t</script>
            ";
                }
                // line 136
                echo "            </div>
            </div><!-- .single-product ends -->
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 139
            echo "    </div>
</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['tab'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        if (($context["use_button"] ?? null)) {
            // line 143
            echo "<!-- Button -->
<div class=\"widget_bottom_btn ";
            // line 144
            if ((($context["carousel"] ?? null) && ($context["carousel_b"] ?? null))) {
                echo "has-dots";
            }
            echo "\">
<a class=\"btn btn-contrast\" href=\"";
            // line 145
            echo ((($context["link_href"] ?? null)) ? (($context["link_href"] ?? null)) : (""));
            echo "\">";
            echo ($context["link_title"] ?? null);
            echo "</a>
</div>
";
        }
        // line 148
        echo "</div>
<div class=\"clearfix\"></div>
</div>
";
        // line 151
        if (($context["carousel"] ?? null)) {
            // line 152
            echo "<script>
\$('.grid-holder.prod_module";
            // line 153
            echo ($context["module"] ?? null);
            echo "').slick({
    accessibility: false,
";
            // line 155
            if (($context["carousel_a"] ?? null)) {
                // line 156
                echo "prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
";
            } else {
                // line 159
                echo "arrows: false,
";
            }
            // line 161
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 162
                echo "rtl: true,
";
            }
            // line 164
            if (($context["carousel_b"] ?? null)) {
                // line 165
                echo "dots:true,
";
            }
            // line 167
            echo "respondTo:'min',
rows:";
            // line 168
            echo ($context["rows"] ?? null);
            echo ",
";
            // line 169
            if ((($context["columns"] ?? null) == "5")) {
                // line 170
                echo "slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 171
($context["columns"] ?? null) == "4")) {
                // line 172
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 173
($context["columns"] ?? null) == "3")) {
                // line 174
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 175
($context["columns"] ?? null) == "2")) {
                // line 176
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            } elseif (((            // line 177
($context["columns"] ?? null) == "1") || (($context["columns"] ?? null) == "list"))) {
                // line 178
                echo "adaptiveHeight:true,slidesToShow:1,slidesToScroll:1,responsive:[
";
            }
            // line 180
            if (($context["items_mobile_fw"] ?? null)) {
                // line 181
                echo "{breakpoint:420,settings:{slidesToShow:1,slidesToScroll:1}}
";
            }
            // line 183
            echo "]
});
\$('.product-style2 .single-product .icon').attr('data-placement', 'top');
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
";
            // line 187
            if ((($context["carousel_a"] ?? null) && (($context["rows"] ?? null) > 1))) {
                // line 188
                echo "\$(window).load(function() {
var p_c_o = \$('.prod_module";
                // line 189
                echo ($context["module"] ?? null);
                echo "').offset().top;
var p_c_o_b = \$('.prod_module";
                // line 190
                echo ($context["module"] ?? null);
                echo "').offset().top + \$('.prod_module";
                echo ($context["module"] ?? null);
                echo "').outerHeight(true) - 100;
var p_sticky_arrows = function(){
var p_m_o = \$(window).scrollTop() + (\$(window).height()/2);
if (p_m_o > p_c_o && p_m_o < p_c_o_b) {
\$('.prod_module";
                // line 194
                echo ($context["module"] ?? null);
                echo " .slick-arrow').addClass('visible').css('top', p_m_o - p_c_o + 'px');
} else {
\$('.prod_module";
                // line 196
                echo ($context["module"] ?? null);
                echo " .slick-arrow').removeClass('visible');
}
};
\$(window).scroll(function() {p_sticky_arrows();});
});
";
            }
            // line 202
            echo "</script>
";
        }
    }

    public function getTemplateName()
    {
        return "basel/template/extension/module/basel_products.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  650 => 202,  641 => 196,  636 => 194,  627 => 190,  623 => 189,  620 => 188,  618 => 187,  612 => 183,  608 => 181,  606 => 180,  602 => 178,  600 => 177,  597 => 176,  595 => 175,  592 => 174,  590 => 173,  587 => 172,  585 => 171,  582 => 170,  580 => 169,  576 => 168,  573 => 167,  569 => 165,  567 => 164,  563 => 162,  561 => 161,  557 => 159,  552 => 156,  550 => 155,  545 => 153,  542 => 152,  540 => 151,  535 => 148,  527 => 145,  521 => 144,  518 => 143,  516 => 142,  508 => 139,  500 => 136,  492 => 131,  488 => 130,  484 => 129,  480 => 128,  470 => 125,  466 => 123,  464 => 122,  456 => 119,  448 => 118,  440 => 117,  432 => 111,  426 => 109,  418 => 107,  416 => 106,  409 => 101,  406 => 100,  388 => 98,  385 => 97,  383 => 96,  378 => 95,  376 => 94,  372 => 93,  366 => 92,  359 => 91,  354 => 88,  346 => 86,  343 => 85,  335 => 83,  329 => 81,  327 => 80,  323 => 78,  321 => 77,  318 => 76,  310 => 71,  305 => 69,  299 => 68,  288 => 64,  280 => 63,  272 => 62,  263 => 60,  258 => 59,  255 => 58,  252 => 57,  249 => 56,  247 => 55,  244 => 54,  242 => 53,  236 => 49,  230 => 47,  227 => 46,  222 => 44,  217 => 43,  215 => 42,  212 => 41,  202 => 39,  200 => 38,  192 => 37,  188 => 36,  180 => 35,  176 => 33,  172 => 32,  160 => 31,  150 => 30,  146 => 29,  138 => 27,  134 => 25,  128 => 24,  119 => 22,  110 => 20,  107 => 19,  103 => 18,  97 => 17,  94 => 16,  92 => 15,  88 => 13,  82 => 11,  80 => 10,  74 => 7,  70 => 6,  64 => 5,  60 => 3,  58 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/extension/module/basel_products.twig", "");
    }
}
