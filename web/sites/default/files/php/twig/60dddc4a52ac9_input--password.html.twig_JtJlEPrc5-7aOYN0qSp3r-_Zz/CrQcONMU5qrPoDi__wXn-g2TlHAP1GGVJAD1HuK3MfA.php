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

/* themes/tietheme/templates/form/input--password.html.twig */
class __TwigTemplate_5f76778e82e52f6544599a6861a0676d8fd953a3afd31f9b6d0c0904b81effb7 extends \Twig\Template
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
        // line 13
        echo "
<input type=\"password\" class=\"tw-border-t tw-border-r tw-border-b tw-border-l tw-border-gray-500 tw-px-3
    tw-py-3 tw-placeholder-gray-400 tw-text-gray-700 tw-bg-white tw-rounded tw-text-sm tw-shadow
    focus:tw-outline-none tw-focus:ring tw-w-full\" placeholder=\"Password\"
       style=\"transition: all 0.15s ease 0s;\"
  ";
        // line 18
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 18, $this->source), "html", null, true);
        echo " /> ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 18, $this->source), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/tietheme/templates/form/input--password.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 18,  39 => 13,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/form/input--password.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/form/input--password.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 18);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                []
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
