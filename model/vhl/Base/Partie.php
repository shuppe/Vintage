<?php

namespace Base;

use \Alignement as ChildAlignement;
use \AlignementQuery as ChildAlignementQuery;
use \Arena as ChildArena;
use \ArenaQuery as ChildArenaQuery;
use \PartieQuery as ChildPartieQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\PartieTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'Partie' table.
 *
 *
 *
 * @package    propel.generator.vhl.Base
 */
abstract class Partie implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PartieTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the datepartie field.
     *
     * @var        DateTime
     */
    protected $datepartie;

    /**
     * The value for the heure field.
     *
     * @var        DateTime
     */
    protected $heure;

    /**
     * The value for the arenano field.
     *
     * @var        int
     */
    protected $arenano;

    /**
     * The value for the equipelocale field.
     *
     * @var        int
     */
    protected $equipelocale;

    /**
     * The value for the ptsequipelocale field.
     *
     * @var        int
     */
    protected $ptsequipelocale;

    /**
     * The value for the equipevisite field.
     *
     * @var        int
     */
    protected $equipevisite;

    /**
     * The value for the ptsequipevisite field.
     *
     * @var        int
     */
    protected $ptsequipevisite;

    /**
     * @var        ChildArena
     */
    protected $aArena;

    /**
     * @var        ChildAlignement
     */
    protected $aAlignementRelatedByEquipelocale;

    /**
     * @var        ChildAlignement
     */
    protected $aAlignementRelatedByEquipevisite;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Partie object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Partie</code> instance.  If
     * <code>obj</code> is an instance of <code>Partie</code>, delegates to
     * <code>equals(Partie)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Partie The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [optionally formatted] temporal [datepartie] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDatepartie($format = NULL)
    {
        if ($format === null) {
            return $this->datepartie;
        } else {
            return $this->datepartie instanceof \DateTimeInterface ? $this->datepartie->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [heure] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getHeure($format = NULL)
    {
        if ($format === null) {
            return $this->heure;
        } else {
            return $this->heure instanceof \DateTimeInterface ? $this->heure->format($format) : null;
        }
    }

    /**
     * Get the [arenano] column value.
     *
     * @return int
     */
    public function getArenano()
    {
        return $this->arenano;
    }

    /**
     * Get the [equipelocale] column value.
     *
     * @return int
     */
    public function getEquipelocale()
    {
        return $this->equipelocale;
    }

    /**
     * Get the [ptsequipelocale] column value.
     *
     * @return int
     */
    public function getPtsequipelocale()
    {
        return $this->ptsequipelocale;
    }

    /**
     * Get the [equipevisite] column value.
     *
     * @return int
     */
    public function getEquipevisite()
    {
        return $this->equipevisite;
    }

    /**
     * Get the [ptsequipevisite] column value.
     *
     * @return int
     */
    public function getPtsequipevisite()
    {
        return $this->ptsequipevisite;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PartieTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Sets the value of [datepartie] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setDatepartie($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->datepartie !== null || $dt !== null) {
            if ($this->datepartie === null || $dt === null || $dt->format("Y-m-d") !== $this->datepartie->format("Y-m-d")) {
                $this->datepartie = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PartieTableMap::COL_DATEPARTIE] = true;
            }
        } // if either are not null

        return $this;
    } // setDatepartie()

    /**
     * Sets the value of [heure] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setHeure($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->heure !== null || $dt !== null) {
            if ($this->heure === null || $dt === null || $dt->format("H:i:s.u") !== $this->heure->format("H:i:s.u")) {
                $this->heure = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PartieTableMap::COL_HEURE] = true;
            }
        } // if either are not null

        return $this;
    } // setHeure()

    /**
     * Set the value of [arenano] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setArenano($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->arenano !== $v) {
            $this->arenano = $v;
            $this->modifiedColumns[PartieTableMap::COL_ARENANO] = true;
        }

        if ($this->aArena !== null && $this->aArena->getId() !== $v) {
            $this->aArena = null;
        }

        return $this;
    } // setArenano()

    /**
     * Set the value of [equipelocale] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setEquipelocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->equipelocale !== $v) {
            $this->equipelocale = $v;
            $this->modifiedColumns[PartieTableMap::COL_EQUIPELOCALE] = true;
        }

        if ($this->aAlignementRelatedByEquipelocale !== null && $this->aAlignementRelatedByEquipelocale->getId() !== $v) {
            $this->aAlignementRelatedByEquipelocale = null;
        }

        return $this;
    } // setEquipelocale()

    /**
     * Set the value of [ptsequipelocale] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setPtsequipelocale($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ptsequipelocale !== $v) {
            $this->ptsequipelocale = $v;
            $this->modifiedColumns[PartieTableMap::COL_PTSEQUIPELOCALE] = true;
        }

        return $this;
    } // setPtsequipelocale()

    /**
     * Set the value of [equipevisite] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setEquipevisite($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->equipevisite !== $v) {
            $this->equipevisite = $v;
            $this->modifiedColumns[PartieTableMap::COL_EQUIPEVISITE] = true;
        }

        if ($this->aAlignementRelatedByEquipevisite !== null && $this->aAlignementRelatedByEquipevisite->getId() !== $v) {
            $this->aAlignementRelatedByEquipevisite = null;
        }

        return $this;
    } // setEquipevisite()

    /**
     * Set the value of [ptsequipevisite] column.
     *
     * @param int $v new value
     * @return $this|\Partie The current object (for fluent API support)
     */
    public function setPtsequipevisite($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->ptsequipevisite !== $v) {
            $this->ptsequipevisite = $v;
            $this->modifiedColumns[PartieTableMap::COL_PTSEQUIPEVISITE] = true;
        }

        return $this;
    } // setPtsequipevisite()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PartieTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PartieTableMap::translateFieldName('Datepartie', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->datepartie = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PartieTableMap::translateFieldName('Heure', TableMap::TYPE_PHPNAME, $indexType)];
            $this->heure = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PartieTableMap::translateFieldName('Arenano', TableMap::TYPE_PHPNAME, $indexType)];
            $this->arenano = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PartieTableMap::translateFieldName('Equipelocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->equipelocale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PartieTableMap::translateFieldName('Ptsequipelocale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ptsequipelocale = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PartieTableMap::translateFieldName('Equipevisite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->equipevisite = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PartieTableMap::translateFieldName('Ptsequipevisite', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ptsequipevisite = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = PartieTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Partie'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aArena !== null && $this->arenano !== $this->aArena->getId()) {
            $this->aArena = null;
        }
        if ($this->aAlignementRelatedByEquipelocale !== null && $this->equipelocale !== $this->aAlignementRelatedByEquipelocale->getId()) {
            $this->aAlignementRelatedByEquipelocale = null;
        }
        if ($this->aAlignementRelatedByEquipevisite !== null && $this->equipevisite !== $this->aAlignementRelatedByEquipevisite->getId()) {
            $this->aAlignementRelatedByEquipevisite = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartieTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPartieQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aArena = null;
            $this->aAlignementRelatedByEquipelocale = null;
            $this->aAlignementRelatedByEquipevisite = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Partie::setDeleted()
     * @see Partie::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPartieQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PartieTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aArena !== null) {
                if ($this->aArena->isModified() || $this->aArena->isNew()) {
                    $affectedRows += $this->aArena->save($con);
                }
                $this->setArena($this->aArena);
            }

            if ($this->aAlignementRelatedByEquipelocale !== null) {
                if ($this->aAlignementRelatedByEquipelocale->isModified() || $this->aAlignementRelatedByEquipelocale->isNew()) {
                    $affectedRows += $this->aAlignementRelatedByEquipelocale->save($con);
                }
                $this->setAlignementRelatedByEquipelocale($this->aAlignementRelatedByEquipelocale);
            }

            if ($this->aAlignementRelatedByEquipevisite !== null) {
                if ($this->aAlignementRelatedByEquipevisite->isModified() || $this->aAlignementRelatedByEquipevisite->isNew()) {
                    $affectedRows += $this->aAlignementRelatedByEquipevisite->save($con);
                }
                $this->setAlignementRelatedByEquipevisite($this->aAlignementRelatedByEquipevisite);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[PartieTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PartieTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PartieTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PartieTableMap::COL_DATEPARTIE)) {
            $modifiedColumns[':p' . $index++]  = 'datePartie';
        }
        if ($this->isColumnModified(PartieTableMap::COL_HEURE)) {
            $modifiedColumns[':p' . $index++]  = 'Heure';
        }
        if ($this->isColumnModified(PartieTableMap::COL_ARENANO)) {
            $modifiedColumns[':p' . $index++]  = 'ArenaNo';
        }
        if ($this->isColumnModified(PartieTableMap::COL_EQUIPELOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'EquipeLocale';
        }
        if ($this->isColumnModified(PartieTableMap::COL_PTSEQUIPELOCALE)) {
            $modifiedColumns[':p' . $index++]  = 'ptsEquipeLocale';
        }
        if ($this->isColumnModified(PartieTableMap::COL_EQUIPEVISITE)) {
            $modifiedColumns[':p' . $index++]  = 'EquipeVisite';
        }
        if ($this->isColumnModified(PartieTableMap::COL_PTSEQUIPEVISITE)) {
            $modifiedColumns[':p' . $index++]  = 'ptsEquipeVisite';
        }

        $sql = sprintf(
            'INSERT INTO Partie (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'datePartie':
                        $stmt->bindValue($identifier, $this->datepartie ? $this->datepartie->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'Heure':
                        $stmt->bindValue($identifier, $this->heure ? $this->heure->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'ArenaNo':
                        $stmt->bindValue($identifier, $this->arenano, PDO::PARAM_INT);
                        break;
                    case 'EquipeLocale':
                        $stmt->bindValue($identifier, $this->equipelocale, PDO::PARAM_INT);
                        break;
                    case 'ptsEquipeLocale':
                        $stmt->bindValue($identifier, $this->ptsequipelocale, PDO::PARAM_INT);
                        break;
                    case 'EquipeVisite':
                        $stmt->bindValue($identifier, $this->equipevisite, PDO::PARAM_INT);
                        break;
                    case 'ptsEquipeVisite':
                        $stmt->bindValue($identifier, $this->ptsequipevisite, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PartieTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getDatepartie();
                break;
            case 2:
                return $this->getHeure();
                break;
            case 3:
                return $this->getArenano();
                break;
            case 4:
                return $this->getEquipelocale();
                break;
            case 5:
                return $this->getPtsequipelocale();
                break;
            case 6:
                return $this->getEquipevisite();
                break;
            case 7:
                return $this->getPtsequipevisite();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Partie'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Partie'][$this->hashCode()] = true;
        $keys = PartieTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDatepartie(),
            $keys[2] => $this->getHeure(),
            $keys[3] => $this->getArenano(),
            $keys[4] => $this->getEquipelocale(),
            $keys[5] => $this->getPtsequipelocale(),
            $keys[6] => $this->getEquipevisite(),
            $keys[7] => $this->getPtsequipevisite(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aArena) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'arena';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Arena';
                        break;
                    default:
                        $key = 'Arena';
                }

                $result[$key] = $this->aArena->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAlignementRelatedByEquipelocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'alignement';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Alignement';
                        break;
                    default:
                        $key = 'Alignement';
                }

                $result[$key] = $this->aAlignementRelatedByEquipelocale->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAlignementRelatedByEquipevisite) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'alignement';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Alignement';
                        break;
                    default:
                        $key = 'Alignement';
                }

                $result[$key] = $this->aAlignementRelatedByEquipevisite->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Partie
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PartieTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Partie
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setDatepartie($value);
                break;
            case 2:
                $this->setHeure($value);
                break;
            case 3:
                $this->setArenano($value);
                break;
            case 4:
                $this->setEquipelocale($value);
                break;
            case 5:
                $this->setPtsequipelocale($value);
                break;
            case 6:
                $this->setEquipevisite($value);
                break;
            case 7:
                $this->setPtsequipevisite($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PartieTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDatepartie($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setHeure($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setArenano($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEquipelocale($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPtsequipelocale($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEquipevisite($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPtsequipevisite($arr[$keys[7]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Partie The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PartieTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PartieTableMap::COL_ID)) {
            $criteria->add(PartieTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PartieTableMap::COL_DATEPARTIE)) {
            $criteria->add(PartieTableMap::COL_DATEPARTIE, $this->datepartie);
        }
        if ($this->isColumnModified(PartieTableMap::COL_HEURE)) {
            $criteria->add(PartieTableMap::COL_HEURE, $this->heure);
        }
        if ($this->isColumnModified(PartieTableMap::COL_ARENANO)) {
            $criteria->add(PartieTableMap::COL_ARENANO, $this->arenano);
        }
        if ($this->isColumnModified(PartieTableMap::COL_EQUIPELOCALE)) {
            $criteria->add(PartieTableMap::COL_EQUIPELOCALE, $this->equipelocale);
        }
        if ($this->isColumnModified(PartieTableMap::COL_PTSEQUIPELOCALE)) {
            $criteria->add(PartieTableMap::COL_PTSEQUIPELOCALE, $this->ptsequipelocale);
        }
        if ($this->isColumnModified(PartieTableMap::COL_EQUIPEVISITE)) {
            $criteria->add(PartieTableMap::COL_EQUIPEVISITE, $this->equipevisite);
        }
        if ($this->isColumnModified(PartieTableMap::COL_PTSEQUIPEVISITE)) {
            $criteria->add(PartieTableMap::COL_PTSEQUIPEVISITE, $this->ptsequipevisite);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPartieQuery::create();
        $criteria->add(PartieTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Partie (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDatepartie($this->getDatepartie());
        $copyObj->setHeure($this->getHeure());
        $copyObj->setArenano($this->getArenano());
        $copyObj->setEquipelocale($this->getEquipelocale());
        $copyObj->setPtsequipelocale($this->getPtsequipelocale());
        $copyObj->setEquipevisite($this->getEquipevisite());
        $copyObj->setPtsequipevisite($this->getPtsequipevisite());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Partie Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildArena object.
     *
     * @param  ChildArena $v
     * @return $this|\Partie The current object (for fluent API support)
     * @throws PropelException
     */
    public function setArena(ChildArena $v = null)
    {
        if ($v === null) {
            $this->setArenano(NULL);
        } else {
            $this->setArenano($v->getId());
        }

        $this->aArena = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildArena object, it will not be re-added.
        if ($v !== null) {
            $v->addPartie($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildArena object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildArena The associated ChildArena object.
     * @throws PropelException
     */
    public function getArena(ConnectionInterface $con = null)
    {
        if ($this->aArena === null && ($this->arenano != 0)) {
            $this->aArena = ChildArenaQuery::create()->findPk($this->arenano, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aArena->addParties($this);
             */
        }

        return $this->aArena;
    }

    /**
     * Declares an association between this object and a ChildAlignement object.
     *
     * @param  ChildAlignement $v
     * @return $this|\Partie The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAlignementRelatedByEquipelocale(ChildAlignement $v = null)
    {
        if ($v === null) {
            $this->setEquipelocale(NULL);
        } else {
            $this->setEquipelocale($v->getId());
        }

        $this->aAlignementRelatedByEquipelocale = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAlignement object, it will not be re-added.
        if ($v !== null) {
            $v->addPartieRelatedByEquipelocale($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAlignement object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAlignement The associated ChildAlignement object.
     * @throws PropelException
     */
    public function getAlignementRelatedByEquipelocale(ConnectionInterface $con = null)
    {
        if ($this->aAlignementRelatedByEquipelocale === null && ($this->equipelocale != 0)) {
            $this->aAlignementRelatedByEquipelocale = ChildAlignementQuery::create()->findPk($this->equipelocale, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAlignementRelatedByEquipelocale->addPartiesRelatedByEquipelocale($this);
             */
        }

        return $this->aAlignementRelatedByEquipelocale;
    }

    /**
     * Declares an association between this object and a ChildAlignement object.
     *
     * @param  ChildAlignement $v
     * @return $this|\Partie The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAlignementRelatedByEquipevisite(ChildAlignement $v = null)
    {
        if ($v === null) {
            $this->setEquipevisite(NULL);
        } else {
            $this->setEquipevisite($v->getId());
        }

        $this->aAlignementRelatedByEquipevisite = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAlignement object, it will not be re-added.
        if ($v !== null) {
            $v->addPartieRelatedByEquipevisite($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAlignement object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAlignement The associated ChildAlignement object.
     * @throws PropelException
     */
    public function getAlignementRelatedByEquipevisite(ConnectionInterface $con = null)
    {
        if ($this->aAlignementRelatedByEquipevisite === null && ($this->equipevisite != 0)) {
            $this->aAlignementRelatedByEquipevisite = ChildAlignementQuery::create()->findPk($this->equipevisite, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAlignementRelatedByEquipevisite->addPartiesRelatedByEquipevisite($this);
             */
        }

        return $this->aAlignementRelatedByEquipevisite;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aArena) {
            $this->aArena->removePartie($this);
        }
        if (null !== $this->aAlignementRelatedByEquipelocale) {
            $this->aAlignementRelatedByEquipelocale->removePartieRelatedByEquipelocale($this);
        }
        if (null !== $this->aAlignementRelatedByEquipevisite) {
            $this->aAlignementRelatedByEquipevisite->removePartieRelatedByEquipevisite($this);
        }
        $this->id = null;
        $this->datepartie = null;
        $this->heure = null;
        $this->arenano = null;
        $this->equipelocale = null;
        $this->ptsequipelocale = null;
        $this->equipevisite = null;
        $this->ptsequipevisite = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aArena = null;
        $this->aAlignementRelatedByEquipelocale = null;
        $this->aAlignementRelatedByEquipevisite = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PartieTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
