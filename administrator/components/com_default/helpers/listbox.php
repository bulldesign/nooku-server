<?php
/**
 * @version     $Id$
 * @category	Koowa
 * @package     Koowa_Components
 * @subpackage  Default
 * @copyright   Copyright (C) 2007 - 2010 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license     GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link        http://www.koowa.org
 */

/**
 * Default Paginator Helper
.*
 * @author		Johan Janssens <johan@koowa.org>
 * @category	Koowa
 * @package     Koowa_Components
 * @subpackage  Default
 */

class ComDefaultHelperListbox extends KTemplateHelperListbox
{
	/**
	 * Generates an HTML enabled optionlist
	 *
	 * @param 	array 	An optional array with configuration options
	 * @return	string	Html
	 */
	public function enabled( $config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'enabled',
			'attribs'	=> array(),
			'deselect'	=> true
		))->append(array(
			'selected'  => $config->{$config->name}
		));
		
		$options = array();
		
		if($config->deselect) {
			$options[] = $this->option(array('text' => '- '.JText::_( 'Select' ).' -', 'value' => ''));
		}
		
		$options[] = $this->option(array('text' => JText::_( 'Enabled' ) , 'value' => 1 ));
		$options[] = $this->option(array('text' => JText::_( 'Disabled' ), 'value' => 0 ));
	
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	/**
	 * Generates an HTML published optionlist
	 *
	 * @param 	array 	An optional array with configuration options
	 * @return	string	Html
	 */
	public function published( $config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'enabled',
			'attribs'	=> array(),
			'deselect'	=> true
		))->append(array(
			'selected'  => $config->{$config->name}
		));
		
		$options = array();
		
		if($config->deselect) {
			$options[] = $this->option(array('text' => '- '.JText::_( 'Select' ).' -', 'value' => ''));
		}
		
		$options[] = $this->option(array('text' => JText::_( 'Published' ) , 'value' => 1 ));
		$options[] = $this->option(array('text' => JText::_( 'Draft' ), 'value' => 0 ));

		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	/**
	 * Generates an HTML access optionlist
	 *
	 * @param 	array 	An optional array with configuration options
	 * @return	string	Html
	 */
	public function access($config = array())
 	{
		$config = new KConfig($config);
		$config->append(array(
			'name'		=> 'access',
			'attribs'	=> array(),
			'deselect'	=> true
		))->append(array(
			'selected'  => $config->{$config->name}
		));
		
 		$options  = array();
 		
 		if($config->deselect) {
			$options[] =  $this->option(array('text' => '- '.JText::_( 'Select' ).' -'));
 		}
		
		$options[] = $this->option(array('text' => JText::_( 'Public' ), 'value' => '0' ));
		$options[] = $this->option(array('text' => JText::_( 'Registered' ), 'value' => '1' ));
		$options[] = $this->option(array('text' => JText::_( 'Special' ), 'value' => '2' ));

		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
 	}
}