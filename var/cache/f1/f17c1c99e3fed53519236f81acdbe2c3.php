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

/* base.html.twig */
class __TwigTemplate_cc0346b06af7c316ecbd894f5b7708ec extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
  <head>
    ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 9
        echo "  </head>
  <body>
    <nav class=\"navbar navbar-expand-lg container-fluid\">
      <a class=\"navbar-brand\" href=\"#\">BOOKLOOKER</a>
      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
        <ul class=\"navbar-nav\">
          ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["nav"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 19
            echo "            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"";
            // line 20
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "href", [], "any", false, false, false, 20), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "caption", [], "any", false, false, false, 20), "html", null, true);
            echo "</a>
            </li>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "        </ul>
      </div>
    </nav>
      <div class=\"container-fluid\"> ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        echo "</div>
 <footer class=\"py-3 my-4\">
    <ul class=\"nav justify-content-center border-bottom pb-3 mb-3\">
      <li class=\"nav-item\"><a href=\"https://bbsovg.de/\" class=\"nav-link px-2 text-muted\">BBSOVG</a></li>
      <li class=\"nav-item\"><a href=\"https://moodle.bildung-lsa.de/bbs3-magdeburg/login/index.php\" class=\"nav-link px-2 text-muted\">Moodle</a></li>
      <li class=\"nav-item\"><a href=\"https://www.antrago.de/\" class=\"nav-link px-2 text-muted\">Antrago</a></li>
      <li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-muted\">Niklas Firma</a></li>
      <li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-muted\">Jans Firma</a></li>
    </ul>
    <p class=\"text-center text-muted\">© 2022 Niklas Ahl, Christian Ortloff, Jan Wilingstedt</p>
</footer>
    <script src=\"https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct\" crossorigin=\"anonymous\"></script>
  </body>
</html>";
    }

    // line 4
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "        <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css\" integrity=\"sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N\" crossorigin=\"anonymous\">
        <link rel=\"stylesheet\" href=\"main.css\">
        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo " - LF8</title>
    ";
    }

    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 26
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  119 => 26,  108 => 7,  104 => 5,  100 => 4,  81 => 26,  76 => 23,  65 => 20,  62 => 19,  58 => 18,  47 => 9,  45 => 4,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
  <head>
    {% block head %}
        <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css\" integrity=\"sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N\" crossorigin=\"anonymous\">
        <link rel=\"stylesheet\" href=\"main.css\">
        <title>{% block title %}{% endblock %} - LF8</title>
    {% endblock %}
  </head>
  <body>
    <nav class=\"navbar navbar-expand-lg container-fluid\">
      <a class=\"navbar-brand\" href=\"#\">BOOKLOOKER</a>
      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
        <ul class=\"navbar-nav\">
          {% for item in nav %}
            <li class=\"nav-item\">
              <a class=\"nav-link\" href=\"{{ item.href }}\">{{ item.caption }}</a>
            </li>
          {% endfor %}
        </ul>
      </div>
    </nav>
      <div class=\"container-fluid\"> {% block content %}{% endblock %}</div>
 <footer class=\"py-3 my-4\">
    <ul class=\"nav justify-content-center border-bottom pb-3 mb-3\">
      <li class=\"nav-item\"><a href=\"https://bbsovg.de/\" class=\"nav-link px-2 text-muted\">BBSOVG</a></li>
      <li class=\"nav-item\"><a href=\"https://moodle.bildung-lsa.de/bbs3-magdeburg/login/index.php\" class=\"nav-link px-2 text-muted\">Moodle</a></li>
      <li class=\"nav-item\"><a href=\"https://www.antrago.de/\" class=\"nav-link px-2 text-muted\">Antrago</a></li>
      <li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-muted\">Niklas Firma</a></li>
      <li class=\"nav-item\"><a href=\"#\" class=\"nav-link px-2 text-muted\">Jans Firma</a></li>
    </ul>
    <p class=\"text-center text-muted\">© 2022 Niklas Ahl, Christian Ortloff, Jan Wilingstedt</p>
</footer>
    <script src=\"https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js\" integrity=\"sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct\" crossorigin=\"anonymous\"></script>
  </body>
</html>", "base.html.twig", "/home/haxli/sources/schule/feldheinzmann/projekt_lf8/templates/base.html.twig");
    }
}
