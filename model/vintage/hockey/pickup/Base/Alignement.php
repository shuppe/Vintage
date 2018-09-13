<?php

namespace Base;

use \Alignement as ChildAlignement;
use \AlignementQuery as ChildAlignementQuery;
use \Equipe as ChildEquipe;
use \EquipeQuery as ChildEquipeQuery;
use \Joueur as ChildJoueur;
use \JoueurQuery as ChildJoueurQuery;
use \Partie as ChildPartie;
use \PartieQuery as ChildPartieQuery;
use \Position as ChildPosition;
use \PositionQuery as ChildPositionQuery;
use \Exception;
use \PDO;
use Map\AlignementTableMap;
use Map\PartieTableMap;
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
 * Base class that represents a row from the 'Alignement' table.
 *
 *
 *
 * @package    propel.generator.vintage.hockey.pickup.Base
 */
abstract class Alignement implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\AlignementTableMap';


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
     * The value for the equipeno field.
     *
     * @var        int
     */
    protected $equipeno;

    /**
     * The value for the joueurno field.
     *
     * @var        int
     */
    protected $joueurno;

    /**
     * The value for the posabbr field.
     *
     * @var        string
     */
    protected $posabbr;

    /**
     * The value for the but field.
     *
     * @var        int
     */
    protected $but;

    /**
     * The value for the passe field.
     *
     * @var        int
     */
    protected $passe;

    /**
     * The value for the blanchissage field.
     *
     * @var        int
     */
    protected $blanchissage;

    /**
     * @var        ChildEquipe
     */
    protected $aEquipe;

    /**
     * @var        ChildJoueur
     */
    protected $aJoueur;

    /**
     * @var        ChildPosition
     */
    protected $aPosition;

    /**
     * @var        ObjectCollection|ChildPartie[] Collection to store aggregation of ChildPartie objects.
     */
    protected $collPartiesRelatedByEquipelocale;
    protected $collPartiesRelatedByEquipelocalePartial;

    /**
     * @var        ObjectCollection|ChildPartie[] Collection to store aggregation of ChildPartie objects.
     */
    protected $collPartiesRelatedByEquipevisite;
    protected $collPartiesRelatedByEquipevisitePartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartie[]
     */
    protected $partiesRelatedByEquipelocaleScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPartie[]
     */
    protected $partiesRelatedByEquipevisiteScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Alignement object.
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
     * Compares this with another <code>Alignement</code> instance.  If
     * <code>obj</code> is an instance of <code>Alignement</code>, delegates to
     * <code>equals(Alignement)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Alignement The current object, for fluid interface
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
     * Get the [equipeno] column value.
     *
     * @return int
     */
    public function getEquipeno()
    {
        return $this->equipeno;
    }

    /**
     * Get the [joueurno] column value.
     *
     * @return int
     */
    public function getJoueurno()
    {
        return $this->joueurno;
    }

    /**
     * Get the [posabbr] column value.
     *
     * @return string
     */
    public function getPosabbr()
    {
        return $this->posabbr;
    }

    /**
     * Get the [but] column value.
     *
     * @return int
     */
    public function getBut()
    {
        return $this->but;
    }

    /**
     * Get the [passe] column value.
     *
     * @return int
     */
    public function getPasse()
    {
        return $this->passe;
    }

    /**
     * Get the [blanchissage] column value.
     *
     * @return int
     */
    public function getBlanchissage()
    {
        return $this->blanchissage;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AlignementTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [equipeno] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setEquipeno($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->equipeno !== $v) {
            $this->equipeno = $v;
            $this->modifiedColumns[AlignementTableMap::COL_EQUIPENO] = true;
        }

        if ($this->aEquipe !== null && $this->aEquipe->getId() !== $v) {
            $this->aEquipe = null;
        }

        return $this;
    } // setEquipeno()

    /**
     * Set the value of [joueurno] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setJoueurno($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->joueurno !== $v) {
            $this->joueurno = $v;
            $this->modifiedColumns[AlignementTableMap::COL_JOUEURNO] = true;
        }

        if ($this->aJoueur !== null && $this->aJoueur->getId() !== $v) {
            $this->aJoueur = null;
        }

        return $this;
    } // setJoueurno()

    /**
     * Set the value of [posabbr] column.
     *
     * @param string $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setPosabbr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->posabbr !== $v) {
            $this->posabbr = $v;
            $this->modifiedColumns[AlignementTableMap::COL_POSABBR] = true;
        }

        if ($this->aPosition !== null && $this->aPosition->getAbbr() !== $v) {
            $this->aPosition = null;
        }

        return $this;
    } // setPosabbr()

    /**
     * Set the value of [but] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setBut($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->but !== $v) {
            $this->but = $v;
            $this->modifiedColumns[AlignementTableMap::COL_BUT] = true;
        }

        return $this;
    } // setBut()

    /**
     * Set the value of [passe] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setPasse($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->passe !== $v) {
            $this->passe = $v;
            $this->modifiedColumns[AlignementTableMap::COL_PASSE] = true;
        }

        return $this;
    } // setPasse()

    /**
     * Set the value of [blanchissage] column.
     *
     * @param int $v new value
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function setBlanchissage($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->blanchissage !== $v) {
            $this->blanchissage = $v;
            $this->modifiedColumns[AlignementTableMap::COL_BLANCHISSAGE] = true;
        }

        return $this;
    } // setBlanchissage()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AlignementTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AlignementTableMap::translateFieldName('Equipeno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->equipeno = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AlignementTableMap::translateFieldName('Joueurno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->joueurno = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AlignementTableMap::translateFieldName('Posabbr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->posabbr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AlignementTableMap::translateFieldName('But', TableMap::TYPE_PHPNAME, $indexType)];
            $this->but = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AlignementTableMap::translateFieldName('Passe', TableMap::TYPE_PHPNAME, $indexType)];
            $this->passe = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AlignementTableMap::translateFieldName('Blanchissage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->blanchissage = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = AlignementTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Alignement'), 0, $e);
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
        if ($this->aEquipe !== null && $this->equipeno !== $this->aEquipe->getId()) {
            $this->aEquipe = null;
        }
        if ($this->aJoueur !== null && $this->joueurno !== $this->aJoueur->getId()) {
            $this->aJoueur = null;
        }
        if ($this->aPosition !== null && $this->posabbr !== $this->aPosition->getAbbr()) {
            $this->aPosition = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(AlignementTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAlignementQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aEquipe = null;
            $this->aJoueur = null;
            $this->aPosition = null;
            $this->collPartiesRelatedByEquipelocale = null;

            $this->collPartiesRelatedByEquipevisite = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Alignement::setDeleted()
     * @see Alignement::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAlignementQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
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
                AlignementTableMap::addInstanceToPool($this);
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

            if ($this->aEquipe !== null) {
                if ($this->aEquipe->isModified() || $this->aEquipe->isNew()) {
                    $affectedRows += $this->aEquipe->save($con);
                }
                $this->setEquipe($this->aEquipe);
            }

            if ($this->aJoueur !== null) {
                if ($this->aJoueur->isModified() || $this->aJoueur->isNew()) {
                    $affectedRows += $this->aJoueur->save($con);
                }
                $this->setJoueur($this->aJoueur);
            }

            if ($this->aPosition !== null) {
                if ($this->aPosition->isModified() || $this->aPosition->isNew()) {
                    $affectedRows += $this->aPosition->save($con);
                }
                $this->setPosition($this->aPosition);
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

            if ($this->partiesRelatedByEquipelocaleScheduledForDeletion !== null) {
                if (!$this->partiesRelatedByEquipelocaleScheduledForDeletion->isEmpty()) {
                    \PartieQuery::create()
                        ->filterByPrimaryKeys($this->partiesRelatedByEquipelocaleScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partiesRelatedByEquipelocaleScheduledForDeletion = null;
                }
            }

            if ($this->collPartiesRelatedByEquipelocale !== null) {
                foreach ($this->collPartiesRelatedByEquipelocale as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->partiesRelatedByEquipevisiteScheduledForDeletion !== null) {
                if (!$this->partiesRelatedByEquipevisiteScheduledForDeletion->isEmpty()) {
                    \PartieQuery::create()
                        ->filterByPrimaryKeys($this->partiesRelatedByEquipevisiteScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->partiesRelatedByEquipevisiteScheduledForDeletion = null;
                }
            }

            if ($this->collPartiesRelatedByEquipevisite !== null) {
                foreach ($this->collPartiesRelatedByEquipevisite as $referrerFK) {
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

        $this->modifiedColumns[AlignementTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AlignementTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AlignementTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'Id';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_EQUIPENO)) {
            $modifiedColumns[':p' . $index++]  = 'EquipeNo';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_JOUEURNO)) {
            $modifiedColumns[':p' . $index++]  = 'JoueurNo';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_POSABBR)) {
            $modifiedColumns[':p' . $index++]  = 'PosAbbr';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_BUT)) {
            $modifiedColumns[':p' . $index++]  = 'But';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_PASSE)) {
            $modifiedColumns[':p' . $index++]  = 'Passe';
        }
        if ($this->isColumnModified(AlignementTableMap::COL_BLANCHISSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'Blanchissage';
        }

        $sql = sprintf(
            'INSERT INTO Alignement (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'Id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'EquipeNo':
                        $stmt->bindValue($identifier, $this->equipeno, PDO::PARAM_INT);
                        break;
                    case 'JoueurNo':
                        $stmt->bindValue($identifier, $this->joueurno, PDO::PARAM_INT);
                        break;
                    case 'PosAbbr':
                        $stmt->bindValue($identifier, $this->posabbr, PDO::PARAM_STR);
                        break;
                    case 'But':
                        $stmt->bindValue($identifier, $this->but, PDO::PARAM_INT);
                        break;
                    case 'Passe':
                        $stmt->bindValue($identifier, $this->passe, PDO::PARAM_INT);
                        break;
                    case 'Blanchissage':
                        $stmt->bindValue($identifier, $this->blanchissage, PDO::PARAM_INT);
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
        $pos = AlignementTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getEquipeno();
                break;
            case 2:
                return $this->getJoueurno();
                break;
            case 3:
                return $this->getPosabbr();
                break;
            case 4:
                return $this->getBut();
                break;
            case 5:
                return $this->getPasse();
                break;
            case 6:
                return $this->getBlanchissage();
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

        if (isset($alreadyDumpedObjects['Alignement'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Alignement'][$this->hashCode()] = true;
        $keys = AlignementTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEquipeno(),
            $keys[2] => $this->getJoueurno(),
            $keys[3] => $this->getPosabbr(),
            $keys[4] => $this->getBut(),
            $keys[5] => $this->getPasse(),
            $keys[6] => $this->getBlanchissage(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aEquipe) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'equipe';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Equipe';
                        break;
                    default:
                        $key = 'Equipe';
                }

                $result[$key] = $this->aEquipe->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aJoueur) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'joueur';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Joueur';
                        break;
                    default:
                        $key = 'Joueur';
                }

                $result[$key] = $this->aJoueur->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPosition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'position';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Position';
                        break;
                    default:
                        $key = 'Position';
                }

                $result[$key] = $this->aPosition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPartiesRelatedByEquipelocale) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'parties';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Parties';
                        break;
                    default:
                        $key = 'Parties';
                }

                $result[$key] = $this->collPartiesRelatedByEquipelocale->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPartiesRelatedByEquipevisite) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'parties';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Parties';
                        break;
                    default:
                        $key = 'Parties';
                }

                $result[$key] = $this->collPartiesRelatedByEquipevisite->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Alignement
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AlignementTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Alignement
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setEquipeno($value);
                break;
            case 2:
                $this->setJoueurno($value);
                break;
            case 3:
                $this->setPosabbr($value);
                break;
            case 4:
                $this->setBut($value);
                break;
            case 5:
                $this->setPasse($value);
                break;
            case 6:
                $this->setBlanchissage($value);
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
        $keys = AlignementTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setEquipeno($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setJoueurno($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPosabbr($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setBut($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPasse($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setBlanchissage($arr[$keys[6]]);
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
     * @return $this|\Alignement The current object, for fluid interface
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
        $criteria = new Criteria(AlignementTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AlignementTableMap::COL_ID)) {
            $criteria->add(AlignementTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_EQUIPENO)) {
            $criteria->add(AlignementTableMap::COL_EQUIPENO, $this->equipeno);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_JOUEURNO)) {
            $criteria->add(AlignementTableMap::COL_JOUEURNO, $this->joueurno);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_POSABBR)) {
            $criteria->add(AlignementTableMap::COL_POSABBR, $this->posabbr);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_BUT)) {
            $criteria->add(AlignementTableMap::COL_BUT, $this->but);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_PASSE)) {
            $criteria->add(AlignementTableMap::COL_PASSE, $this->passe);
        }
        if ($this->isColumnModified(AlignementTableMap::COL_BLANCHISSAGE)) {
            $criteria->add(AlignementTableMap::COL_BLANCHISSAGE, $this->blanchissage);
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
        $criteria = ChildAlignementQuery::create();
        $criteria->add(AlignementTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Alignement (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEquipeno($this->getEquipeno());
        $copyObj->setJoueurno($this->getJoueurno());
        $copyObj->setPosabbr($this->getPosabbr());
        $copyObj->setBut($this->getBut());
        $copyObj->setPasse($this->getPasse());
        $copyObj->setBlanchissage($this->getBlanchissage());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPartiesRelatedByEquipelocale() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartieRelatedByEquipelocale($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPartiesRelatedByEquipevisite() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPartieRelatedByEquipevisite($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \Alignement Clone of current object.
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
     * Declares an association between this object and a ChildEquipe object.
     *
     * @param  ChildEquipe $v
     * @return $this|\Alignement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEquipe(ChildEquipe $v = null)
    {
        if ($v === null) {
            $this->setEquipeno(NULL);
        } else {
            $this->setEquipeno($v->getId());
        }

        $this->aEquipe = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildEquipe object, it will not be re-added.
        if ($v !== null) {
            $v->addAlignement($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildEquipe object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildEquipe The associated ChildEquipe object.
     * @throws PropelException
     */
    public function getEquipe(ConnectionInterface $con = null)
    {
        if ($this->aEquipe === null && ($this->equipeno != 0)) {
            $this->aEquipe = ChildEquipeQuery::create()->findPk($this->equipeno, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEquipe->addAlignements($this);
             */
        }

        return $this->aEquipe;
    }

    /**
     * Declares an association between this object and a ChildJoueur object.
     *
     * @param  ChildJoueur $v
     * @return $this|\Alignement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setJoueur(ChildJoueur $v = null)
    {
        if ($v === null) {
            $this->setJoueurno(NULL);
        } else {
            $this->setJoueurno($v->getId());
        }

        $this->aJoueur = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildJoueur object, it will not be re-added.
        if ($v !== null) {
            $v->addAlignement($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildJoueur object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildJoueur The associated ChildJoueur object.
     * @throws PropelException
     */
    public function getJoueur(ConnectionInterface $con = null)
    {
        if ($this->aJoueur === null && ($this->joueurno != 0)) {
            $this->aJoueur = ChildJoueurQuery::create()->findPk($this->joueurno, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aJoueur->addAlignements($this);
             */
        }

        return $this->aJoueur;
    }

    /**
     * Declares an association between this object and a ChildPosition object.
     *
     * @param  ChildPosition $v
     * @return $this|\Alignement The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPosition(ChildPosition $v = null)
    {
        if ($v === null) {
            $this->setPosabbr(NULL);
        } else {
            $this->setPosabbr($v->getAbbr());
        }

        $this->aPosition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPosition object, it will not be re-added.
        if ($v !== null) {
            $v->addAlignement($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPosition object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPosition The associated ChildPosition object.
     * @throws PropelException
     */
    public function getPosition(ConnectionInterface $con = null)
    {
        if ($this->aPosition === null && (($this->posabbr !== "" && $this->posabbr !== null))) {
            $this->aPosition = ChildPositionQuery::create()->findPk($this->posabbr, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPosition->addAlignements($this);
             */
        }

        return $this->aPosition;
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
        if ('PartieRelatedByEquipelocale' == $relationName) {
            $this->initPartiesRelatedByEquipelocale();
            return;
        }
        if ('PartieRelatedByEquipevisite' == $relationName) {
            $this->initPartiesRelatedByEquipevisite();
            return;
        }
    }

    /**
     * Clears out the collPartiesRelatedByEquipelocale collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartiesRelatedByEquipelocale()
     */
    public function clearPartiesRelatedByEquipelocale()
    {
        $this->collPartiesRelatedByEquipelocale = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartiesRelatedByEquipelocale collection loaded partially.
     */
    public function resetPartialPartiesRelatedByEquipelocale($v = true)
    {
        $this->collPartiesRelatedByEquipelocalePartial = $v;
    }

    /**
     * Initializes the collPartiesRelatedByEquipelocale collection.
     *
     * By default this just sets the collPartiesRelatedByEquipelocale collection to an empty array (like clearcollPartiesRelatedByEquipelocale());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartiesRelatedByEquipelocale($overrideExisting = true)
    {
        if (null !== $this->collPartiesRelatedByEquipelocale && !$overrideExisting) {
            return;
        }

        $collectionClassName = PartieTableMap::getTableMap()->getCollectionClassName();

        $this->collPartiesRelatedByEquipelocale = new $collectionClassName;
        $this->collPartiesRelatedByEquipelocale->setModel('\Partie');
    }

    /**
     * Gets an array of ChildPartie objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAlignement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartie[] List of ChildPartie objects
     * @throws PropelException
     */
    public function getPartiesRelatedByEquipelocale(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartiesRelatedByEquipelocalePartial && !$this->isNew();
        if (null === $this->collPartiesRelatedByEquipelocale || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartiesRelatedByEquipelocale) {
                // return empty collection
                $this->initPartiesRelatedByEquipelocale();
            } else {
                $collPartiesRelatedByEquipelocale = ChildPartieQuery::create(null, $criteria)
                    ->filterByAlignementRelatedByEquipelocale($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartiesRelatedByEquipelocalePartial && count($collPartiesRelatedByEquipelocale)) {
                        $this->initPartiesRelatedByEquipelocale(false);

                        foreach ($collPartiesRelatedByEquipelocale as $obj) {
                            if (false == $this->collPartiesRelatedByEquipelocale->contains($obj)) {
                                $this->collPartiesRelatedByEquipelocale->append($obj);
                            }
                        }

                        $this->collPartiesRelatedByEquipelocalePartial = true;
                    }

                    return $collPartiesRelatedByEquipelocale;
                }

                if ($partial && $this->collPartiesRelatedByEquipelocale) {
                    foreach ($this->collPartiesRelatedByEquipelocale as $obj) {
                        if ($obj->isNew()) {
                            $collPartiesRelatedByEquipelocale[] = $obj;
                        }
                    }
                }

                $this->collPartiesRelatedByEquipelocale = $collPartiesRelatedByEquipelocale;
                $this->collPartiesRelatedByEquipelocalePartial = false;
            }
        }

        return $this->collPartiesRelatedByEquipelocale;
    }

    /**
     * Sets a collection of ChildPartie objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partiesRelatedByEquipelocale A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAlignement The current object (for fluent API support)
     */
    public function setPartiesRelatedByEquipelocale(Collection $partiesRelatedByEquipelocale, ConnectionInterface $con = null)
    {
        /** @var ChildPartie[] $partiesRelatedByEquipelocaleToDelete */
        $partiesRelatedByEquipelocaleToDelete = $this->getPartiesRelatedByEquipelocale(new Criteria(), $con)->diff($partiesRelatedByEquipelocale);


        $this->partiesRelatedByEquipelocaleScheduledForDeletion = $partiesRelatedByEquipelocaleToDelete;

        foreach ($partiesRelatedByEquipelocaleToDelete as $partieRelatedByEquipelocaleRemoved) {
            $partieRelatedByEquipelocaleRemoved->setAlignementRelatedByEquipelocale(null);
        }

        $this->collPartiesRelatedByEquipelocale = null;
        foreach ($partiesRelatedByEquipelocale as $partieRelatedByEquipelocale) {
            $this->addPartieRelatedByEquipelocale($partieRelatedByEquipelocale);
        }

        $this->collPartiesRelatedByEquipelocale = $partiesRelatedByEquipelocale;
        $this->collPartiesRelatedByEquipelocalePartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partie objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partie objects.
     * @throws PropelException
     */
    public function countPartiesRelatedByEquipelocale(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartiesRelatedByEquipelocalePartial && !$this->isNew();
        if (null === $this->collPartiesRelatedByEquipelocale || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartiesRelatedByEquipelocale) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartiesRelatedByEquipelocale());
            }

            $query = ChildPartieQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAlignementRelatedByEquipelocale($this)
                ->count($con);
        }

        return count($this->collPartiesRelatedByEquipelocale);
    }

    /**
     * Method called to associate a ChildPartie object to this object
     * through the ChildPartie foreign key attribute.
     *
     * @param  ChildPartie $l ChildPartie
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function addPartieRelatedByEquipelocale(ChildPartie $l)
    {
        if ($this->collPartiesRelatedByEquipelocale === null) {
            $this->initPartiesRelatedByEquipelocale();
            $this->collPartiesRelatedByEquipelocalePartial = true;
        }

        if (!$this->collPartiesRelatedByEquipelocale->contains($l)) {
            $this->doAddPartieRelatedByEquipelocale($l);

            if ($this->partiesRelatedByEquipelocaleScheduledForDeletion and $this->partiesRelatedByEquipelocaleScheduledForDeletion->contains($l)) {
                $this->partiesRelatedByEquipelocaleScheduledForDeletion->remove($this->partiesRelatedByEquipelocaleScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPartie $partieRelatedByEquipelocale The ChildPartie object to add.
     */
    protected function doAddPartieRelatedByEquipelocale(ChildPartie $partieRelatedByEquipelocale)
    {
        $this->collPartiesRelatedByEquipelocale[]= $partieRelatedByEquipelocale;
        $partieRelatedByEquipelocale->setAlignementRelatedByEquipelocale($this);
    }

    /**
     * @param  ChildPartie $partieRelatedByEquipelocale The ChildPartie object to remove.
     * @return $this|ChildAlignement The current object (for fluent API support)
     */
    public function removePartieRelatedByEquipelocale(ChildPartie $partieRelatedByEquipelocale)
    {
        if ($this->getPartiesRelatedByEquipelocale()->contains($partieRelatedByEquipelocale)) {
            $pos = $this->collPartiesRelatedByEquipelocale->search($partieRelatedByEquipelocale);
            $this->collPartiesRelatedByEquipelocale->remove($pos);
            if (null === $this->partiesRelatedByEquipelocaleScheduledForDeletion) {
                $this->partiesRelatedByEquipelocaleScheduledForDeletion = clone $this->collPartiesRelatedByEquipelocale;
                $this->partiesRelatedByEquipelocaleScheduledForDeletion->clear();
            }
            $this->partiesRelatedByEquipelocaleScheduledForDeletion[]= clone $partieRelatedByEquipelocale;
            $partieRelatedByEquipelocale->setAlignementRelatedByEquipelocale(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Alignement is new, it will return
     * an empty collection; or if this Alignement has previously
     * been saved, it will retrieve related PartiesRelatedByEquipelocale from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Alignement.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartie[] List of ChildPartie objects
     */
    public function getPartiesRelatedByEquipelocaleJoinArena(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartieQuery::create(null, $criteria);
        $query->joinWith('Arena', $joinBehavior);

        return $this->getPartiesRelatedByEquipelocale($query, $con);
    }

    /**
     * Clears out the collPartiesRelatedByEquipevisite collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPartiesRelatedByEquipevisite()
     */
    public function clearPartiesRelatedByEquipevisite()
    {
        $this->collPartiesRelatedByEquipevisite = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPartiesRelatedByEquipevisite collection loaded partially.
     */
    public function resetPartialPartiesRelatedByEquipevisite($v = true)
    {
        $this->collPartiesRelatedByEquipevisitePartial = $v;
    }

    /**
     * Initializes the collPartiesRelatedByEquipevisite collection.
     *
     * By default this just sets the collPartiesRelatedByEquipevisite collection to an empty array (like clearcollPartiesRelatedByEquipevisite());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPartiesRelatedByEquipevisite($overrideExisting = true)
    {
        if (null !== $this->collPartiesRelatedByEquipevisite && !$overrideExisting) {
            return;
        }

        $collectionClassName = PartieTableMap::getTableMap()->getCollectionClassName();

        $this->collPartiesRelatedByEquipevisite = new $collectionClassName;
        $this->collPartiesRelatedByEquipevisite->setModel('\Partie');
    }

    /**
     * Gets an array of ChildPartie objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAlignement is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPartie[] List of ChildPartie objects
     * @throws PropelException
     */
    public function getPartiesRelatedByEquipevisite(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPartiesRelatedByEquipevisitePartial && !$this->isNew();
        if (null === $this->collPartiesRelatedByEquipevisite || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPartiesRelatedByEquipevisite) {
                // return empty collection
                $this->initPartiesRelatedByEquipevisite();
            } else {
                $collPartiesRelatedByEquipevisite = ChildPartieQuery::create(null, $criteria)
                    ->filterByAlignementRelatedByEquipevisite($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPartiesRelatedByEquipevisitePartial && count($collPartiesRelatedByEquipevisite)) {
                        $this->initPartiesRelatedByEquipevisite(false);

                        foreach ($collPartiesRelatedByEquipevisite as $obj) {
                            if (false == $this->collPartiesRelatedByEquipevisite->contains($obj)) {
                                $this->collPartiesRelatedByEquipevisite->append($obj);
                            }
                        }

                        $this->collPartiesRelatedByEquipevisitePartial = true;
                    }

                    return $collPartiesRelatedByEquipevisite;
                }

                if ($partial && $this->collPartiesRelatedByEquipevisite) {
                    foreach ($this->collPartiesRelatedByEquipevisite as $obj) {
                        if ($obj->isNew()) {
                            $collPartiesRelatedByEquipevisite[] = $obj;
                        }
                    }
                }

                $this->collPartiesRelatedByEquipevisite = $collPartiesRelatedByEquipevisite;
                $this->collPartiesRelatedByEquipevisitePartial = false;
            }
        }

        return $this->collPartiesRelatedByEquipevisite;
    }

    /**
     * Sets a collection of ChildPartie objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $partiesRelatedByEquipevisite A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAlignement The current object (for fluent API support)
     */
    public function setPartiesRelatedByEquipevisite(Collection $partiesRelatedByEquipevisite, ConnectionInterface $con = null)
    {
        /** @var ChildPartie[] $partiesRelatedByEquipevisiteToDelete */
        $partiesRelatedByEquipevisiteToDelete = $this->getPartiesRelatedByEquipevisite(new Criteria(), $con)->diff($partiesRelatedByEquipevisite);


        $this->partiesRelatedByEquipevisiteScheduledForDeletion = $partiesRelatedByEquipevisiteToDelete;

        foreach ($partiesRelatedByEquipevisiteToDelete as $partieRelatedByEquipevisiteRemoved) {
            $partieRelatedByEquipevisiteRemoved->setAlignementRelatedByEquipevisite(null);
        }

        $this->collPartiesRelatedByEquipevisite = null;
        foreach ($partiesRelatedByEquipevisite as $partieRelatedByEquipevisite) {
            $this->addPartieRelatedByEquipevisite($partieRelatedByEquipevisite);
        }

        $this->collPartiesRelatedByEquipevisite = $partiesRelatedByEquipevisite;
        $this->collPartiesRelatedByEquipevisitePartial = false;

        return $this;
    }

    /**
     * Returns the number of related Partie objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Partie objects.
     * @throws PropelException
     */
    public function countPartiesRelatedByEquipevisite(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPartiesRelatedByEquipevisitePartial && !$this->isNew();
        if (null === $this->collPartiesRelatedByEquipevisite || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPartiesRelatedByEquipevisite) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPartiesRelatedByEquipevisite());
            }

            $query = ChildPartieQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAlignementRelatedByEquipevisite($this)
                ->count($con);
        }

        return count($this->collPartiesRelatedByEquipevisite);
    }

    /**
     * Method called to associate a ChildPartie object to this object
     * through the ChildPartie foreign key attribute.
     *
     * @param  ChildPartie $l ChildPartie
     * @return $this|\Alignement The current object (for fluent API support)
     */
    public function addPartieRelatedByEquipevisite(ChildPartie $l)
    {
        if ($this->collPartiesRelatedByEquipevisite === null) {
            $this->initPartiesRelatedByEquipevisite();
            $this->collPartiesRelatedByEquipevisitePartial = true;
        }

        if (!$this->collPartiesRelatedByEquipevisite->contains($l)) {
            $this->doAddPartieRelatedByEquipevisite($l);

            if ($this->partiesRelatedByEquipevisiteScheduledForDeletion and $this->partiesRelatedByEquipevisiteScheduledForDeletion->contains($l)) {
                $this->partiesRelatedByEquipevisiteScheduledForDeletion->remove($this->partiesRelatedByEquipevisiteScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPartie $partieRelatedByEquipevisite The ChildPartie object to add.
     */
    protected function doAddPartieRelatedByEquipevisite(ChildPartie $partieRelatedByEquipevisite)
    {
        $this->collPartiesRelatedByEquipevisite[]= $partieRelatedByEquipevisite;
        $partieRelatedByEquipevisite->setAlignementRelatedByEquipevisite($this);
    }

    /**
     * @param  ChildPartie $partieRelatedByEquipevisite The ChildPartie object to remove.
     * @return $this|ChildAlignement The current object (for fluent API support)
     */
    public function removePartieRelatedByEquipevisite(ChildPartie $partieRelatedByEquipevisite)
    {
        if ($this->getPartiesRelatedByEquipevisite()->contains($partieRelatedByEquipevisite)) {
            $pos = $this->collPartiesRelatedByEquipevisite->search($partieRelatedByEquipevisite);
            $this->collPartiesRelatedByEquipevisite->remove($pos);
            if (null === $this->partiesRelatedByEquipevisiteScheduledForDeletion) {
                $this->partiesRelatedByEquipevisiteScheduledForDeletion = clone $this->collPartiesRelatedByEquipevisite;
                $this->partiesRelatedByEquipevisiteScheduledForDeletion->clear();
            }
            $this->partiesRelatedByEquipevisiteScheduledForDeletion[]= clone $partieRelatedByEquipevisite;
            $partieRelatedByEquipevisite->setAlignementRelatedByEquipevisite(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Alignement is new, it will return
     * an empty collection; or if this Alignement has previously
     * been saved, it will retrieve related PartiesRelatedByEquipevisite from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Alignement.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPartie[] List of ChildPartie objects
     */
    public function getPartiesRelatedByEquipevisiteJoinArena(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPartieQuery::create(null, $criteria);
        $query->joinWith('Arena', $joinBehavior);

        return $this->getPartiesRelatedByEquipevisite($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aEquipe) {
            $this->aEquipe->removeAlignement($this);
        }
        if (null !== $this->aJoueur) {
            $this->aJoueur->removeAlignement($this);
        }
        if (null !== $this->aPosition) {
            $this->aPosition->removeAlignement($this);
        }
        $this->id = null;
        $this->equipeno = null;
        $this->joueurno = null;
        $this->posabbr = null;
        $this->but = null;
        $this->passe = null;
        $this->blanchissage = null;
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
            if ($this->collPartiesRelatedByEquipelocale) {
                foreach ($this->collPartiesRelatedByEquipelocale as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPartiesRelatedByEquipevisite) {
                foreach ($this->collPartiesRelatedByEquipevisite as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPartiesRelatedByEquipelocale = null;
        $this->collPartiesRelatedByEquipevisite = null;
        $this->aEquipe = null;
        $this->aJoueur = null;
        $this->aPosition = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AlignementTableMap::DEFAULT_STRING_FORMAT);
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
