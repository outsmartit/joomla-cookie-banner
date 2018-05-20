<?php

/**
 * @copyright   Copyright (C) 2018 Outsmartit.be. All rights reserved.
 * @license             GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

class plgSystemOutsmartCookie extends JPlugin {

  protected $autoloadLanguage = true;
    /*function __construct(& $subject, $config) {
        parent::__construct($subject, $config);
         $this->loadLanguage();
    }*/

    public function onBeforeCompileHead() {
        $app = JFactory::getApplication();
        $position = $this->params->get('position','bottom');
	    $linktype = $this->params->get('linktype','id');
	    $linkparameter = $this->params->get('linkparameter');
	    if($linktype == 'id'){
		    $link = JUri::root().'index.php?option=com_content&view=article&id='.$linkparameter;
	    } elseif($linktype == 'abs') {
	    	$link = $linkparameter;
	    } else {
		    $link = JUri::root().'/'.$linkparameter;
	    }

      $backgroundcolor = $this->params->get('backgroundcolor','#ffffff');
	    $textcolor = $this->params->get('textcolor','#000000');
	    $buttoncolor = $this->params->get('buttoncolor','#e80e0e');
	    $buttontextcolor = $this->params->get('buttontextcolor','#ffffff');
        if ($app->isClient('site') == false) {
            return;
        }
        $document = JFactory::getDocument();
        $document->addStyleSheet('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css');
        $document->addScript('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js');
        $additionalscript = 'window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "'.$backgroundcolor.'",
      "text": "'.$textcolor.'"
    },
    "button": {
      "background": "'.$buttoncolor.'",
      "text": "'.$buttontextcolor.'"
    }
  },
  "position": "'.$position.'",
  "content": {
    "message":"' . JText::_("PLG_SYSTEM_OUTSMARTCOOKIE_MESSAGE") . '" ,
    "dismiss": "' . JText::_("PLG_SYSTEM_OUTSMARTCOOKIE_BUTTON_TXT") . '",
    "link": "' . JText::_("PLG_SYSTEM_OUTSMARTCOOKIE_LINK_TXT") . '",
    "href": "'.$link.'"
  }
})});';
        $document->addScriptDeclaration($additionalscript);
    }

}
