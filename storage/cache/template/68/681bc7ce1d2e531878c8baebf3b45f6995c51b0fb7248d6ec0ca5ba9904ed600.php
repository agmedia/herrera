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

/* basel/template/common/header.twig */
class __TwigTemplate_6bd898fe3027c92998f8c8abec91e19be8eadfa2a4fb7588701d01069c17bc9e extends \Twig\Template
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
        echo "<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir=\"";
        // line 3
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\" class=\"ie8\"><![endif]-->
<!--[if IE 9 ]><html dir=\"";
        // line 4
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\" class=\"ie9\"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir=\"";
        // line 6
        echo ($context["direction"] ?? null);
        echo "\" lang=\"";
        echo ($context["lang"] ?? null);
        echo "\">
<!--<![endif]-->
<head>
<meta charset=\"UTF-8\" />
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
<title>";
        // line 12
        echo ($context["title"] ?? null);
        echo "</title>
<base href=\"";
        // line 13
        echo ($context["base"] ?? null);
        echo "\" />
";
        // line 14
        if (($context["description"] ?? null)) {
            echo "<meta name=\"description\" content=\"";
            echo ($context["description"] ?? null);
            echo "\" />";
        }
        // line 15
        if (($context["keywords"] ?? null)) {
            echo "<meta name=\"keywords\" content= \"";
            echo ($context["keywords"] ?? null);
            echo "\" />";
        }
        // line 16
        echo "<!-- Load essential resources -->
<script src=\"catalog/view/javascript/jquery/jquery-2.1.1.min.js\"></script>
<link href=\"catalog/view/javascript/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\" media=\"screen\" />
<script src=\"catalog/view/javascript/bootstrap/js/bootstrap.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/slick.min.js\"></script>
<script src=\"catalog/view/theme/basel/js/basel_common.js\"></script>

<!-- Main stylesheet -->
<link href=\"catalog/view/theme/basel/stylesheet/stylesheet.css\" rel=\"stylesheet\">

<!-- Mandatory Theme Settings CSS -->
<style id=\"basel-mandatory-css\">";
        // line 27
        echo ($context["basel_mandatory_css"] ?? null);
        echo "</style>
<!-- Plugin Stylesheet(s) -->
";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 30
            echo "<link href=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 30);
            echo "\" rel=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 30);
            echo "\" media=\"";
            echo twig_get_attribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 30);
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        if ((($context["direction"] ?? null) == "rtl")) {
            // line 33
            echo "<link href=\"catalog/view/theme/basel/stylesheet/rtl.css\" rel=\"stylesheet\">
";
        }
        // line 35
        echo "<!-- Pluing scripts(s) -->
";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 37
            echo "<script src=\"";
            echo $context["script"];
            echo "\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "<!-- Page specific meta information -->
";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 41
            if ((twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 41) == "image")) {
                // line 42
                echo "
";
            } else {
                // line 44
                echo "<link href=\"";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 44);
                echo "\" rel=\"";
                echo twig_get_attribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 44);
                echo "\" />
";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "<!--favicon-->
<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"/apple-touch-icon.png\">
<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"/favicon-32x32.png\">
<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"/favicon-16x16.png\">
<link rel=\"manifest\" href=\"/site.webmanifest\">
<link rel=\"mask-icon\" href=\"/safari-pinned-tab.svg\" color=\"#00a9a3\">
<meta name=\"msapplication-TileColor\" content=\"#00a9a3\">
<meta name=\"theme-color\" content=\"#ffffff\">
<!-- Analytic tools -->
";
        // line 56
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 57
            echo $context["analytic"];
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['analytic'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        if (($context["basel_styles_status"] ?? null)) {
            // line 60
            echo "<!-- Custom Color Scheme -->
<style id=\"basel-color-scheme\">";
            // line 61
            echo ($context["basel_styles_cache"] ?? null);
            echo ";</style>
";
        }
        // line 63
        if (($context["basel_typo_status"] ?? null)) {
            // line 64
            echo "<!-- Custom Fonts -->
<style id=\"basel-fonts\">";
            // line 65
            echo ($context["basel_fonts_cache"] ?? null);
            echo "</style>
";
        }
        // line 67
        if (($context["basel_custom_css_status"] ?? null)) {
            // line 68
            echo "<!-- Custom CSS -->
<style id=\"basel-custom-css\">
";
            // line 70
            echo ($context["basel_custom_css"] ?? null);
            echo "
</style>
";
        }
        // line 73
        if (($context["basel_custom_js_status"] ?? null)) {
            // line 74
            echo "<!-- Custom Javascript -->
<script>
";
            // line 76
            echo ($context["basel_custom_js"] ?? null);
            echo "
</script>
";
        }
        // line 79
        echo "
\t\t\t";
        // line 80
        if (($context["mpgdpr_cbstatus"] ?? null)) {
            // line 81
            echo "\t\t\t<!-- /*start gdpr 28-07-2018*/ -->
\t\t\t<!-- /*mpgdpr starts*/ -->
\t\t\t<link href=\"catalog/view/javascript/mpgdpr/cookieconsent/cookieconsent.min.css\" rel=\"stylesheet\">
\t\t\t<script type=\"text/javascript\" src=\"catalog/view/javascript/mpgdpr/cookieconsent/cookieconsent.js\"></script>
\t\t\t<script type=\"text/javascript\">
\t\t\t  \$(document).ready(function() {
\t\t\t    // remove cookie using js
\t\t\t    /*cookieconsent_status, mpcookie_preferencesdisable*/

\t\t\t    \$.get('index.php?route=mpgdpr/preferenceshtml/getPreferencesHtml', function(json) {
\t\t\t      if(json) {
\t\t\t        \$('body').append(json);
\t\t\t        mpgdpr.handle_cookie();
\t\t\t        mpgdpr.maintainance_cookies();
\t\t\t        mpgdpr.cookieconsent();
\t\t\t        setTimeout(function() {
\t\t\t        \t//console.log(mpgdpr.instance)
\t\t\t        },500);
\t\t\t      }
\t\t\t    })
\t\t\t  });
\t\t\t</script>
\t\t\t<!-- /*mpgdpr ends*/ -->
\t\t\t<!-- /*end gdpr 28-07-2018*/ -->
\t\t\t";
        }
        // line 106
        echo "\t\t\t

                ";
        // line 108
        if (twig_test_iterable(($context["opengraphs"] ?? null))) {
            // line 109
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["opengraphs"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["opengraph"]) {
                echo " 
                    <meta property=\"";
                // line 110
                echo (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["opengraph"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["meta"] ?? null) : null);
                echo "\" content=\"";
                echo (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["opengraph"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["content"] ?? null) : null);
                echo "\" />
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['opengraph'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo " 
                ";
        }
        // line 112
        echo " 
                
                ";
        // line 114
        if (twig_test_iterable(($context["twittercards"] ?? null))) {
            // line 115
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["twittercards"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["twittercard"]) {
                echo " 
                    <meta name=\"";
                // line 116
                echo (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["twittercard"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["name"] ?? null) : null);
                echo "\" content=\"";
                echo (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["twittercard"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["content"] ?? null) : null);
                echo "\" />
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['twittercard'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 117
            echo " 
                ";
        }
        // line 118
        echo " 
                
                ";
        // line 120
        if (twig_test_iterable(($context["jsonld_data"] ?? null))) {
            // line 121
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["jsonld_data"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["jsonld"]) {
                echo " 
                    ";
                // line 122
                echo (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = $context["jsonld"]) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["content"] ?? null) : null);
                echo " 
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['jsonld'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 123
            echo " 
                ";
        }
        // line 125
        echo "\t\t\t\t
</head>
<body class=\"";
        // line 127
        echo ($context["class"] ?? null);
        echo ($context["basel_body_class"] ?? null);
        echo "\">

";
        // line 129
        $this->loadTemplate("basel/template/common/mobile-nav.twig", "basel/template/common/header.twig", 129)->display($context);
        // line 130
        echo "<div class=\"outer-container main-wrapper\">
";
        // line 131
        if (($context["notification_status"] ?? null)) {
            // line 132
            echo "<div class=\"top_notificaiton\">
  <div class=\"container";
            // line 133
            if (($context["top_promo_close"] ?? null)) {
                echo " has-close";
            }
            echo " ";
            echo ($context["top_promo_width"] ?? null);
            echo " ";
            echo ($context["top_promo_align"] ?? null);
            echo "\">
    <div class=\"table\">
    <div class=\"table-cell w100\"><div class=\"ellipsis-wrap\">";
            // line 135
            echo ($context["top_promo_text"] ?? null);
            echo "</div></div>
    ";
            // line 136
            if (($context["top_promo_close"] ?? null)) {
                // line 137
                echo "    <div class=\"table-cell text-right\">
    <a onClick=\"addCookie('basel_top_promo', 1, 30);\$(this).closest('.top_notificaiton').slideUp();\" class=\"top_promo_close\">&times;</a>
    </div>
    ";
            }
            // line 141
            echo "    </div>
  </div>
</div>
";
        }
        // line 145
        $this->loadTemplate((("basel/template/common/headers/" . ($context["basel_header"] ?? null)) . ".twig"), "basel/template/common/header.twig", 145)->display($context);
        // line 146
        echo "<!-- breadcrumb -->
<div class=\"breadcrumb-holder\">
<div class=\"container\">
<span id=\"title-holder\">&nbsp;</span>
<div class=\"links-holder\">
<a class=\"basel-back-btn\" onClick=\"history.go(-1); return false;\"><i></i></a><span>&nbsp;</span>
</div>
</div>
</div>
<div class=\"container\">
";
        // line 156
        echo ($context["position_top"] ?? null);
        echo "
</div>";
    }

    public function getTemplateName()
    {
        return "basel/template/common/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  408 => 156,  396 => 146,  394 => 145,  388 => 141,  382 => 137,  380 => 136,  376 => 135,  365 => 133,  362 => 132,  360 => 131,  357 => 130,  355 => 129,  349 => 127,  345 => 125,  341 => 123,  333 => 122,  326 => 121,  324 => 120,  320 => 118,  316 => 117,  306 => 116,  299 => 115,  297 => 114,  293 => 112,  289 => 111,  279 => 110,  272 => 109,  270 => 108,  266 => 106,  239 => 81,  237 => 80,  234 => 79,  228 => 76,  224 => 74,  222 => 73,  216 => 70,  212 => 68,  210 => 67,  205 => 65,  202 => 64,  200 => 63,  195 => 61,  192 => 60,  190 => 59,  182 => 57,  178 => 56,  167 => 47,  155 => 44,  151 => 42,  149 => 41,  145 => 40,  142 => 39,  133 => 37,  129 => 36,  126 => 35,  122 => 33,  120 => 32,  107 => 30,  103 => 29,  98 => 27,  85 => 16,  79 => 15,  73 => 14,  69 => 13,  65 => 12,  54 => 6,  47 => 4,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "basel/template/common/header.twig", "");
    }
}
