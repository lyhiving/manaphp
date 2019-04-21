<?php
namespace ManaPHP;

interface ModelInterface
{
    /**
     * Returns table name mapped in the model
     *
     * @param mixed $context
     *
     * @return string
     */
    public function getSource($context = null);

    /**
     * Gets internal database connection
     *
     * @param mixed $context
     *
     * @return string
     */
    public function getDb($context = null);

    /**
     * @return string|array
     */
    public function getPrimaryKey();

    /**
     * @return array
     */
    public function getForeignKeys();

    /**
     * @return array
     */
    public function getFields();

    /**
     * @param string $field
     *
     * @return bool
     */
    public function hasField($field);

    /**
     * @param string $field
     *
     * @return string
     */
    public function getDateFormat($field);

    /**
     * @return array|null
     */
    public function getSafeFields();

    /**
     * @return array
     */
    public function getJsonFields();

    /**
     * @return array|null
     */
    public function getIntFields();

    /**
     * @return string|null
     */
    public function getAutoIncrementField();

    /**
     * @param int $step
     *
     * @return int
     */
    public function getNextAutoIncrementId($step = 1);

    /**
     * @return array
     */
    public function rules();

    /**
     * @param string         $alias
     * @param \ManaPHP\Model $model
     *
     * @return \ManaPHP\QueryInterface
     */
    public static function query($alias = null, $model = null);

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param array $filters
     * @param array $options
     * @param array $fields
     *
     * @return  static[]
     */
    public static function all($filters = [], $options = null, $fields = null);

    /**
     * @param string|array $field
     * @param array        $filters
     *
     * @return array
     */
    public static function lists($field, $filters = null);

    /**
     * @param int|string $id
     * @param int|array  $fieldsOrTtl
     *
     * @return static
     */
    public static function get($id, $fieldsOrTtl = null);

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param int|string|array $filters
     * @param array            $fields
     *
     * @return static|null
     */
    public static function first($filters, $fields = null);

    /**
     * @param int|string|array $filters
     * @param array            $fields
     *
     * @return static
     */
    public static function firstOrFail($filters, $fields = null);

    /**
     * @param array $fields
     *
     * @return static|null
     */
    public static function firstOrNull($fields = null);

    /**
     * Allows to query the last record that match the specified conditions
     *
     * @param array $filters
     * @param array $fields
     *
     * @return static|null
     */
    public static function last($filters = null, $fields = null);

    /**
     * @param int|string|array $filters
     * @param string           $field
     * @param int              $ttl
     *
     * @return int|float|string|null
     */
    public static function value($filters, $field, $ttl = null);

    /**
     * @param int|string|array $filters
     * @param string           $field
     * @param int              $ttl
     *
     * @return int|float|string
     */
    public static function valueOrFail($filters, $field, $ttl = null);

    /**
     * @param string $field
     * @param array  $filters
     *
     * @return array
     */
    public static function values($field, $filters = null);

    /**
     * @param string|array $filters
     *
     * @return bool
     */
    public static function exists($filters);

    /**
     * @param array        $filters
     * @param array        $aggregation
     * @param string|array $options
     *
     * @return array
     */
    public static function aggregate($filters, $aggregation, $options = null);

    /**
     * Allows to count how many records match the specified conditions
     *
     * @param array  $filters
     * @param string $field
     *
     * @return int
     */
    public static function count($filters = null, $field = '*');

    /**
     * Allows to calculate a summary on a column that match the specified conditions
     *
     * @param string $field
     * @param array  $filters
     *
     * @return int|float|null
     */
    public static function sum($field, $filters = null);

    /**
     * Allows to get the max value of a column that match the specified conditions
     *
     * @param string $field
     * @param array  $filters
     *
     * @return int|float|null
     */
    public static function max($field, $filters = null);

    /**
     * Allows to get the min value of a column that match the specified conditions
     *
     * @param string $field
     * @param array  $filters
     *
     * @return int|float|null
     */
    public static function min($field, $filters = null);

    /**
     * Allows to calculate the average value on a column matching the specified conditions
     *
     * @param string $field
     * @param array  $filters
     *
     * @return float|null
     */
    public static function avg($field, $filters = null);

    /**
     * Assigns values to a model from an array
     *
     * @param array $data
     * @param array $whiteList
     *
     * @return static
     */
    public function assign($data, $whiteList = null);

    /**
     * @param string|array $fields
     *
     * @return void
     */
    public function validate($fields = null);

    /**
     * Inserts or updates a model instance. Returning true on success or false otherwise.
     *
     * @return static
     */
    public function save();

    /**
     * Inserts a model instance. If the instance already exists in the persistence it will throw an exception
     * Returning true on success or false otherwise.
     *
     * @return static
     */
    public function create();

    /**
     * @param array $data
     *
     * @return static|null
     */
    public static function createOrNull($data = null);

    /**
     * Updates a model instance. If the instance does n't exist in the persistence it will throw an exception
     * Returning true on success or false otherwise.
     *
     * @return static
     */
    public function update();

    /**
     * @param array $data
     *
     * @return static|null
     */
    public static function updateOrNull($data = null);

    /**
     * @param array $fieldValues
     * @param array $filters
     *
     * @return int
     */
    public static function updateAll($fieldValues, $filters);

    /**
     * @param int|string $primaryKey
     * @param array      $fieldValues
     *
     * @return int
     */
    public static function updateRecord($primaryKey, $fieldValues);

    /**
     * Deletes a model instance. Returning true on success or false otherwise.
     *
     * @return static
     */
    public function delete();

    /**
     * @return static|null
     */
    public static function deleteOrNull();

    /**
     * @param array $filters
     *
     * @return int
     */
    public static function deleteAll($filters);

    /**
     * @param array $record
     *
     * @return int
     */
    public static function insert($record);

    /**
     * Returns the instance as an array representation
     *
     * @return array
     */
    public function toArray();

    /**
     * Returns the internal snapshot data
     *
     * @return array
     */
    public function getSnapshotData();

    /**
     * @return static
     */
    public function disableSnapshot();

    /**
     * Returns a list of changed values
     *
     * @return array
     */
    public function getChangedFields();

    /**
     * Check if a specific attribute has changed
     * This only works if the model is keeping data snapshots
     *
     * @param string|array $fields
     *
     * @return bool
     */
    public function hasChanged($fields);

    /**
     * @param float $interval
     * @param array $fields
     *
     * @return static
     */
    public function refresh($interval, $fields = null);

    /**
     * @param string    $field
     * @param int|float $step
     *
     * @return static
     */
    public function increment($field, $step = 1);

    /**
     * @param string    $field
     * @param int|float $step
     *
     * @return static
     */
    public function decrement($field, $step = 1);
}