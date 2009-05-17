<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package		Koowa_View
 * @subpackage 	Ajax
 * @copyright	Copyright (C) 2007 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * Ajax View Class
 *
 * @author		Mathias Verraes <mathias@koowa.org>
 * @category	Koowa
 * @package		Koowa_View
 * @subpackage 	Ajax
 */
class KViewAjax extends KViewAbstract 
{ 
	public function __construct($options = array())
	{
		$options = $this->_initialize($options);
		
		// Set a base path for use by the view
		$this->assign('baseurl', $options['base_url']);
		
		parent::__construct($options);
	}
}
