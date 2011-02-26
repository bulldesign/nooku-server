<?php 
/**
 * @version     $Id$
 * @category	Nooku
 * @package     Nooku_Server
 * @subpackage  Sections
 * @copyright   Copyright (C) 2011 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * Sections Template Listbox Helper Class
 *   
 * @author      John Bell <http://nooku.assembla.com/profile/johnbell>
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Sections
 */
class ComSectionsTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
  	public function ordering( $config = array() )
   	{
     	$config = new KConfig($config);
       	$config->append(array(
          	'model' => 'sections',
           	'name' => 'ordering',
            'value' => 'ordering',
        	'text' => 'ordering',
          	'deselect' => false
       	));

      	return parent::_listbox($config);
 	}

   /**
     * Generates an HTML image position optionlist
     *
     * @param 	array   An optional array with configuration options
     * @return 	string  Html
     */
   	public function image_position($config = array())
   	{
       	$config = new KConfig($config);
      	$config->append(array(
          	'name'          => 'image_position',
           	'attribs'       => array(),
             'deselect'      => false
      	))->append(array(
           	'selected'  => $config->{$config->name}
       	));
		     
		$options  = array();
                
     	if($config->deselect) {
         	$options[] =  $this->option(array('text' => '- '.JText::_( 'Select' ).' -'));
       	}
                
      	$options[] = $this->option(array('text' => JText::_( 'Left' ), 'value' => 'left' ));
      	$options[] = $this->option(array('text' => JText::_( 'Center' ), 'value' => 'center' ));
       	$options[] = $this->option(array('text' => JText::_( 'Right' ), 'value' => 'right' ));
      	
       	//Add the options to the config object
       	$config->options = $options;
                
      	return $this->optionlist($config);
	}

	public function image_names($config = array())
	{
  		$config = new KConfig($config);
  		$config->append(array(
   			'name'  => 'image_name',
   			'directory' => 'images/stories',
  			'filetypes'	=> array('swf', 'gif', 'jpg', 'png'),
   			'deselect' => true
  		))->append(array(
                        'selected'  => $config->{$config->name}
		))->append(array(
			'attribs' => array(
			'id' => $config->name,
			'class' => 'inputbox',
			'onchange' => "javascript:if (document.forms.adminForm.$config->name.options[selectedIndex].value!='') {document.imagelib.src='../$config->directory/' + document.forms.adminForm.$config->name.options[selectedIndex].value} else {document.imagelib.src='../media/system/images/blank.png'}"
			)));  

		if($config->deselect) {
			$options[] = $this->option(array('text' => '- '.JText::_( 'Select' ).' -', 'value' => ''));
  		}
  
		$files = array();
  		foreach(new DirectoryIterator(JPATH_SITE.'/'.$config->directory) as $file) {
   			if(in_array(pathinfo($file, PATHINFO_EXTENSION), $config->filetypes->toArray() )) {
    				$files[] = (string) $file;
   			}
  		}
		sort($files);
		foreach( $files as $file) {
			$options[] = $this->option(array('text' => (string) $file, 'value' => (string) $file));
 		}

 
  		$list = $this->optionlist(array(
   			'options' => $options,
   			'name'  => $config->name,
   			'attribs' => $config->attribs,
   			'selected' => $config->selected
  		));

  		return $list;
 	}		
}