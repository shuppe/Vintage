<?php

namespace Base;

use \PositionJoueur as ChildPositionJoueur;
use \PositionJoueurQuery as ChildPositionJoueurQuery;
use \Exception;
use \PDO;
use Map\PositionJoueurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Position_Joueur' table.
 *
 *
 *
 * @method     ChildPositionJoueurQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPositionJoueurQuery orderByIdjoueur($order = Criteria::ASC) Order by the idJoueur column
 * @method     ChildPositionJoueurQuery orderByAbbrpos($order = Criteria::ASC) Order by the abbrPos column
 *
 * @method     ChildPositionJoueurQuery groupById() Group by the id column
 * @method     ChildPositionJoueurQuery groupByIdjoueur() Group by the idJoueur column
 * @method     ChildPositionJoueurQuery groupByAbbrpos() Group by the abbrPos column
 *
 * @method     ChildPositionJoueurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPositionJoueurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPositionJoueurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPositionJoueurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPositionJoueurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPositionJoueurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPositionJoueurQuery leftJoinJoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Joueur relation
 * @method     ChildPositionJoueurQuery rightJoinJoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Joueur relation
 * @method     ChildPositionJoueurQuery innerJoinJoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Joueur relation
 *
 * @method     ChildPositionJoueurQuery joinWithJoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Joueur relation
 *
 * @method     ChildPositionJoueurQuery leftJoinWithJoueur() Adds a LEFT JOIN clause and with to the query using the Joueur relation
 * @method     ChildPositionJoueurQuery rightJoinWithJoueur() Adds a RIGHT JOIN clause and with to the query using the Joueur relation
 * @method     ChildPositionJoueurQuery innerJoinWithJoueur() Adds a INNER JOIN clause and with to the query using the Joueur relation
 *
 * @method     ChildPositionJoueurQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildPositionJoueurQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildPositionJoueurQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildPositionJoueurQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildPositionJoueurQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildPositionJoueurQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildPositionJoueurQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     \JoueurQuery|\PositionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPositionJoueur findOne(ConnectionInterface $con = null) Return the first ChildPositionJoueur matching the query
 * @method     ChildPositionJoueur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPositionJoueur matching the query, or a new ChildPositionJoueur object populated from the query conditions when no match is found
 *
 * @method     ChildPositionJoueur findOneById(int $id) Return the first ChildPositionJoueur filtered by the id column
 * @method     ChildPositionJoueur findOneByIdjoueur(int $idJoueur) Return the first ChildPositionJoueur filtered by the idJoueur column
 * @method     ChildPositionJoueur findOneByAbbrpos(string $abbrPos) Return the first ChildPositionJoueur filtered by the abbrPos column *

 * @method     ChildPositionJoueur requirePk($key, ConnectionInterface $con = null) Return the ChildPositionJoueur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionJoueur requireOne(ConnectionInterface $con = null) Return the first ChildPositionJoueur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositionJoueur requireOneById(int $id) Return the first ChildPositionJoueur filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionJoueur requireOneByIdjoueur(int $idJoueur) Return the first ChildPositionJoueur filtered by the idJoueur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPositionJoueur requireOneByAbbrpos(string $abbrPos) Return the first ChildPositionJoueur filtered by the abbrPos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPositionJoueur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPositionJoueur objects based on current ModelCriteria
 * @method     ChildPositionJoueur[]|ObjectCollection findById(int $id) Return ChildPositionJoueur objects filtered by the id column
 * @method     ChildPositionJoueur[]|ObjectCollection findByIdjoueur(int $idJoueur) Return ChildPositionJoueur objects filtered by the idJoueur column
 * @method     ChildPositionJoueur[]|ObjectCollection findByAbbrpos(string $abbrPos) Return ChildPositionJoueur objects filtered by the abbrPos column
 * @method     ChildPositionJoueur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PositionJoueurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PositionJoueurQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PositionJoueur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPositionJoueurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPositionJoueurQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPositionJoueurQuery) {
            return $criteria;
        }
        $query = new ChildPositionJoueurQuery();
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
     * @return ChildPositionJoueur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PositionJoueurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PositionJoueurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPositionJoueur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, idJoueur, abbrPos FROM Position_Joueur WHERE id = :p0';
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
            /** @var ChildPositionJoueur $obj */
            $obj = new ChildPositionJoueur();
            $obj->hydrate($row);
            PositionJoueurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPositionJoueur|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByIdjoueur($idjoueur = null, $comparison = null)
    {
        if (is_array($idjoueur)) {
            $useMinMax = false;
            if (isset($idjoueur['min'])) {
                $this->addUsingAlias(PositionJoueurTableMap::COL_IDJOUEUR, $idjoueur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idjoueur['max'])) {
                $this->addUsingAlias(PositionJoueurTableMap::COL_IDJOUEUR, $idjoueur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionJoueurTableMap::COL_IDJOUEUR, $idjoueur, $comparison);
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByAbbrpos($abbrpos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($abbrpos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PositionJoueurTableMap::COL_ABBRPOS, $abbrpos, $comparison);
    }

    /**
     * Filter the query by a related \Joueur object
     *
     * @param \Joueur|ObjectCollection $joueur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByJoueur($joueur, $comparison = null)
    {
        if ($joueur instanceof \Joueur) {
            return $this
                ->addUsingAlias(PositionJoueurTableMap::COL_IDJOUEUR, $joueur->getId(), $comparison);
        } elseif ($joueur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionJoueurTableMap::COL_IDJOUEUR, $joueur->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
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
     * @return ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \Position) {
            return $this
                ->addUsingAlias(PositionJoueurTableMap::COL_ABBRPOS, $position->getAbbr(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PositionJoueurTableMap::COL_ABBRPOS, $position->toKeyValue('PrimaryKey', 'Abbr'), $comparison);
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
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
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
     * @param   ChildPositionJoueur $positionJoueur Object to remove from the list of results
     *
     * @return $this|ChildPositionJoueurQuery The current query, for fluid interface
     */
    public function prune($positionJoueur = null)
    {
        if ($positionJoueur) {
            $this->addUsingAlias(PositionJoueurTableMap::COL_ID, $positionJoueur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Position_Joueur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PositionJoueurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PositionJoueurTableMap::clearInstancePool();
            PositionJoueurTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PositionJoueurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PositionJoueurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PositionJoueurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PositionJoueurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PositionJoueurQuery
