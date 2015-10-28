<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License
 */

namespace ZfTable\Params;

use ZfTable\Params\AbstractAdapter;
use ZfTable\Params\AdapterInterface;
use ZfTable\Table\Exception;

class AdapterArrayObject extends AbstractAdapter implements AdapterInterface, \Zend\Stdlib\InitializableInterface
{

    /**
     *
     * @var \ArrayObject | \Zend\Stdlib\ArrayObject
     */
    protected $object;

    /**
     *
     * @var int
     */
    protected $page;

    /**
     *
     * @var string
     */
    protected $order;

    /**
     *
     * @var string
     */
    protected $column;

    /**
     *
     * @var int
     */
    protected $itemCountPerPage;

    /**
     * Quick search
     * @var string
     */
    protected $quickSearch;


     /**
     * Array of filters
     * @var array
     */
    protected $filters;

    const DEFAULT_PAGE = 1;
    const DEFAULT_ORDER = 'asc';
    const DEFAULT_ITEM_COUNT_PER_PAGE = 2;


    public function __construct($object)
    {
        if ($object instanceof \ArrayObject) {
            $this->object = $object;
        } elseif ($object instanceof \Zend\Stdlib\ArrayObject) {
            $this->object = $object;
        } else {
            throw new Exception\InvalidArgumentException('parameter must be instance of ArrayObject');
        }
    }
    
    /**
     * (non-PHPdoc)
     * @see \ZfTable\Params\AdapterInterface::isSearch()
     */
    public function isSearch()
    {
        if ($this->getQuickSearch()) {
            return true;
        }
        
        $array = (method_exists($this->object, 'toArray')) ? $this->object->toArray() : $this->object->getArrayCopy();
        
        foreach ($array as $k => $v) {
            if (strpos($k, 'zff') !== false && $v != '') {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Init method
     */
    public function init()
    {
        $array = (method_exists($this->object, 'toArray')) ? $this->object->toArray() : $this->object->getArrayCopy();

        $this->page = (isset($array['zfTablePage'])) ? $array['zfTablePage'] : self::DEFAULT_PAGE;
        $this->column = (isset($array['zfTableColumn'])) ? $array['zfTableColumn'] : null;
        $this->order = (isset($array['zfTableOrder'])) ? $array['zfTableOrder'] : self::DEFAULT_ORDER;
        $this->itemCountPerPage = (isset($array['zfTableItemPerPage'])) ? $array['zfTableItemPerPage'] : $this->getOptions()->getItemCountPerPage();
        $this->quickSearch = (isset($array['zfTableQuickSearch'])) ? $array['zfTableQuickSearch'] : '';
        
        $options = $this->getTable()->getOptions();
        $name = strtolower($options->getName());
        
        //Init filters value
        if ($options->getShowColumnFilters()) {
            foreach ($array as $key => $value) {
                if (substr($key, 0, 4) == 'zff_') {
                    $this->filters[$key] = $value;
                }
            }
        }
    }

    public function getPureValueOfFilter($key)
    {
        return $this->object[$key];
    }

    public function getValueOfFilter($key, $prefix = 'zff_')
    {
        $tablename = strtolower($this->getOptions()->getName()) . '_';
        return $this->filters[$prefix . $tablename . $key];
    }

    /**
     * Get page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set page
     *
     * @param string $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Get order
     *
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set asc or desc ordering
     *
     * @param $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Get column
     *
     * @return string
     */
    public function getColumn()
    {
        return ($this->column == '') ? null : $this->column;
    }

    /**
     *
     * @param string $column
     * @return $this
     */
    public function setColumn($column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * Get item count per page
     *
     * @return int
     */
    public function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    /**
     *
     * @param int $itemCountPerPage
     */
    public function setItemCountPerPage($itemCountPerPage)
    {
        $this->itemCountPerPage = $itemCountPerPage;
    }

    /**
     * Return offset
     *
     * @return int
     */
    public function getOffset()
    {
        return ($this->getPage() * $this->getItemCountPerPage()) - $this->getItemCountPerPage();
    }

    /**
     * Get quick search string
     *
     * @return string
     */
    public function getQuickSearch()
    {
        return $this->quickSearch;
    }
}
