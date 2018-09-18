<?php

namespace Map;

use \Formation;
use \FormationQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'Formation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FormationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'vhl.Map.FormationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Formation';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Formation';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'vhl.Formation';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the AlignementId field
     */
    const COL_ALIGNEMENTID = 'Formation.AlignementId';

    /**
     * the column name for the JoueurId field
     */
    const COL_JOUEURID = 'Formation.JoueurId';

    /**
     * the column name for the PosAbbr field
     */
    const COL_POSABBR = 'Formation.PosAbbr';

    /**
     * the column name for the But field
     */
    const COL_BUT = 'Formation.But';

    /**
     * the column name for the Passe field
     */
    const COL_PASSE = 'Formation.Passe';

    /**
     * the column name for the Blanchissage field
     */
    const COL_BLANCHISSAGE = 'Formation.Blanchissage';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Alignementid', 'Joueurid', 'Posabbr', 'But', 'Passe', 'Blanchissage', ),
        self::TYPE_CAMELNAME     => array('alignementid', 'joueurid', 'posabbr', 'but', 'passe', 'blanchissage', ),
        self::TYPE_COLNAME       => array(FormationTableMap::COL_ALIGNEMENTID, FormationTableMap::COL_JOUEURID, FormationTableMap::COL_POSABBR, FormationTableMap::COL_BUT, FormationTableMap::COL_PASSE, FormationTableMap::COL_BLANCHISSAGE, ),
        self::TYPE_FIELDNAME     => array('AlignementId', 'JoueurId', 'PosAbbr', 'But', 'Passe', 'Blanchissage', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Alignementid' => 0, 'Joueurid' => 1, 'Posabbr' => 2, 'But' => 3, 'Passe' => 4, 'Blanchissage' => 5, ),
        self::TYPE_CAMELNAME     => array('alignementid' => 0, 'joueurid' => 1, 'posabbr' => 2, 'but' => 3, 'passe' => 4, 'blanchissage' => 5, ),
        self::TYPE_COLNAME       => array(FormationTableMap::COL_ALIGNEMENTID => 0, FormationTableMap::COL_JOUEURID => 1, FormationTableMap::COL_POSABBR => 2, FormationTableMap::COL_BUT => 3, FormationTableMap::COL_PASSE => 4, FormationTableMap::COL_BLANCHISSAGE => 5, ),
        self::TYPE_FIELDNAME     => array('AlignementId' => 0, 'JoueurId' => 1, 'PosAbbr' => 2, 'But' => 3, 'Passe' => 4, 'Blanchissage' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Formation');
        $this->setPhpName('Formation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Formation');
        $this->setPackage('vhl');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('AlignementId', 'Alignementid', 'INTEGER' , 'Alignement', 'Id', true, 10, null);
        $this->addForeignPrimaryKey('JoueurId', 'Joueurid', 'INTEGER' , 'Joueur', 'id', true, 10, null);
        $this->addForeignKey('PosAbbr', 'Posabbr', 'VARCHAR', 'Position', 'abbr', true, 3, null);
        $this->addColumn('But', 'But', 'INTEGER', true, 2, null);
        $this->addColumn('Passe', 'Passe', 'INTEGER', true, null, null);
        $this->addColumn('Blanchissage', 'Blanchissage', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Alignement', '\\Alignement', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':AlignementId',
    1 => ':Id',
  ),
), null, null, null, false);
        $this->addRelation('Joueur', '\\Joueur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':JoueurId',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Position', '\\Position', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':PosAbbr',
    1 => ':abbr',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Formation $obj A \Formation object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getAlignementid() || is_scalar($obj->getAlignementid()) || is_callable([$obj->getAlignementid(), '__toString']) ? (string) $obj->getAlignementid() : $obj->getAlignementid()), (null === $obj->getJoueurid() || is_scalar($obj->getJoueurid()) || is_callable([$obj->getJoueurid(), '__toString']) ? (string) $obj->getJoueurid() : $obj->getJoueurid())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Formation object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Formation) {
                $key = serialize([(null === $value->getAlignementid() || is_scalar($value->getAlignementid()) || is_callable([$value->getAlignementid(), '__toString']) ? (string) $value->getAlignementid() : $value->getAlignementid()), (null === $value->getJoueurid() || is_scalar($value->getJoueurid()) || is_callable([$value->getJoueurid(), '__toString']) ? (string) $value->getJoueurid() : $value->getJoueurid())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Formation object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Alignementid', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Joueurid', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FormationTableMap::CLASS_DEFAULT : FormationTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Formation object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FormationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FormationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FormationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FormationTableMap::OM_CLASS;
            /** @var Formation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FormationTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FormationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FormationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Formation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FormationTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FormationTableMap::COL_ALIGNEMENTID);
            $criteria->addSelectColumn(FormationTableMap::COL_JOUEURID);
            $criteria->addSelectColumn(FormationTableMap::COL_POSABBR);
            $criteria->addSelectColumn(FormationTableMap::COL_BUT);
            $criteria->addSelectColumn(FormationTableMap::COL_PASSE);
            $criteria->addSelectColumn(FormationTableMap::COL_BLANCHISSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.AlignementId');
            $criteria->addSelectColumn($alias . '.JoueurId');
            $criteria->addSelectColumn($alias . '.PosAbbr');
            $criteria->addSelectColumn($alias . '.But');
            $criteria->addSelectColumn($alias . '.Passe');
            $criteria->addSelectColumn($alias . '.Blanchissage');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FormationTableMap::DATABASE_NAME)->getTable(FormationTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FormationTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FormationTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FormationTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Formation or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Formation object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Formation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FormationTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(FormationTableMap::COL_ALIGNEMENTID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(FormationTableMap::COL_JOUEURID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = FormationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FormationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FormationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Formation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FormationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Formation or Criteria object.
     *
     * @param mixed               $criteria Criteria or Formation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Formation object
        }


        // Set the correct dbName
        $query = FormationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FormationTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FormationTableMap::buildTableMap();
