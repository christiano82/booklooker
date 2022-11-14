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

/* library/library.table.html.twig */
class __TwigTemplate_26b3f043cdf5650a557e1dbad9c3b14a extends Template
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
        echo "
";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tables"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["table"]) {
            // line 3
            echo "    <h2>";
            echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["table"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), "html", null, true);
            echo "</h2>
    <div class=\"table-responsive\">
        <table class=\"table\">
        <thead class=\"thead-dark\">
            <tr>
            ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_1 = $context["table"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["columns"] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["head"]) {
                // line 9
                echo "                <th>";
                echo twig_escape_filter($this->env, $context["head"], "html", null, true);
                echo "</th>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['head'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "            </tr>
        </thead>
            ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((($__internal_compile_2 = $context["table"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["rows"] ?? null) : null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 14
                echo "                <tr>
                    ";
                // line 15
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["row"]);
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
                foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
                    // line 16
                    echo "                    <td>
                        ";
                    // line 17
                    if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 17)) {
                        // line 18
                        echo "                            ";
                        echo twig_escape_filter($this->env, $context["r"], "html", null, true);
                        echo " <a href=\"";
                        echo twig_escape_filter($this->env, $context["r"], "html", null, true);
                        echo "\">Edit</a>|<a href=\"";
                        echo twig_escape_filter($this->env, $context["r"], "html", null, true);
                        echo "\">Delete</a>
                        ";
                    } else {
                        // line 20
                        echo "                            ";
                        echo twig_escape_filter($this->env, $context["r"], "html", null, true);
                        echo "
                        ";
                    }
                    // line 22
                    echo "                    </td>
                    ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 24
                echo "                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "        </table>
    </div>
    <hr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['table'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "
";
    }

    public function getTemplateName()
    {
        return "library/library.table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 30,  137 => 26,  130 => 24,  115 => 22,  109 => 20,  99 => 18,  97 => 17,  94 => 16,  77 => 15,  74 => 14,  70 => 13,  66 => 11,  57 => 9,  53 => 8,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
{% for table in tables %}
    <h2>{{table['name']}}</h2>
    <div class=\"table-responsive\">
        <table class=\"table\">
        <thead class=\"thead-dark\">
            <tr>
            {% for head in table['columns'] %}
                <th>{{ head }}</th>
            {% endfor %}
            </tr>
        </thead>
            {% for row in table['rows'] %}
                <tr>
                    {% for r in row %}
                    <td>
                        {% if loop.first %}
                            {{r}} <a href=\"{{r}}\">Edit</a>|<a href=\"{{r}}\">Delete</a>
                        {% else %}
                            {{r}}
                        {% endif %}
                    </td>
                    {% endfor %}
                </tr>
            {% endfor %}
        </table>
    </div>
    <hr>
{% endfor %}

", "library/library.table.html.twig", "/home/haxli/sources/schule/feldheinzmann/projekt_lf8/templates/library/library.table.html.twig");
    }
}
