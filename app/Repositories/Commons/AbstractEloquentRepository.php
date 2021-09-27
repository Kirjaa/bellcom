<?php


namespace App\Repositories\Commons;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEloquentRepository
{


    /**
     * Store model instance
     *
     * @var Model
     */
    protected Model $model;


    /**
     * Store builder instance
     *
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Set model
     *
     * @return Model
     */
    abstract protected function getModel(): Model;


    /**
     * Make new instance
     *
     * @return $this
     */
    public static function make(): self
    {
        return resolve(static::class);
    }


    /**
     * BaseRepository constructor.
     * Init new model and builder instances
     *
     */
    public function __construct()
    {
        // Base
        $this->model = $this->getModel();
        $this->builder = $this->getFreshBuilderInstance();

    }


    /**
     * Get fresh instance of class repository
     *
     * @return $this
     */
    public function fresh(): self
    {
        return resolve(get_class($this));
    }


    /**
     * Get model instance
     *
     * @return Model
     */
    public function getModelInstance(): Model
    {
        return $this->model;
    }


    /**
     * Get builder instance
     *
     * @return Builder
     */
    public function getBuilderInstance(): Builder
    {
        return $this->builder;
    }


    /**
     * Set builder instance
     *
     * @param Builder $builder
     * @return $this
     */
    public function setBuilderInstance(Builder $builder): self
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * Apply custom function to builder
     *
     * @param callable|null $function
     * @return $this
     */
    public function apply(callable $function = null): self
    {
        return $function
            ? $this->setBuilderInstance(call_user_func_array($function, [$this->getBuilderInstance()]))
            : $this;
    }

    /**
     * Set where query to builder.
     *
     * @param callable|string|array $column
     * @param mixed $operator
     * @param mixed $value
     * @param string $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and'): self
    {
        return $this->apply(fn(Builder $builder) => $builder->where($column, $operator, $value, $boolean));
    }


    /**
     * Get first record or null
     *
     * @param array $columns
     * @return mixed
     */
    public function firstOrNull(array $columns = ['*'])
    {
        // Get result
        $entity = $this->getBuilderInstance()->first($columns);

        // Reset build with fresh one
        $this->setBuilderInstance($this->getFreshBuilderInstance());

        // Process found entity
        return $entity;
    }


    /**
     * Get new builder from provided model
     * Try to get new model query from model instance
     *
     * @return Builder
     */
    protected function getFreshBuilderInstance(): Builder
    {
        return $this->getModelInstance()->newQuery();
    }


}
