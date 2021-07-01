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

/* themes/tietheme/templates/form/form--user-login-form.html.twig */
class __TwigTemplate_b8f5fc1e615107e78271e2e11134ec4b5bcbbece4301a631bc8543185bb2ff2b extends \Twig\Template
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
        // line 4
        echo "<div class=\"login-form login-form__wrapper\">
  <form";
        // line 5
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 5, $this->source), "html", null, true);
        echo ">
    <div class=\"login-form__top\">
      <div id=\"error_messages\"></div>
      ";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "messages", [], "any", false, false, true, 8), 8, $this->source), "html", null, true);
        echo "


      ";
        // line 11
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "name", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
        echo " ";
        // line 12
        echo "

      <div class=\"tw-block tw-uppercase tw-text-gray-700 tw-text-xs tw-font-bold tw-mb-2\">
      ";
        // line 15
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "pass", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
        echo " ";
        // line 16
        echo "      </div>

      <div class=\"login-form__help_actions\">
        <input id=\"show_password\" class=\"show_password\" type=\"checkbox\" />
        <label class=\"password-toggle\" for=\"show_password\">Show password</label>
        <a href=\"/user/password\" class=\"forgot-password\">Forgot Password?</a>
      </div>
      ";
        // line 23
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "form_build_id", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
        echo " ";
        // line 24
        echo "      ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "form_id", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        echo " ";
        // line 25
        echo "

      <div class=\"tw-text-center tw-mt-6\">

      <div class=\" login-form__submit tw-bg-black tw-text-white active:bg-gray-900 tw-text-sm
           tw-font-bold tw-uppercase tw-px-6 tw-py-3 tw-rounded tw-shadow
           hover:tw-shadow-lg tw-outline-none tw-focus:outline-none tw-mr-1
           tw-mb-1 tw-w-full\">
        ";
        // line 33
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["element"] ?? null), "actions", [], "any", false, false, true, 33), "submit", [], "any", false, false, true, 33), 33, $this->source), "html", null, true);
        echo "
      </div>
      </div>

    </div>
  </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/tietheme/templates/form/form--user-login-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 33,  81 => 25,  77 => 24,  74 => 23,  65 => 16,  62 => 15,  57 => 12,  54 => 11,  48 => 8,  42 => 5,  39 => 4,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/form/form--user-login-form.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/form/form--user-login-form.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 5);
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
