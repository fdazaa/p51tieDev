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

/* modules/contrib/epayco/templates/epayco--payment-option.html.twig */
class __TwigTemplate_2743ad86d8c364c054f35b29b498d99394bb6b9b2fbc4cb708ea9491cd71231f extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 19
        $context["classes"] = [0 => "epayco--payment-option", 1 => \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 21
($context["context"] ?? null), "provider", [], "any", false, false, true, 21), 21, $this->source)), 2 => \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source,         // line 22
($context["context"] ?? null), "plugin_id", [], "any", false, false, true, 22), 22, $this->source))];
        // line 25
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("epayco/payment.option.style"), "html", null, true);
        echo "

<div";
        // line 27
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method", false, false, true, 27), 27, $this->source), "html", null, true);
        echo ">
";
        // line 28
        if ( !twig_test_empty(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["context"] ?? null), "epayco", [], "any", false, false, true, 28), "data", [], "any", false, false, true, 28), "missing", [], "any", false, false, true, 28))) {
            // line 29
            echo "  <span class=\"epayco-missing-attributes\">
    ";
            // line 30
            echo t("Some parameters are missing. Please review your implementation.", array());
            // line 31
            echo "  </span>
";
        }
        // line 33
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/epayco/templates/epayco--payment-option.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 33,  59 => 31,  57 => 30,  54 => 29,  52 => 28,  48 => 27,  43 => 25,  41 => 22,  40 => 21,  39 => 19,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/contrib/epayco/templates/epayco--payment-option.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/modules/contrib/epayco/templates/epayco--payment-option.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 19, "if" => 28, "trans" => 30);
        static $filters = array("clean_class" => 21, "escape" => 25);
        static $functions = array("attach_library" => 25);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'trans'],
                ['clean_class', 'escape'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
