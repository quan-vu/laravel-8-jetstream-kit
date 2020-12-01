<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class BaseRepository
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param  Application  $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (! $model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Configure the Cache Key All
     *
     * @return string
     */
    abstract public function cacheKeyAll();

    /**
     * Configure the Cache Key Id
     *
     * @return string
     */
    abstract public function cacheKeyId();

    /**
     * Paginate records for scaffold.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'], $orderBy='id', $sortBy='asc', $searchBy=NULL, $filterWhere=NULL, $relations=[])
    {
        $query = $this->allQuery();
        $where = [];
        $orWhere = [];

        if(!empty($searchBy['field']) && !empty($searchBy['value'])){
            $_searchFields = explode(',', $searchBy['field']);

            // Search by multiple columns: 
            // Ex: id,name
            if(count($_searchFields) > 1){                
                foreach($_searchFields as $index => $field){
                    if(!$index){
                        array_push($where, [$field, 'like', '%'.$searchBy['value'].'%']);
                    }else{
                        array_push($orWhere, [$field, 'like', '%'.$searchBy['value'].'%']);
                    }
                }
            }else{
                // Search by 1 column
                // Ex: name
                if(!empty($searchBy['exactly'])){
                    array_push($where, [$searchBy['field'], $searchBy['value']]);
                }else{
                    array_push($where, [$searchBy['field'], 'like', '%'.$searchBy['value'].'%']);
                }
            }
        }

        if(!empty($filterWhere)){
            foreach($filterWhere as $field => $value){
                array_push($where, [$field, $value]);
            }
        }
        
        if(!empty($relations)){
            foreach($relations as $relation){
                $query->with($relation);
            }
        }

        $query->where($where);

        if(!empty($orWhere)){
            $query->orWhere($orWhere);
        }

        return $query->orderBy($orderBy, $sortBy)->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param  array  $search
     * @param  int|null  $skip
     * @param  int|null  $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (! is_null($skip)) {
            $query->skip($skip);
        }

        if (! is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Retrieve all records with given filter criteria
     *
     * @param  array  $search
     * @param  int|null  $skip
     * @param  int|null  $limit
     * @param  array  $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery($search, $skip, $limit);

        $all = null;

        // return $cacheKeyAll;
        $cacheKeyAll = $this->cacheKeyAll();

        if(!empty($cacheKeyAll) && Cache::has($cacheKeyAll)){
            $all = Cache::get($cacheKeyAll);
        }else{
            $all = $query->get($columns);
            if($all){
                Cache::set($cacheKeyAll, $all);
            }
        }

        return $all;
    }

    /**
     * Create model record
     *
     * @param  array  $input
     *
     * @return Model
     */
    public function create($input)
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param  int  $id
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    public function findWhere(array $conditions = [])
    {
        return $this->model->where($conditions)->get();
    }

    /**
     * Update model record for given id
     *
     * @param  array  $input
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     */
    public function delete($id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }
}
