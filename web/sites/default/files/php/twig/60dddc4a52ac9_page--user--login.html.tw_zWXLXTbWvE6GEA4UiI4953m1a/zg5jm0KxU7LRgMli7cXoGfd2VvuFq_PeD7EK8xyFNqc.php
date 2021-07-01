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

/* themes/tietheme/templates/layout/page--user--login.html.twig */
class __TwigTemplate_ee9dd550f0cc6f126ffac99938b0182906b479f68f13bcc17b113627b7d1145f extends \Twig\Template
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
        // line 7
        echo "<section class=\"tw-absolute tw-w-full tw-h-full\">
  <div class=\"tw-absolute tw-top-0 tw-w-full tw-h-full tw-invisible lg:tw-visible tw-bg-cover tw-bg-no-repeat\" style=\"background-image: url(/themes/tietheme/img/background.png);\">
  </div>
    <div class=\"tw-container tw-mx-auto tw-px-4 tw-h-full\">
      <div class=\"tw-flex tw-content-center tw-items-center tw-justify-center tw-h-full\">
        <div class=\"tw-w-full lg:tw-w-5/12 tw-px-6\">
          <div
            class=\"tw-relative tw-flex tw-flex-col tw-min-w-0 break-words tw-w-full tw-mb-6
                  tw-shadow-lg tw-rounded-lg tw-bg-white tw-border-0\">
            <div class=\"tw-flex-auto tw-px-4 lg:tw-px-10 tw-py-10 tw-pt-10\">
              <div class= \"tw-text-gray-500 tw-text-center tw-mb-3 tw-text-3xl
                      tw-font-bold\">
                <small>Login</small>
              </div>
              ";
        // line 21
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 21)) {
            // line 22
            echo "                <div class=\"tw-container\">
                  ";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 23), 23, $this->source), "html", null, true);
            echo "
                </div>
              ";
        }
        // line 26
        echo "              ";
        // line 77
        echo "            </div>
          </div>
          <div class=\"tw-relative tw-flex tw-flex-wrap tw-text-lg tw-mt-6 tw-px-4\">
            <div>
              <a href=\"/user/password\" class= \"tw-text-black lg:tw-text-white\"><small>Olvidó su contraseña?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class=\"tw-bg-green-700 tw-absolute tw-w-full tw-bottom-0 tw-pb-6\">
      <div class=\"";
        // line 88
        echo " tw-px-4\">
        <hr class=\"tw-mb-6 tw-border-none\" />
        <div
          class= \"tw-text-center lg:tw-text-left tw-flex tw-flex-wrap tw-items-center md:tw-justify-between
                tw-justify-center\">
          <div class=\"tw-w-full lg:tw-w-4/12 tw-px-4\">
            <div class= \"tw-text-sm tw-text-white tw-font-semibold tw-py-1\">
              Copyright © 2021
              <a
                href=\"#\"
                class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                      tw-font-semibold
                      tw-py-1\">Segen Group</a>
            </div>
          </div>
          <div class=\"tw-hidden lg:tw-block tw-w-full md:tw-w-8/12 tw-px-4\">
            <ul
              class=\"tw-flex tw-flex-wrap tw-list-none md:tw-justify-end
                    tw-justify-center\">
              <li>
                <a
                  href=\"/\"
                  class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                        tw-font-semibold tw-block tw-py-1 tw-px-3\">Inicio</a>
              </li>
              <li>
                <a
                  href=\"/\"
                  class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                        tw-font-semibold tw-block tw-py-1 tw-px-3\">Empresa</a>
              </li>
              <li>
                <a
                  href=\"/\"
                  class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                        tw-font-semibold tw-block tw-py-1 tw-px-3\">Servicios</a>
              </li>
              <li>
                <a
                  href=\"/\"
                  class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                        tw-font-semibold tw-block tw-py-1 tw-px-3\">Plataforma</a>
              <li>
                <a
                  href=\"/\"
                  class= \"tw-text-white hover:tw-text-gray-400 tw-text-sm
                          tw-font-semibold tw-block tw-py-1 tw-px-3\">Contactos</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </section>

";
    }

    public function getTemplateName()
    {
        return "themes/tietheme/templates/layout/page--user--login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 88,  68 => 77,  66 => 26,  60 => 23,  57 => 22,  55 => 21,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/tietheme/templates/layout/page--user--login.html.twig", "/var/www/vhosts/compassionate-tu.104-207-133-129.plesk.page/development1.compassionate-tu.104-207-133-129.plesk.page/web/themes/tietheme/templates/layout/page--user--login.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 21);
        static $filters = array("escape" => 23);
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
