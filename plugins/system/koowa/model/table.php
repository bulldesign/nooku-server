<?php
/**
 * @version		$Id$
 * @category	Koowa
 * @package		Koowa_Model
 * @copyright	Copyright (C) 2007 - 2009 Johan Janssens and Mathias Verraes. All rights reserved.
 * @license		GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.koowa.org
 */

/**
 * Table Model Class
 * 
 * Provides interaction with a database table
 *
 * @author		Johan Janssens <johan@koowa.org>
 * @category	Koowa
 * @package     Koowa_Model
 */
class KModelTable extends KModelAbstract
{
	/**
	 * Database adapter
	 *
	 * @var object
	 */
	protected $_db;

	/**
	 * Table object or identifier (APP::com.COMPONENT.table.TABLENAME)
	 *
	 * @var	string|object
	 */
	protected $_table;

	/**
	 * Constructor
     *
     * @param	array An optional associative array of configuration settings.
	 */
	public function __construct(array $options = array())
	{
		parent::__construct($options);
		
		// Initialize the options
		$options  = $this->_initialize($options);
		
		// Set the database adapter
		$this->_db = $options['adapter'];
		
		// Set the table associated to the model
		$this->_table = $options['table'];
				
		// Set the state
		$this->_state
			->insert('id'       , 'int')
			->insert('limit'    , 'int', 20)
			->insert('offset'   , 'int', 0)
			->insert('order'    , 'cmd')
			->insert('direction', 'word', 'asc')
			->insert('search'   , 'string');
	}
	
	/**
	 * Initializes the options for the object
	 *
	 * Called from {@link __construct()} as a first step of object instantiation.
	 *
	 * @param   array   Options
	 * @return  array   Options
	 */
	protected function _initialize(array $options)
	{
		$options = parent::_initialize($options);
		
		$table 			= KInflector::tableize($this->_identifier->name);
		$package		= $this->_identifier->package;
		$application 	= $this->_identifier->application;
		
		$defaults = array(
            'adapter' => KFactory::get('lib.koowa.database'),
			'table'   => $application.'::com.'.$package.'.table.'.$table
       	);
       	
        return array_merge($defaults, $options);
    }

	/**
	 * Method to get the database adapter object
	 *
	 * @return KDatabaseAdapterAbstract
	 */
	public function getDatabase()
	{
		return $this->_db;
	}

	/**
	 * Method to set the database connector object
	 *
	 * @param	object	A KDatabaseAdapterAbstract object
	 * @return KDatabaseAdapterAbstract
	 */
	public function setDatabase($db)
	{
		$this->_db = $db;
		return $this;
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param	array	Options array for view. Optional.
	 * @return	object	The table object or NULL if an table object could not be created
	 */
	public function getTable(array $options = array())
	{
		if(!($this->_table instanceof KDatabaseTableAbstract || is_null($this->_table))) 
		{
			try	{
				$this->_table = KFactory::get($this->_table, $options);
			} catch ( KDatabaseTableException $e ) { 
				$this->_table = null;
			}
		}

		return $this->_table;
	}

	/**
	 * Method to set a table object or identifier
	 *
	 * @param	string|object The table identifier to be used in KFactory or a table object
	 * @return	KDatabaseAdapterAbstract
	 */
	public function setTable($identifier)
	{
		$this->_table = $identifier;
		return $this;
	}

    /**
     * Method to get a item object which represents a table row
     *
     * @return KDatabaseRow
     */
    public function getItem()
    {
        // Get the data if it doesn't already exist
        if (!isset($this->_item))
        {
        	if($table = $this->getTable()) 
        	{
         		$query = $this->_buildQuery()->where('tbl.'.$table->getPrimaryKey(), '=', $this->_state->id);
        		$this->_item = $table->fetchRow($query);
        	} 
        	else $this->_item = null;
        }

        return parent::getItem();
    }

    /**
     * Get a list of items which represnts a  table rowset
     *
     * @return KDatabaseRowset
     */
    public function getList()
    {
        // Get the data if it doesn't already exist
        if (!isset($this->_list))
        {
        	if($table = $this->getTable()) 
        	{
        		$query = $this->_buildQuery();
        		$this->_list = $table->fetchRowset($query);
        	}
        	else $this->_list = array(); 
        }

        return parent::getList();
    }

    /**
     * Get the total amount of items
     *
     * @return  int
     */
    public function getTotal()
    {
        // Get the data if it doesn't already exist
        if (!isset($this->_total))
        {
            if($table = $this->getTable())
            {
        		$query = $this->_buildCountQuery();
				$this->_total = $table->count($query);
            } 
            else $this->_total = 0; 
        }

        return parent::getTotal();
    }


    /**
     * Builds a generic SELECT query
     *
     * @return  string  KDatabaseQuery
     */
    protected function _buildQuery()
    {
    	$query = $this->_db->getQuery();
        $query->select(array('tbl.*'));

        $this->_buildQueryFields($query);
        $this->_buildQueryFrom($query);
        $this->_buildQueryJoins($query);
        $this->_buildQueryWhere($query);
        $this->_buildQueryOrder($query);
        $this->_buildQueryLimit($query);
  
		return $query;
    }

 	/**
     * Builds a generic SELECT COUNT(*) query
     */
    protected function _buildCountQuery()
    {
        $query = $this->_db->getQuery();

        $this->_buildQueryFrom($query);
        $this->_buildQueryJoins($query);
        $this->_buildQueryWhere($query);

        return $query;
    }

    /**
     * Builds SELECT fields list for the query
     */
    protected function _buildQueryFields(KDatabaseQuery $query)
    {

    }

	/**
     * Builds FROM tables list for the query
     */
    protected function _buildQueryFrom(KDatabaseQuery $query)
    {
      	$name = $this->getTable()->getTableName();
    	$query->from($name.' AS tbl');
    }

    /**
     * Builds LEFT JOINS clauses for the query
     */
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {

    }

    /**
     * Builds a WHERE clause for the query
     */
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {

    }

    /**
     * Builds a generic ORDER BY clasue based on the model's state
     */
    protected function _buildQueryOrder(KDatabaseQuery $query)
    {
    	$order      = $this->_state->order;
       	$direction  = strtoupper($this->_state->direction);

    	if($order) {
    		$query->order($order, $direction);
    	}

		if(in_array('ordering', $this->getTable()->getColumns())) {
    		$query->order('ordering', 'ASC');
    	}
    }

    /**
     * Builds LIMIT clause for the query
     */
    protected function _buildQueryLimit(KDatabaseQuery $query)
    {
		$query->limit($this->_state->limit, $this->_state->offset);
    }
}