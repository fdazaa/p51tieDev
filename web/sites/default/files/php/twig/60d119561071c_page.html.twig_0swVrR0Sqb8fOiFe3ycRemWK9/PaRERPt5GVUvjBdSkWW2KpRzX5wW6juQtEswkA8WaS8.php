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
    <a class=\"tw-text-3xl tw-font-bold tw-leading-none\" href=\"#\">
      <img class=\"tw-h-12\"
           src=\"/drupal9/recommended-project/web/themes/tietheme/img/logosegen.png\" alt=\"\" width=\"tw-auto\">
    </a>
    <div class=\"tw-hidden lg:tw-hidden\">
      <button class=\"tw-navbar-burger tw-flex tw-items-center tw-text-gray-400
                        tw-p-3\">
        <svg class=\"tw-block tw-h-4 tw-w-4 tw-fill-current\" viewBox=\"0 0 20
                            20\" xmlns=\"http://www.w3.org/2000/svg\">
          <title>Mobile menu</title>
          <path d=\"M0 3h20v2H0V3zm0 6h20v2H0V9zm0
                                6h20v2H0v-2z\"></path>
        </svg>
      </button>
    </div>
    <ul class=\"tw-hidden tw-top-1/2 tw-left-1/2 tw-transform tw--translate-y-50% lg:tw-flex lg:tw-mx-auto lg:tw-flex lg:tw-items-center lg:tw-w-auto lg:tw-space-x-6 tw--translate-x-50%\">
      <li><a class=\"tw-text-sm tw-text-gray-400 hover:tw-text-gray-500\"
             href=\"#\">Inicio</a></li>
      <li class=\"tw-text-gray-800\">
        <svg class=\"tw-w-4 tw-h-4 tw-current-fill\"
             xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\"
             viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                stroke-width=\"2\" d=\"M12 5v.01M12 12v.01M12
                                19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0
                                110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010
                                2z\"></path>
        </svg>
      </li>
      <li><a class=\"tw-text-sm tw-text-green-600 tw-font-bold\" href=\"#\">Empresa</a></li>
      <li class=\"tw-text-gray-800\">
        <svg class=\"tw-w-4 tw-h-4 tw-current-fill\"
             xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\"
             viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                stroke-width=\"2\" d=\"M12 5v.01M12 12v.01M12
                                19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0
                                110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010
                                2z\"></path>
        </svg>
      </li>
      <li><a class=\"tw-text-sm tw-text-gray-400 hover:tw-text-gray-500\"
             href=\"#\">Servicios</a></li>
      <li class=\"tw-text-gray-800\">
        <svg class=\"tw-w-4 tw-h-4 tw-current-fill\"
             xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\"
             viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                stroke-width=\"2\" d=\"M12 5v.01M12 12v.01M12
                                19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0
                                110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010
                                2z\"></path>
        </svg>
      </li>
      <li><a class=\"tw-text-sm tw-text-gray-400 hover:tw-text-gray-500\"
             href=\"#\">Plataforma</a></li>
      <li class=\"tw-text-gray-800\">
        <svg class=\"tw-w-4 tw-h-4 tw-current-fill\"
             xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\"
             viewBox=\"0 0 24 24\" stroke=\"currentColor\">
          <path stroke-linecap=\"round\" stroke-linejoin=\"round\"
                stroke-width=\"2\" d=\"M12 5v.01M12 12v.01M12
                                19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0
                                110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010
                                2z\"></path>
        </svg>
      </li>
      <li><a class=\"tw-text-sm tw-text-gray-400 hover:tw-text-gray-500\" href=\"#\">Contacto</a></li>
    </ul>
    <div class=\"tw-row-reverse tw-flex tw-w-20% tw-justify-items-center tw-flex tw-space-x-6\">
      <img class=\"tw-self-center tw-h-8\" src=\"/drupal9/recommended-project/web/themes/tietheme/img/shopping-car.svg\" alt=\"\" width=\"tw-auto\">
      <a class=\"tw-inline-block lg:tw-mb-0 lg:tw-mr-3 tw-w-full lg:tw-w-auto md:tw-py-3 lg:tw-py-2 tw-px-3 md:tw-px-3 lg:tw-px-6
        tw-leading-loose tw-bg-green-600 hover:tw-bg-green-700 tw-text-white md:tw-text-xl tw-font-semibold tw-rounded-l-xl tw-rounded-t-xl transition
        duration-200\" href=\"#\">Planes</a>
      <a class=\"tw-inline-block lg:tw-mb-0 lg:tw-mr-3 tw-w-full lg:tw-w-auto md:tw-py-3 lg:tw-py-2 tw-px-3 md:tw-px-3 lg:tw-px-6
        tw-leading-loose tw-bg-green-600 hover:tw-bg-green-700 tw-text-white md:tw-text-xl tw-font-semibold tw-rounded-l-xl tw-rounded-t-xl
        transition duration-200\"
         href=\"#\">Login</a>
    </div>
  </nav>
  <div class=\"tw-bg-gray-50 tw-pt-12 tw-pb-20 radius-for-skewed tw-m-0\">
    <div class=\"tw-container lg:tw-ml-40\">
      <div class=\"tw-flex tw-flex-wrap tw-mx-14\">
        <div class=\"tw-w-full lg:tw-w-1/2 tw-px-4 tw-mb-12 md:mb-20 lg:tw-mb-0 tw-flex tw-items-center\">
          <div class=\"tw-w-full tw-text-left md:tw-text-left lg:tw-text-left\">
            <div class=\"tw-mx-auto lg:tw-mx-0\">
              <h2 class=\"tw-mb-3 tw-text-4xl md:tw-text-5xl lg:tw-text-5xl tw-font-bold tw-font-heading tw-leading-none\">
                <span data-config-id=\"tw-header\">¿Está lista su compañía <br>para las oportunidades<br/> del siglo XXI?</span>
              </h2>
            </div>
            <div class=\"tw-max-w-sm tw-mx-auto md:tw-mx-0 md:tw-max-w-full lg:tw-mx-0\">
              <p class=\"tw-mb-6 tw-text-gray-500 md:tw-text-3xl lg:tw-text-base lg:tw-max-w-sm tw-leading-tight\">Descubra
                cómo la transformación digital y productiva e industria 4.0 le ayudan a su compañía a crecer.
                ¡Lo invitamos a los entrenamientos que tenemos para usted y sus equipos!</p>
              <div><a class=\"tw-inline-block tw-mb-3 lg:tw-mb-0 lg:tw-mr-3 tw-w-1/4 lg:tw-w-auto md:tw-py-3 lg:tw-py-2 tw-pl-4 md:tw-py-3
                lg:tw-px-6 tw-leading-loose tw-bg-green-600 hover:tw-bg-green-700 tw-text-white md:tw-text-xl tw-font-semibold tw-rounded-l-xl
                tw-rounded-t-xl tw-transition tw-duration-200\" href=\"https://segen-group.com/contactenos/\">Planes</a>
              </div>
            </div>
          </div>
        </div>
        <div class=\"tw-w-full lg:tw-w-1/2 tw-flex tw-items-center tw-justify-center\">
          <div class=\"tw-relative\" style=\"z-index: 0; width: 80%\">

            <img class=\"tw-h-128 tw-w-full max-w-lg object-cover tw-rounded-3xl md:rounded-br-none\"
                 src=\"/drupal9/recommended-project/web/themes/tietheme/img/segen.png\" alt=\"\">
            <img class=\"tw-hidden md:tw-block tw-absolute\"
                 style=\"top:0rem; right: 3rem; z-index:
                                        -1;\"
                 src=\"/drupal9/recommended-project/web/themes/tietheme/img/imgsupder.svg\"
                 alt=\"\">
            <img class=\"tw-hidden md:tw-block tw-absolute\"
                 style=\"bottom:-2rem; right: -2rem;
                                        z-index:
                                        -1;\"
                 src=\"/drupal9/recommended-project/web/themes/tietheme/img/imginfder.svg\"
                 alt=\"\">
            <img class=\"tw-hidden md:tw-block tw-absolute\"
                 style=\"top:3rem; right: -3rem; z-index:
                                        -1;\"
                 src=\"/drupal9/recommended-project/web/themes/tietheme/img/imgladder.svg\"
                 alt=\"\">
            <img class=\"tw-hidden md:tw-block tw-absolute\"
                 style=\"bottom:2.5rem; left: -4.5rem;
                                        z-index: -1;\"
                 src=\"/drupal9/recommended-project/web/themes/tietheme/img/imgladizq.svg\"
                 alt=\"\">
          </div>
        </div>
      </div>
    </div>

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
            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"
                  d=\"M6 18L18 6M6 6l12 12\"></path>
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
        <div class=\"tw-pt-6\"><a class=\"block tw-px-4 tw-py-3 tw-mb-3 tw-leading-loose tw-text-xs tw-text-center tw-font-semibold
             tw-leading-none tw-bg-gray-50 hover:tw-bg-gray-100 tw-rounded-l-xl tw-rounded-t-xl\" href=\"#\">Sign In</a>
          <a
            class=\"block tw-px-4 tw-py-3 tw-mb-2 tw-leading-loose tw-text-xs tw-text-center tw-text-white tw-font-semibold
             tw-bg-green-600 hover:tw-bg-green-700 tw-rounded-l-xl tw-rounded-t-xl\" href=\"#\">Sign Up</a>
        </div>
        <p class=\"tw-my-4 tw-text-xs tw-text-center tw-text-gray-400\">
          <span>© 2020 All rights reserved.</span>
        </p>
          <a class=\"tw-inline-block tw-px-1\" href=\"#\">
            <img src=\"atis-assets/social/facebook.svg\"
                 alt=\"\">
          </a>
          <a class=\"tw-inline-block tw-px-1\" href=\"#\">
            <img src=\"atis-assets/social/twitter.svg\"
                 alt=\"\">
          </a>
          <a class=\"tw-inline-block tw-px-1\" href=\"#\">
            <img src=\"atis-assets/social/instagram.svg\"
                 alt=\"\">
          </a>
        </div>
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

    public function getDebugInfo()
    {
        return array (  39 => 41,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/layout/page.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
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
