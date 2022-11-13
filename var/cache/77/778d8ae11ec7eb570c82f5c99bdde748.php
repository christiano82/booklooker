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

/* library.html.twig */
class __TwigTemplate_844af027482b80f3ec72c2bb632a2315 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "library.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Library";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "<div class=\"container\">
    <h1>Library</h1>
    <p class=\"lead\">
        Welcome on my awesome homepage.
    </p>
    <p>Nutzen Sie die Eingabe um ein Select Satement zu formulieren. Dabei muss das 'Select' selbst nicht aufgeführt werden<p>
    <p>Beispiele für ein Select
        <ul>
            <li><code>* from autoren a join autoren_has_buecher ahb on a.autoren_id = ahb.autoren_autoren_id join buecher b on ahb.buecher_buecher_id = b.buecher_id;</code></li>
            <li><code>* from autoren;</code></li>
            <li><code>* from buecher order by buecher_id desc;</code></li>
        </ul>
    </p>
    <form method=\"post\" action=\"Library\">
        <div class=\"form-group row\">
            <label for=\"selectCommand\" class=\"col-2 col-form-label text-right\">SELECT </label>
            <input type=\"text\" class=\"form-control col-10\" name=\"selectCommand\" id=\"selectCommand\" value=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["stmt"] ?? null), "html", null, true);
        echo "\">
        </div>
        <div class=\"text-right\">
            <button type=\"submit\" name=\"command\" value=\"create\" class=\"btn btn-primary\">Submit</button>
            <a href=\"Library?command=read&view=all\" class=\"btn btn-primary\">Alle</a>
        </div>
    </form>
    ";
        // line 29
        $__internal_compile_0 = null;
        try {
            $__internal_compile_0 =             $this->loadTemplate(($context["template"] ?? null), "library.html.twig", 29);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_compile_0) {
            $__internal_compile_0->display($context);
        }
        // line 30
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "library.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 30,  86 => 29,  76 => 22,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Library{% endblock %}

{% block content %}
<div class=\"container\">
    <h1>Library</h1>
    <p class=\"lead\">
        Welcome on my awesome homepage.
    </p>
    <p>Nutzen Sie die Eingabe um ein Select Satement zu formulieren. Dabei muss das 'Select' selbst nicht aufgeführt werden<p>
    <p>Beispiele für ein Select
        <ul>
            <li><code>* from autoren a join autoren_has_buecher ahb on a.autoren_id = ahb.autoren_autoren_id join buecher b on ahb.buecher_buecher_id = b.buecher_id;</code></li>
            <li><code>* from autoren;</code></li>
            <li><code>* from buecher order by buecher_id desc;</code></li>
        </ul>
    </p>
    <form method=\"post\" action=\"Library\">
        <div class=\"form-group row\">
            <label for=\"selectCommand\" class=\"col-2 col-form-label text-right\">SELECT </label>
            <input type=\"text\" class=\"form-control col-10\" name=\"selectCommand\" id=\"selectCommand\" value=\"{{stmt}}\">
        </div>
        <div class=\"text-right\">
            <button type=\"submit\" name=\"command\" value=\"create\" class=\"btn btn-primary\">Submit</button>
            <a href=\"Library?command=read&view=all\" class=\"btn btn-primary\">Alle</a>
        </div>
    </form>
    {% include template ignore missing %}
</div>
{% endblock %}", "library.html.twig", "/home/haxli/sources/schule/feldheinzmann/projekt_lf8/templates/library.html.twig");
    }
}
