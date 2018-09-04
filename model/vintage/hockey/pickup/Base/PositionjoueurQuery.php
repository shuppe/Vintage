<?php

namespace Base;

use \Positionjoueur as ChildPositionjoueur;
use \PositionjoueurQuery as ChildPositionjoueurQuery;
use \Exception;
use \PDO;
use Map\PositionjoueurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'PositionJoueur' table.
 *
 *
 *
 * @method     ChildPositionjoueurQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPositionjoueurQuery orderByIdjoueur($order = Criteria::ASC) Order by the idJoueur column
 * @method     ChildPositionjoueurQuery orderByAbbrpos($order = Criteria::ASC) Order by the abbrPos column
 *
 * @method     ChildPositionjoueurQuery groupById() Group by the id column
 * @method     ChildPositionjoueurQuery groupByIdjoueur() Group by the idJoueur column
 * @method     ChildPositionjoueurQuery groupByAbbrpos() Group by the abbrPos column
 *
 * @method     ChildPositionjoueurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionjoueurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionjoueurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionjoueurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPositionjoueurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPositionjoueurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPositionjoueurQuery leftJoinJoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Joueur relation
 * @method     ChildPositionjoueurQuery rightJoinJoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Joueur relation
 * @method     ChildPositionjoueurQuery innerJoinJoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Joueur relation
 *
 * @method     ChildPositionjoueurQuery joinWithJoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Joueur relation
 *
 * @method     ChildPositionjoueurQuery leftJoinWithJoueur() Adds a LEFT JOIN clause and with to the query using the Joueur relation
 * @method     ChildPositionjoueurQuery rightJoinWithJoueur() Adds a RIGHT JOIN clause and with to the query using the Joueur relation
 * @method     ChildPositionjoueurQuery innerJoinWithJoueur() Adds a INNER JOIN clause and with to the query using the Joueur relation
 *
 * @method     ChildPositionjoueurQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildPositionjoueurQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildPositionjoueurQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildPositionjoueurQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildPositionjoueurQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildPositionjoueurQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildPositionjoueurQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     \JoueurQuery|\PositionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPositionjoueur findOne(ConnectionInterface $con = null) Return the first ChildPositionjoueur matching the query
 * @method     ChildPositionjoueur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPositionjoueur matching the query, or a new ChildPositionjoueur object populated from the query conditions when no match is found
 *
 * @method     ChildPositionjoueur findOneById(int $id) Return the first ChildPositionjoueur filtered by the id column
 * @method     ChildPositionjoueur findOneByIdjoueur(int $idJoueur) Return the first ChildPositionjoueur filtered by the idJoueur column
 * @method     ChildPositionjoueur findOneByAbbrpos(string $abbrPos) Return the first ChildPositionjoueur filtered by the abbrPos column *

 * @method     ChildPositionjoueur requirePk($key, ConnectionInterface $con = null) Return the ChildPositionjoueur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionjoueur requireOne(ConnectionInterface $con = null) Return the first ChildPositionjoueur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositionjoueur requireOneById(int $id) Return the first ChildPositionjoueur filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionjoueur requireOneByIdjoueur(int $idJoueur) Return the first ChildPositionjoueur filtered by the idJoueur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionjoueur requireOneByAbbrpos(string $abbrPos) Return the first ChildPositionjoueur filtered by the abbrPos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositionjoueur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPositionjoueur objects based on current ModelCriteria
 * @method     ChildPositionjoueur[]|ObjectCollection findById(int $id) Return ChildPositionjoueur objects filtered by the id column
 * @method     ChildPositionjoueur[]|ObjectCollection findByIdjoueur(int $idJoueur) Return ChildPositionjoueur objects filtered by the idJoueur column
 * @method     ChildPositionjoueur[]|ObjectCollection findByAbbrpos(string $abbrPos) Return ChildPositionjoueur objects filtered by the abbrPos column
 * @method     ChildPositionjoueur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PositionjoueurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PositionjoueurQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Positionjoueur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionjoueurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionjoueurQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPositionjoueurQuery) {
            return $criteria;
        }
        $query = new ChildPositionjoueurQuery();
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
     * @return ChildPositionjoueur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionjoueurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PositionjoueurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPositionjoueur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, idJoueur, abbrPos FROM PositionJoueur WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPositionjoueur $obj */
            $obj = new ChildPositionjoueur();
            $obj->hydrate($row);
            PositionjoueurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPositionjoueur|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the idJoueur column
     *
     * Example usage:
     * <code>
     * $query->filterByIdjoueur(1234); // WHERE idJoueur = 1234
     * $query->filterByIdjoueur(array(12, 34)); // WHERE idJoueur IN (12, 34)
     * $query->filterByIdjoueur(array('min' => 12)); // WHERE idJoueur > 12
     * </code>
     *
     * @see       filterByJoueur()
     *
     * @param     mixed $idjoueur The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByIdjoueur($idjoueur = null, $comparison = null)
    {
        if (is_array($idjoueur)) {
            $useMinMax = false;
            if (isset($idjoueur['min'])) {
                $this->addUsingAlias(PositionjoueurTableMap::COL_IDJOUEUR, $idjoueur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idjoueur['max'])) {
                $this->addUsingAlias(PositionjoueurTableMap::COL_IDJOUEUR, $idjoueur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionjoueurTableMap::COL_IDJOUEUR, $idjoueur, $comparison);
    }

    /**
     * Filter the query on the abbrPos column
     *
     * Example usage:
     * <code>
     * $query->filterByAbbrpos('fooValue');   // WHERE abbrPos = 'fooValue'
     * $query->filterByAbbrpos('%fooValue%', Criteria::LIKE); // WHERE abbrPos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $abbrpos The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByAbbrpos($abbrpos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbrpos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionjoueurTableMap::COL_ABBRPOS, $abbrpos, $comparison);
    }

    /**
     * Filter the query by a related \Joueur object
     *
     * @param \Joueur|ObjectCollection $joueur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByJoueur($joueur, $comparison = null)
    {
        if ($joueur instanceof \Joueur) {
            return $this
                ->addUsingAlias(PositionjoueurTableMap::COL_IDJOUEUR, $joueur->getId(), $comparison);
        } elseif ($joueur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionjoueurTableMap::COL_IDJOUEUR, $joueur->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByJoueur() only accepts arguments of type \Joueur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Joueur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function joinJoueur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Joueur');

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
            $this->addJoinObject($join, 'Joueur');
        }

        return $this;
    }

    /**
     * Use the Joueur relation Joueur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \JoueurQuery A secondary query class using the current class as primary query
     */
    public function useJoueurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJoueur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Joueur', '\JoueurQuery');
    }

    /**
     * Filter the query by a related \Position object
     *
     * @param \Position|ObjectCollection $position The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \Position) {
            return $this
                ->addUsingAlias(PositionjoueurTableMap::COL_ABBRPOS, $position->getAbbr(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionjoueurTableMap::COL_ABBRPOS, $position->toKeyValue('PrimaryKey', 'Abbr'), $comparison);
        } else {
            throw new PropelException('filterByPosition() only accepts arguments of type \Position or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Position relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function joinPosition($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Position');

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
            $this->addJoinObject($join, 'Position');
        }

        return $this;
    }

    /**
     * Use the Position relation Position object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PositionQuery A secondary query class using the current class as primary query
     */
    public function usePositionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPosition($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Position', '\PositionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPositionjoueur $positionjoueur Object to remove from the list of results
     *
     * @return $this|ChildPositionjoueurQuery The current query, for fluid interface
     */
    public function prune($positionjoueur = null)
    {
        if ($positionjoueur) {
            $this->addUsingAlias(PositionjoueurTableMap::COL_ID, $positionjoueur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the PositionJoueur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionjoueurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionjoueurTableMap::clearInstancePool();
            PositionjoueurTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionjoueurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionjoueurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionjoueurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionjoueurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PositionjoueurQuery
