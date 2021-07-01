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

/* themes/tietheme/templates/layout/page.html.twig */
class __TwigTemplate_4819fd46953fcce8aca1af0074c41a287e72cd7a928dabab306c73988c9e8b55 extends \Twig\Template
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
        // line 41
        echo "<section class=\"tw-skewed-bottom-right tw-h-full\">
  <nav class=\"tw-relative tw-px-2 md:tw-px-5 lg:tw-px-6 tw-py-2 md:tw-py-5 lg:tw-py-6 tw-flex tw-justify-between tw-items-center
    tw-bg-white-50 tw-shadow-lg\">


    ";
        // line 47
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_logo", [], "any", false, false, true, 47)) {
            // line 48
            echo "    <a class=\"tw-text-3xl tw-font-bold tw-leading-none\" href=\"/drupal9/recommended-project/web/\">
      ";
            // line 49
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_logo", [], "any", false, false, true, 49), 49, $this->source), "html", null, true);
            echo "
    </a>
    ";
        }
        // line 52
        echo "

    ";
        // line 55
        echo "    <div class=\"tw-hidden lg:tw-hidden\">
      <button class=\"tw-navbar-burger tw-flex tw-items-center tw-text-gray-400 tw-p-3\">
        <svg class=\"tw-block tw-h-4 tw-w-4 tw-fill-current\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\">
          <title>Mobile menu</title>
          <path d=\"M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z\"></path>
        </svg>
      </button>
    </div>


      ";
        // line 66
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_menu", [], "any", false, false, true, 66)) {
            // line 67
            echo "    <ul class=\"tw-hidden tw-top-1/2 tw-left-1/2 tw-transform tw--translate-y-50% lg:tw-flex lg:tw-mx-auto lg:tw-flex lg:tw-items-center lg:tw-w-auto lg:tw-space-x-6 tw--translate-x-50%\">
      ";
            // line 68
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_menu", [], "any", false, false, true, 68), 68, $this->source), "html", null, true);
            echo "
    </ul>
    ";
        }
        // line 71
        echo "

      ";
        // line 74
        echo "    ";
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_accesos", [], "any", false, false, true, 74)) {
            // line 75
            echo "    ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_accesos", [], "any", false, false, true, 75), 75, $this->source), "html", null, true);
            echo "
    ";
        }
        // line 77
        echo "
  </nav>




    ";
        // line 84
        echo "  <div class=\"tw-bg-gray-50 tw-pt-12 tw-pb-20 radius-for-skewed tw-m-0\">
    ";
        // line 85
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 85)) {
            // line 86
            echo "    <div class=\"tw-container lg:tw-ml-40\">
      ";
            // line 87
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 87), 87, $this->source), "html", null, true);
            echo "
    </div>
    ";
        }
        // line 90
        echo "
  </div>
    <div class=\"tw-hidden tw-navbar-menu tw-relative z-50\">
    <div class=\"tw-navbar-backdrop fixed inset-0 tw-bg-gray-800 opacity-25\"></div>
    <nav class=\"fixed top-0 left-0 bottom-0 tw-flex tw-flex-col tw-w-5/6 max-w-sm tw-py-6 tw-px-6 tw-bg-white border-r overflow-y-auto\">
      <div class=\"tw-flex tw-items-center tw-mb-8\">
        <a class=\"tw-mr-auto tw-text-3xl tw-font-bold tw-leading-none\" href=\"#\">
          <img class=\"tw-h-10\" src=\"atis-assets/logo/atis/atis-mono-black.svg\" alt=\"\" width=\"auto\">
        </a>
        <button class=\"tw-navbar-close\">
          <svg class=\"tw-h-6 tw-w-6 tw-text-gray-400 cursor-pointer hover:tw-text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\"
               fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\"></path>
          </svg>
        </button>
      </div>
      <div>
        <ul>
          <li class=\"mb-1\"><a class=\"block tw-p-4 tw-text-sm tw-font-semibold tw-text-gray-400 hover:tw-bg-green-50 hover:tw-text-green-600
            rounded\" href=\"#\">Start</a></li>
          <li class=\"mb-1\"><a class=\"block tw-p-4 tw-text-sm tw-font-semibold tw-text-gray-400 hover:tw-bg-green-50 hover:tw-text-green-600
            rounded\" href=\"#\">About Us</a></li>
          <li class=\"mb-1\"><a class=\"block tw-p-4 tw-text-sm tw-font-semibold tw-text-gray-400 hover:tw-bg-green-50 hover:tw-text-green-600
            rounded\" href=\"#\">Services</a></li>
          <li class=\"mb-1\"><a class=\"block tw-p-4 tw-text-sm tw-font-semibold tw-text-gray-400 hover:tw-bg-green-50 hover:tw-text-green-600
            rounded\" href=\"#\">Platform</a></li>
          <li class=\"mb-1\"><a class=\"block tw-p-4 tw-text-sm tw-font-semibold tw-text-gray-400 hover:tw-bg-green-50 hover:tw-text-green-600
            rounded\" href=\"#\">Testimonials</a></li>
        </ul>
      </div>
      <div class=\"mt-auto\">
        <div class=\"tw-pt-6\">
          <a class=\"block tw-px-4 tw-py-3 tw-mb-3 tw-leading-loose tw-text-xs tw-text-center tw-font-semibold
           tw-leading-none tw-bg-gray-50 hover:tw-bg-gray-100 tw-rounded-l-xl tw-rounded-t-xl\" href=\"#\">Sign In</a>
          <a class=\"block tw-px-4 tw-py-3 tw-mb-2 tw-leading-loose tw-text-xs tw-text-center tw-text-white tw-font-semibold
           tw-bg-green-600 hover:tw-bg-green-700 tw-rounded-l-xl tw-rounded-t-xl\" href=\"#\">Sign Up</a>
        </div>
        <p class=\"tw-my-4 tw-text-xs tw-text-center tw-text-gray-400\">
            <span>© 2021 All rights reserved.</span>
        </p>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/facebook.svg\" alt=\"\"> </a>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/twitter.svg\" alt=\"\"> </a>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/instagram.svg\" alt=\"\"> </a>
      </div>
    </nav>
  </div>
       ";
        // line 136
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_footer", [], "any", false, false, true, 136)) {
            // line 137
            echo "        ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 137), 137, $this->source), "html", null, true);
            echo "
        ";
        }
        // line 139
        echo "</section>







";
    }

    public function getTemplateName()
    {
        return "themes/tietheme/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 139,  171 => 137,  169 => 136,  121 => 90,  115 => 87,  112 => 86,  110 => 85,  107 => 84,  99 => 77,  93 => 75,  90 => 74,  86 => 71,  80 => 68,  77 => 67,  74 => 66,  62 => 55,  58 => 52,  52 => 49,  49 => 48,  46 => 47,  39 => 41,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/layout/page.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 47);
        static $filters = array("escape" => 49);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
