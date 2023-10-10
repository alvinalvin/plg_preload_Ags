<?php
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
// no direct access
defined('_JEXEC') or die;
class plgsystemPreloadAgs extends JPlugin {
  protected $app;

  function onAfterRender()
  {
$app = JFactory::getApplication();
 // validando lado cliente
if ($app->isClient("administrator")) {
         return;
  }
$body = $this->app->getBody();
// html
$html='<div class="preloader">
         <div class="inner">
           <span class="percentage"><span id="percentage">15</span>%</span>
         </div>
        <div class="loader-progress" id="loader-progress"> </div>
      </div>';
 $body = str_replace('</body>',  $html .'</body>', $body );
 $this->app->setBody($body);
}

// fin Evento
function onBeforeRender(){
  $doc = JFactory::getDocument();
  // params
  $fontcolor = $this->params->get('font');
  $background = $this->params->get('background');
  $doc->addScript('plugins/system/preloadags/assets/js/percent-preloader.js');
  $doc->addStyleSheet('plugins/system/preloadags/assets/css/percent-preloader.css');
  JHtml::script('https://code.jquery.com/jquery-3.6.0.slim.min.js');
  // add style
  $style = '.preloader{
    background:'.$background.' ;
  }
  .percentage{
    color:'.$fontcolor.';
  }';
  $doc->addStyleDeclaration($style);
}
 }
