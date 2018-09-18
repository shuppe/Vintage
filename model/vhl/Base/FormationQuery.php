<?php

namespace Base;

use \Formation as ChildFormation;
use \FormationQuery as ChildFormationQuery;
use \Exception;
use \PDO;
use Map\FormationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Formation' table.
 *
 *
 *
 * @method     ChildFormationQuery orderByAlignementid($order = Criteria::ASC) Order by the AlignementId column
 * @method     ChildFormationQuery orderByJoueurid($order = Criteria::ASC) Order by the JoueurId column
 * @method     ChildFormationQuery orderByPosabbr($order = Criteria::ASC) Order by the PosAbbr column
 * @method     ChildFormationQuery orderByBut($order = Criteria::ASC) Order by the But column
 * @method     ChildFormationQuery orderByPasse($order = Criteria::ASC) Order by the Passe column
 * @method     ChildFormationQuery orderByBlanchissage($order = Criteria::ASC) Order by the Blanchissage column
 *
 * @method     ChildFormationQuery groupByAlignementid() Group by the AlignementId column
 * @method     ChildFormationQuery groupByJoueurid() Group by the JoueurId column
 * @method     ChildFormationQuery groupByPosabbr() Group by the PosAbbr column
 * @method     ChildFormationQuery groupByBut() Group by the But column
 * @method     ChildFormationQuery groupByPasse() Group by the Passe column
 * @method     ChildFormationQuery groupByBlanchissage() Group by the Blanchissage column
 *
 * @method     ChildFormationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFormationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFormationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFormationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFormationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFormationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFormationQuery leftJoinAlignement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Alignement relation
 * @method     ChildFormationQuery rightJoinAlignement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Alignement relation
 * @method     ChildFormationQuery innerJoinAlignement($relationAlias = null) Adds a INNER JOIN clause to the query using the Alignement relation
 *
 * @method     ChildFormationQuery joinWithAlignement($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Alignement relation
 *
 * @method     ChildFormationQuery leftJoinWithAlignement() Adds a LEFT JOIN clause and with to the query using the Alignement relation
 * @method     ChildFormationQuery rightJoinWithAlignement() Adds a RIGHT JOIN clause and with to the query using the Alignement relation
 * @method     ChildFormationQuery innerJoinWithAlignement() Adds a INNER JOIN clause and with to the query using the Alignement relation
 *
 * @method     ChildFormationQuery leftJoinJoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Joueur relation
 * @method     ChildFormationQuery rightJoinJoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Joueur relation
 * @method     ChildFormationQuery innerJoinJoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Joueur relation
 *
 * @method     ChildFormationQuery joinWithJoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Joueur relation
 *
 * @method     ChildFormationQuery leftJoinWithJoueur() Adds a LEFT JOIN clause and with to the query using the Joueur relation
 * @method     ChildFormationQuery rightJoinWithJoueur() Adds a RIGHT JOIN clause and with to the query using the Joueur relation
 * @method     ChildFormationQuery innerJoinWithJoueur() Adds a INNER JOIN clause and with to the query using the Joueur relation
 *
 * @method     ChildFormationQuery leftJoinPosition($relationAlias = null) Adds a LEFT JOIN clause to the query using the Position relation
 * @method     ChildFormationQuery rightJoinPosition($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Position relation
 * @method     ChildFormationQuery innerJoinPosition($relationAlias = null) Adds a INNER JOIN clause to the query using the Position relation
 *
 * @method     ChildFormationQuery joinWithPosition($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Position relation
 *
 * @method     ChildFormationQuery leftJoinWithPosition() Adds a LEFT JOIN clause and with to the query using the Position relation
 * @method     ChildFormationQuery rightJoinWithPosition() Adds a RIGHT JOIN clause and with to the query using the Position relation
 * @method     ChildFormationQuery innerJoinWithPosition() Adds a INNER JOIN clause and with to the query using the Position relation
 *
 * @method     \AlignementQuery|\JoueurQuery|\PositionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFormation findOne(ConnectionInterface $con = null) Return the first ChildFormation matching the query
 * @method     ChildFormation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFormation matching the query, or a new ChildFormation object populated from the query conditions when no match is found
 *
 * @method     ChildFormation findOneByAlignementid(int $AlignementId) Return the first ChildFormation filtered by the AlignementId column
 * @method     ChildFormation findOneByJoueurid(int $JoueurId) Return the first ChildFormation filtered by the JoueurId column
 * @method     ChildFormation findOneByPosabbr(string $PosAbbr) Return the first ChildFormation filtered by the PosAbbr column
 * @method     ChildFormation findOneByBut(int $But) Return the first ChildFormation filtered by the But column
 * @method     ChildFormation findOneByPasse(int $Passe) Return the first ChildFormation filtered by the Passe column
 * @method     ChildFormation findOneByBlanchissage(int $Blanchissage) Return the first ChildFormation filtered by the Blanchissage column *

 * @method     ChildFormation requirePk($key, ConnectionInterface $con = null) Return the ChildFormation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOne(ConnectionInterface $con = null) Return the first ChildFormation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormation requireOneByAlignementid(int $AlignementId) Return the first ChildFormation filtered by the AlignementId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOneByJoueurid(int $JoueurId) Return the first ChildFormation filtered by the JoueurId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOneByPosabbr(string $PosAbbr) Return the first ChildFormation filtered by the PosAbbr column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOneByBut(int $But) Return the first ChildFormation filtered by the But column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOneByPasse(int $Passe) Return the first ChildFormation filtered by the Passe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFormation requireOneByBlanchissage(int $Blanchissage) Return the first ChildFormation filtered by the Blanchissage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFormation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFormation objects based on current ModelCriteria
 * @method     ChildFormation[]|ObjectCollection findByAlignementid(int $AlignementId) Return ChildFormation objects filtered by the AlignementId column
 * @method     ChildFormation[]|ObjectCollection findByJoueurid(int $JoueurId) Return ChildFormation objects filtered by the JoueurId column
 * @method     ChildFormation[]|ObjectCollection findByPosabbr(string $PosAbbr) Return ChildFormation objects filtered by the PosAbbr column
 * @method     ChildFormation[]|ObjectCollection findByBut(int $But) Return ChildFormation objects filtered by the But column
 * @method     ChildFormation[]|ObjectCollection findByPasse(int $Passe) Return ChildFormation objects filtered by the Passe column
 * @method     ChildFormation[]|ObjectCollection findByBlanchissage(int $Blanchissage) Return ChildFormation objects filtered by the Blanchissage column
 * @method     ChildFormation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FormationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FormationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Formation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFormationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFormationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFormationQuery) {
            return $criteria;
        }
        $query = new ChildFormationQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$AlignementId, $JoueurId] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFormation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FormationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FormationTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildFormation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT AlignementId, JoueurId, PosAbbr, But, Passe, Blanchissage FROM Formation WHERE AlignementId = :p0 AND JoueurId = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFormation $obj */
            $obj = new ChildFormation();
            $obj->hydrate($row);
            FormationTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildFormation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(FormationTableMap::COL_JOUEURID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(FormationTableMap::COL_ALIGNEMENTID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(FormationTableMap::COL_JOUEURID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the AlignementId column
     *
     * Example usage:
     * <code>
     * $query->filterByAlignementid(1234); // WHERE AlignementId = 1234
     * $query->filterByAlignementid(array(12, 34)); // WHERE AlignementId IN (12, 34)
     * $query->filterByAlignementid(array('min' => 12)); // WHERE AlignementId > 12
     * </code>
     *
     * @see       filterByAlignement()
     *
     * @param     mixed $alignementid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByAlignementid($alignementid = null, $comparison = null)
    {
        if (is_array($alignementid)) {
            $useMinMax = false;
            if (isset($alignementid['min'])) {
                $this->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $alignementid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($alignementid['max'])) {
                $this->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $alignementid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $alignementid, $comparison);
    }

    /**
     * Filter the query on the JoueurId column
     *
     * Example usage:
     * <code>
     * $query->filterByJoueurid(1234); // WHERE JoueurId = 1234
     * $query->filterByJoueurid(array(12, 34)); // WHERE JoueurId IN (12, 34)
     * $query->filterByJoueurid(array('min' => 12)); // WHERE JoueurId > 12
     * </code>
     *
     * @see       filterByJoueur()
     *
     * @param     mixed $joueurid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByJoueurid($joueurid = null, $comparison = null)
    {
        if (is_array($joueurid)) {
            $useMinMax = false;
            if (isset($joueurid['min'])) {
                $this->addUsingAlias(FormationTableMap::COL_JOUEURID, $joueurid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($joueurid['max'])) {
                $this->addUsingAlias(FormationTableMap::COL_JOUEURID, $joueurid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_JOUEURID, $joueurid, $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByPosabbr($posabbr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($posabbr)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_POSABBR, $posabbr, $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByBut($but = null, $comparison = null)
    {
        if (is_array($but)) {
            $useMinMax = false;
            if (isset($but['min'])) {
                $this->addUsingAlias(FormationTableMap::COL_BUT, $but['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($but['max'])) {
                $this->addUsingAlias(FormationTableMap::COL_BUT, $but['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_BUT, $but, $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByPasse($passe = null, $comparison = null)
    {
        if (is_array($passe)) {
            $useMinMax = false;
            if (isset($passe['min'])) {
                $this->addUsingAlias(FormationTableMap::COL_PASSE, $passe['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($passe['max'])) {
                $this->addUsingAlias(FormationTableMap::COL_PASSE, $passe['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_PASSE, $passe, $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function filterByBlanchissage($blanchissage = null, $comparison = null)
    {
        if (is_array($blanchissage)) {
            $useMinMax = false;
            if (isset($blanchissage['min'])) {
                $this->addUsingAlias(FormationTableMap::COL_BLANCHISSAGE, $blanchissage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($blanchissage['max'])) {
                $this->addUsingAlias(FormationTableMap::COL_BLANCHISSAGE, $blanchissage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FormationTableMap::COL_BLANCHISSAGE, $blanchissage, $comparison);
    }

    /**
     * Filter the query by a related \Alignement object
     *
     * @param \Alignement|ObjectCollection $alignement The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormationQuery The current query, for fluid interface
     */
    public function filterByAlignement($alignement, $comparison = null)
    {
        if ($alignement instanceof \Alignement) {
            return $this
                ->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $alignement->getId(), $comparison);
        } elseif ($alignement instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormationTableMap::COL_ALIGNEMENTID, $alignement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
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
     * Filter the query by a related \Joueur object
     *
     * @param \Joueur|ObjectCollection $joueur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFormationQuery The current query, for fluid interface
     */
    public function filterByJoueur($joueur, $comparison = null)
    {
        if ($joueur instanceof \Joueur) {
            return $this
                ->addUsingAlias(FormationTableMap::COL_JOUEURID, $joueur->getId(), $comparison);
        } elseif ($joueur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormationTableMap::COL_JOUEURID, $joueur->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
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
     * @return ChildFormationQuery The current query, for fluid interface
     */
    public function filterByPosition($position, $comparison = null)
    {
        if ($position instanceof \Position) {
            return $this
                ->addUsingAlias(FormationTableMap::COL_POSABBR, $position->getAbbr(), $comparison);
        } elseif ($position instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FormationTableMap::COL_POSABBR, $position->toKeyValue('PrimaryKey', 'Abbr'), $comparison);
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
     * @return $this|ChildFormationQuery The current query, for fluid interface
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
     * @param   ChildFormation $formation Object to remove from the list of results
     *
     * @return $this|ChildFormationQuery The current query, for fluid interface
     */
    public function prune($formation = null)
    {
        if ($formation) {
            $this->addCond('pruneCond0', $this->getAliasedColName(FormationTableMap::COL_ALIGNEMENTID), $formation->getAlignementid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(FormationTableMap::COL_JOUEURID), $formation->getJoueurid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Formation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FormationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FormationTableMap::clearInstancePool();
            FormationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FormationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FormationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FormationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FormationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FormationQuery
