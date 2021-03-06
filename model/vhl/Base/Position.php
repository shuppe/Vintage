<?php

namespace Base;

use \Formation as ChildFormation;
use \FormationQuery as ChildFormationQuery;
use \Position as ChildPosition;
use \PositionJoueur as ChildPositionJoueur;
use \PositionJoueurQuery as ChildPositionJoueurQuery;
use \PositionQuery as ChildPositionQuery;
use \Exception;
use \PDO;
use Map\FormationTableMap;
use Map\PositionJoueurTableMap;
use Map\PositionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'Position' table.
 *
 *
 *
 * @package    propel.generator.vhl.Base
 */
abstract class Position implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PositionTableMap';


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
     * The value for the abbr field.
     *
     * @var        string
     */
    protected $abbr;

    /**
     * The value for the nom field.
     *
     * @var        string
     */
    protected $nom;

    /**
     * @var        ObjectCollection|ChildFormation[] Collection to store aggregation of ChildFormation objects.
     */
    protected $collFormations;
    protected $collFormationsPartial;

    /**
     * @var        ObjectCollection|ChildPositionJoueur[] Collection to store aggregation of ChildPositionJoueur objects.
     */
    protected $collPositionJoueurs;
    protected $collPositionJoueursPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildFormation[]
     */
    protected $formationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPositionJoueur[]
     */
    protected $positionJoueursScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Position object.
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
     * Compares this with another <code>Position</code> instance.  If
     * <code>obj</code> is an instance of <code>Position</code>, delegates to
     * <code>equals(Position)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Position The current object, for fluid interface
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
     * Get the [abbr] column value.
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Get the [nom] column value.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of [abbr] column.
     *
     * @param string $v new value
     * @return $this|\Position The current object (for fluent API support)
     */
    public function setAbbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->abbr !== $v) {
            $this->abbr = $v;
            $this->modifiedColumns[PositionTableMap::COL_ABBR] = true;
        }

        return $this;
    } // setAbbr()

    /**
     * Set the value of [nom] column.
     *
     * @param string $v new value
     * @return $this|\Position The current object (for fluent API support)
     */
    public function setNom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nom !== $v) {
            $this->nom = $v;
            $this->modifiedColumns[PositionTableMap::COL_NOM] = true;
        }

        return $this;
    } // setNom()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PositionTableMap::translateFieldName('Abbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->abbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PositionTableMap::translateFieldName('Nom', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nom = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = PositionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Position'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(PositionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPositionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collFormations = null;

            $this->collPositionJoueurs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Position::setDeleted()
     * @see Position::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPositionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
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
                PositionTableMap::addInstanceToPool($this);
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

            if ($this->formationsScheduledForDeletion !== null) {
                if (!$this->formationsScheduledForDeletion->isEmpty()) {
                    \FormationQuery::create()
                        ->filterByPrimaryKeys($this->formationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->formationsScheduledForDeletion = null;
                }
            }

            if ($this->collFormations !== null) {
                foreach ($this->collFormations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->positionJoueursScheduledForDeletion !== null) {
                if (!$this->positionJoueursScheduledForDeletion->isEmpty()) {
                    \PositionJoueurQuery::create()
                        ->filterByPrimaryKeys($this->positionJoueursScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->positionJoueursScheduledForDeletion = null;
                }
            }

            if ($this->collPositionJoueurs !== null) {
                foreach ($this->collPositionJoueurs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PositionTableMap::COL_ABBR)) {
            $modifiedColumns[':p' . $index++]  = 'abbr';
        }
        if ($this->isColumnModified(PositionTableMap::COL_NOM)) {
            $modifiedColumns[':p' . $index++]  = 'nom';
        }

        $sql = sprintf(
            'INSERT INTO Position (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'abbr':
                        $stmt->bindValue($identifier, $this->abbr, PDO::PARAM_STR);
                        break;
                    case 'nom':
                        $stmt->bindValue($identifier, $this->nom, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = PositionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAbbr();
                break;
            case 1:
                return $this->getNom();
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

        if (isset($alreadyDumpedObjects['Position'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Position'][$this->hashCode()] = true;
        $keys = PositionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAbbr(),
            $keys[1] => $this->getNom(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collFormations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'formations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Formations';
                        break;
                    default:
                        $key = 'Formations';
                }

                $result[$key] = $this->collFormations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPositionJoueurs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'positionJoueurs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Position_Joueurs';
                        break;
                    default:
                        $key = 'PositionJoueurs';
                }

                $result[$key] = $this->collPositionJoueurs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Position
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PositionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Position
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setAbbr($value);
                break;
            case 1:
                $this->setNom($value);
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
        $keys = PositionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAbbr($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNom($arr[$keys[1]]);
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
     * @return $this|\Position The current object, for fluid interface
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
        $criteria = new Criteria(PositionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PositionTableMap::COL_ABBR)) {
            $criteria->add(PositionTableMap::COL_ABBR, $this->abbr);
        }
        if ($this->isColumnModified(PositionTableMap::COL_NOM)) {
            $criteria->add(PositionTableMap::COL_NOM, $this->nom);
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
        $criteria = ChildPositionQuery::create();
        $criteria->add(PositionTableMap::COL_ABBR, $this->abbr);

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
        $validPk = null !== $this->getAbbr();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getAbbr();
    }

    /**
     * Generic method to set the primary key (abbr column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setAbbr($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getAbbr();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Position (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAbbr($this->getAbbr());
        $copyObj->setNom($this->getNom());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getFormations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addFormation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPositionJoueurs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPositionJoueur($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \Position Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Formation' == $relationName) {
            $this->initFormations();
            return;
        }
        if ('PositionJoueur' == $relationName) {
            $this->initPositionJoueurs();
            return;
        }
    }

    /**
     * Clears out the collFormations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addFormations()
     */
    public function clearFormations()
    {
        $this->collFormations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collFormations collection loaded partially.
     */
    public function resetPartialFormations($v = true)
    {
        $this->collFormationsPartial = $v;
    }

    /**
     * Initializes the collFormations collection.
     *
     * By default this just sets the collFormations collection to an empty array (like clearcollFormations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initFormations($overrideExisting = true)
    {
        if (null !== $this->collFormations && !$overrideExisting) {
            return;
        }

        $collectionClassName = FormationTableMap::getTableMap()->getCollectionClassName();

        $this->collFormations = new $collectionClassName;
        $this->collFormations->setModel('\Formation');
    }

    /**
     * Gets an array of ChildFormation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPosition is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildFormation[] List of ChildFormation objects
     * @throws PropelException
     */
    public function getFormations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collFormationsPartial && !$this->isNew();
        if (null === $this->collFormations || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collFormations) {
                // return empty collection
                $this->initFormations();
            } else {
                $collFormations = ChildFormationQuery::create(null, $criteria)
                    ->filterByPosition($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collFormationsPartial && count($collFormations)) {
                        $this->initFormations(false);

                        foreach ($collFormations as $obj) {
                            if (false == $this->collFormations->contains($obj)) {
                                $this->collFormations->append($obj);
                            }
                        }

                        $this->collFormationsPartial = true;
                    }

                    return $collFormations;
                }

                if ($partial && $this->collFormations) {
                    foreach ($this->collFormations as $obj) {
                        if ($obj->isNew()) {
                            $collFormations[] = $obj;
                        }
                    }
                }

                $this->collFormations = $collFormations;
                $this->collFormationsPartial = false;
            }
        }

        return $this->collFormations;
    }

    /**
     * Sets a collection of ChildFormation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $formations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPosition The current object (for fluent API support)
     */
    public function setFormations(Collection $formations, ConnectionInterface $con = null)
    {
        /** @var ChildFormation[] $formationsToDelete */
        $formationsToDelete = $this->getFormations(new Criteria(), $con)->diff($formations);


        $this->formationsScheduledForDeletion = $formationsToDelete;

        foreach ($formationsToDelete as $formationRemoved) {
            $formationRemoved->setPosition(null);
        }

        $this->collFormations = null;
        foreach ($formations as $formation) {
            $this->addFormation($formation);
        }

        $this->collFormations = $formations;
        $this->collFormationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Formation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Formation objects.
     * @throws PropelException
     */
    public function countFormations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collFormationsPartial && !$this->isNew();
        if (null === $this->collFormations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collFormations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getFormations());
            }

            $query = ChildFormationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPosition($this)
                ->count($con);
        }

        return count($this->collFormations);
    }

    /**
     * Method called to associate a ChildFormation object to this object
     * through the ChildFormation foreign key attribute.
     *
     * @param  ChildFormation $l ChildFormation
     * @return $this|\Position The current object (for fluent API support)
     */
    public function addFormation(ChildFormation $l)
    {
        if ($this->collFormations === null) {
            $this->initFormations();
            $this->collFormationsPartial = true;
        }

        if (!$this->collFormations->contains($l)) {
            $this->doAddFormation($l);

            if ($this->formationsScheduledForDeletion and $this->formationsScheduledForDeletion->contains($l)) {
                $this->formationsScheduledForDeletion->remove($this->formationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildFormation $formation The ChildFormation object to add.
     */
    protected function doAddFormation(ChildFormation $formation)
    {
        $this->collFormations[]= $formation;
        $formation->setPosition($this);
    }

    /**
     * @param  ChildFormation $formation The ChildFormation object to remove.
     * @return $this|ChildPosition The current object (for fluent API support)
     */
    public function removeFormation(ChildFormation $formation)
    {
        if ($this->getFormations()->contains($formation)) {
            $pos = $this->collFormations->search($formation);
            $this->collFormations->remove($pos);
            if (null === $this->formationsScheduledForDeletion) {
                $this->formationsScheduledForDeletion = clone $this->collFormations;
                $this->formationsScheduledForDeletion->clear();
            }
            $this->formationsScheduledForDeletion[]= clone $formation;
            $formation->setPosition(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Position is new, it will return
     * an empty collection; or if this Position has previously
     * been saved, it will retrieve related Formations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Position.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormation[] List of ChildFormation objects
     */
    public function getFormationsJoinAlignement(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormationQuery::create(null, $criteria);
        $query->joinWith('Alignement', $joinBehavior);

        return $this->getFormations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Position is new, it will return
     * an empty collection; or if this Position has previously
     * been saved, it will retrieve related Formations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Position.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildFormation[] List of ChildFormation objects
     */
    public function getFormationsJoinJoueur(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildFormationQuery::create(null, $criteria);
        $query->joinWith('Joueur', $joinBehavior);

        return $this->getFormations($query, $con);
    }

    /**
     * Clears out the collPositionJoueurs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPositionJoueurs()
     */
    public function clearPositionJoueurs()
    {
        $this->collPositionJoueurs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPositionJoueurs collection loaded partially.
     */
    public function resetPartialPositionJoueurs($v = true)
    {
        $this->collPositionJoueursPartial = $v;
    }

    /**
     * Initializes the collPositionJoueurs collection.
     *
     * By default this just sets the collPositionJoueurs collection to an empty array (like clearcollPositionJoueurs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPositionJoueurs($overrideExisting = true)
    {
        if (null !== $this->collPositionJoueurs && !$overrideExisting) {
            return;
        }

        $collectionClassName = PositionJoueurTableMap::getTableMap()->getCollectionClassName();

        $this->collPositionJoueurs = new $collectionClassName;
        $this->collPositionJoueurs->setModel('\PositionJoueur');
    }

    /**
     * Gets an array of ChildPositionJoueur objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPosition is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPositionJoueur[] List of ChildPositionJoueur objects
     * @throws PropelException
     */
    public function getPositionJoueurs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPositionJoueursPartial && !$this->isNew();
        if (null === $this->collPositionJoueurs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPositionJoueurs) {
                // return empty collection
                $this->initPositionJoueurs();
            } else {
                $collPositionJoueurs = ChildPositionJoueurQuery::create(null, $criteria)
                    ->filterByPosition($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPositionJoueursPartial && count($collPositionJoueurs)) {
                        $this->initPositionJoueurs(false);

                        foreach ($collPositionJoueurs as $obj) {
                            if (false == $this->collPositionJoueurs->contains($obj)) {
                                $this->collPositionJoueurs->append($obj);
                            }
                        }

                        $this->collPositionJoueursPartial = true;
                    }

                    return $collPositionJoueurs;
                }

                if ($partial && $this->collPositionJoueurs) {
                    foreach ($this->collPositionJoueurs as $obj) {
                        if ($obj->isNew()) {
                            $collPositionJoueurs[] = $obj;
                        }
                    }
                }

                $this->collPositionJoueurs = $collPositionJoueurs;
                $this->collPositionJoueursPartial = false;
            }
        }

        return $this->collPositionJoueurs;
    }

    /**
     * Sets a collection of ChildPositionJoueur objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $positionJoueurs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPosition The current object (for fluent API support)
     */
    public function setPositionJoueurs(Collection $positionJoueurs, ConnectionInterface $con = null)
    {
        /** @var ChildPositionJoueur[] $positionJoueursToDelete */
        $positionJoueursToDelete = $this->getPositionJoueurs(new Criteria(), $con)->diff($positionJoueurs);


        $this->positionJoueursScheduledForDeletion = $positionJoueursToDelete;

        foreach ($positionJoueursToDelete as $positionJoueurRemoved) {
            $positionJoueurRemoved->setPosition(null);
        }

        $this->collPositionJoueurs = null;
        foreach ($positionJoueurs as $positionJoueur) {
            $this->addPositionJoueur($positionJoueur);
        }

        $this->collPositionJoueurs = $positionJoueurs;
        $this->collPositionJoueursPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PositionJoueur objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PositionJoueur objects.
     * @throws PropelException
     */
    public function countPositionJoueurs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPositionJoueursPartial && !$this->isNew();
        if (null === $this->collPositionJoueurs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPositionJoueurs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPositionJoueurs());
            }

            $query = ChildPositionJoueurQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPosition($this)
                ->count($con);
        }

        return count($this->collPositionJoueurs);
    }

    /**
     * Method called to associate a ChildPositionJoueur object to this object
     * through the ChildPositionJoueur foreign key attribute.
     *
     * @param  ChildPositionJoueur $l ChildPositionJoueur
     * @return $this|\Position The current object (for fluent API support)
     */
    public function addPositionJoueur(ChildPositionJoueur $l)
    {
        if ($this->collPositionJoueurs === null) {
            $this->initPositionJoueurs();
            $this->collPositionJoueursPartial = true;
        }

        if (!$this->collPositionJoueurs->contains($l)) {
            $this->doAddPositionJoueur($l);

            if ($this->positionJoueursScheduledForDeletion and $this->positionJoueursScheduledForDeletion->contains($l)) {
                $this->positionJoueursScheduledForDeletion->remove($this->positionJoueursScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPositionJoueur $positionJoueur The ChildPositionJoueur object to add.
     */
    protected function doAddPositionJoueur(ChildPositionJoueur $positionJoueur)
    {
        $this->collPositionJoueurs[]= $positionJoueur;
        $positionJoueur->setPosition($this);
    }

    /**
     * @param  ChildPositionJoueur $positionJoueur The ChildPositionJoueur object to remove.
     * @return $this|ChildPosition The current object (for fluent API support)
     */
    public function removePositionJoueur(ChildPositionJoueur $positionJoueur)
    {
        if ($this->getPositionJoueurs()->contains($positionJoueur)) {
            $pos = $this->collPositionJoueurs->search($positionJoueur);
            $this->collPositionJoueurs->remove($pos);
            if (null === $this->positionJoueursScheduledForDeletion) {
                $this->positionJoueursScheduledForDeletion = clone $this->collPositionJoueurs;
                $this->positionJoueursScheduledForDeletion->clear();
            }
            $this->positionJoueursScheduledForDeletion[]= clone $positionJoueur;
            $positionJoueur->setPosition(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Position is new, it will return
     * an empty collection; or if this Position has previously
     * been saved, it will retrieve related PositionJoueurs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Position.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPositionJoueur[] List of ChildPositionJoueur objects
     */
    public function getPositionJoueursJoinJoueur(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPositionJoueurQuery::create(null, $criteria);
        $query->joinWith('Joueur', $joinBehavior);

        return $this->getPositionJoueurs($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->abbr = null;
        $this->nom = null;
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
            if ($this->collFormations) {
                foreach ($this->collFormations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPositionJoueurs) {
                foreach ($this->collPositionJoueurs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collFormations = null;
        $this->collPositionJoueurs = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PositionTableMap::DEFAULT_STRING_FORMAT);
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
