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

/* default/template/common/maintenance.twig */
class __TwigTemplate_24adc8b7289b6954520a6cccc7ebd4bd8fe2da4d3a04c487545861a97748f6f6 extends \Twig\Template
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
<html>
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>Herrera - veleprodaja rasvjete i kućnih potrepština</title>
    <meta name=\"description\" content=\"Herrera - veleprodaja rasvjete i kućnih potrepština\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"robots\" content=\"all,follow\">
    <!-- Bootstrap CSS-->
    <link rel=\"stylesheet\" href=\"siteoff/vendor/bootstrap/css/bootstrap.min.css\">
    <!-- Google fonts - Roboto for copy, Montserrat for headings-->
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Rubik:300,400,700\">
    <!-- theme stylesheet-->
    <link rel=\"stylesheet\" href=\"siteoff/css/style.default.css\" id=\"theme-stylesheet\">
    <!-- Custom stylesheet - for your changes-->
    <link rel=\"stylesheet\" href=\"siteoff/css/custom.css\">
    <!-- Favicon-->

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
        <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script><![endif]-->
  </head>
  <body>
  <div class=\"container-fluid\">
    <div class=\"row min-vh-100\">
      
      <div class=\"col-xl-12 p-5 p-lg-4 d-flex align-items-center red\" style=\"background-color: #1d1e22;\">
      
<img src=\"image/logo-herrera.png\" style=\"max-width:300px;margin:0 auto\" title=\"Herrera - veleprodaja rasvjete i kućnih potrepština\" alt=\"Herrera - veleprodaja rasvjete i kućnih potrepština\">
      </div>
    </div>
  </div>
    <!-- JavaScript files-->
    <script src=\"siteoff/vendor/jquery/jquery.min.js\"></script>
    <script src=\"siteoff/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>
    <script src=\"siteoff/js/front.js\"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.7.1/css/all.css\" integrity=\"sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr\" crossorigin=\"anonymous\">
  </body>
</html>";
    }

    public function getTemplateName()
    {
        return "default/template/common/maintenance.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "default/template/common/maintenance.twig", "");
    }
}
