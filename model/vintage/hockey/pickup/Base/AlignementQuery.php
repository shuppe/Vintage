<?php

namespace Base;

use \Alignement as ChildAlignement;
use \AlignementQuery as ChildAlignementQuery;
use \Exception;
use \PDO;
use Map\AlignementTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Alignement' table.
 *
 *
 *
 * @method     ChildAlignementQuery orderById($order = Criteria::ASC) Order by the Id column
 * @method     ChildAlignementQuery orderByEquipeno($order = Criteria::ASC) Order by the EquipeNo column
 * @method     ChildAlignementQuery orderByJoueurno($order = Criteria::ASC) Order by the JoueurNo column
 * @method     ChildAlignementQuery orderByPosabbr($order = Criteria::ASC) Order by the PosAbbr column
 * @method     ChildAlignementQuery orderByBut($order = Criteria::ASC) Order by the But column
 * @method     ChildAlignementQuery orderByPasse($order = Criteria::ASC) Order by the Passe column
 * @method     ChildAlignementQuery orderByBlanchissage($order = Criteria::ASC) Order by the Blanchissage column
 *
 * @method     ChildAlignementQuery groupById() Group by the Id column
 * @method     ChildAlignementQuery groupByEquipeno() Group by the EquipeNo column
 * @method     ChildAlignementQuery groupByJoueurno() Group by the JoueurNo column
 * @method     ChildAlignementQuery groupByPosabbr() Group by the PosAbbr column
 * @method     ChildAlignementQuery groupByBut() Group by the But column
 * @method     ChildAlignementQuery groupByPasse() Group by the Passe column
 * @method     ChildAlignementQuery groupByBlanchissage() Group by the Blanchissage column
 *
 * @method     ChildAlignementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAlignementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAlignementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAlignementQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAlignementQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAlignementQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAlignementQuery leftJoinEquipe($relationAlias = null) Adds a LEFT JOIN clause to the query using the Equipe relation
 * @method     ChildAlignementQuery rightJoinEquipe($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Equipe relation
 * @method     ChildAlignementQuery innerJoinEquipe($relationAlias = null) Adds a INNER JOIN clause to the query using the Equipe relation
 *
 * @method     ChildAlignementQuery joinWithEquipe($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Equipe relation
 *
 * @method     ChildAlignementQuery leftJoinWithEquipe() Adds a LEFT JOIN clause and with to the query using the Equipe relation
 * @method     ChildAlignementQuery rightJoinWithEquipe() Adds a RIGHT JOIN clause and with to the query using the Equipe relation
 * @method     ChildAlignementQuery innerJoinWithEquipe() Adds a INNER JOIN clause and with to the query using the Equipe relation
 *
 * @method     ChildAlignementQuery leftJoinJoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Joueur relation
 * @method     ChildAlignementQuery rightJoinJoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Joueur relation
 * @method     ChildAlignementQuery innerJoinJoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Joueur relation
 *
 * @method     ChildAlignementQuery joinWithJoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Joueur relation
 *
 * @method     ChildAlignementQuery leftJoinWithJoueur() Adds a LEFT JOIN clause and with to the query using the Joueur relation
 * @method     ChildAlignementQuery rightJoinWithJoueur() Adds a RIGHT JOIN clause and with to the query using the Joueur relation
 * @method     ChildAlignementQuery innerJoinWithJoueur() Adds a INNER JOIN clause and with to the query using the Joueur relation
 *
 * @method     ChildAlignementQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildAlignementQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildAlignementQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildAlignementQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildAlignementQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildAlignementQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildAlignementQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     ChildAlignementQuery leftJoinPartieRelatedByEquipelocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartieRelatedByEquipelocale relation
 * @method     ChildAlignementQuery rightJoinPartieRelatedByEquipelocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartieRelatedByEquipelocale relation
 * @method     ChildAlignementQuery innerJoinPartieRelatedByEquipelocale($relationAlias = null) Adds a INNER JOIN clause to the query using the PartieRelatedByEquipelocale relation
 *
 * @method     ChildAlignementQuery joinWithPartieRelatedByEquipelocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartieRelatedByEquipelocale relation
 *
 * @method     ChildAlignementQuery leftJoinWithPartieRelatedByEquipelocale() Adds a LEFT JOIN clause and with to the query using the PartieRelatedByEquipelocale relation
 * @method     ChildAlignementQuery rightJoinWithPartieRelatedByEquipelocale() Adds a RIGHT JOIN clause and with to the query using the PartieRelatedByEquipelocale relation
 * @method     ChildAlignementQuery innerJoinWithPartieRelatedByEquipelocale() Adds a INNER JOIN clause and with to the query using the PartieRelatedByEquipelocale relation
 *
 * @method     ChildAlignementQuery leftJoinPartieRelatedByEquipevisite($relationAlias = null) Adds a LEFT JOIN clause to the query using the PartieRelatedByEquipevisite relation
 * @method     ChildAlignementQuery rightJoinPartieRelatedByEquipevisite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PartieRelatedByEquipevisite relation
 * @method     ChildAlignementQuery innerJoinPartieRelatedByEquipevisite($relationAlias = null) Adds a INNER JOIN clause to the query using the PartieRelatedByEquipevisite relation
 *
 * @method     ChildAlignementQuery joinWithPartieRelatedByEquipevisite($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PartieRelatedByEquipevisite relation
 *
 * @method     ChildAlignementQuery leftJoinWithPartieRelatedByEquipevisite() Adds a LEFT JOIN clause and with to the query using the PartieRelatedByEquipevisite relation
 * @method     ChildAlignementQuery rightJoinWithPartieRelatedByEquipevisite() Adds a RIGHT JOIN clause and with to the query using the PartieRelatedByEquipevisite relation
 * @method     ChildAlignementQuery innerJoinWithPartieRelatedByEquipevisite() Adds a INNER JOIN clause and with to the query using the PartieRelatedByEquipevisite relation
 *
 * @method     \EquipeQuery|\JoueurQuery|\PositionQuery|\PartieQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAlignement findOne(ConnectionInterface $con = null) Return the first ChildAlignement matching the query
 * @method     ChildAlignement findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAlignement matching the query, or a new ChildAlignement object populated from the query conditions when no match is found
 *
 * @method     ChildAlignement findOneById(int $Id) Return the first ChildAlignement filtered by the Id column
 * @method     ChildAlignement findOneByEquipeno(int $EquipeNo) Return the first ChildAlignement filtered by the EquipeNo column
 * @method     ChildAlignement findOneByJoueurno(int $JoueurNo) Return the first ChildAlignement filtered by the JoueurNo column
 * @method     ChildAlignement findOneByPosabbr(string $PosAbbr) Return the first ChildAlignement filtered by the PosAbbr column
 * @method     ChildAlignement findOneByBut(int $But) Return the first ChildAlignement filtered by the But column
 * @method     ChildAlignement findOneByPasse(int $Passe) Return the first ChildAlignement filtered by the Passe column
 * @method     ChildAlignement findOneByBlanchissage(int $Blanchissage) Return the first ChildAlignement filtered by the Blanchissage column *

 * @method     ChildAlignement requirePk($key, ConnectionInterface $con = null) Return the ChildAlignement by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOne(ConnectionInterface $con = null) Return the first ChildAlignement matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAlignement requireOneById(int $Id) Return the first ChildAlignement filtered by the Id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByEquipeno(int $EquipeNo) Return the first ChildAlignement filtered by the EquipeNo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByJoueurno(int $JoueurNo) Return the first ChildAlignement filtered by the JoueurNo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByPosabbr(string $PosAbbr) Return the first ChildAlignement filtered by the PosAbbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByBut(int $But) Return the first ChildAlignement filtered by the But column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByPasse(int $Passe) Return the first ChildAlignement filtered by the Passe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAlignement requireOneByBlanchissage(int $Blanchissage) Return the first ChildAlignement filtered by the Blanchissage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAlignement[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAlignement objects based on current ModelCriteria
 * @method     ChildAlignement[]|ObjectCollection findById(int $Id) Return ChildAlignement objects filtered by the Id column
 * @method     ChildAlignement[]|ObjectCollection findByEquipeno(int $EquipeNo) Return ChildAlignement objects filtered by the EquipeNo column
 * @method     ChildAlignement[]|ObjectCollection findByJoueurno(int $JoueurNo) Return ChildAlignement objects filtered by the JoueurNo column
 * @method     ChildAlignement[]|ObjectCollection findByPosabbr(string $PosAbbr) Return ChildAlignement objects filtered by the PosAbbr column
 * @method     ChildAlignement[]|ObjectCollection findByBut(int $But) Return ChildAlignement objects filtered by the But column
 * @method     ChildAlignement[]|ObjectCollection findByPasse(int $Passe) Return ChildAlignement objects filtered by the Passe column
 * @method     ChildAlignement[]|ObjectCollection findByBlanchissage(int $Blanchissage) Return ChildAlignement objects filtered by the Blanchissage column
 * @method     ChildAlignement[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AlignementQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AlignementQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Alignement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAlignementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAlignementQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAlignementQuery) {
            return $criteria;
        }
        $query = new ChildAlignementQuery();
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
     * @return ChildAlignement|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AlignementTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AlignementTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAlignement A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT Id, EquipeNo, JoueurNo, PosAbbr, But, Passe, Blanchissage FROM Alignement WHERE Id = :p0';
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
            /** @var ChildAlignement $obj */
            $obj = new ChildAlignement();
            $obj->hydrate($row);
            AlignementTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAlignement|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AlignementTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AlignementTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the Id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE Id = 1234
     * $query->filterById(array(12, 34)); // WHERE Id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE Id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the EquipeNo column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipeno(1234); // WHERE EquipeNo = 1234
     * $query->filterByEquipeno(array(12, 34)); // WHERE EquipeNo IN (12, 34)
     * $query->filterByEquipeno(array('min' => 12)); // WHERE EquipeNo > 12
     * </code>
     *
     * @see       filterByEquipe()
     *
     * @param     mixed $equipeno The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByEquipeno($equipeno = null, $comparison = null)
    {
        if (is_array($equipeno)) {
            $useMinMax = false;
            if (isset($equipeno['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_EQUIPENO, $equipeno['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($equipeno['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_EQUIPENO, $equipeno['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_EQUIPENO, $equipeno, $comparison);
    }

    /**
     * Filter the query on the JoueurNo column
     *
     * Example usage:
     * <code>
     * $query->filterByJoueurno(1234); // WHERE JoueurNo = 1234
     * $query->filterByJoueurno(array(12, 34)); // WHERE JoueurNo IN (12, 34)
     * $query->filterByJoueurno(array('min' => 12)); // WHERE JoueurNo > 12
     * </code>
     *
     * @see       filterByJoueur()
     *
     * @param     mixed $joueurno The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByJoueurno($joueurno = null, $comparison = null)
    {
        if (is_array($joueurno)) {
            $useMinMax = false;
            if (isset($joueurno['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_JOUEURNO, $joueurno['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($joueurno['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_JOUEURNO, $joueurno['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_JOUEURNO, $joueurno, $comparison);
    }

    /**
     * Filter the query on the PosAbbr column
     *
     * Example usage:
     * <code>
     * $query->filterByPosabbr('fooValue');   // WHERE PosAbbr = 'fooValue'
     * $query->filterByPosabbr('%fooValue%', Criteria::LIKE); // WHERE PosAbbr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $posabbr The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPosabbr($posabbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($posabbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_POSABBR, $posabbr, $comparison);
    }

    /**
     * Filter the query on the But column
     *
     * Example usage:
     * <code>
     * $query->filterByBut(1234); // WHERE But = 1234
     * $query->filterByBut(array(12, 34)); // WHERE But IN (12, 34)
     * $query->filterByBut(array('min' => 12)); // WHERE But > 12
     * </code>
     *
     * @param     mixed $but The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByBut($but = null, $comparison = null)
    {
        if (is_array($but)) {
            $useMinMax = false;
            if (isset($but['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_BUT, $but['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($but['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_BUT, $but['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_BUT, $but, $comparison);
    }

    /**
     * Filter the query on the Passe column
     *
     * Example usage:
     * <code>
     * $query->filterByPasse(1234); // WHERE Passe = 1234
     * $query->filterByPasse(array(12, 34)); // WHERE Passe IN (12, 34)
     * $query->filterByPasse(array('min' => 12)); // WHERE Passe > 12
     * </code>
     *
     * @param     mixed $passe The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPasse($passe = null, $comparison = null)
    {
        if (is_array($passe)) {
            $useMinMax = false;
            if (isset($passe['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_PASSE, $passe['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($passe['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_PASSE, $passe['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_PASSE, $passe, $comparison);
    }

    /**
     * Filter the query on the Blanchissage column
     *
     * Example usage:
     * <code>
     * $query->filterByBlanchissage(1234); // WHERE Blanchissage = 1234
     * $query->filterByBlanchissage(array(12, 34)); // WHERE Blanchissage IN (12, 34)
     * $query->filterByBlanchissage(array('min' => 12)); // WHERE Blanchissage > 12
     * </code>
     *
     * @param     mixed $blanchissage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByBlanchissage($blanchissage = null, $comparison = null)
    {
        if (is_array($blanchissage)) {
            $useMinMax = false;
            if (isset($blanchissage['min'])) {
                $this->addUsingAlias(AlignementTableMap::COL_BLANCHISSAGE, $blanchissage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($blanchissage['max'])) {
                $this->addUsingAlias(AlignementTableMap::COL_BLANCHISSAGE, $blanchissage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AlignementTableMap::COL_BLANCHISSAGE, $blanchissage, $comparison);
    }

    /**
     * Filter the query by a related \Equipe object
     *
     * @param \Equipe|ObjectCollection $equipe The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByEquipe($equipe, $comparison = null)
    {
        if ($equipe instanceof \Equipe) {
            return $this
                ->addUsingAlias(AlignementTableMap::COL_EQUIPENO, $equipe->getId(), $comparison);
        } elseif ($equipe instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlignementTableMap::COL_EQUIPENO, $equipe->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEquipe() only accepts arguments of type \Equipe or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Equipe relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function joinEquipe($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Equipe');

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
            $this->addJoinObject($join, 'Equipe');
        }

        return $this;
    }

    /**
     * Use the Equipe relation Equipe object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EquipeQuery A secondary query class using the current class as primary query
     */
    public function useEquipeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEquipe($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Equipe', '\EquipeQuery');
    }

    /**
     * Filter the query by a related \Joueur object
     *
     * @param \Joueur|ObjectCollection $joueur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByJoueur($joueur, $comparison = null)
    {
        if ($joueur instanceof \Joueur) {
            return $this
                ->addUsingAlias(AlignementTableMap::COL_JOUEURNO, $joueur->getId(), $comparison);
        } elseif ($joueur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlignementTableMap::COL_JOUEURNO, $joueur->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildAlignementQuery The current query, for fluid interface
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
     * @return ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \Position) {
            return $this
                ->addUsingAlias(AlignementTableMap::COL_POSABBR, $position->getAbbr(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AlignementTableMap::COL_POSABBR, $position->toKeyValue('PrimaryKey', 'Abbr'), $comparison);
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
     * @return $this|ChildAlignementQuery The current query, for fluid interface
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
     * Filter the query by a related \Partie object
     *
     * @param \Partie|ObjectCollection $partie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPartieRelatedByEquipelocale($partie, $comparison = null)
    {
        if ($partie instanceof \Partie) {
            return $this
                ->addUsingAlias(AlignementTableMap::COL_ID, $partie->getEquipelocale(), $comparison);
        } elseif ($partie instanceof ObjectCollection) {
            return $this
                ->usePartieRelatedByEquipelocaleQuery()
                ->filterByPrimaryKeys($partie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartieRelatedByEquipelocale() only accepts arguments of type \Partie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartieRelatedByEquipelocale relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function joinPartieRelatedByEquipelocale($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartieRelatedByEquipelocale');

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
            $this->addJoinObject($join, 'PartieRelatedByEquipelocale');
        }

        return $this;
    }

    /**
     * Use the PartieRelatedByEquipelocale relation Partie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartieQuery A secondary query class using the current class as primary query
     */
    public function usePartieRelatedByEquipelocaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartieRelatedByEquipelocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartieRelatedByEquipelocale', '\PartieQuery');
    }

    /**
     * Filter the query by a related \Partie object
     *
     * @param \Partie|ObjectCollection $partie the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAlignementQuery The current query, for fluid interface
     */
    public function filterByPartieRelatedByEquipevisite($partie, $comparison = null)
    {
        if ($partie instanceof \Partie) {
            return $this
                ->addUsingAlias(AlignementTableMap::COL_ID, $partie->getEquipevisite(), $comparison);
        } elseif ($partie instanceof ObjectCollection) {
            return $this
                ->usePartieRelatedByEquipevisiteQuery()
                ->filterByPrimaryKeys($partie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPartieRelatedByEquipevisite() only accepts arguments of type \Partie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PartieRelatedByEquipevisite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function joinPartieRelatedByEquipevisite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PartieRelatedByEquipevisite');

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
            $this->addJoinObject($join, 'PartieRelatedByEquipevisite');
        }

        return $this;
    }

    /**
     * Use the PartieRelatedByEquipevisite relation Partie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PartieQuery A secondary query class using the current class as primary query
     */
    public function usePartieRelatedByEquipevisiteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPartieRelatedByEquipevisite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PartieRelatedByEquipevisite', '\PartieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAlignement $alignement Object to remove from the list of results
     *
     * @return $this|ChildAlignementQuery The current query, for fluid interface
     */
    public function prune($alignement = null)
    {
        if ($alignement) {
            $this->addUsingAlias(AlignementTableMap::COL_ID, $alignement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Alignement table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AlignementTableMap::clearInstancePool();
            AlignementTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AlignementTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AlignementTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AlignementTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AlignementTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AlignementQuery
