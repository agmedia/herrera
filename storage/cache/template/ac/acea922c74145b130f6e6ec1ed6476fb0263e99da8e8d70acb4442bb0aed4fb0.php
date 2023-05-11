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

/* basel/template/product/product.twig */
class __TwigTemplate_77df3694b496b10c6e7ffd288bc20b21e86da6e6ee156b7230e2d42108c5948c extends \Twig\Template
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

\t\t\t";
        // line 3
        if (($context["product_disabled"] ?? null)) {
            echo "<div class=\"container\"><div class=\"alert alert-warning\" role=\"alert\">";
            echo ($context["product_disabled"] ?? null);
            echo "</div></div>";
        }
        // line 4
        echo "\t\t\t

";
        // line 6
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 7
            echo "<style>
.product-page .image-area {
\t";
            // line 9
            if (((($context["product_layout"] ?? null) == "images-left") && ($context["images"] ?? null))) {
                echo " 
\t\twidth: ";
                // line 10
                echo ((($context["img_w"] ?? null) + ($context["img_a_w"] ?? null)) + 20);
                echo "px;
\t";
            } else {
                // line 12
                echo "\t\twidth: ";
                echo ($context["img_w"] ?? null);
                echo "px;
\t";
            }
            // line 14
            echo "}
.product-page .main-image {
\twidth:";
            // line 16
            echo ($context["img_w"] ?? null);
            echo "px;\t
}
.product-page .image-additional {
\t";
            // line 19
            if ((($context["product_layout"] ?? null) == "images-left")) {
                echo " 
\t\twidth: ";
                // line 20
                echo ($context["img_a_w"] ?? null);
                echo "px;
\t\theight: ";
                // line 21
                echo ($context["img_h"] ?? null);
                echo "px;
\t";
            } else {
                // line 23
                echo "\t\twidth: ";
                echo ($context["img_w"] ?? null);
                echo "px;
\t";
            }
            // line 25
            echo "}
.product-page .image-additional.has-arrows {
\t";
            // line 27
            if ((($context["product_layout"] ?? null) == "images-left")) {
                echo " 
\t\theight: ";
                // line 28
                echo (($context["img_h"] ?? null) - 40);
                echo "px;
\t";
            }
            // line 30
            echo "}
@media (min-width: 992px) and (max-width: 1199px) {
.product-page .image-area {
\t";
            // line 33
            if ((($context["product_layout"] ?? null) == "images-left")) {
                echo " 
\t\twidth: ";
                // line 34
                echo (((($context["img_w"] ?? null) + ($context["img_a_w"] ?? null)) / 1.25) + 20);
                echo "px;
\t";
            } else {
                // line 36
                echo "\t\twidth: ";
                echo (($context["img_w"] ?? null) / 1.25);
                echo "px;
\t";
            }
            // line 38
            echo "}
.product-page .main-image {
\twidth:";
            // line 40
            echo (($context["img_w"] ?? null) / 1.25);
            echo "px;\t
}
.product-page .image-additional {
\t";
            // line 43
            if ((($context["product_layout"] ?? null) == "images-left")) {
                echo " 
\t\twidth: ";
                // line 44
                echo (($context["img_a_w"] ?? null) / 1.25);
                echo "px;
\t\theight: ";
                // line 45
                echo (($context["img_h"] ?? null) / 1.25);
                echo "px;
\t";
            } else {
                // line 47
                echo "\t\twidth: ";
                echo (($context["img_w"] ?? null) / 1.25);
                echo "px;
\t";
            }
            // line 49
            echo "}
}
</style>
";
        }
        // line 53
        echo "
<ul class=\"breadcrumb\">
    ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 56
            echo "    <li><a href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "href", [], "any", false, false, false, 56);
            echo "\">";
            echo twig_get_attribute($this->env, $this->source, $context["breadcrumb"], "text", [], "any", false, false, false, 56);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "  </ul>

<div class=\"container product-layout ";
        // line 60
        echo ($context["product_layout"] ?? null);
        echo "\">
  
  <div class=\"row\">";
        // line 62
        echo ($context["column_left"] ?? null);
        echo "
    ";
        // line 63
        if ((($context["column_left"] ?? null) && ($context["column_right"] ?? null))) {
            // line 64
            echo "    ";
            $context["class"] = "col-sm-6";
            // line 65
            echo "    ";
        } elseif ((($context["column_left"] ?? null) || ($context["column_right"] ?? null))) {
            // line 66
            echo "    ";
            $context["class"] = "col-md-9 col-sm-8";
            // line 67
            echo "    ";
        } else {
            // line 68
            echo "    ";
            $context["class"] = "col-sm-12";
            // line 69
            echo "    ";
        }
        // line 70
        echo "    <div id=\"content\" class=\"product-main no-min-height ";
        echo ($context["class"] ?? null);
        echo "\">
    ";
        // line 71
        echo ($context["content_top"] ?? null);
        echo "
    
    <div class=\"table product-info product-page\">
     
     <div class=\"table-cell left\">
     
     ";
        // line 77
        if ((($context["thumb"] ?? null) || ($context["images"] ?? null))) {
            // line 78
            echo "     <div class=\"image-area ";
            if ( !($context["hover_zoom"] ?? null)) {
                echo "hover-zoom-disabled";
            }
            echo "\" id=\"gallery\">
            
        ";
            // line 80
            if (($context["thumb"] ?? null)) {
                // line 81
                echo "        <div class=\"main-image\">
        
        ";
                // line 83
                if (((($context["price"] ?? null) && ($context["special"] ?? null)) && ($context["sale_badge"] ?? null))) {
                    // line 84
                    echo "        <span class=\"badge sale_badge\"><i>";
                    echo ($context["sale_badge"] ?? null);
                    echo "</i></span>
        ";
                }
                // line 86
                echo "        
        ";
                // line 87
                if (($context["is_new"] ?? null)) {
                    // line 88
                    echo "        <span class=\"badge new_badge\"><i>";
                    echo ($context["basel_text_new"] ?? null);
                    echo "</i></span>
        ";
                }
                // line 90
                echo "\t\t
\t\t";
                // line 91
                if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                    // line 92
                    echo "        <span class=\"badge out_of_stock_badge\"><i>";
                    echo ($context["basel_text_out_of_stock"] ?? null);
                    echo "</i></span>
        ";
                }
                // line 94
                echo "
        <a class=\"";
                // line 95
                if ( !($context["images"] ?? null)) {
                    echo "link cloud-zoom";
                }
                echo " ";
                if ((($context["product_layout"] ?? null) == "full-width")) {
                    echo "link";
                } else {
                    echo "cloud-zoom";
                }
                echo "\" id=\"main-image\" href=\"";
                echo ($context["popup"] ?? null);
                echo "\" rel=\"position:'inside', showTitle: false\"><img src=\"";
                echo ($context["thumb"] ?? null);
                echo "\" title=\"";
                echo ($context["heading_title"] ?? null);
                echo "\" alt=\"";
                echo ($context["heading_title"] ?? null);
                echo "\" /></a>
        </div>
        ";
            }
            // line 98
            echo "\t\t
        ";
            // line 99
            if (($context["images"] ?? null)) {
                // line 100
                echo "        <ul class=\"image-additional\">
        ";
                // line 101
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["images"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                    // line 102
                    echo "        <li>
        <a class=\"link ";
                    // line 103
                    if ((($context["product_layout"] ?? null) != "full-width")) {
                        echo "cloud-zoom-gallery locked";
                    }
                    echo "\" href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "popup", [], "any", false, false, false, 103);
                    echo "\" rel=\"useZoom: 'main-image', smallImage: '";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "thumb_lg", [], "any", false, false, false, 103);
                    echo "'\"><img src=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["image"], "thumb", [], "any", false, false, false, 103);
                    echo "\" title=\"";
                    echo ($context["heading_title"] ?? null);
                    echo "\" alt=\"";
                    echo ($context["heading_title"] ?? null);
                    echo "\" /></a>
        </li>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 106
                echo "            ";
                if ((($context["thumb"] ?? null) && (($context["product_layout"] ?? null) != "full-width"))) {
                    // line 107
                    echo "            <li><a class=\"link cloud-zoom-gallery locked active\" href=\"";
                    echo ($context["popup"] ?? null);
                    echo "\" rel=\"useZoom: 'main-image', smallImage: '";
                    echo ($context["thumb"] ?? null);
                    echo "'\"><img src=\"";
                    echo ($context["thumb_sm"] ?? null);
                    echo "\" title=\"";
                    echo ($context["heading_title"] ?? null);
                    echo "\" alt=\"";
                    echo ($context["heading_title"] ?? null);
                    echo "\" /></a></li>
            ";
                }
                // line 109
                echo "        </ul>
        ";
            }
            // line 111
            echo "            
     </div> <!-- .table-cell.left ends -->
      
     </div> <!-- .image-area ends -->
     ";
        }
        // line 116
        echo "     
    <div class=\"table-cell w100 right\">
\t<div class=\"inner\">
    
    <div class=\"product-h1\">
    <h1 id=\"page-title\">";
        // line 121
        echo ($context["heading_title"] ?? null);
        echo "</h1>
    </div>
    
    ";
        // line 124
        if ((($context["review_status"] ?? null) && (($context["review_qty"] ?? null) > 0))) {
            // line 125
            echo "    <div class=\"rating\">
    <span class=\"rating_stars rating r";
            // line 126
            echo ($context["rating"] ?? null);
            echo "\">
    <i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
    </span>
    </div>
    <span class=\"review_link\">(<a class=\"hover_uline to_tabs\" onclick=\"\$('a[href=\\'#tab-review\\']').trigger('click'); return false;\">";
            // line 130
            echo ($context["reviews"] ?? null);
            echo "</a>)</span>
\t";
        }
        // line 132
        echo "
    ";
        // line 133
        if (($context["price"] ?? null)) {
            // line 134
            echo "      <ul class=\"list-unstyled price\">
        ";
            // line 135
            if ( !($context["special"] ?? null)) {
                // line 136
                echo "        <li><span class=\"live-price\">";
                echo ($context["price"] ?? null);
                echo " <small>";
                echo ($context["priceeur"] ?? null);
                echo "</small><span>   <small>";
                echo ($context["text_tax_included"] ?? null);
                echo " </small></li>
        ";
            } else {
                // line 138
                echo "        <li><span class=\"live-price-new\">";
                echo ($context["special"] ?? null);
                echo "  <small>";
                echo ($context["specialeur"] ?? null);
                echo "</small></span> <br><small>";
                echo ($context["text_tax_included"] ?? null);
                echo " </small></li>

        <span id=\"special_countdown\"></span>
        ";
            }
            // line 142
            echo "      </ul>
 ";
            // line 143
            if (($context["special"] ?? null)) {
                // line 144
                echo "      <p>Najniža cijena u zadnjih 30 dana: ";
                echo ($context["price"] ?? null);
                echo " <small>";
                echo ($context["priceeur"] ?? null);
                echo "</small> </p>
";
            }
            // line 146
            echo "
    
      ";
            // line 148
            if ((($context["price"] ?? null) && ($context["tax"] ?? null))) {
                // line 149
                echo "      <p class=\"info p-tax\"><b>";
                echo ($context["text_tax"] ?? null);
                echo "</b> <span class=\"live-price-tax\">";
                echo ($context["tax"] ?? null);
                echo "</span></p>
      ";
            }
            // line 151
            echo "
        ";
            // line 152
            if (($context["discounts"] ?? null)) {
                // line 153
                echo "        <p class=\"discount\">
        ";
                // line 154
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["discounts"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["discount"]) {
                    // line 155
                    echo "        <span>";
                    echo twig_get_attribute($this->env, $this->source, $context["discount"], "quantity", [], "any", false, false, false, 155);
                    echo ($context["text_discount"] ?? null);
                    echo "<i class=\"price\">";
                    echo twig_get_attribute($this->env, $this->source, $context["discount"], "price", [], "any", false, false, false, 155);
                    echo "</i></span>
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['discount'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 157
                echo "        </p>
        ";
            }
            // line 159
            echo "      
      ";
        }
        // line 160
        echo " <!-- if price ends -->
      
      
      ";
        // line 163
        if ((($context["meta_description_status"] ?? null) && ($context["meta_description"] ?? null))) {
            // line 164
            echo "      <p class=\"meta_description\">";
            echo ($context["meta_description"] ?? null);
            echo "</p>
      ";
        }
        // line 166
        echo "            
      
      <div id=\"product\">
            
            ";
        // line 170
        if (($context["options"] ?? null)) {
            // line 171
            echo "            <div class=\"options\">
            ";
            // line 172
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["options"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                // line 173
                echo "            
            ";
                // line 174
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 174) == "select")) {
                    // line 175
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 175)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 177
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 177);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 177);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <select name=\"option[";
                    // line 180
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 180);
                    echo "]\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 180);
                    echo "\" class=\"form-control\">
                <option value=\"\">";
                    // line 181
                    echo ($context["text_select"] ?? null);
                    echo "</option>
                ";
                    // line 182
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 182));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 183
                        echo "                <option value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 183);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 183);
                        echo "
                ";
                        // line 184
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 184)) {
                            // line 185
                            echo "                (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 185);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 185);
                            echo ")
                ";
                        }
                        // line 187
                        echo "                </option>
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 189
                    echo "              </select>
              </div>
            </div>
            ";
                }
                // line 193
                echo "            
            ";
                // line 194
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 194) == "radio")) {
                    // line 195
                    echo "                            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 195)) {
                        echo " required ";
                    }
                    echo "   mb-0 \">
                              <div class=\" radio-cell name variation-title\">
                              <label class=\"control-label vt-title\">  ";
                    // line 197
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 197);
                    echo "</label>
                                
                              </div>
                              <div class=\" radio-cell\">
                              <div id=\"input-option";
                    // line 201
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 201);
                    echo "\">
                                  <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                                ";
                    // line 203
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 203));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 204
                        echo "
                                        <label class=\"btn btn-outline btn-option \">
                                    <input type=\"radio\" name=\"option[";
                        // line 206
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 206);
                        echo "]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 206);
                        echo "\" data-uid=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "sifra", [], "any", false, false, false, 206);
                        echo "\" />
                                    ";
                        // line 207
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 207)) {
                            // line 208
                            echo "                                    <img src=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 208);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 208);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 208)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 208);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 208);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 208);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 208)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 208);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 208);
                                echo ")";
                            }
                            echo "\" />
                                    ";
                        }
                        // line 210
                        echo "                                    <span class=\"name\">
                                    ";
                        // line 211
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 211);
                        echo "
                                    ";
                        // line 212
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 212)) {
                            // line 213
                            echo "                                    (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 213);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 213);
                            echo ")
                                    ";
                        }
                        // line 215
                        echo "                                    </span>
                                  </label>

                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 219
                    echo "                                  </div>
                              </div>
                              </div>
                            </div>
                            ";
                }
                // line 224
                echo "            
            ";
                // line 225
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 225) == "checkbox")) {
                    // line 226
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 226)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell checkbox-cell name\">
              <label class=\"control-label\">";
                    // line 228
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 228);
                    echo "</label>
              </div>
              <div class=\"table-cell checkbox-cell\">
              <div id=\"input-option";
                    // line 231
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 231);
                    echo "\">
                ";
                    // line 232
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["option"], "product_option_value", [], "any", false, false, false, 232));
                    foreach ($context['_seq'] as $context["_key"] => $context["option_value"]) {
                        // line 233
                        echo "                <div class=\"checkbox";
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 233)) {
                            echo " has-image";
                        }
                        echo "\">
                  <label>
                    <input type=\"checkbox\" name=\"option[";
                        // line 235
                        echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 235);
                        echo "][]\" value=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "product_option_value_id", [], "any", false, false, false, 235);
                        echo "\" />
                    ";
                        // line 236
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 236)) {
                            // line 237
                            echo "                    <img src=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "image", [], "any", false, false, false, 237);
                            echo "\" alt=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 237);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 237)) {
                                echo "(";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 237);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 237);
                                echo ")";
                            }
                            echo "\" data-toggle=\"tooltip\" data-title=\"";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 237);
                            if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 237)) {
                                echo " (";
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 237);
                                echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 237);
                                echo ")";
                            }
                            echo "\" /> 
                    ";
                        }
                        // line 239
                        echo "                    <span class=\"name\">
                    ";
                        // line 240
                        echo twig_get_attribute($this->env, $this->source, $context["option_value"], "name", [], "any", false, false, false, 240);
                        echo "
                    ";
                        // line 241
                        if (twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 241)) {
                            // line 242
                            echo "                    (";
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price_prefix", [], "any", false, false, false, 242);
                            echo twig_get_attribute($this->env, $this->source, $context["option_value"], "price", [], "any", false, false, false, 242);
                            echo ")
                    ";
                        }
                        // line 244
                        echo "                    </span>
                  </label>
                </div>
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option_value'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 248
                    echo "              </div>
              </div>
            </div>
            ";
                }
                // line 252
                echo "            
            
            ";
                // line 254
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 254) == "text")) {
                    // line 255
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 255)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 257
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 257);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 257);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <input type=\"text\" name=\"option[";
                    // line 260
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 260);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 260);
                    echo "\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 260);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 260);
                    echo "\" class=\"form-control\" />
              </div>
            </div>
            ";
                }
                // line 264
                echo "            
            ";
                // line 265
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 265) == "textarea")) {
                    // line 266
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 266)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 268
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 268);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 268);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <textarea name=\"option[";
                    // line 271
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 271);
                    echo "]\" rows=\"5\" placeholder=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 271);
                    echo "\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 271);
                    echo "\" class=\"form-control\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 271);
                    echo "</textarea>
              </div>
            </div>
            ";
                }
                // line 275
                echo "            
            ";
                // line 276
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 276) == "file")) {
                    // line 277
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 277)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\">";
                    // line 279
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 279);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <button type=\"button\" id=\"button-upload";
                    // line 282
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 282);
                    echo "\" data-loading-text=\"";
                    echo ($context["text_loading"] ?? null);
                    echo "\" class=\"btn btn-default btn-block\"><i class=\"fa fa-upload\"></i> ";
                    echo ($context["button_upload"] ?? null);
                    echo "</button>
              <input type=\"hidden\" name=\"option[";
                    // line 283
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 283);
                    echo "]\" value=\"\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 283);
                    echo "\" />
              </div>
            </div>
            ";
                }
                // line 287
                echo "            
            ";
                // line 288
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 288) == "date")) {
                    // line 289
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 289)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 291
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 291);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 291);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <div class=\"input-group date\">
                <input type=\"text\" name=\"option[";
                    // line 295
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 295);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 295);
                    echo "\" data-date-format=\"YYYY-MM-DD\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 295);
                    echo "\" class=\"form-control\" />
                <span class=\"input-group-btn\">
                <button class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                </div>
            </div>
            ";
                }
                // line 302
                echo "            
            ";
                // line 303
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 303) == "datetime")) {
                    // line 304
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 304)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 306
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 306);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 306);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <div class=\"input-group datetime\">
                <input type=\"text\" name=\"option[";
                    // line 310
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 310);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 310);
                    echo "\" data-date-format=\"YYYY-MM-DD HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 310);
                    echo "\" class=\"form-control\" />
                <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                </div>
            </div>
            ";
                }
                // line 317
                echo "            
            ";
                // line 318
                if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 318) == "time")) {
                    // line 319
                    echo "            <div class=\"form-group";
                    if (twig_get_attribute($this->env, $this->source, $context["option"], "required", [], "any", false, false, false, 319)) {
                        echo " required";
                    }
                    echo " table-row\">
              <div class=\"table-cell name\">
              <label class=\"control-label\" for=\"input-option";
                    // line 321
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 321);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "name", [], "any", false, false, false, 321);
                    echo "</label>
              </div>
              <div class=\"table-cell\">
              <div class=\"input-group time\">
                <input type=\"text\" name=\"option[";
                    // line 325
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 325);
                    echo "]\" value=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "value", [], "any", false, false, false, 325);
                    echo "\" data-date-format=\"HH:mm\" id=\"input-option";
                    echo twig_get_attribute($this->env, $this->source, $context["option"], "product_option_id", [], "any", false, false, false, 325);
                    echo "\" class=\"form-control\" />
                <span class=\"input-group-btn\">
                <button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-calendar\"></i></button>
                </span></div>
                </div>
            </div>
            ";
                }
                // line 332
                echo "            
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 333
            echo " <!-- foreach option -->
            </div>
            ";
        }
        // line 336
        echo "            
            ";
        // line 337
        if (($context["recurrings"] ?? null)) {
            // line 338
            echo "            <hr>
            <h3>";
            // line 339
            echo ($context["text_payment_recurring"] ?? null);
            echo "</h3>
            <div class=\"form-group required\">
              <select name=\"recurring_id\" class=\"form-control\">
                <option value=\"\">";
            // line 342
            echo ($context["text_select"] ?? null);
            echo "</option>
                ";
            // line 343
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["recurrings"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["recurring"]) {
                // line 344
                echo "                <option value=\"";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "recurring_id", [], "any", false, false, false, 344);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["recurring"], "name", [], "any", false, false, false, 344);
                echo "</option>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['recurring'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 346
            echo "              </select>
              <div class=\"help-block\" id=\"recurring-description\"></div>
            </div>
            ";
        }
        // line 350
        echo "             ";
        if (($context["is_logged"] ?? null)) {
            // line 351
            echo "                <div class=\"form-group quantity buttons_added buy catalog_hide\">

                          <input type=\"button\" value=\"-\" class=\"minus\"><input type=\"text\" step=\"";
            // line 353
            echo ($context["minimum"] ?? null);
            echo "\" min=\"";
            echo ($context["minimum"] ?? null);
            echo "\" max=\"";
            echo ($context["quantity"] ?? null);
            echo "\" id=\"input-quantity\" name=\"quantity\" value=\"";
            echo ($context["minimum"] ?? null);
            echo "\" title=\"Qty\" class=\"input-text qty text put-qty\" size=\"4\" pattern=\"\" inputmode=\"\"><input type=\"button\" value=\"+\" class=\"plus\">
                          
                           <input type=\"hidden\" name=\"product_id\" value=\"";
            // line 355
            echo ($context["product_id"] ?? null);
            echo "\" />
                                 
                                      ";
            // line 357
            if (((($context["qty"] ?? null) < 1) && ($context["stock_badge_status"] ?? null))) {
                // line 358
                echo "                                        <button type=\"button\"  data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span>";
                echo ($context["basel_text_out_of_stock"] ?? null);
                echo "</span></button>
                                      ";
            } else {
                // line 360
                echo "                                          <button type=\"button\" id=\"button-cart\" data-loading-text=\"";
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-primary cd-btn-add\"><span> <i class=\"global-cart icon\"></i> ";
                echo ($context["button_cart"] ?? null);
                echo "</span></button>
                                      ";
            }
            // line 362
            echo "
                                 
                 </div>

            ";
        } else {
            // line 367
            echo "
                ";
            // line 368
            if (($context["attention"] ?? null)) {
                // line 369
                echo "                    <div class=\"alert alert-info\"><i class=\"fa fa-info-circle\"></i> ";
                echo ($context["attention"] ?? null);
                echo "
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
                    </div>
                ";
            }
            // line 373
            echo "

            ";
        }
        // line 376
        echo "

            ";
        // line 378
        if ((($context["minimum"] ?? null) > 1)) {
            // line 379
            echo "            <p><i class=\"fa fa-info-circle\"></i> ";
            echo ($context["text_minimum"] ?? null);
            echo "</p>
            ";
        }
        // line 381
        echo "          
          </div> <!-- #product ends -->


\t<p class=\"info is_wishlist\"><a onclick=\"wishlist.add('";
        // line 385
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-heart\"></i> ";
        echo ($context["button_wishlist"] ?? null);
        echo "</a></p>
\t<p class=\"info is_compare\"><a onclick=\"compare.add('";
        // line 386
        echo ($context["product_id"] ?? null);
        echo "');\"><i class=\"icon-refresh\"></i> ";
        echo ($context["button_compare"] ?? null);
        echo "</a></p>
    ";
        // line 387
        if (($context["question_status"] ?? null)) {
            // line 388
            echo "    <p class=\"info is_ask\"><a class=\"to_tabs\" onclick=\"\$('a[href=\\'#tab-questions\\']').trigger('click'); return false;\"><i class=\"icon-question\"></i> ";
            echo ($context["basel_button_ask"] ?? null);
            echo "</a></p>
    ";
        }
        // line 390
        echo "    
    <div class=\"clearfix\"></div>
    
    <div class=\"info-holder\">
   
      
      ";
        // line 396
        if ((($context["price"] ?? null) && ($context["points"] ?? null))) {
            // line 397
            echo "      <p class=\"info\"><b>";
            echo ($context["text_points"] ?? null);
            echo "</b> ";
            echo ($context["points"] ?? null);
            echo "</p>
      ";
        }
        // line 399
        echo "      
      <p class=\"info ";
        // line 400
        if ((($context["qty"] ?? null) > 0)) {
            echo "in_stock";
        }
        echo "\"><b>";
        echo ($context["text_stock"] ?? null);
        echo "</b> ";
        echo ($context["stock"] ?? null);
        echo "</p>
      
      ";
        // line 402
        if (($context["manufacturer"] ?? null)) {
            // line 403
            echo "      <p class=\"info\"><b>";
            echo ($context["text_manufacturer"] ?? null);
            echo "</b> <a class=\"hover_uline\" href=\"";
            echo ($context["manufacturers"] ?? null);
            echo "\">";
            echo ($context["manufacturer"] ?? null);
            echo "</a></p>
      ";
        }
        // line 405
        echo "      
      <p class=\"info\"><b>";
        // line 406
        echo ($context["text_model"] ?? null);
        echo "</b> ";
        echo ($context["model"] ?? null);
        echo "</p>

      ";
        // line 408
        if (($context["ean"] ?? null)) {
            // line 409
            echo "      <p class=\"info\"><b>";
            echo ($context["text_ean"] ?? null);
            echo "</b> ";
            echo ($context["ean"] ?? null);
            echo "</p>
      ";
        }
        // line 411
        echo "      
      ";
        // line 412
        if (($context["reward"] ?? null)) {
            // line 413
            echo "      <p class=\"info\"><b>";
            echo ($context["text_reward"] ?? null);
            echo "</b> ";
            echo ($context["reward"] ?? null);
            echo "</p>
      ";
        }
        // line 415
        echo "      
      ";
        // line 416
        if (($context["tags"] ?? null)) {
            // line 417
            echo "      <p class=\"info tags\"><b>";
            echo ($context["text_tags"] ?? null);
            echo "</b> &nbsp;<span>";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tags"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo "<a class=\"hover_uline\" href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "href", [], "any", false, false, false, 417);
                echo "\">";
                echo twig_get_attribute($this->env, $this->source, $context["tag"], "tag", [], "any", false, false, false, 417);
                echo "</a>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</span></p>
      ";
        }
        // line 419
        echo "      
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=61a636a5d0a9e10012e4df2d&product=sop' async='async'></script>
     <!-- ShareThis BEGIN -->
<div class=\"sharethis-inline-share-buttons\"></div>
<!-- ShareThis END -->
     </div> <!-- .info-holder ends -->
     
\t </div> <!-- .inner ends -->
     </div> <!-- .table-cell.right ends -->
    
    </div> <!-- .product-info ends -->
    
";
        // line 431
        if (($context["full_width_tabs"] ?? null)) {
            // line 432
            echo "</div> <!-- main column ends -->
";
            // line 433
            echo ($context["column_right"] ?? null);
            echo "
</div> <!-- .row ends -->
</div> <!-- .container ends -->    
";
        }
        // line 437
        echo "
";
        // line 438
        if (($context["full_width_tabs"] ?? null)) {
            // line 439
            echo "<div class=\"outer-container product-tabs-wrapper\">
<div class=\"container\">   
";
        } else {
            // line 442
            echo "<div class=\"inline-tabs\"> 
";
        }
        // line 444
        echo "
<!-- Tabs area start -->
<div class=\"row\">
<div class=\"col-sm-12\">
  
  <ul class=\"nav nav-tabs ";
        // line 449
        echo ($context["product_tabs_style"] ?? null);
        echo " main_tabs\">
    <li class=\"active\"><a href=\"#tab-description\" data-toggle=\"tab\">";
        // line 450
        echo ($context["tab_description"] ?? null);
        echo "</a></li>
    ";
        // line 451
        if (($context["product_tabs"] ?? null)) {
            // line 452
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 453
                echo "        <li><a href=\"#custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 453);
                echo "\" data-toggle=\"tab\">";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "name", [], "any", false, false, false, 453);
                echo "</a></li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 455
            echo "    ";
        }
        // line 456
        echo "    ";
        if (($context["attribute_groups"] ?? null)) {
            // line 457
            echo "    <li><a href=\"#tab-specification\" data-toggle=\"tab\">";
            echo ($context["tab_attribute"] ?? null);
            echo "</a></li>
    ";
        }
        // line 459
        echo "    ";
        if (($context["review_status"] ?? null)) {
            // line 460
            echo "    <li><a href=\"#tab-review\" data-toggle=\"tab\">";
            echo ($context["tab_review"] ?? null);
            echo "</a></li>
    ";
        }
        // line 462
        echo "    ";
        if (($context["question_status"] ?? null)) {
            // line 463
            echo "    <li><a href=\"#tab-questions\" data-toggle=\"tab\">";
            echo ($context["basel_tab_questions"] ?? null);
            echo " (";
            echo ($context["questions_total"] ?? null);
            echo ")</a></li>
    ";
        }
        // line 465
        echo "  </ul>
  
  <div class=\"tab-content\">
    
    <div class=\"tab-pane active\" id=\"tab-description\">
    ";
        // line 470
        echo ($context["description"] ?? null);
        echo "
    </div>
    
    ";
        // line 473
        if (($context["product_tabs"] ?? null)) {
            // line 474
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["product_tabs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tab"]) {
                // line 475
                echo "    <div class=\"tab-pane\" id=\"custom-tab-";
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "tab_id", [], "any", false, false, false, 475);
                echo "\">
    ";
                // line 476
                echo twig_get_attribute($this->env, $this->source, $context["tab"], "description", [], "any", false, false, false, 476);
                echo "
    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tab'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 479
            echo "    ";
        }
        // line 480
        echo "    
    ";
        // line 481
        if (($context["attribute_groups"] ?? null)) {
            // line 482
            echo "    <div class=\"tab-pane\" id=\"tab-specification\">
      <table class=\"table specification\">
        ";
            // line 484
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attribute_groups"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute_group"]) {
                // line 485
                echo "        <thead>
          <tr>
            <td colspan=\"2\">";
                // line 487
                echo twig_get_attribute($this->env, $this->source, $context["attribute_group"], "name", [], "any", false, false, false, 487);
                echo "</td>
          </tr>
        </thead>
        <tbody>
          ";
                // line 491
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["attribute_group"], "attribute", [], "any", false, false, false, 491));
                foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                    // line 492
                    echo "          <tr>
            <td class=\"text-left\"><b>";
                    // line 493
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "name", [], "any", false, false, false, 493);
                    echo "</b></td>
            <td class=\"text-right\">";
                    // line 494
                    echo twig_get_attribute($this->env, $this->source, $context["attribute"], "text", [], "any", false, false, false, 494);
                    echo "</td>
          </tr>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 497
                echo "        </tbody>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 499
            echo "      </table>
    </div>
    ";
        }
        // line 502
        echo "    
    ";
        // line 503
        if (($context["question_status"] ?? null)) {
            // line 504
            echo "    <div class=\"tab-pane\" id=\"tab-questions\">
    ";
            // line 505
            echo ($context["product_questions"] ?? null);
            echo "
    </div>
    ";
        }
        // line 508
        echo "    
    ";
        // line 509
        if (($context["review_status"] ?? null)) {
            // line 510
            echo "    <div class=\"tab-pane\" id=\"tab-review\">
    <div class=\"row\">
    <div class=\"col-sm-6\">
    <h4><b>";
            // line 513
            echo ($context["button_reviews"] ?? null);
            echo "</b></h4>
        
\t\t<div id=\"review\">
\t\t";
            // line 516
            if (($context["seo_reviews"] ?? null)) {
                // line 517
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["seo_reviews"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["review"]) {
                    // line 518
                    echo "\t\t<div class=\"table\">
\t\t<div class=\"table-cell\"><i class=\"fa fa-user\"></i></div>
\t\t<div class=\"table-cell right\">
\t\t<p class=\"author\"><b>";
                    // line 521
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "author", [], "any", false, false, false, 521);
                    echo "</b>  -  ";
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "date_added", [], "any", false, false, false, 521);
                    echo "
\t\t<span class=\"rating\">
\t\t<span class=\"rating_stars rating r";
                    // line 523
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "rating", [], "any", false, false, false, 523);
                    echo "\">
\t\t<i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i>
\t\t</span>
\t\t</span>
\t\t</p>
\t\t";
                    // line 528
                    echo twig_get_attribute($this->env, $this->source, $context["review"], "text", [], "any", false, false, false, 528);
                    echo "
\t\t</div>
\t\t</div>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['review'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 532
                echo "\t\t";
                if (($context["pagination"] ?? null)) {
                    // line 533
                    echo "\t\t<div class=\"pagination-holder\">";
                    echo ($context["pagination"] ?? null);
                    echo "</div>
\t\t";
                }
                // line 535
                echo "\t\t";
            } else {
                // line 536
                echo "\t\t<p>";
                echo ($context["text_no_reviews"] ?? null);
                echo "</p>
\t\t";
            }
            // line 538
            echo "\t\t</div>

    </div>
    <div class=\"col-sm-6 right\">
      <form class=\"form-horizontal\" id=\"form-review\">
        
        <h4 id=\"review-notification\"><b>";
            // line 544
            echo ($context["text_write"] ?? null);
            echo "</b></h4>
        ";
            // line 545
            if (($context["review_guest"] ?? null)) {
                // line 546
                echo "        
        <div class=\"form-group required\">
          <div class=\"col-sm-12 rating-stars\">
            <label class=\"control-label\">";
                // line 549
                echo ($context["entry_rating"] ?? null);
                echo "</label>
            
            <input type=\"radio\" value=\"1\" name=\"rating\" id=\"rating1\" />
        \t<label for=\"rating1\"><i class=\"fa fa-star-o\"></i></label>
            
            <input type=\"radio\" value=\"2\" name=\"rating\" id=\"rating2\" />
        \t<label for=\"rating2\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>
            
            <input type=\"radio\" value=\"3\" name=\"rating\" id=\"rating3\" />
        \t<label for=\"rating3\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>
            
            <input type=\"radio\" value=\"4\" name=\"rating\" id=\"rating4\" />
        \t<label for=\"rating4\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>
            
            <input type=\"radio\" value=\"5\" name=\"rating\" id=\"rating5\" />
        \t<label for=\"rating5\"><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i><i class=\"fa fa-star-o\"></i></label>
            </div>
        </div>
        
        <div class=\"form-group required\">
          <div class=\"col-sm-12\">
            <label class=\"control-label\" for=\"input-name\">";
                // line 570
                echo ($context["entry_name"] ?? null);
                echo "</label>
            <input type=\"text\" name=\"name\" value=\"";
                // line 571
                echo ($context["customer_name"] ?? null);
                echo "\" id=\"input-name\" class=\"form-control grey\" />
          </div>
        </div>
        <div class=\"form-group required\">
          <div class=\"col-sm-12\">
            <label class=\"control-label\" for=\"input-review\">";
                // line 576
                echo ($context["entry_review"] ?? null);
                echo "</label>
            <textarea name=\"text\" rows=\"5\" id=\"input-review\" class=\"form-control grey\"></textarea>
            <small>";
                // line 578
                echo ($context["text_note"] ?? null);
                echo "</small>
          </div>
        </div>
        
        <div class=\"form-group required\">
          <div class=\"col-sm-12\">
            ";
                // line 584
                echo ($context["captcha"] ?? null);
                echo "
          </div>
        </div>
        
        <div class=\"buttons clearfix\">
          <div class=\"text-right\">
          <button type=\"button\" id=\"button-review\" data-loading-text=\"";
                // line 590
                echo ($context["text_loading"] ?? null);
                echo "\" class=\"btn btn-outline\">";
                echo ($context["button_continue"] ?? null);
                echo "</button>
          </div>
        </div>
        ";
            } else {
                // line 594
                echo "        ";
                echo ($context["text_login"] ?? null);
                echo "
        ";
            }
            // line 596
            echo "      </form>
       </div>
      </div>
    </div>
    ";
        }
        // line 600
        echo "<!-- if review-status ends -->
    
  </div> <!-- .tab-content ends -->
</div> <!-- .col-sm-12 ends -->
</div> <!-- .row ends -->
<!-- Tabs area ends -->

";
        // line 607
        if (($context["full_width_tabs"] ?? null)) {
            // line 608
            echo "</div>
";
        }
        // line 610
        echo "</div>
      
      <!-- Related Products -->
      
    ";
        // line 614
        if (($context["full_width_tabs"] ?? null)) {
            // line 615
            echo "    <div class=\"container\">  
    ";
        }
        // line 617
        echo "      
        ";
        // line 618
        if (($context["products"] ?? null)) {
            // line 619
            echo "        <div class=\"widget widget-related\">
        
        <div class=\"widget-title\">
        <p class=\"main-title\"><span>";
            // line 622
            echo ($context["text_related"] ?? null);
            echo "</span></p>
        <p class=\"widget-title-separator\"><i class=\"icon-line-cross\"></i></p>
        </div>
        
        <div class=\"grid grid-holder related carousel grid";
            // line 626
            echo ($context["basel_rel_prod_grid"] ?? null);
            echo "\">
            ";
            // line 627
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
                // line 628
                echo "              ";
                $this->loadTemplate("basel/template/product/single_product.twig", "basel/template/product/product.twig", 628)->display($context);
                // line 629
                echo "            ";
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
            // line 630
            echo "        </div>
        </div>
        ";
        }
        // line 633
        echo "      
      ";
        // line 634
        echo ($context["content_bottom"] ?? null);
        echo "
      
    ";
        // line 636
        if (($context["full_width_tabs"] ?? null)) {
            // line 637
            echo "    </div>  
    ";
        }
        // line 639
        echo "

";
        // line 641
        if ( !($context["full_width_tabs"] ?? null)) {
            // line 642
            echo "</div> <!-- main column ends -->
";
            // line 643
            echo ($context["column_right"] ?? null);
            echo "
</div> <!-- .row ends -->
</div> <!-- .container ends -->
";
        }
        // line 647
        echo "

   <!-- Modal -->
    <div class=\"modal fade\" id=\"sizeModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"sizeModalLabel\">
        <div class=\"modal-dialog\" role=\"document\"  id=\"velicinet\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close close-modal\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <h4 class=\"modal-title\" id=\"myModalLabel\">Vodič za veličine </h4>
                </div>

                <div class=\"modal-body\" style=\"padding-top: 0px;\">
                 <div style=\"overflow-x: auto;\">

                  <table class=\"sizechart-main-table table table-striped table-bordered table-responsive\" style=\"width: 100%;\">



<tbody>
  <tr>
<td>
<p>VELIČINA</p>
</td>
<td>
<p>OPSEG GRUDI&nbsp;&nbsp;(cm)&nbsp;</p>
</td>
<td>
<p>&nbsp;OPSEG STRUKA&nbsp;(cm)</p>
</td>
<td>
<p>OPSEG BOKOVA (cm)</p>
</td>
<td>
<p>DULJINA U KORAKU (cm)</p>
</td>
</tr>
<tr>
<td>XS</td>
<td>80-83</td>
<td>62-65</td>
<td>88-93</td>
<td>76</td>
</tr>
<tr>
<td>S</td>
<td>84-88</td>
<td>66-70</td>
<td>94-98</td>
<td>76</td>
</tr>
<tr>
<td>M</td>
<td>89-93</td>
<td>71-75</td>
<td>99-103</td>
<td>76.5</td>
</tr>
<tr>
<td>L</td>
<td>94-98</td>
<td>76-80</td>
<td>104-108</td>
<td>77</td>
</tr>
<tr>
<td>XL</td>
<td>99-103</td>
<td>81-85</td>
<td>&aring;109-114</td>
<td>77</td>
</tr>
</tbody>
</table>





                </div>  <p><strong>Kako se pravilno izmjeriti?</strong></p> <p><strong>Opseg grudi&nbsp;</strong>- Mjeri ispod ruku oko najšireg dijela grudi. Pripazi da traka za mjerenje nije previše stegnuta.</p> <p><strong>Opseg struka -&nbsp;</strong>Izmjeri na najužem dijelu struka, pazi da traka za mjerenje nije previše stegnuta.</p> <p><strong>Opseg bokova</strong> - Mjeri oko najšireg dijela bokova i pazi da ti stopala nisu previše odmaknuta.</p> <p><strong>Duljina u koraku</strong> - Izmjeri unutarnju stranu nogu od prepona do poda.</p></div>
            


             </div>
        </div>
    </div>

<script src=\"catalog/view/theme/basel/js/lightgallery/js/lightgallery.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/lightgallery/js/lg-zoom.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/cloudzoom/cloud-zoom.1.0.2.min.js\"></script>
";
        // line 736
        if (($context["basel_price_update"] ?? null)) {
            // line 737
            echo "<script src=\"index.php?route=extension/basel/live_options/js&product_id=";
            echo ($context["product_id"] ?? null);
            echo "\"></script>
";
        }
        // line 739
        echo "
";
        // line 740
        if (($context["products"] ?? null)) {
            // line 741
            echo "<script><!--
\$('.grid-holder.related').slick({
prevArrow: \"<a class=\\\"arrow-left icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"arrow-right icon-arrow-right\\\"></a>\",
dots:true,
";
            // line 746
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 747
                echo "rtl: true,
";
            }
            // line 749
            echo "respondTo:'min',
";
            // line 750
            if ((($context["basel_rel_prod_grid"] ?? null) == "5")) {
                // line 751
                echo "slidesToShow:5,slidesToScroll:5,responsive:[{breakpoint:1100,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 752
($context["basel_rel_prod_grid"] ?? null) == "4")) {
                // line 753
                echo "slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:960,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 754
($context["basel_rel_prod_grid"] ?? null) == "3")) {
                // line 755
                echo "slidesToShow:3,slidesToScroll:3,responsive:[{breakpoint:600,settings:{slidesToShow:2,slidesToScroll:2}},
";
            } elseif ((            // line 756
($context["basel_rel_prod_grid"] ?? null) == "2")) {
                // line 757
                echo "slidesToShow:2,slidesToScroll:2,responsive:[
";
            }
            // line 759
            if (($context["items_mobile_fw"] ?? null)) {
                // line 760
                echo "{breakpoint:320,settings:{slidesToShow:1,slidesToScroll:1}}
";
            }
            // line 762
            echo "]
});
\$('.product-style2 .single-product .icon').attr('data-placement', 'top');
\$('[data-toggle=\\'tooltip\\']').tooltip({container: 'body'});
//--></script>
";
        }
        // line 768
        echo "
";
        // line 769
        if ((($context["sale_end_date"] ?? null) && ($context["product_page_countdown"] ?? null))) {
            // line 770
            echo " <script>
  \$(function() {
\t\$('#special_countdown').countdown('";
            // line 772
            echo ($context["sale_end_date"] ?? null);
            echo "').on('update.countdown', function(event) {
  var \$this = \$(this).html(event.strftime(''
    + '<div class=\\\"special_countdown\\\"></span><p><span class=\\\"icon-clock\\\"></span> ";
            // line 774
            echo ($context["basel_text_offer_ends"] ?? null);
            echo "</p><div>'
    + '%D<i>";
            // line 775
            echo ($context["basel_text_days"] ?? null);
            echo "</i></div><div>'
    + '%H <i>";
            // line 776
            echo ($context["basel_text_hours"] ?? null);
            echo "</i></div><div>'
    + '%M <i>";
            // line 777
            echo ($context["basel_text_mins"] ?? null);
            echo "</i></div><div>'
    + '%S <i>";
            // line 778
            echo ($context["basel_text_secs"] ?? null);
            echo "</i></div></div>'));
});
  });
</script>
";
        }
        // line 783
        echo "
<script><!--
\$('select[name=\\'recurring_id\\'], input[name=\"quantity\"]').change(function(){
\t\$.ajax({
\t\turl: 'index.php?route=product/product/getRecurringDescription',
\t\ttype: 'post',
\t\tdata: \$('input[name=\\'product_id\\'], input[name=\\'quantity\\'], select[name=\\'recurring_id\\']'),
\t\tdataType: 'json',
\t\tbeforeSend: function() {
\t\t\t\$('#recurring-description').html('');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-dismissible, .text-danger').remove();

\t\t\tif (json['success']) {
\t\t\t\t\$('#recurring-description').html(json['success']);
\t\t\t}
\t\t}
\t});
});
//--></script>



<script>
    function wcqib_refresh_quantity_increments() {
        jQuery(\"div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)\").each(function(a, b) {
            var c = jQuery(b);
            c.addClass(\"buttons_added\"), c.children().first().before('<input type=\"button\" value=\"-\" class=\"minus\" />'), c.children().last().after('<input type=\"button\" value=\"+\" class=\"plus\" />')
        })
    }
    String.prototype.getDecimals || (String.prototype.getDecimals = function() {
        var a = this,
            b = (\"\" + a).match(/(?:\\.(\\d+))?(?:[eE]([+-]?\\d+))?\$/);
        return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
    }), jQuery(document).ready(function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on(\"updated_wc_div\", function() {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on(\"click\", \".plus, .minus\", function() {
        var a = jQuery(this).closest(\".quantity\").find(\".qty\"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr(\"max\")),
            d = parseFloat(a.attr(\"min\")),
            e = a.attr(\"step\");
        b && \"\" !== b && \"NaN\" !== b || (b = 0), \"\" !== c && \"NaN\" !== c || (c = \"\"), \"\" !== d && \"NaN\" !== d || (d = 0), \"any\" !== e && \"\" !== e && void 0 !== e && \"NaN\" !== parseFloat(e) || (e = 1), jQuery(this).is(\".plus\") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger(\"change\")
    });
</script>

<script><!--
\$('#button-cart').on('click', function() {
\t\$.ajax({
\t\turl: 'index.php?route=extension/basel/basel_features/add_to_cart',
\t\ttype: 'post',
\t\tdata: \$('#product input[type=\\'text\\'], #product input[type=\\'hidden\\'], #product input[type=\\'number\\'], #product input[type=\\'radio\\']:checked, #product input[type=\\'checkbox\\']:checked, #product select, #product textarea'),
\t\tdataType: 'json',
\t\tbeforeSend: function(json) {
\t\t\t\$('body').append('<span class=\"basel-spinner ajax-call\"></span>');
\t\t},

\t\tsuccess: function(json) {
\t\t\t\$('.alert, .text-danger').remove();
\t\t\t\$('.table-cell').removeClass('has-error');

\t\t\tif (json.error) {
\t\t\t\t\$('.basel-spinner.ajax-call').remove();
\t\t\t\tif (json.error.option) {
\t\t\t\t\tfor (i in json.error.option) {
\t\t\t\t\t\tvar element = \$('#input-option' + i.replace('_', '-'));

\t\t\t\t\t\tif (element.parent().hasClass('input-group')) {
\t\t\t\t\t\t\telement.parent().after('<div class=\"text-danger\">' + json.error.option[i] + '</div>');
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\telement.after('<div class=\"text-danger\">' + json.error.option[i] + '</div>');
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t}

\t\t\t\tif (json.error.recurring) {
\t\t\t\t\t\$('select[name=\\'recurring_id\\']').after('<div class=\"text-danger\">' + json['error']['recurring'] + '</div>');
\t\t\t\t}

\t\t\t\t// Highlight any found errors
\t\t\t\t\$('.text-danger').parent().addClass('has-error');
\t\t\t}

\t\t\t\tif (json.success_redirect) {
\t\t\t\t\t
\t\t\t\t\tlocation = json.success_redirect;
\t\t\t\t
\t\t\t\t} else if (json.success) {
\t\t\t\t\t
\t\t\t\t\t\$('.table-cell').removeClass('has-error');
\t\t\t\t\t\$('.alert, .popup-note, .basel-spinner.ajax-call, .text-danger').remove();
\t\t\t\t 
\t\t\t\t\thtml = '<div class=\"popup-note\">';
\t\t\t\t\thtml += '<div class=\"inner\">';
\t\t\t\t\thtml += '<a class=\"popup-note-close\" onclick=\"\$(this).parent().parent().remove()\">&times;</a>';
\t\t\t\t\thtml += '<div class=\"table\">';
\t\t\t\t\thtml += '<div class=\"table-cell v-top img\"><img src=\"' + json.image + '\" /></div>';
\t\t\t\t\thtml += '<div class=\"table-cell v-top\">' + json.success + '</div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t\thtml += '</div>';
\t\t\t\t\t\$('body').append(html);
\t\t\t\t\tsetTimeout(function() {\$('.popup-note').hide();}, 8100);
\t\t\t\t\t// Need to set timeout otherwise it wont update the total
\t\t\t\t\tsetTimeout(function () {
\t\t\t\t\t\$('.cart-total-items').html( json.total_items );
\t\t\t\t\t\$('.cart-total-amount').html( json.total_amount );
\t\t\t\t\t}, 100);

\t\t\t\t\t\$('#cart-content').load('index.php?route=common/cart/info #cart-content > *');
\t\t\t}
\t\t},
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
\t});
});
//--></script>

<script>
    \$(document).ready(function(){

        \$(document).on(\"click\",\".close-ikon-rate\",function() {
            \$('#kupovina-rate').popover('hide');
        });
    });

</script>


<script><!--
\$('.date').datetimepicker({
\tpickTime: false
});

\$('.datetime').datetimepicker({
\tpickDate: true,
\tpickTime: true
});

\$('.time').datetimepicker({
\tpickDate: false
});

\$('button[id^=\\'button-upload\\']').on('click', function() {
\tvar node = this;

\t\$('#form-upload').remove();

\t\$('body').prepend('<form enctype=\"multipart/form-data\" id=\"form-upload\" style=\"display: none;\"><input type=\"file\" name=\"file\" /></form>');

\t\$('#form-upload input[name=\\'file\\']').trigger('click');

\tif (typeof timer != 'undefined') {
    \tclearInterval(timer);
\t}

\ttimer = setInterval(function() {
\t\tif (\$('#form-upload input[name=\\'file\\']').val() != '') {
\t\t\tclearInterval(timer);

\t\t\t\$.ajax({
\t\t\t\turl: 'index.php?route=tool/upload',
\t\t\t\ttype: 'post',
\t\t\t\tdataType: 'json',
\t\t\t\tdata: new FormData(\$('#form-upload')[0]),
\t\t\t\tcache: false,
\t\t\t\tcontentType: false,
\t\t\t\tprocessData: false,
\t\t\t\tbeforeSend: function() {
\t\t\t\t\t\$(node).button('loading');
\t\t\t\t},
\t\t\t\tcomplete: function() {
\t\t\t\t\t\$(node).button('reset');
\t\t\t\t},
\t\t\t\tsuccess: function(json) {
\t\t\t\t\t\$('.text-danger').remove();

\t\t\t\t\tif (json['error']) {
\t\t\t\t\t\t\$(node).parent().find('input').after('<div class=\"text-danger\">' + json['error'] + '</div>');
\t\t\t\t\t}

\t\t\t\t\tif (json['success']) {
\t\t\t\t\t\talert(json['success']);

\t\t\t\t\t\t\$(node).parent().find('input').val(json['code']);
\t\t\t\t\t}
\t\t\t\t},
\t\t\t\terror: function(xhr, ajaxOptions, thrownError) {
\t\t\t\t\talert(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
\t\t\t\t}
\t\t\t});
\t\t}
\t}, 500);
});
//--></script>
<script><!--
\$('#review').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
\t\$(\"html,body\").animate({scrollTop:((\$(\"#review\").offset().top)-50)},500);
    \$('#review').fadeOut(50);

    \$('#review').load(this.href);

    \$('#review').fadeIn(500);
\t
});


\$('#button-review').on('click', function() {
\t\$.ajax({
\t\turl: 'index.php?route=product/product/write&product_id=";
        // line 997
        echo ($context["product_id"] ?? null);
        echo "',
\t\ttype: 'post',
\t\tdataType: 'json',
\t\tdata: \$(\"#form-review\").serialize(),
\t\tbeforeSend: function() {
\t\t\t\$('#button-review').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-review').button('reset');
\t\t},
\t\tsuccess: function(json) {
\t\t\t\$('.alert-success, .alert-danger').remove();

\t\t\tif (json.error) {
\t\t\t\t\$('#review-notification').after('<div class=\"alert alert-sm alert-danger\"><i class=\"fa fa-exclamation-circle\"></i> ' + json.error + '</div>');
\t\t\t}

\t\t\tif (json.success) {
\t\t\t\t\$('#review-notification').after('<div class=\"alert alert-sm alert-success\"><i class=\"fa fa-check-circle\"></i> ' + json.success + '</div>');

\t\t\t\t\$('input[name=\\'name\\']').val('');
\t\t\t\t\$('textarea[name=\\'text\\']').val('');
\t\t\t\t\$('input[name=\\'rating\\']:checked').prop('checked', false);
\t\t\t}
\t\t}
\t});
});

\$(document).ready(function() {
";
        // line 1026
        if ((($context["product_layout"] ?? null) == "full-width")) {
            // line 1027
            echo "// Sticky information
\$('.table-cell.right .inner').theiaStickySidebar({containerSelector:'.product-info'});
";
        }
        // line 1030
        echo "
// Reviews/Question scroll link
\$(\".to_tabs\").click(function() {
    \$('html, body').animate({
        scrollTop: (\$(\".main_tabs\").offset().top - 100)
    }, 1000);
});

// Sharing buttons
";
        // line 1039
        if (($context["basel_share_btn"] ?? null)) {
            // line 1040
            echo "var share_url = encodeURIComponent(window.location.href);
var page_title = '";
            // line 1041
            echo ($context["heading_title"] ?? null);
            echo "';
";
            // line 1042
            if (($context["thumb"] ?? null)) {
                // line 1043
                echo "var thumb = '";
                echo ($context["thumb"] ?? null);
                echo "';
";
            }
            // line 1045
            echo "\$('.fb_share').attr(\"href\", 'https://www.facebook.com/sharer/sharer.php?u=' + share_url + '');
\$('.twitter_share').attr(\"href\", 'https://twitter.com/intent/tweet?source=' + share_url + '&text=' + page_title + ': ' + share_url + '');
\$('.google_share').attr(\"href\", 'https://plus.google.com/share?url=' + share_url + '');
\$('.pinterest_share').attr(\"href\", 'http://pinterest.com/pin/create/button/?url=' + share_url + '&media=' + thumb + '&description=' + page_title + '');
\$('.vk_share').attr(\"href\", 'http://vkontakte.ru/share.php?url=' + share_url + '');
";
        }
        // line 1051
        echo "});
//--></script>

";
        // line 1054
        if ((($context["product_layout"] ?? null) != "full-width")) {
            // line 1055
            echo "<script>
\$(document).ready(function() {
\$('.image-additional a.link').click(function (e) {
\tif (\$(this).hasClass(\"locked\")) {
  \t\te.stopImmediatePropagation();
\t}
\t\$('.image-additional a.link.active').removeClass('active');
\t\$(this).addClass('active')
});

";
            // line 1065
            if (($context["images"] ?? null)) {
                // line 1066
                echo "\$('.cloud-zoom-wrap').click(function (e) {
\te.preventDefault();
\t\$('.image-additional a.link.active').removeClass('locked').trigger('click').addClass('locked');
});
";
            } else {
                // line 1071
                echo "\$('.cloud-zoom-wrap').click(function (e) {
\te.preventDefault();
\t\$('#main-image').trigger('click');
});
";
            }
            // line 1076
            echo "
\$('.image-additional').slick({
prevArrow: \"<a class=\\\"icon-arrow-left\\\"></a>\",
nextArrow: \"<a class=\\\"icon-arrow-right\\\"></a>\",
appendArrows: '.image-additional .slick-list',
arrows:true,
";
            // line 1082
            if ((($context["direction"] ?? null) == "rtl")) {
                // line 1083
                echo "rtl: true,
";
            }
            // line 1085
            echo "infinite:false,
";
            // line 1086
            if ((($context["product_layout"] ?? null) == "images-left")) {
                // line 1087
                echo "slidesToShow: ";
                echo twig_round((($context["img_h"] ?? null) / ($context["img_a_h"] ?? null)), 0, "floor");
                echo ",
vertical:true,
verticalSwiping:true,
";
            } else {
                // line 1091
                echo "slidesToShow: ";
                echo twig_round((($context["img_w"] ?? null) / ($context["img_a_w"] ?? null)));
                echo ",
";
            }
            // line 1093
            echo "responsive: [
{
breakpoint: 992,
settings: {
vertical:false,
verticalSwiping:false
}
}]
});\t

});
//--></script>
";
        }
        // line 1106
        echo "<script>
\$(document).ready(function() {
// Image Gallery
\$(\"#gallery\").lightGallery({
\tselector: '.link',
\tdownload:false,
\thideBarsDelay:99999
});
});
//--></script>
<script type=\"application/ld+json\">
{
\"@context\": \"http://schema.org\",
\"@type\": \"Product\",
\"image\": [
";
        // line 1121
        if (($context["thumb"] ?? null)) {
            // line 1122
            echo "\"";
            echo ($context["thumb"] ?? null);
            echo "\"
";
        }
        // line 1124
        echo "],
\"description\": \"";
        // line 1125
        echo ($context["meta_description"] ?? null);
        echo "\",
";
        // line 1126
        if (($context["review_qty"] ?? null)) {
            // line 1127
            echo "\"aggregateRating\": {
\"@type\": \"AggregateRating\",
\"ratingValue\": \"";
            // line 1129
            echo ($context["rating"] ?? null);
            echo "\",
\"reviewCount\": \"";
            // line 1130
            echo ($context["review_qty"] ?? null);
            echo "\"},
";
        }
        // line 1132
        echo "\"name\": \"";
        echo ($context["heading_title"] ?? null);
        echo "\",
\"sku\": \"";
        // line 1133
        echo ($context["model"] ?? null);
        echo "\",
";
        // line 1134
        if (($context["manufacturer"] ?? null)) {
            // line 1135
            echo "\"brand\": \"";
            echo ($context["manufacturer"] ?? null);
            echo "\",
";
        }
        // line 1137
        echo "\"offers\": {
\"@type\": \"Offer\",
";
        // line 1139
        if ((($context["qty"] ?? null) > 0)) {
            // line 1140
            echo "\"availability\": \"http://schema.org/InStock\",
";
        } else {
            // line 1142
            echo "\"availability\": \"http://schema.org/OutOfStock\",
";
        }
        // line 1144
        if (($context["price"] ?? null)) {
            // line 1145
            if (($context["special"] ?? null)) {
                // line 1146
                echo "\"price\": \"";
                echo ($context["special_snippet"] ?? null);
                echo "\",
";
            } else {
                // line 1148
                echo "\"price\": \"";
                echo ($context["price_snippet"] ?? null);
                echo "\",
";
            }
            // line 1150
            echo "\"priceCurrency\": \"";
            echo ($context["currency_code"] ?? null);
            echo "\"
";
        }
        // line 1152
        echo "}
}
</script>
";
        // line 1155
        echo ($context["footer"] ?? null);
    }

    public function getTemplateName()
    {
        return "basel/template/product/product.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  2418 => 1155,  2413 => 1152,  2407 => 1150,  2401 => 1148,  2395 => 1146,  2393 => 1145,  2391 => 1144,  2387 => 1142,  2383 => 1140,  2381 => 1139,  2377 => 1137,  2371 => 1135,  2369 => 1134,  2365 => 1133,  2360 => 1132,  2355 => 1130,  2351 => 1129,  2347 => 1127,  2345 => 1126,  2341 => 1125,  2338 => 1124,  2332 => 1122,  2330 => 1121,  2313 => 1106,  2298 => 1093,  2292 => 1091,  2284 => 1087,  2282 => 1086,  2279 => 1085,  2275 => 1083,  2273 => 1082,  2265 => 1076,  2258 => 1071,  2251 => 1066,  2249 => 1065,  2237 => 1055,  2235 => 1054,  2230 => 1051,  2222 => 1045,  2216 => 1043,  2214 => 1042,  2210 => 1041,  2207 => 1040,  2205 => 1039,  2194 => 1030,  2189 => 1027,  2187 => 1026,  2155 => 997,  1939 => 783,  1931 => 778,  1927 => 777,  1923 => 776,  1919 => 775,  1915 => 774,  1910 => 772,  1906 => 770,  1904 => 769,  1901 => 768,  1893 => 762,  1889 => 760,  1887 => 759,  1883 => 757,  1881 => 756,  1878 => 755,  1876 => 754,  1873 => 753,  1871 => 752,  1868 => 751,  1866 => 750,  1863 => 749,  1859 => 747,  1857 => 746,  1850 => 741,  1848 => 740,  1845 => 739,  1839 => 737,  1837 => 736,  1746 => 647,  1739 => 643,  1736 => 642,  1734 => 641,  1730 => 639,  1726 => 637,  1724 => 636,  1719 => 634,  1716 => 633,  1711 => 630,  1697 => 629,  1694 => 628,  1677 => 627,  1673 => 626,  1666 => 622,  1661 => 619,  1659 => 618,  1656 => 617,  1652 => 615,  1650 => 614,  1644 => 610,  1640 => 608,  1638 => 607,  1629 => 600,  1622 => 596,  1616 => 594,  1607 => 590,  1598 => 584,  1589 => 578,  1584 => 576,  1576 => 571,  1572 => 570,  1548 => 549,  1543 => 546,  1541 => 545,  1537 => 544,  1529 => 538,  1523 => 536,  1520 => 535,  1514 => 533,  1511 => 532,  1501 => 528,  1493 => 523,  1486 => 521,  1481 => 518,  1476 => 517,  1474 => 516,  1468 => 513,  1463 => 510,  1461 => 509,  1458 => 508,  1452 => 505,  1449 => 504,  1447 => 503,  1444 => 502,  1439 => 499,  1432 => 497,  1423 => 494,  1419 => 493,  1416 => 492,  1412 => 491,  1405 => 487,  1401 => 485,  1397 => 484,  1393 => 482,  1391 => 481,  1388 => 480,  1385 => 479,  1376 => 476,  1371 => 475,  1366 => 474,  1364 => 473,  1358 => 470,  1351 => 465,  1343 => 463,  1340 => 462,  1334 => 460,  1331 => 459,  1325 => 457,  1322 => 456,  1319 => 455,  1308 => 453,  1303 => 452,  1301 => 451,  1297 => 450,  1293 => 449,  1286 => 444,  1282 => 442,  1277 => 439,  1275 => 438,  1272 => 437,  1265 => 433,  1262 => 432,  1260 => 431,  1246 => 419,  1227 => 417,  1225 => 416,  1222 => 415,  1214 => 413,  1212 => 412,  1209 => 411,  1201 => 409,  1199 => 408,  1192 => 406,  1189 => 405,  1179 => 403,  1177 => 402,  1166 => 400,  1163 => 399,  1155 => 397,  1153 => 396,  1145 => 390,  1139 => 388,  1137 => 387,  1131 => 386,  1125 => 385,  1119 => 381,  1113 => 379,  1111 => 378,  1107 => 376,  1102 => 373,  1094 => 369,  1092 => 368,  1089 => 367,  1082 => 362,  1074 => 360,  1066 => 358,  1064 => 357,  1059 => 355,  1048 => 353,  1044 => 351,  1041 => 350,  1035 => 346,  1024 => 344,  1020 => 343,  1016 => 342,  1010 => 339,  1007 => 338,  1005 => 337,  1002 => 336,  997 => 333,  990 => 332,  976 => 325,  967 => 321,  959 => 319,  957 => 318,  954 => 317,  940 => 310,  931 => 306,  923 => 304,  921 => 303,  918 => 302,  904 => 295,  895 => 291,  887 => 289,  885 => 288,  882 => 287,  873 => 283,  865 => 282,  859 => 279,  851 => 277,  849 => 276,  846 => 275,  833 => 271,  825 => 268,  817 => 266,  815 => 265,  812 => 264,  799 => 260,  791 => 257,  783 => 255,  781 => 254,  777 => 252,  771 => 248,  762 => 244,  755 => 242,  753 => 241,  749 => 240,  746 => 239,  724 => 237,  722 => 236,  716 => 235,  708 => 233,  704 => 232,  700 => 231,  694 => 228,  686 => 226,  684 => 225,  681 => 224,  674 => 219,  665 => 215,  658 => 213,  656 => 212,  652 => 211,  649 => 210,  627 => 208,  625 => 207,  617 => 206,  613 => 204,  609 => 203,  604 => 201,  597 => 197,  589 => 195,  587 => 194,  584 => 193,  578 => 189,  571 => 187,  564 => 185,  562 => 184,  555 => 183,  551 => 182,  547 => 181,  541 => 180,  533 => 177,  525 => 175,  523 => 174,  520 => 173,  516 => 172,  513 => 171,  511 => 170,  505 => 166,  499 => 164,  497 => 163,  492 => 160,  488 => 159,  484 => 157,  472 => 155,  468 => 154,  465 => 153,  463 => 152,  460 => 151,  452 => 149,  450 => 148,  446 => 146,  438 => 144,  436 => 143,  433 => 142,  421 => 138,  411 => 136,  409 => 135,  406 => 134,  404 => 133,  401 => 132,  396 => 130,  389 => 126,  386 => 125,  384 => 124,  378 => 121,  371 => 116,  364 => 111,  360 => 109,  346 => 107,  343 => 106,  322 => 103,  319 => 102,  315 => 101,  312 => 100,  310 => 99,  307 => 98,  285 => 95,  282 => 94,  276 => 92,  274 => 91,  271 => 90,  265 => 88,  263 => 87,  260 => 86,  254 => 84,  252 => 83,  248 => 81,  246 => 80,  238 => 78,  236 => 77,  227 => 71,  222 => 70,  219 => 69,  216 => 68,  213 => 67,  210 => 66,  207 => 65,  204 => 64,  202 => 63,  198 => 62,  193 => 60,  189 => 58,  178 => 56,  174 => 55,  170 => 53,  164 => 49,  158 => 47,  153 => 45,  149 => 44,  145 => 43,  139 => 40,  135 => 38,  129 => 36,  124 => 34,  120 => 33,  115 => 30,  110 => 28,  106 => 27,  102 => 25,  96 => 23,  91 => 21,  87 => 20,  83 => 19,  77 => 16,  73 => 14,  67 => 12,  62 => 10,  58 => 9,  54 => 7,  52 => 6,  48 => 4,  42 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/product/product.twig", "");
    }
}
