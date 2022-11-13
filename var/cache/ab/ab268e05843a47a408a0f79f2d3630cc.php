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

/* datamanager.html.twig */
class __TwigTemplate_3665dad778053bac2b8e7be0446c6b09 extends Template
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
        $this->parent = $this->loadTemplate("base.html.twig", "datamanager.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Datamanager";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <ul class=\"nav\">
    <li class=\"nav-item\">
        <a class=\"nav-link active\" href=\"?tblid=buecher\">Active</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Link</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Link</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link disabled\">Disabled</a>
    </li>
    </ul>
    <h1>Datamanager</h1>
    <p class=\"important\">
        Welcome on my awesome homepage.
    </p>
    ";
        // line 24
        $__internal_compile_0 = null;
        try {
            $__internal_compile_0 =             $this->loadTemplate(($context["template"] ?? null), "datamanager.html.twig", 24);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_compile_0) {
            $__internal_compile_0->display($context);
        }
    }

    public function getTemplateName()
    {
        return "datamanager.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 24,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}

{% block title %}Datamanager{% endblock %}

{% block content %}
    <ul class=\"nav\">
    <li class=\"nav-item\">
        <a class=\"nav-link active\" href=\"?tblid=buecher\">Active</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Link</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"#\">Link</a>
    </li>
    <li class=\"nav-item\">
        <a class=\"nav-link disabled\">Disabled</a>
    </li>
    </ul>
    <h1>Datamanager</h1>
    <p class=\"important\">
        Welcome on my awesome homepage.
    </p>
    {% include template ignore missing %}
{% endblock %}", "datamanager.html.twig", "/home/haxli/sources/schule/feldheinzmann/projekt_lf8/templates/datamanager.html.twig");
    }
}
