<?php

namespace Map;

use \Alignement;
use \AlignementQuery;
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
 * This class defines the structure of the 'Alignement' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AlignementTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'vintage.hockey.pickup.Map.AlignementTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Alignement';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Alignement';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'vintage.hockey.pickup.Alignement';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the Id field
     */
    const COL_ID = 'Alignement.Id';

    /**
     * the column name for the EquipeNo field
     */
    const COL_EQUIPENO = 'Alignement.EquipeNo';

    /**
     * the column name for the JoueurNo field
     */
    const COL_JOUEURNO = 'Alignement.JoueurNo';

    /**
     * the column name for the PosAbbr field
     */
    const COL_POSABBR = 'Alignement.PosAbbr';

    /**
     * the column name for the But field
     */
    const COL_BUT = 'Alignement.But';

    /**
     * the column name for the Passe field
     */
    const COL_PASSE = 'Alignement.Passe';

    /**
     * the column name for the Blanchissage field
     */
    const COL_BLANCHISSAGE = 'Alignement.Blanchissage';

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
        self::TYPE_PHPNAME       => array('Id', 'Equipeno', 'Joueurno', 'Posabbr', 'But', 'Passe', 'Blanchissage', ),
        self::TYPE_CAMELNAME     => array('id', 'equipeno', 'joueurno', 'posabbr', 'but', 'passe', 'blanchissage', ),
        self::TYPE_COLNAME       => array(AlignementTableMap::COL_ID, AlignementTableMap::COL_EQUIPENO, AlignementTableMap::COL_JOUEURNO, AlignementTableMap::COL_POSABBR, AlignementTableMap::COL_BUT, AlignementTableMap::COL_PASSE, AlignementTableMap::COL_BLANCHISSAGE, ),
        self::TYPE_FIELDNAME     => array('Id', 'EquipeNo', 'JoueurNo', 'PosAbbr', 'But', 'Passe', 'Blanchissage', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Equipeno' => 1, 'Joueurno' => 2, 'Posabbr' => 3, 'But' => 4, 'Passe' => 5, 'Blanchissage' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'equipeno' => 1, 'joueurno' => 2, 'posabbr' => 3, 'but' => 4, 'passe' => 5, 'blanchissage' => 6, ),
        self::TYPE_COLNAME       => array(AlignementTableMap::COL_ID => 0, AlignementTableMap::COL_EQUIPENO => 1, AlignementTableMap::COL_JOUEURNO => 2, AlignementTableMap::COL_POSABBR => 3, AlignementTableMap::COL_BUT => 4, AlignementTableMap::COL_PASSE => 5, AlignementTableMap::COL_BLANCHISSAGE => 6, ),
        self::TYPE_FIELDNAME     => array('Id' => 0, 'EquipeNo' => 1, 'JoueurNo' => 2, 'PosAbbr' => 3, 'But' => 4, 'Passe' => 5, 'Blanchissage' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('Alignement');
        $this->setPhpName('Alignement');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Alignement');
        $this->setPackage('vintage.hockey.pickup');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('Id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('EquipeNo', 'Equipeno', 'INTEGER', 'Equipe', 'id', true, 10, null);
        $this->addForeignKey('JoueurNo', 'Joueurno', 'INTEGER', 'Joueur', 'id', true, 10, null);
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
        $this->addRelation('Equipe', '\\Equipe', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':EquipeNo',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('Joueur', '\\Joueur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':JoueurNo',
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
        $this->addRelation('PartieRelatedByEquipelocale', '\\Partie', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':EquipeLocale',
    1 => ':Id',
  ),
), null, null, 'PartiesRelatedByEquipelocale', false);
        $this->addRelation('PartieRelatedByEquipevisite', '\\Partie', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':EquipeVisite',
    1 => ':Id',
  ),
), null, null, 'PartiesRelatedByEquipevisite', false);
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
        return $withPrefix ? AlignementTableMap::CLASS_DEFAULT : AlignementTableMap::OM_CLASS;
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
     * @return array           (Alignement object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AlignementTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AlignementTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AlignementTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AlignementTableMap::OM_CLASS;
            /** @var Alignement $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AlignementTableMap::addInstanceToPool($obj, $key);
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
            $key = AlignementTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AlignementTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Alignement $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AlignementTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AlignementTableMap::COL_ID);
            $criteria->addSelectColumn(AlignementTableMap::COL_EQUIPENO);
            $criteria->addSelectColumn(AlignementTableMap::COL_JOUEURNO);
            $criteria->addSelectColumn(AlignementTableMap::COL_POSABBR);
            $criteria->addSelectColumn(AlignementTableMap::COL_BUT);
            $criteria->addSelectColumn(AlignementTableMap::COL_PASSE);
            $criteria->addSelectColumn(AlignementTableMap::COL_BLANCHISSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.Id');
            $criteria->addSelectColumn($alias . '.EquipeNo');
            $criteria->addSelectColumn($alias . '.JoueurNo');
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
        return Propel::getServiceContainer()->getDatabaseMap(AlignementTableMap::DATABASE_NAME)->getTable(AlignementTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AlignementTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AlignementTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AlignementTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Alignement or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Alignement object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Alignement) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AlignementTableMap::DATABASE_NAME);
            $criteria->add(AlignementTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AlignementQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AlignementTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AlignementTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Alignement table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AlignementQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Alignement or Criteria object.
     *
     * @param mixed               $criteria Criteria or Alignement object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Alignement object
        }

        if ($criteria->containsKey(AlignementTableMap::COL_ID) && $criteria->keyContainsValue(AlignementTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AlignementTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AlignementQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AlignementTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AlignementTableMap::buildTableMap();