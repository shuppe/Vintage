<?php

namespace Map;

use \Partie;
use \PartieQuery;
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
 * This class defines the structure of the 'Partie' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PartieTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'vhl.Map.PartieTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Partie';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Partie';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'vhl.Partie';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'Partie.id';

    /**
     * the column name for the datePartie field
     */
    const COL_DATEPARTIE = 'Partie.datePartie';

    /**
     * the column name for the Heure field
     */
    const COL_HEURE = 'Partie.Heure';

    /**
     * the column name for the ArenaNo field
     */
    const COL_ARENANO = 'Partie.ArenaNo';

    /**
     * the column name for the EquipeLocale field
     */
    const COL_EQUIPELOCALE = 'Partie.EquipeLocale';

    /**
     * the column name for the ptsEquipeLocale field
     */
    const COL_PTSEQUIPELOCALE = 'Partie.ptsEquipeLocale';

    /**
     * the column name for the EquipeVisite field
     */
    const COL_EQUIPEVISITE = 'Partie.EquipeVisite';

    /**
     * the column name for the ptsEquipeVisite field
     */
    const COL_PTSEQUIPEVISITE = 'Partie.ptsEquipeVisite';

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
        self::TYPE_PHPNAME       => array('Id', 'Datepartie', 'Heure', 'Arenano', 'Equipelocale', 'Ptsequipelocale', 'Equipevisite', 'Ptsequipevisite', ),
        self::TYPE_CAMELNAME     => array('id', 'datepartie', 'heure', 'arenano', 'equipelocale', 'ptsequipelocale', 'equipevisite', 'ptsequipevisite', ),
        self::TYPE_COLNAME       => array(PartieTableMap::COL_ID, PartieTableMap::COL_DATEPARTIE, PartieTableMap::COL_HEURE, PartieTableMap::COL_ARENANO, PartieTableMap::COL_EQUIPELOCALE, PartieTableMap::COL_PTSEQUIPELOCALE, PartieTableMap::COL_EQUIPEVISITE, PartieTableMap::COL_PTSEQUIPEVISITE, ),
        self::TYPE_FIELDNAME     => array('id', 'datePartie', 'Heure', 'ArenaNo', 'EquipeLocale', 'ptsEquipeLocale', 'EquipeVisite', 'ptsEquipeVisite', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Datepartie' => 1, 'Heure' => 2, 'Arenano' => 3, 'Equipelocale' => 4, 'Ptsequipelocale' => 5, 'Equipevisite' => 6, 'Ptsequipevisite' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'datepartie' => 1, 'heure' => 2, 'arenano' => 3, 'equipelocale' => 4, 'ptsequipelocale' => 5, 'equipevisite' => 6, 'ptsequipevisite' => 7, ),
        self::TYPE_COLNAME       => array(PartieTableMap::COL_ID => 0, PartieTableMap::COL_DATEPARTIE => 1, PartieTableMap::COL_HEURE => 2, PartieTableMap::COL_ARENANO => 3, PartieTableMap::COL_EQUIPELOCALE => 4, PartieTableMap::COL_PTSEQUIPELOCALE => 5, PartieTableMap::COL_EQUIPEVISITE => 6, PartieTableMap::COL_PTSEQUIPEVISITE => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'datePartie' => 1, 'Heure' => 2, 'ArenaNo' => 3, 'EquipeLocale' => 4, 'ptsEquipeLocale' => 5, 'EquipeVisite' => 6, 'ptsEquipeVisite' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('Partie');
        $this->setPhpName('Partie');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Partie');
        $this->setPackage('vhl');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('datePartie', 'Datepartie', 'DATE', true, null, null);
        $this->addColumn('Heure', 'Heure', 'TIME', false, null, null);
        $this->addForeignKey('ArenaNo', 'Arenano', 'INTEGER', 'Arena', 'id', false, 10, null);
        $this->addForeignKey('EquipeLocale', 'Equipelocale', 'INTEGER', 'Alignement', 'Id', true, 10, null);
        $this->addColumn('ptsEquipeLocale', 'Ptsequipelocale', 'INTEGER', false, 3, null);
        $this->addForeignKey('EquipeVisite', 'Equipevisite', 'INTEGER', 'Alignement', 'Id', true, 10, null);
        $this->addColumn('ptsEquipeVisite', 'Ptsequipevisite', 'INTEGER', false, 3, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Arena', '\\Arena', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':ArenaNo',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('AlignementRelatedByEquipelocale', '\\Alignement', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EquipeLocale',
    1 => ':Id',
  ),
), null, null, null, false);
        $this->addRelation('AlignementRelatedByEquipevisite', '\\Alignement', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EquipeVisite',
    1 => ':Id',
  ),
), null, null, null, false);
    } // buildRelations()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
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
        return $withPrefix ? PartieTableMap::CLASS_DEFAULT : PartieTableMap::OM_CLASS;
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
     * @return array           (Partie object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PartieTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PartieTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PartieTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PartieTableMap::OM_CLASS;
            /** @var Partie $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PartieTableMap::addInstanceToPool($obj, $key);
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
            $key = PartieTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PartieTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Partie $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PartieTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PartieTableMap::COL_ID);
            $criteria->addSelectColumn(PartieTableMap::COL_DATEPARTIE);
            $criteria->addSelectColumn(PartieTableMap::COL_HEURE);
            $criteria->addSelectColumn(PartieTableMap::COL_ARENANO);
            $criteria->addSelectColumn(PartieTableMap::COL_EQUIPELOCALE);
            $criteria->addSelectColumn(PartieTableMap::COL_PTSEQUIPELOCALE);
            $criteria->addSelectColumn(PartieTableMap::COL_EQUIPEVISITE);
            $criteria->addSelectColumn(PartieTableMap::COL_PTSEQUIPEVISITE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.datePartie');
            $criteria->addSelectColumn($alias . '.Heure');
            $criteria->addSelectColumn($alias . '.ArenaNo');
            $criteria->addSelectColumn($alias . '.EquipeLocale');
            $criteria->addSelectColumn($alias . '.ptsEquipeLocale');
            $criteria->addSelectColumn($alias . '.EquipeVisite');
            $criteria->addSelectColumn($alias . '.ptsEquipeVisite');
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
        return Propel::getServiceContainer()->getDatabaseMap(PartieTableMap::DATABASE_NAME)->getTable(PartieTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PartieTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PartieTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PartieTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Partie or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Partie object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Partie) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PartieTableMap::DATABASE_NAME);
            $criteria->add(PartieTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PartieQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PartieTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PartieTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Partie table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PartieQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Partie or Criteria object.
     *
     * @param mixed               $criteria Criteria or Partie object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Partie object
        }

        if ($criteria->containsKey(PartieTableMap::COL_ID) && $criteria->keyContainsValue(PartieTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PartieTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PartieQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PartieTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PartieTableMap::buildTableMap();
