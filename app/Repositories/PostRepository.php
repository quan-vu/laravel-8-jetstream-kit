<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\BaseRepository;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version May 19, 2020, 8:30 am UTC
*/

class PostRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }

    /**
     * Configure the Cache Key All
     *
     * @return string
     */
    public function cacheKeyAll()
    {
        return 'CACHE_KEY_ALL_POSTS';
    }

    /**
     * Configure the Cache Key Id
     *
     * @return string
     */
    public function cacheKeyId()
    {
        return 'CACHE_KEY_POST_ID_%s';
    }

}
