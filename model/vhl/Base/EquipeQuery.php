<?php

namespace Base;

use \Equipe as ChildEquipe;
use \EquipeQuery as ChildEquipeQuery;
use \Exception;
use \PDO;
use Map\EquipeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Equipe' table.
 *
 *
 *
 * @method     ChildEquipeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildEquipeQuery orderByNom($order = Criteria::ASC) Order by the nom column
 *
 * @method     ChildEquipeQuery groupById() Group by the id column
 * @method     ChildEquipeQuery groupByNom() Group by the nom column
 *
 * @method     ChildEquipeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEquipeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEquipeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEquipeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEquipeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEquipeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEquipeQuery leftJoinAlignement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Alignement relation
 * @method     ChildEquipeQuery rightJoinAlignement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Alignement relation
 * @method     ChildEquipeQuery innerJoinAlignement($relationAlias = null) Adds a INNER JOIN clause to the query using the Alignement relation
 *
 * @method     ChildEquipeQuery joinWithAlignement($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Alignement relation
 *
 * @method     ChildEquipeQuery leftJoinWithAlignement() Adds a LEFT JOIN clause and with to the query using the Alignement relation
 * @method     ChildEquipeQuery rightJoinWithAlignement() Adds a RIGHT JOIN clause and with to the query using the Alignement relation
 * @method     ChildEquipeQuery innerJoinWithAlignement() Adds a INNER JOIN clause and with to the query using the Alignement relation
 *
 * @method     \AlignementQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEquipe findOne(ConnectionInterface $con = null) Return the first ChildEquipe matching the query
 * @method     ChildEquipe findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEquipe matching the query, or a new ChildEquipe object populated from the query conditions when no match is found
 *
 * @method     ChildEquipe findOneById(int $id) Return the first ChildEquipe filtered by the id column
 * @method     ChildEquipe findOneByNom(string $nom) Return the first ChildEquipe filtered by the nom column *

 * @method     ChildEquipe requirePk($key, ConnectionInterface $con = null) Return the ChildEquipe by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEquipe requireOne(ConnectionInterface $con = null) Return the first ChildEquipe matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEquipe requireOneById(int $id) Return the first ChildEquipe filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEquipe requireOneByNom(string $nom) Return the first ChildEquipe filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEquipe[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEquipe objects based on current ModelCriteria
 * @method     ChildEquipe[]|ObjectCollection findById(int $id) Return ChildEquipe objects filtered by the id column
 * @method     ChildEquipe[]|ObjectCollection findByNom(string $nom) Return ChildEquipe objects filtered by the nom column
 * @method     ChildEquipe[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EquipeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EquipeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Equipe', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEquipeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEquipeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEquipeQuery) {
            return $criteria;
        }
        $query = new ChildEquipeQuery();
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
     * @return ChildEquipe|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EquipeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EquipeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildEquipe A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nom FROM Equipe WHERE id = :p0';
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
            /** @var ChildEquipe $obj */
            $obj = new ChildEquipe();
            $obj->hydrate($row);
            EquipeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEquipe|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EquipeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EquipeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EquipeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EquipeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EquipeTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EquipeTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query by a related \Alignement object
     *
     * @param \Alignement|ObjectCollection $alignement the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildEquipeQuery The current query, for fluid interface
     */
    public function filterByAlignement($alignement, $comparison = null)
    {
        if ($alignement instanceof \Alignement) {
            return $this
                ->addUsingAlias(EquipeTableMap::COL_ID, $alignement->getEquipeid(), $comparison);
        } elseif ($alignement instanceof ObjectCollection) {
            return $this
                ->useAlignementQuery()
                ->filterByPrimaryKeys($alignement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAlignement() only accepts arguments of type \Alignement or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Alignement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function joinAlignement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Alignement');

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
            $this->addJoinObject($join, 'Alignement');
        }

        return $this;
    }

    /**
     * Use the Alignement relation Alignement object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AlignementQuery A secondary query class using the current class as primary query
     */
    public function useAlignementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAlignement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Alignement', '\AlignementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEquipe $equipe Object to remove from the list of results
     *
     * @return $this|ChildEquipeQuery The current query, for fluid interface
     */
    public function prune($equipe = null)
    {
        if ($equipe) {
            $this->addUsingAlias(EquipeTableMap::COL_ID, $equipe->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Equipe table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EquipeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EquipeTableMap::clearInstancePool();
            EquipeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EquipeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EquipeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EquipeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EquipeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EquipeQuery
