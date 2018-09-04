<?php

namespace Base;

use \Position as ChildPosition;
use \PositionQuery as ChildPositionQuery;
use \Exception;
use \PDO;
use Map\PositionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Position' table.
 *
 *
 *
 * @method     ChildPositionQuery orderByAbbr($order = Criteria::ASC) Order by the abbr column
 * @method     ChildPositionQuery orderByNom($order = Criteria::ASC) Order by the nom column
 *
 * @method     ChildPositionQuery groupByAbbr() Group by the abbr column
 * @method     ChildPositionQuery groupByNom() Group by the nom column
 *
 * @method     ChildPositionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPositionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPositionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPositionQuery leftJoinPositionjoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positionjoueur relation
 * @method     ChildPositionQuery rightJoinPositionjoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positionjoueur relation
 * @method     ChildPositionQuery innerJoinPositionjoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Positionjoueur relation
 *
 * @method     ChildPositionQuery joinWithPositionjoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positionjoueur relation
 *
 * @method     ChildPositionQuery leftJoinWithPositionjoueur() Adds a LEFT JOIN clause and with to the query using the Positionjoueur relation
 * @method     ChildPositionQuery rightJoinWithPositionjoueur() Adds a RIGHT JOIN clause and with to the query using the Positionjoueur relation
 * @method     ChildPositionQuery innerJoinWithPositionjoueur() Adds a INNER JOIN clause and with to the query using the Positionjoueur relation
 *
 * @method     \PositionjoueurQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPosition findOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query
 * @method     ChildPosition findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPosition matching the query, or a new ChildPosition object populated from the query conditions when no match is found
 *
 * @method     ChildPosition findOneByAbbr(string $abbr) Return the first ChildPosition filtered by the abbr column
 * @method     ChildPosition findOneByNom(string $nom) Return the first ChildPosition filtered by the nom column *

 * @method     ChildPosition requirePk($key, ConnectionInterface $con = null) Return the ChildPosition by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOne(ConnectionInterface $con = null) Return the first ChildPosition matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition requireOneByAbbr(string $abbr) Return the first ChildPosition filtered by the abbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPosition requireOneByNom(string $nom) Return the first ChildPosition filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPosition[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPosition objects based on current ModelCriteria
 * @method     ChildPosition[]|ObjectCollection findByAbbr(string $abbr) Return ChildPosition objects filtered by the abbr column
 * @method     ChildPosition[]|ObjectCollection findByNom(string $nom) Return ChildPosition objects filtered by the nom column
 * @method     ChildPosition[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PositionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PositionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Position', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPositionQuery) {
            return $criteria;
        }
        $query = new ChildPositionQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PositionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPosition A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT abbr, nom FROM Position WHERE abbr = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPosition $obj */
            $obj = new ChildPosition();
            $obj->hydrate($row);
            PositionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildPosition|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ABBR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionTableMap::COL_ABBR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the abbr column
     *
     * Example usage:
     * <code>
     * $query->filterByAbbr('fooValue');   // WHERE abbr = 'fooValue'
     * $query->filterByAbbr('%fooValue%', Criteria::LIKE); // WHERE abbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $abbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByAbbr($abbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_ABBR, $abbr, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%', Criteria::LIKE); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query by a related \Positionjoueur object
     *
     * @param \Positionjoueur|ObjectCollection $positionjoueur the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPositionQuery The current query, for fluid interface
     */
    public function filterByPositionjoueur($positionjoueur, $comparison = null)
    {
        if ($positionjoueur instanceof \Positionjoueur) {
            return $this
                ->addUsingAlias(PositionTableMap::COL_ABBR, $positionjoueur->getAbbrpos(), $comparison);
        } elseif ($positionjoueur instanceof ObjectCollection) {
            return $this
                ->usePositionjoueurQuery()
                ->filterByPrimaryKeys($positionjoueur->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPositionjoueur() only accepts arguments of type \Positionjoueur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Positionjoueur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function joinPositionjoueur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Positionjoueur');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Positionjoueur');
        }

        return $this;
    }

    /**
     * Use the Positionjoueur relation Positionjoueur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PositionjoueurQuery A secondary query class using the current class as primary query
     */
    public function usePositionjoueurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPositionjoueur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Positionjoueur', '\PositionjoueurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPosition $position Object to remove from the list of results
     *
     * @return $this|ChildPositionQuery The current query, for fluid interface
     */
    public function prune($position = null)
    {
        if ($position) {
            $this->addUsingAlias(PositionTableMap::COL_ABBR, $position->getAbbr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Position table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionTableMap::clearInstancePool();
            PositionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PositionQuery
