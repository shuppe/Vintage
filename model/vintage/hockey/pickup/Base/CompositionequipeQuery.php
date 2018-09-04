<?php

namespace Base;

use \Compositionequipe as ChildCompositionequipe;
use \CompositionequipeQuery as ChildCompositionequipeQuery;
use \Exception;
use \PDO;
use Map\CompositionequipeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'CompositionEquipe' table.
 *
 *
 *
 * @method     ChildCompositionequipeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCompositionequipeQuery orderByIdequipe($order = Criteria::ASC) Order by the idEquipe column
 * @method     ChildCompositionequipeQuery orderByIdjoueur($order = Criteria::ASC) Order by the idJoueur column
 * @method     ChildCompositionequipeQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     ChildCompositionequipeQuery groupById() Group by the id column
 * @method     ChildCompositionequipeQuery groupByIdequipe() Group by the idEquipe column
 * @method     ChildCompositionequipeQuery groupByIdjoueur() Group by the idJoueur column
 * @method     ChildCompositionequipeQuery groupByPosition() Group by the position column
 *
 * @method     ChildCompositionequipeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCompositionequipeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCompositionequipeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCompositionequipeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCompositionequipeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCompositionequipeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCompositionequipe findOne(ConnectionInterface $con = null) Return the first ChildCompositionequipe matching the query
 * @method     ChildCompositionequipe findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCompositionequipe matching the query, or a new ChildCompositionequipe object populated from the query conditions when no match is found
 *
 * @method     ChildCompositionequipe findOneById(int $id) Return the first ChildCompositionequipe filtered by the id column
 * @method     ChildCompositionequipe findOneByIdequipe(int $idEquipe) Return the first ChildCompositionequipe filtered by the idEquipe column
 * @method     ChildCompositionequipe findOneByIdjoueur(int $idJoueur) Return the first ChildCompositionequipe filtered by the idJoueur column
 * @method     ChildCompositionequipe findOneByPosition(string $position) Return the first ChildCompositionequipe filtered by the position column *

 * @method     ChildCompositionequipe requirePk($key, ConnectionInterface $con = null) Return the ChildCompositionequipe by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompositionequipe requireOne(ConnectionInterface $con = null) Return the first ChildCompositionequipe matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompositionequipe requireOneById(int $id) Return the first ChildCompositionequipe filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompositionequipe requireOneByIdequipe(int $idEquipe) Return the first ChildCompositionequipe filtered by the idEquipe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompositionequipe requireOneByIdjoueur(int $idJoueur) Return the first ChildCompositionequipe filtered by the idJoueur column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompositionequipe requireOneByPosition(string $position) Return the first ChildCompositionequipe filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompositionequipe[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCompositionequipe objects based on current ModelCriteria
 * @method     ChildCompositionequipe[]|ObjectCollection findById(int $id) Return ChildCompositionequipe objects filtered by the id column
 * @method     ChildCompositionequipe[]|ObjectCollection findByIdequipe(int $idEquipe) Return ChildCompositionequipe objects filtered by the idEquipe column
 * @method     ChildCompositionequipe[]|ObjectCollection findByIdjoueur(int $idJoueur) Return ChildCompositionequipe objects filtered by the idJoueur column
 * @method     ChildCompositionequipe[]|ObjectCollection findByPosition(string $position) Return ChildCompositionequipe objects filtered by the position column
 * @method     ChildCompositionequipe[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CompositionequipeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CompositionequipeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Compositionequipe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCompositionequipeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCompositionequipeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCompositionequipeQuery) {
            return $criteria;
        }
        $query = new ChildCompositionequipeQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$id, $idEquipe, $idJoueur] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCompositionequipe|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CompositionequipeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CompositionequipeTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildCompositionequipe A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, idEquipe, idJoueur, position FROM CompositionEquipe WHERE id = :p0 AND idEquipe = :p1 AND idJoueur = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCompositionequipe $obj */
            $obj = new ChildCompositionequipe();
            $obj->hydrate($row);
            CompositionequipeTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildCompositionequipe|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CompositionequipeTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CompositionequipeTableMap::COL_IDEQUIPE, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(CompositionequipeTableMap::COL_IDJOUEUR, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CompositionequipeTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CompositionequipeTableMap::COL_IDEQUIPE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(CompositionequipeTableMap::COL_IDJOUEUR, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompositionequipeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the idEquipe column
     *
     * Example usage:
     * <code>
     * $query->filterByIdequipe(1234); // WHERE idEquipe = 1234
     * $query->filterByIdequipe(array(12, 34)); // WHERE idEquipe IN (12, 34)
     * $query->filterByIdequipe(array('min' => 12)); // WHERE idEquipe > 12
     * </code>
     *
     * @param     mixed $idequipe The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterByIdequipe($idequipe = null, $comparison = null)
    {
        if (is_array($idequipe)) {
            $useMinMax = false;
            if (isset($idequipe['min'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_IDEQUIPE, $idequipe['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idequipe['max'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_IDEQUIPE, $idequipe['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompositionequipeTableMap::COL_IDEQUIPE, $idequipe, $comparison);
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
     * @param     mixed $idjoueur The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterByIdjoueur($idjoueur = null, $comparison = null)
    {
        if (is_array($idjoueur)) {
            $useMinMax = false;
            if (isset($idjoueur['min'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_IDJOUEUR, $idjoueur['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idjoueur['max'])) {
                $this->addUsingAlias(CompositionequipeTableMap::COL_IDJOUEUR, $idjoueur['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompositionequipeTableMap::COL_IDJOUEUR, $idjoueur, $comparison);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition('fooValue');   // WHERE position = 'fooValue'
     * $query->filterByPosition('%fooValue%', Criteria::LIKE); // WHERE position LIKE '%fooValue%'
     * </code>
     *
     * @param     string $position The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function filterByPosition($position = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($position)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CompositionequipeTableMap::COL_POSITION, $position, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCompositionequipe $compositionequipe Object to remove from the list of results
     *
     * @return $this|ChildCompositionequipeQuery The current query, for fluid interface
     */
    public function prune($compositionequipe = null)
    {
        if ($compositionequipe) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CompositionequipeTableMap::COL_ID), $compositionequipe->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CompositionequipeTableMap::COL_IDEQUIPE), $compositionequipe->getIdequipe(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(CompositionequipeTableMap::COL_IDJOUEUR), $compositionequipe->getIdjoueur(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the CompositionEquipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CompositionequipeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CompositionequipeTableMap::clearInstancePool();
            CompositionequipeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CompositionequipeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CompositionequipeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CompositionequipeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CompositionequipeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CompositionequipeQuery
