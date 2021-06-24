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
        // line 44
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_logo", [], "any", false, false, true, 44)) {
            // line 45
            echo "    <a class=\"tw-text-3xl tw-font-bold tw-leading-none\" href=\"/drupal9/recommended-project/web/\">
      ";
            // line 46
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_logo", [], "any", false, false, true, 46), 46, $this->source), "html", null, true);
            echo "
    </a>
    ";
        }
        // line 49
        echo "
    ";
        // line 51
        echo "    <div class=\"tw-hidden lg:tw-hidden\">
      <button class=\"tw-navbar-burger tw-flex tw-items-center tw-text-gray-400 tw-p-3\">
        <svg class=\"tw-block tw-h-4 tw-w-4 tw-fill-current\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\">
          <title>Mobile menu</title>
          <path d=\"M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z\"></path>
        </svg>
      </button>
    </div>




    <ul class=\"tw-hidden tw-top-1/2 tw-left-1/2 tw-transform tw--translate-y-50% lg:tw-flex lg:tw-mx-auto lg:tw-flex lg:tw-items-center lg:tw-w-auto lg:tw-space-x-6 tw--translate-x-50%\">
      ";
        // line 64
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "header_menu", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
        echo "
    </ul>



    <div class=\"tw-row-reverse tw-flex tw-w-20% tw-justify-items-center tw-flex tw-space-x-6\">
      <img class=\"tw-self-center tw-h-8\" src=\"/drupal9/recommended-project/web/themes/tietheme/img/shopping-car.svg\" alt=\"\" width=\"tw-auto\">
      <a class=\"tw-inline-block lg:tw-mb-0 lg:tw-mr-3 tw-w-full lg:tw-w-auto md:tw-py-3 lg:tw-py-2 tw-px-3 md:tw-px-3 lg:tw-px-6
        tw-leading-loose tw-bg-green-600 hover:tw-bg-green-700 tw-text-white md:tw-text-xl tw-font-semibold tw-rounded-l-xl tw-rounded-t-xl transition
        duration-200\" href=\"#\">Planes</a>
      <a class=\"tw-inline-block lg:tw-mb-0 lg:tw-mr-3 tw-w-full lg:tw-w-auto md:tw-py-3 lg:tw-py-2 tw-px-3 md:tw-px-3 lg:tw-px-6
        tw-leading-loose tw-bg-green-600 hover:tw-bg-green-700 tw-text-white md:tw-text-xl tw-font-semibold tw-rounded-l-xl tw-rounded-t-xl
        transition duration-200\" href=\"#\">Login</a>
    </div>
  </nav>





  <div class=\"tw-bg-gray-50 tw-pt-12 tw-pb-20 radius-for-skewed tw-m-0\">
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
            <span>© 2020 All rights reserved.</span>
        </p>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/facebook.svg\" alt=\"\"> </a>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/twitter.svg\" alt=\"\"> </a>
        <a class=\"tw-inline-block tw-px-1\" href=\"#\"> <img src=\"atis-assets/social/instagram.svg\" alt=\"\"> </a>
      </div>
    </nav>
  </div>
</section>
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
        return array (  108 => 90,  102 => 87,  99 => 86,  97 => 85,  73 => 64,  58 => 51,  55 => 49,  49 => 46,  46 => 45,  44 => 44,  39 => 41,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/layout/page.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 44);
        static $filters = array("escape" => 46);
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
