<?php

namespace Base;

use \Partie as ChildPartie;
use \PartieQuery as ChildPartieQuery;
use \Exception;
use \PDO;
use Map\PartieTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Partie' table.
 *
 *
 *
 * @method     ChildPartieQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPartieQuery orderByDatepartie($order = Criteria::ASC) Order by the datePartie column
 * @method     ChildPartieQuery orderByHeure($order = Criteria::ASC) Order by the Heure column
 * @method     ChildPartieQuery orderByIdarena($order = Criteria::ASC) Order by the idArena column
 * @method     ChildPartieQuery orderByIdequipelocale($order = Criteria::ASC) Order by the idEquipeLocale column
 * @method     ChildPartieQuery orderByPtsequipelocale($order = Criteria::ASC) Order by the ptsEquipeLocale column
 * @method     ChildPartieQuery orderByIdequipevisite($order = Criteria::ASC) Order by the idEquipeVisite column
 * @method     ChildPartieQuery orderByPtsequipevisite($order = Criteria::ASC) Order by the ptsEquipeVisite column
 *
 * @method     ChildPartieQuery groupById() Group by the id column
 * @method     ChildPartieQuery groupByDatepartie() Group by the datePartie column
 * @method     ChildPartieQuery groupByHeure() Group by the Heure column
 * @method     ChildPartieQuery groupByIdarena() Group by the idArena column
 * @method     ChildPartieQuery groupByIdequipelocale() Group by the idEquipeLocale column
 * @method     ChildPartieQuery groupByPtsequipelocale() Group by the ptsEquipeLocale column
 * @method     ChildPartieQuery groupByIdequipevisite() Group by the idEquipeVisite column
 * @method     ChildPartieQuery groupByPtsequipevisite() Group by the ptsEquipeVisite column
 *
 * @method     ChildPartieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPartieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPartieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPartieQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPartieQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPartieQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPartieQuery leftJoinArena($relationAlias = null) Adds a LEFT JOIN clause to the query using the Arena relation
 * @method     ChildPartieQuery rightJoinArena($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Arena relation
 * @method     ChildPartieQuery innerJoinArena($relationAlias = null) Adds a INNER JOIN clause to the query using the Arena relation
 *
 * @method     ChildPartieQuery joinWithArena($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Arena relation
 *
 * @method     ChildPartieQuery leftJoinWithArena() Adds a LEFT JOIN clause and with to the query using the Arena relation
 * @method     ChildPartieQuery rightJoinWithArena() Adds a RIGHT JOIN clause and with to the query using the Arena relation
 * @method     ChildPartieQuery innerJoinWithArena() Adds a INNER JOIN clause and with to the query using the Arena relation
 *
 * @method     \ArenaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPartie findOne(ConnectionInterface $con = null) Return the first ChildPartie matching the query
 * @method     ChildPartie findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPartie matching the query, or a new ChildPartie object populated from the query conditions when no match is found
 *
 * @method     ChildPartie findOneById(int $id) Return the first ChildPartie filtered by the id column
 * @method     ChildPartie findOneByDatepartie(string $datePartie) Return the first ChildPartie filtered by the datePartie column
 * @method     ChildPartie findOneByHeure(string $Heure) Return the first ChildPartie filtered by the Heure column
 * @method     ChildPartie findOneByIdarena(int $idArena) Return the first ChildPartie filtered by the idArena column
 * @method     ChildPartie findOneByIdequipelocale(int $idEquipeLocale) Return the first ChildPartie filtered by the idEquipeLocale column
 * @method     ChildPartie findOneByPtsequipelocale(int $ptsEquipeLocale) Return the first ChildPartie filtered by the ptsEquipeLocale column
 * @method     ChildPartie findOneByIdequipevisite(int $idEquipeVisite) Return the first ChildPartie filtered by the idEquipeVisite column
 * @method     ChildPartie findOneByPtsequipevisite(int $ptsEquipeVisite) Return the first ChildPartie filtered by the ptsEquipeVisite column *

 * @method     ChildPartie requirePk($key, ConnectionInterface $con = null) Return the ChildPartie by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOne(ConnectionInterface $con = null) Return the first ChildPartie matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartie requireOneById(int $id) Return the first ChildPartie filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByDatepartie(string $datePartie) Return the first ChildPartie filtered by the datePartie column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByHeure(string $Heure) Return the first ChildPartie filtered by the Heure column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByIdarena(int $idArena) Return the first ChildPartie filtered by the idArena column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByIdequipelocale(int $idEquipeLocale) Return the first ChildPartie filtered by the idEquipeLocale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByPtsequipelocale(int $ptsEquipeLocale) Return the first ChildPartie filtered by the ptsEquipeLocale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByIdequipevisite(int $idEquipeVisite) Return the first ChildPartie filtered by the idEquipeVisite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPartie requireOneByPtsequipevisite(int $ptsEquipeVisite) Return the first ChildPartie filtered by the ptsEquipeVisite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPartie[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPartie objects based on current ModelCriteria
 * @method     ChildPartie[]|ObjectCollection findById(int $id) Return ChildPartie objects filtered by the id column
 * @method     ChildPartie[]|ObjectCollection findByDatepartie(string $datePartie) Return ChildPartie objects filtered by the datePartie column
 * @method     ChildPartie[]|ObjectCollection findByHeure(string $Heure) Return ChildPartie objects filtered by the Heure column
 * @method     ChildPartie[]|ObjectCollection findByIdarena(int $idArena) Return ChildPartie objects filtered by the idArena column
 * @method     ChildPartie[]|ObjectCollection findByIdequipelocale(int $idEquipeLocale) Return ChildPartie objects filtered by the idEquipeLocale column
 * @method     ChildPartie[]|ObjectCollection findByPtsequipelocale(int $ptsEquipeLocale) Return ChildPartie objects filtered by the ptsEquipeLocale column
 * @method     ChildPartie[]|ObjectCollection findByIdequipevisite(int $idEquipeVisite) Return ChildPartie objects filtered by the idEquipeVisite column
 * @method     ChildPartie[]|ObjectCollection findByPtsequipevisite(int $ptsEquipeVisite) Return ChildPartie objects filtered by the ptsEquipeVisite column
 * @method     ChildPartie[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PartieQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PartieQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Partie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPartieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPartieQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPartieQuery) {
            return $criteria;
        }
        $query = new ChildPartieQuery();
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
     * @return ChildPartie|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PartieTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PartieTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPartie A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, datePartie, Heure, idArena, idEquipeLocale, ptsEquipeLocale, idEquipeVisite, ptsEquipeVisite FROM Partie WHERE id = :p0';
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
            /** @var ChildPartie $obj */
            $obj = new ChildPartie();
            $obj->hydrate($row);
            PartieTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPartie|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PartieTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PartieTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the datePartie column
     *
     * Example usage:
     * <code>
     * $query->filterByDatepartie('2011-03-14'); // WHERE datePartie = '2011-03-14'
     * $query->filterByDatepartie('now'); // WHERE datePartie = '2011-03-14'
     * $query->filterByDatepartie(array('max' => 'yesterday')); // WHERE datePartie > '2011-03-13'
     * </code>
     *
     * @param     mixed $datepartie The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByDatepartie($datepartie = null, $comparison = null)
    {
        if (is_array($datepartie)) {
            $useMinMax = false;
            if (isset($datepartie['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_DATEPARTIE, $datepartie['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datepartie['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_DATEPARTIE, $datepartie['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_DATEPARTIE, $datepartie, $comparison);
    }

    /**
     * Filter the query on the Heure column
     *
     * Example usage:
     * <code>
     * $query->filterByHeure('2011-03-14'); // WHERE Heure = '2011-03-14'
     * $query->filterByHeure('now'); // WHERE Heure = '2011-03-14'
     * $query->filterByHeure(array('max' => 'yesterday')); // WHERE Heure > '2011-03-13'
     * </code>
     *
     * @param     mixed $heure The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByHeure($heure = null, $comparison = null)
    {
        if (is_array($heure)) {
            $useMinMax = false;
            if (isset($heure['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_HEURE, $heure['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($heure['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_HEURE, $heure['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_HEURE, $heure, $comparison);
    }

    /**
     * Filter the query on the idArena column
     *
     * Example usage:
     * <code>
     * $query->filterByIdarena(1234); // WHERE idArena = 1234
     * $query->filterByIdarena(array(12, 34)); // WHERE idArena IN (12, 34)
     * $query->filterByIdarena(array('min' => 12)); // WHERE idArena > 12
     * </code>
     *
     * @see       filterByArena()
     *
     * @param     mixed $idarena The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByIdarena($idarena = null, $comparison = null)
    {
        if (is_array($idarena)) {
            $useMinMax = false;
            if (isset($idarena['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDARENA, $idarena['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idarena['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDARENA, $idarena['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_IDARENA, $idarena, $comparison);
    }

    /**
     * Filter the query on the idEquipeLocale column
     *
     * Example usage:
     * <code>
     * $query->filterByIdequipelocale(1234); // WHERE idEquipeLocale = 1234
     * $query->filterByIdequipelocale(array(12, 34)); // WHERE idEquipeLocale IN (12, 34)
     * $query->filterByIdequipelocale(array('min' => 12)); // WHERE idEquipeLocale > 12
     * </code>
     *
     * @param     mixed $idequipelocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByIdequipelocale($idequipelocale = null, $comparison = null)
    {
        if (is_array($idequipelocale)) {
            $useMinMax = false;
            if (isset($idequipelocale['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDEQUIPELOCALE, $idequipelocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idequipelocale['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDEQUIPELOCALE, $idequipelocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_IDEQUIPELOCALE, $idequipelocale, $comparison);
    }

    /**
     * Filter the query on the ptsEquipeLocale column
     *
     * Example usage:
     * <code>
     * $query->filterByPtsequipelocale(1234); // WHERE ptsEquipeLocale = 1234
     * $query->filterByPtsequipelocale(array(12, 34)); // WHERE ptsEquipeLocale IN (12, 34)
     * $query->filterByPtsequipelocale(array('min' => 12)); // WHERE ptsEquipeLocale > 12
     * </code>
     *
     * @param     mixed $ptsequipelocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByPtsequipelocale($ptsequipelocale = null, $comparison = null)
    {
        if (is_array($ptsequipelocale)) {
            $useMinMax = false;
            if (isset($ptsequipelocale['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPELOCALE, $ptsequipelocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ptsequipelocale['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPELOCALE, $ptsequipelocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPELOCALE, $ptsequipelocale, $comparison);
    }

    /**
     * Filter the query on the idEquipeVisite column
     *
     * Example usage:
     * <code>
     * $query->filterByIdequipevisite(1234); // WHERE idEquipeVisite = 1234
     * $query->filterByIdequipevisite(array(12, 34)); // WHERE idEquipeVisite IN (12, 34)
     * $query->filterByIdequipevisite(array('min' => 12)); // WHERE idEquipeVisite > 12
     * </code>
     *
     * @param     mixed $idequipevisite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByIdequipevisite($idequipevisite = null, $comparison = null)
    {
        if (is_array($idequipevisite)) {
            $useMinMax = false;
            if (isset($idequipevisite['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDEQUIPEVISITE, $idequipevisite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idequipevisite['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_IDEQUIPEVISITE, $idequipevisite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_IDEQUIPEVISITE, $idequipevisite, $comparison);
    }

    /**
     * Filter the query on the ptsEquipeVisite column
     *
     * Example usage:
     * <code>
     * $query->filterByPtsequipevisite(1234); // WHERE ptsEquipeVisite = 1234
     * $query->filterByPtsequipevisite(array(12, 34)); // WHERE ptsEquipeVisite IN (12, 34)
     * $query->filterByPtsequipevisite(array('min' => 12)); // WHERE ptsEquipeVisite > 12
     * </code>
     *
     * @param     mixed $ptsequipevisite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function filterByPtsequipevisite($ptsequipevisite = null, $comparison = null)
    {
        if (is_array($ptsequipevisite)) {
            $useMinMax = false;
            if (isset($ptsequipevisite['min'])) {
                $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPEVISITE, $ptsequipevisite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ptsequipevisite['max'])) {
                $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPEVISITE, $ptsequipevisite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PartieTableMap::COL_PTSEQUIPEVISITE, $ptsequipevisite, $comparison);
    }

    /**
     * Filter the query by a related \Arena object
     *
     * @param \Arena|ObjectCollection $arena The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPartieQuery The current query, for fluid interface
     */
    public function filterByArena($arena, $comparison = null)
    {
        if ($arena instanceof \Arena) {
            return $this
                ->addUsingAlias(PartieTableMap::COL_IDARENA, $arena->getId(), $comparison);
        } elseif ($arena instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PartieTableMap::COL_IDARENA, $arena->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByArena() only accepts arguments of type \Arena or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Arena relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function joinArena($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Arena');

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
            $this->addJoinObject($join, 'Arena');
        }

        return $this;
    }

    /**
     * Use the Arena relation Arena object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArenaQuery A secondary query class using the current class as primary query
     */
    public function useArenaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinArena($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Arena', '\ArenaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPartie $partie Object to remove from the list of results
     *
     * @return $this|ChildPartieQuery The current query, for fluid interface
     */
    public function prune($partie = null)
    {
        if ($partie) {
            $this->addUsingAlias(PartieTableMap::COL_ID, $partie->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Partie table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PartieTableMap::clearInstancePool();
            PartieTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PartieTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PartieTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PartieTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PartieTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PartieQuery
