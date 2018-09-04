<?php

namespace Base;

use \Arena as ChildArena;
use \ArenaQuery as ChildArenaQuery;
use \Exception;
use \PDO;
use Map\ArenaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Arena' table.
 *
 *
 *
 * @method     ChildArenaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildArenaQuery orderByNom($order = Criteria::ASC) Order by the Nom column
 * @method     ChildArenaQuery orderByAdresse($order = Criteria::ASC) Order by the adresse column
 * @method     ChildArenaQuery orderByVille($order = Criteria::ASC) Order by the Ville column
 * @method     ChildArenaQuery orderByProvince($order = Criteria::ASC) Order by the province column
 * @method     ChildArenaQuery orderByCodepostal($order = Criteria::ASC) Order by the codePostal column
 * @method     ChildArenaQuery orderByUrl($order = Criteria::ASC) Order by the url column
 *
 * @method     ChildArenaQuery groupById() Group by the id column
 * @method     ChildArenaQuery groupByNom() Group by the Nom column
 * @method     ChildArenaQuery groupByAdresse() Group by the adresse column
 * @method     ChildArenaQuery groupByVille() Group by the Ville column
 * @method     ChildArenaQuery groupByProvince() Group by the province column
 * @method     ChildArenaQuery groupByCodepostal() Group by the codePostal column
 * @method     ChildArenaQuery groupByUrl() Group by the url column
 *
 * @method     ChildArenaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArenaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArenaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArenaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArenaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArenaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArenaQuery leftJoinPartie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Partie relation
 * @method     ChildArenaQuery rightJoinPartie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Partie relation
 * @method     ChildArenaQuery innerJoinPartie($relationAlias = null) Adds a INNER JOIN clause to the query using the Partie relation
 *
 * @method     ChildArenaQuery joinWithPartie($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Partie relation
 *
 * @method     ChildArenaQuery leftJoinWithPartie() Adds a LEFT JOIN clause and with to the query using the Partie relation
 * @method     ChildArenaQuery rightJoinWithPartie() Adds a RIGHT JOIN clause and with to the query using the Partie relation
 * @method     ChildArenaQuery innerJoinWithPartie() Adds a INNER JOIN clause and with to the query using the Partie relation
 *
 * @method     \PartieQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArena findOne(ConnectionInterface $con = null) Return the first ChildArena matching the query
 * @method     ChildArena findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArena matching the query, or a new ChildArena object populated from the query conditions when no match is found
 *
 * @method     ChildArena findOneById(int $id) Return the first ChildArena filtered by the id column
 * @method     ChildArena findOneByNom(string $Nom) Return the first ChildArena filtered by the Nom column
 * @method     ChildArena findOneByAdresse(string $adresse) Return the first ChildArena filtered by the adresse column
 * @method     ChildArena findOneByVille(string $Ville) Return the first ChildArena filtered by the Ville column
 * @method     ChildArena findOneByProvince(string $province) Return the first ChildArena filtered by the province column
 * @method     ChildArena findOneByCodepostal(string $codePostal) Return the first ChildArena filtered by the codePostal column
 * @method     ChildArena findOneByUrl(string $url) Return the first ChildArena filtered by the url column *

 * @method     ChildArena requirePk($key, ConnectionInterface $con = null) Return the ChildArena by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOne(ConnectionInterface $con = null) Return the first ChildArena matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArena requireOneById(int $id) Return the first ChildArena filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByNom(string $Nom) Return the first ChildArena filtered by the Nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByAdresse(string $adresse) Return the first ChildArena filtered by the adresse column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByVille(string $Ville) Return the first ChildArena filtered by the Ville column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByProvince(string $province) Return the first ChildArena filtered by the province column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByCodepostal(string $codePostal) Return the first ChildArena filtered by the codePostal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArena requireOneByUrl(string $url) Return the first ChildArena filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArena[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArena objects based on current ModelCriteria
 * @method     ChildArena[]|ObjectCollection findById(int $id) Return ChildArena objects filtered by the id column
 * @method     ChildArena[]|ObjectCollection findByNom(string $Nom) Return ChildArena objects filtered by the Nom column
 * @method     ChildArena[]|ObjectCollection findByAdresse(string $adresse) Return ChildArena objects filtered by the adresse column
 * @method     ChildArena[]|ObjectCollection findByVille(string $Ville) Return ChildArena objects filtered by the Ville column
 * @method     ChildArena[]|ObjectCollection findByProvince(string $province) Return ChildArena objects filtered by the province column
 * @method     ChildArena[]|ObjectCollection findByCodepostal(string $codePostal) Return ChildArena objects filtered by the codePostal column
 * @method     ChildArena[]|ObjectCollection findByUrl(string $url) Return ChildArena objects filtered by the url column
 * @method     ChildArena[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArenaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ArenaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Arena', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArenaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArenaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArenaQuery) {
            return $criteria;
        }
        $query = new ChildArenaQuery();
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
     * @return ChildArena|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArenaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ArenaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildArena A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, Nom, adresse, Ville, province, codePostal, url FROM Arena WHERE id = :p0';
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
            /** @var ChildArena $obj */
            $obj = new ChildArena();
            $obj->hydrate($row);
            ArenaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildArena|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArenaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArenaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ArenaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ArenaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE Nom = 'fooValue'
     * $query->filterByNom('%fooValue%', Criteria::LIKE); // WHERE Nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the adresse column
     *
     * Example usage:
     * <code>
     * $query->filterByAdresse('fooValue');   // WHERE adresse = 'fooValue'
     * $query->filterByAdresse('%fooValue%', Criteria::LIKE); // WHERE adresse LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adresse The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByAdresse($adresse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adresse)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_ADRESSE, $adresse, $comparison);
    }

    /**
     * Filter the query on the Ville column
     *
     * Example usage:
     * <code>
     * $query->filterByVille('fooValue');   // WHERE Ville = 'fooValue'
     * $query->filterByVille('%fooValue%', Criteria::LIKE); // WHERE Ville LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ville The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByVille($ville = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ville)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_VILLE, $ville, $comparison);
    }

    /**
     * Filter the query on the province column
     *
     * Example usage:
     * <code>
     * $query->filterByProvince('fooValue');   // WHERE province = 'fooValue'
     * $query->filterByProvince('%fooValue%', Criteria::LIKE); // WHERE province LIKE '%fooValue%'
     * </code>
     *
     * @param     string $province The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByProvince($province = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($province)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_PROVINCE, $province, $comparison);
    }

    /**
     * Filter the query on the codePostal column
     *
     * Example usage:
     * <code>
     * $query->filterByCodepostal('fooValue');   // WHERE codePostal = 'fooValue'
     * $query->filterByCodepostal('%fooValue%', Criteria::LIKE); // WHERE codePostal LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codepostal The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByCodepostal($codepostal = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codepostal)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_CODEPOSTAL, $codepostal, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArenaTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query by a related \Partie object
     *
     * @param \Partie|ObjectCollection $partie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildArenaQuery The current query, for fluid interface
     */
    public function filterByPartie($partie, $comparison = null)
    {
        if ($partie instanceof \Partie) {
            return $this
                ->addUsingAlias(ArenaTableMap::COL_ID, $partie->getIdarena(), $comparison);
        } elseif ($partie instanceof ObjectCollection) {
            return $this
                ->usePartieQuery()
                ->filterByPrimaryKeys($partie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartie() only accepts arguments of type \Partie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Partie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function joinPartie($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Partie');

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
            $this->addJoinObject($join, 'Partie');
        }

        return $this;
    }

    /**
     * Use the Partie relation Partie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartieQuery A secondary query class using the current class as primary query
     */
    public function usePartieQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPartie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Partie', '\PartieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildArena $arena Object to remove from the list of results
     *
     * @return $this|ChildArenaQuery The current query, for fluid interface
     */
    public function prune($arena = null)
    {
        if ($arena) {
            $this->addUsingAlias(ArenaTableMap::COL_ID, $arena->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Arena table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArenaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArenaTableMap::clearInstancePool();
            ArenaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArenaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArenaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ArenaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ArenaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ArenaQuery
