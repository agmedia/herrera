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

/* basel/template/common/footer.twig */
class __TwigTemplate_bf92f8ad8804d9daa6a60d181d2f8a08768c6f277b3c0f1a5734f6e63281e285 extends \Twig\Template
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
        echo "<div class=\"container\">
";
        // line 2
        echo ($context["position_bottom_half"] ?? null);
        echo "
</div>
<div class=\"container\">
";
        // line 5
        echo ($context["position_bottom"] ?? null);
        echo "
</div>
<div id=\"footer\">
<div class=\"container\">
";
        // line 9
        if ((($context["footer_block_1"] ?? null) && (($context["footer_block_1"] ?? null) != "<p><br></p>"))) {
            // line 10
            echo "<div class=\"footer-top-block\">
";
            // line 11
            echo ($context["footer_block_1"] ?? null);
            echo "
</div>
";
        }
        // line 14
        echo "<div class=\"row links-holder\">
<div class=\"col-xs-12 col-sm-8\">
  <div class=\"row\">
  ";
        // line 17
        if (($context["custom_links"] ?? null)) {
            // line 18
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["basel_footer_columns"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 19
                echo "    <div class=\"footer-column col-xs-6 col-sm-6 ";
                echo ($context["basel_columns_count"] ?? null);
                echo " eq_height\">
      ";
                // line 20
                if (twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 20)) {
                    // line 21
                    echo "        <h5>";
                    echo twig_get_attribute($this->env, $this->source, $context["column"], "title", [], "any", false, false, false, 21);
                    echo "</h5>
      ";
                }
                // line 23
                echo "      ";
                if (twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", true, true, false, 23)) {
                    // line 24
                    echo "      <ul class=\"list-unstyled\">
      ";
                    // line 25
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["column"], "links", [], "any", false, false, false, 25));
                    foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                        // line 26
                        echo "      <li><a href=\"";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "target", [], "any", false, false, false, 26);
                        echo "\">";
                        echo twig_get_attribute($this->env, $this->source, $context["link"], "title", [], "any", false, false, false, 26);
                        echo "</a></li>
      ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 28
                    echo "      </ul>
      ";
                }
                // line 30
                echo "    </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "  ";
        } else {
            // line 33
            echo "      ";
            if (($context["informations"] ?? null)) {
                // line 34
                echo "      <div class=\"footer-column col-xs-12 col-sm-4 eq_height\">
        <h5> <a  role=\"button\" data-toggle=\"collapse\" href=\"#collapse1\" aria-expanded=\"false\" aria-controls=\"collapse1\">
            ";
                // line 36
                echo ($context["text_information"] ?? null);
                echo "  <b class=\"pull-right visible-xs\">+</b>
          </a></h5>
          <div class=\"collapse in\" id=\"collapse1\">
              <ul class=\"list-unstyled\">
                ";
                // line 40
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["informations"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["information"]) {
                    // line 41
                    echo "                <li><a href=\"";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "href", [], "any", false, false, false, 41);
                    echo "\">";
                    echo twig_get_attribute($this->env, $this->source, $context["information"], "title", [], "any", false, false, false, 41);
                    echo "</a></li>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['information'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 43
                echo "               
              </ul>
         </div>
      </div>
      ";
            }
            // line 48
            echo "      <div class=\"footer-column col-xs-12 col-sm-4 eq_height\">
        <h5> <a  role=\"button\" data-toggle=\"collapse\" href=\"#collapse2\" aria-expanded=\"false\" aria-controls=\"collapse2\">
            ";
            // line 50
            echo ($context["text_extra"] ?? null);
            echo " <b class=\"pull-right visible-xs\">+</b> 
          </a></h5>

          <div class=\"collapse in\" id=\"collapse2\">
              <ul class=\"list-unstyled\">
               
               <li><a href=\"";
            // line 56
            echo ($context["contact"] ?? null);
            echo "\">";
            echo ($context["text_contact"] ?? null);
            echo "</a></li>
                <li><a href=\"https://ec.europa.eu/consumers/odr/main/?event=main.home2.show\">";
            // line 57
            echo ($context["text_sporovi"] ?? null);
            echo "</a></li>
                <li><a href=\"akcije\">";
            // line 58
            echo ($context["text_special"] ?? null);
            echo "</a></li>
                <li><a href=\"";
            // line 59
            echo ($context["sitemap"] ?? null);
            echo "\">";
            echo ($context["text_sitemap"] ?? null);
            echo "</a></li>
              </ul>
            </div>
      </div>
      <div class=\"footer-column hidden-xs col-sm-4 eq_height\">
        <h5>";
            // line 64
            echo ($context["text_account"] ?? null);
            echo "</h5>
        <ul class=\"list-unstyled\">
          <li><a href=\"";
            // line 66
            echo ($context["account"] ?? null);
            echo "\">";
            echo ($context["text_account"] ?? null);
            echo "</a></li>
          <li><a href=\"";
            // line 67
            echo ($context["order"] ?? null);
            echo "\">";
            echo ($context["text_order"] ?? null);
            echo "</a></li>
          <li class=\"is_wishlist\"><a href=\"";
            // line 68
            echo ($context["wishlist"] ?? null);
            echo "\">";
            echo ($context["text_wishlist"] ?? null);
            echo "</a></li>
          <li><a href=\"";
            // line 69
            echo ($context["newsletter"] ?? null);
            echo "\">";
            echo ($context["text_newsletter"] ?? null);
            echo "</a></li>
        </ul>
      </div>
 ";
        }
        // line 73
        echo "</div><!-- .row ends -->
</div><!-- .col-md-8 ends -->
<div class=\"footer-column col-xs-12 col-sm-4\">
<div class=\"footer-custom-wrapper\">
";
        // line 77
        if (array_key_exists("footer_block_title", $context)) {
            // line 78
            echo "<h5>";
            echo ($context["footer_block_title"] ?? null);
            echo "</h5>
";
        }
        // line 80
        if ((($context["footer_block_2"] ?? null) && (($context["footer_block_2"] ?? null) != "<p><br></p>"))) {
            // line 81
            echo "<div class=\"custom_block\">";
            echo ($context["footer_block_2"] ?? null);
            echo "</div>
";
        }
        // line 83
        if (array_key_exists("footer_infoline_1", $context)) {
            // line 84
            echo "<p class=\"infoline\">";
            echo ($context["footer_infoline_1"] ?? null);
            echo "</p>
";
        }
        // line 86
        if (array_key_exists("footer_infoline_2", $context)) {
            // line 87
            echo "<p class=\"infoline\">";
            echo ($context["footer_infoline_2"] ?? null);
            echo "</p>
";
        }
        // line 89
        if (array_key_exists("footer_infoline_3", $context)) {
            // line 90
            echo "<p class=\"infoline\">";
            echo ($context["footer_infoline_3"] ?? null);
            echo "</p>
";
        }
        // line 92
        if (($context["payment_img"] ?? null)) {
            // line 93
            echo "<img class=\"payment_img\" src=\"";
            echo ($context["payment_img"] ?? null);
            echo "\" alt=\"\" />
";
        }
        // line 95
        echo "</div>
</div>

 

  <div class=\"col-xs-12 text-center corvus\">
    <a href=\"http://www.wspay.info\" title=\"WSPay - internet Payment Gateway\" target=\"_blank\"><img src=\"image/catalog/credit-cards/wsPay.svg\" style=\"max-width:140px\" alt=\"WSPay Payment\"></a>

  </div>

  <div class=\"col-xs-12 text-center cardspayment\" style=\"margin-top:15px;margin-bottom:15px\">
    <img style=\"height: 35px;margin-right:3px\" src=\"image/catalog/credit-cards/visa.svg\"  alt=\"visa\">
    <img style=\"height: 35px;margin-right:3px\" src=\"image/catalog/credit-cards/maestro.svg\"  alt=\"maestro\">
    <img style=\"height: 35px;margin-right:3px\" src=\"image/catalog/credit-cards/mastercard.svg\"  alt=\"mastercard\">
    <img style=\"height: 35px;margin-right:3px\" src=\"image/catalog/credit-cards/diners.svg\"  alt=\"diners\">


  </div>

</div><!-- .row ends -->






</div>
";
        // line 122
        if (($context["basel_copyright"] ?? null)) {
            // line 123
            echo "<div class=\"footer-copyright\">";
            echo ($context["basel_copyright"] ?? null);
            echo "</div>
";
        }
        // line 125
        echo "</div>
<link href=\"catalog/view/javascript/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\" />
<link href=\"catalog/view/theme/basel/js/lightgallery/css/lightgallery.css\" rel=\"stylesheet\" />
<script src=\"catalog/view/theme/basel/js/jquery.matchHeight.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/countdown.js\"></script>
<script src=\"catalog/view/theme/basel/js/live_search.js\"></script>
<script src=\"catalog/view/theme/basel/js/featherlight.js\"></script>

    <script>
        \$(document).ready(function(){
          if (\$(window).width() <= 768) {
            \$(\"#collapse1\").removeClass(\"in\");
            \$(\"#collapse2\").removeClass(\"in\");
             \$(\"#collapse3\").removeClass(\"in\");
          }
        });
      </script>
";
        // line 142
        if (($context["view_popup"] ?? null)) {
            // line 143
            echo "<!-- Popup -->
<script>
\$(document).ready(function() {
if (\$(window).width() > ";
            // line 146
            echo ($context["popup_width_limit"] ?? null);
            echo ") {
setTimeout(function() {
\$.featherlight({ajax: 'index.php?route=extension/basel/basel_features/basel_popup', variant:'popup-wrapper'});
}, ";
            // line 149
            echo ($context["popup_delay"] ?? null);
            echo ");
}
});
</script>
";
        }
        // line 154
        if (($context["sticky_columns"] ?? null)) {
            // line 155
            echo "<!-- Sticky columns -->
<script>
if (\$(window).width() > 767) {
\$('#column-left, #column-right').theiaStickySidebar({containerSelector:\$(this).closest('.row'),additionalMarginTop:";
            // line 158
            echo ($context["sticky_columns_offset"] ?? null);
            echo "});
}
</script>
";
        }
        // line 162
        if (($context["view_cookie_bar"] ?? null)) {
            // line 163
            echo "<!-- Cookie bar -->
<div class=\"basel_cookie_bar\">
<div class=\"table\">
<div class=\"table-cell w100\">";
            // line 166
            echo ($context["basel_cookie_info"] ?? null);
            echo "</div>
<div class=\"table-cell button-cell\">
<a class=\"btn btn-tiny btn-light-outline\" onclick=\"\$(this).parent().parent().parent().fadeOut(400);\">";
            // line 168
            echo ($context["basel_cookie_btn_close"] ?? null);
            echo "</a>
";
            // line 169
            if (array_key_exists("href_more_info", $context)) {
                // line 170
                echo "<a class=\"more-info anim-underline light\" href=\"";
                echo ($context["href_more_info"] ?? null);
                echo "\">";
                echo ($context["basel_cookie_btn_more_info"] ?? null);
                echo "</a>
";
            }
            // line 172
            echo "</div>
</div>
</div>
";
        }
        // line 176
        echo "<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
BASEL VERSION ";
        // line 179
        echo ($context["basel_version"] ?? null);
        echo " - OPENCART VERSION 3 (";
        echo ($context["VERSION"] ?? null);
        echo ") 
//-->
</div><!-- .outer-container ends -->
<a class=\"scroll-to-top primary-bg-color hidden-sm hidden-xs\" onclick=\"\$('html, body').animate({scrollTop:0});\"><i class=\"icon-arrow-right\"></i></a>
<div id=\"featherlight-holder\"></div>
</body></html>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  411 => 179,  406 => 176,  400 => 172,  392 => 170,  390 => 169,  386 => 168,  381 => 166,  376 => 163,  374 => 162,  367 => 158,  362 => 155,  360 => 154,  352 => 149,  346 => 146,  341 => 143,  339 => 142,  320 => 125,  314 => 123,  312 => 122,  283 => 95,  277 => 93,  275 => 92,  269 => 90,  267 => 89,  261 => 87,  259 => 86,  253 => 84,  251 => 83,  245 => 81,  243 => 80,  237 => 78,  235 => 77,  229 => 73,  220 => 69,  214 => 68,  208 => 67,  202 => 66,  197 => 64,  187 => 59,  183 => 58,  179 => 57,  173 => 56,  164 => 50,  160 => 48,  153 => 43,  142 => 41,  138 => 40,  131 => 36,  127 => 34,  124 => 33,  121 => 32,  114 => 30,  110 => 28,  99 => 26,  95 => 25,  92 => 24,  89 => 23,  83 => 21,  81 => 20,  76 => 19,  71 => 18,  69 => 17,  64 => 14,  58 => 11,  55 => 10,  53 => 9,  46 => 5,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/footer.twig", "");
    }
}
