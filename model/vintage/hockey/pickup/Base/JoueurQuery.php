<?php

namespace Base;

use \Joueur as ChildJoueur;
use \JoueurQuery as ChildJoueurQuery;
use \Exception;
use \PDO;
use Map\JoueurTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Joueur' table.
 *
 *
 *
 * @method     ChildJoueurQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildJoueurQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method     ChildJoueurQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 * @method     ChildJoueurQuery orderByCourriel($order = Criteria::ASC) Order by the courriel column
 * @method     ChildJoueurQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method     ChildJoueurQuery orderByStatut($order = Criteria::ASC) Order by the statut column
 * @method     ChildJoueurQuery orderByCote($order = Criteria::ASC) Order by the Cote column
 * @method     ChildJoueurQuery orderByNumero($order = Criteria::ASC) Order by the numero column
 *
 * @method     ChildJoueurQuery groupById() Group by the id column
 * @method     ChildJoueurQuery groupByNom() Group by the nom column
 * @method     ChildJoueurQuery groupByPrenom() Group by the prenom column
 * @method     ChildJoueurQuery groupByCourriel() Group by the courriel column
 * @method     ChildJoueurQuery groupByTelephone() Group by the telephone column
 * @method     ChildJoueurQuery groupByStatut() Group by the statut column
 * @method     ChildJoueurQuery groupByCote() Group by the Cote column
 * @method     ChildJoueurQuery groupByNumero() Group by the numero column
 *
 * @method     ChildJoueurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJoueurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJoueurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJoueurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJoueurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJoueurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJoueurQuery leftJoinAlignement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Alignement relation
 * @method     ChildJoueurQuery rightJoinAlignement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Alignement relation
 * @method     ChildJoueurQuery innerJoinAlignement($relationAlias = null) Adds a INNER JOIN clause to the query using the Alignement relation
 *
 * @method     ChildJoueurQuery joinWithAlignement($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Alignement relation
 *
 * @method     ChildJoueurQuery leftJoinWithAlignement() Adds a LEFT JOIN clause and with to the query using the Alignement relation
 * @method     ChildJoueurQuery rightJoinWithAlignement() Adds a RIGHT JOIN clause and with to the query using the Alignement relation
 * @method     ChildJoueurQuery innerJoinWithAlignement() Adds a INNER JOIN clause and with to the query using the Alignement relation
 *
 * @method     ChildJoueurQuery leftJoinPositionjoueur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Positionjoueur relation
 * @method     ChildJoueurQuery rightJoinPositionjoueur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Positionjoueur relation
 * @method     ChildJoueurQuery innerJoinPositionjoueur($relationAlias = null) Adds a INNER JOIN clause to the query using the Positionjoueur relation
 *
 * @method     ChildJoueurQuery joinWithPositionjoueur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Positionjoueur relation
 *
 * @method     ChildJoueurQuery leftJoinWithPositionjoueur() Adds a LEFT JOIN clause and with to the query using the Positionjoueur relation
 * @method     ChildJoueurQuery rightJoinWithPositionjoueur() Adds a RIGHT JOIN clause and with to the query using the Positionjoueur relation
 * @method     ChildJoueurQuery innerJoinWithPositionjoueur() Adds a INNER JOIN clause and with to the query using the Positionjoueur relation
 *
 * @method     \AlignementQuery|\PositionjoueurQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJoueur findOne(ConnectionInterface $con = null) Return the first ChildJoueur matching the query
 * @method     ChildJoueur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJoueur matching the query, or a new ChildJoueur object populated from the query conditions when no match is found
 *
 * @method     ChildJoueur findOneById(int $id) Return the first ChildJoueur filtered by the id column
 * @method     ChildJoueur findOneByNom(string $nom) Return the first ChildJoueur filtered by the nom column
 * @method     ChildJoueur findOneByPrenom(string $prenom) Return the first ChildJoueur filtered by the prenom column
 * @method     ChildJoueur findOneByCourriel(string $courriel) Return the first ChildJoueur filtered by the courriel column
 * @method     ChildJoueur findOneByTelephone(string $telephone) Return the first ChildJoueur filtered by the telephone column
 * @method     ChildJoueur findOneByStatut(string $statut) Return the first ChildJoueur filtered by the statut column
 * @method     ChildJoueur findOneByCote(string $Cote) Return the first ChildJoueur filtered by the Cote column
 * @method     ChildJoueur findOneByNumero(int $numero) Return the first ChildJoueur filtered by the numero column *

 * @method     ChildJoueur requirePk($key, ConnectionInterface $con = null) Return the ChildJoueur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOne(ConnectionInterface $con = null) Return the first ChildJoueur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJoueur requireOneById(int $id) Return the first ChildJoueur filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByNom(string $nom) Return the first ChildJoueur filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByPrenom(string $prenom) Return the first ChildJoueur filtered by the prenom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByCourriel(string $courriel) Return the first ChildJoueur filtered by the courriel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByTelephone(string $telephone) Return the first ChildJoueur filtered by the telephone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByStatut(string $statut) Return the first ChildJoueur filtered by the statut column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByCote(string $Cote) Return the first ChildJoueur filtered by the Cote column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJoueur requireOneByNumero(int $numero) Return the first ChildJoueur filtered by the numero column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJoueur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJoueur objects based on current ModelCriteria
 * @method     ChildJoueur[]|ObjectCollection findById(int $id) Return ChildJoueur objects filtered by the id column
 * @method     ChildJoueur[]|ObjectCollection findByNom(string $nom) Return ChildJoueur objects filtered by the nom column
 * @method     ChildJoueur[]|ObjectCollection findByPrenom(string $prenom) Return ChildJoueur objects filtered by the prenom column
 * @method     ChildJoueur[]|ObjectCollection findByCourriel(string $courriel) Return ChildJoueur objects filtered by the courriel column
 * @method     ChildJoueur[]|ObjectCollection findByTelephone(string $telephone) Return ChildJoueur objects filtered by the telephone column
 * @method     ChildJoueur[]|ObjectCollection findByStatut(string $statut) Return ChildJoueur objects filtered by the statut column
 * @method     ChildJoueur[]|ObjectCollection findByCote(string $Cote) Return ChildJoueur objects filtered by the Cote column
 * @method     ChildJoueur[]|ObjectCollection findByNumero(int $numero) Return ChildJoueur objects filtered by the numero column
 * @method     ChildJoueur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JoueurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\JoueurQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Joueur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJoueurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJoueurQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJoueurQuery) {
            return $criteria;
        }
        $query = new ChildJoueurQuery();
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
     * @return ChildJoueur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JoueurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = JoueurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildJoueur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nom, prenom, courriel, telephone, statut, Cote, numero FROM Joueur WHERE id = :p0';
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
            /** @var ChildJoueur $obj */
            $obj = new ChildJoueur();
            $obj->hydrate($row);
            JoueurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJoueur|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JoueurTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JoueurTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JoueurTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JoueurTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByPrenom('fooValue');   // WHERE prenom = 'fooValue'
     * $query->filterByPrenom('%fooValue%', Criteria::LIKE); // WHERE prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prenom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByPrenom($prenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prenom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_PRENOM, $prenom, $comparison);
    }

    /**
     * Filter the query on the courriel column
     *
     * Example usage:
     * <code>
     * $query->filterByCourriel('fooValue');   // WHERE courriel = 'fooValue'
     * $query->filterByCourriel('%fooValue%', Criteria::LIKE); // WHERE courriel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $courriel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByCourriel($courriel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($courriel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_COURRIEL, $courriel, $comparison);
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%', Criteria::LIKE); // WHERE telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_TELEPHONE, $telephone, $comparison);
    }

    /**
     * Filter the query on the statut column
     *
     * Example usage:
     * <code>
     * $query->filterByStatut('fooValue');   // WHERE statut = 'fooValue'
     * $query->filterByStatut('%fooValue%', Criteria::LIKE); // WHERE statut LIKE '%fooValue%'
     * </code>
     *
     * @param     string $statut The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByStatut($statut = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($statut)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_STATUT, $statut, $comparison);
    }

    /**
     * Filter the query on the Cote column
     *
     * Example usage:
     * <code>
     * $query->filterByCote('fooValue');   // WHERE Cote = 'fooValue'
     * $query->filterByCote('%fooValue%', Criteria::LIKE); // WHERE Cote LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cote The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByCote($cote = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cote)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_COTE, $cote, $comparison);
    }

    /**
     * Filter the query on the numero column
     *
     * Example usage:
     * <code>
     * $query->filterByNumero(1234); // WHERE numero = 1234
     * $query->filterByNumero(array(12, 34)); // WHERE numero IN (12, 34)
     * $query->filterByNumero(array('min' => 12)); // WHERE numero > 12
     * </code>
     *
     * @param     mixed $numero The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByNumero($numero = null, $comparison = null)
    {
        if (is_array($numero)) {
            $useMinMax = false;
            if (isset($numero['min'])) {
                $this->addUsingAlias(JoueurTableMap::COL_NUMERO, $numero['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numero['max'])) {
                $this->addUsingAlias(JoueurTableMap::COL_NUMERO, $numero['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JoueurTableMap::COL_NUMERO, $numero, $comparison);
    }

    /**
     * Filter the query by a related \Alignement object
     *
     * @param \Alignement|ObjectCollection $alignement the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByAlignement($alignement, $comparison = null)
    {
        if ($alignement instanceof \Alignement) {
            return $this
                ->addUsingAlias(JoueurTableMap::COL_ID, $alignement->getJoueurno(), $comparison);
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
     * @return $this|ChildJoueurQuery The current query, for fluid interface
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
     * Filter the query by a related \Positionjoueur object
     *
     * @param \Positionjoueur|ObjectCollection $positionjoueur the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJoueurQuery The current query, for fluid interface
     */
    public function filterByPositionjoueur($positionjoueur, $comparison = null)
    {
        if ($positionjoueur instanceof \Positionjoueur) {
            return $this
                ->addUsingAlias(JoueurTableMap::COL_ID, $positionjoueur->getIdjoueur(), $comparison);
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
     * @return $this|ChildJoueurQuery The current query, for fluid interface
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
     * @param   ChildJoueur $joueur Object to remove from the list of results
     *
     * @return $this|ChildJoueurQuery The current query, for fluid interface
     */
    public function prune($joueur = null)
    {
        if ($joueur) {
            $this->addUsingAlias(JoueurTableMap::COL_ID, $joueur->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Joueur table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JoueurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JoueurTableMap::clearInstancePool();
            JoueurTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JoueurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JoueurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JoueurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JoueurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JoueurQuery
