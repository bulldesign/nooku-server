<?php
/**
 * @version     $Id: http.php 2876 2011-03-07 22:19:20Z johanjanssens $
 * @category	Koowa
 * @package     Koowa_Http
 * @copyright   Copyright (C) 2007 - 2010 Johan Janssens. All rights reserved.
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

/**
 * HTTP Response class
 *
 * @todo Add other statuses
 * @see http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
 *
 * @author      Johan Janssens <johan@nooku.org>
 * @category    Koowa
 * @package     Koowa_Http
 */
class KHttpResponse
{
    // Methods
    const GET     = 'GET';  
    const POST    = 'POST';  
    const PUT     = 'PUT'   
    const DELETE  = 'DELETE';  
    const HEAD    = 'HEAD';  
    const OPTIONS = 'OPTIONS';  
}