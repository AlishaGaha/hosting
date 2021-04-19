<?php

namespace App\Criteria\Post;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PostCriteria.
 *
 * @package namespace App\Criteria\Post;
 */
class PostCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    protected $filters;
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->when(isset($this->filters['title']), function($query) {
            $query->where('title', 'like', '%'.$this->filters['title'].'%');
        })
        ->when(isset($this->filters['category']), function($query) {
            $query->whereHas('categories', function($q) {
                $q->where('categories.id', $this->filters['category']);
            });
        });
        // collect($this->filters)->each(function (String $value, String $key) use (&$model){
        //     if(isset($value)) {
        //         call_user_func_array([$this, $key], [&$model]);
        //     }
        // });

        return $model;
    }

    // public function title(&$model){
    //     $model = $model->where('title', 'like', sprintf('%%%s%%',collect($this->filters)->get('title','')));
    // }

    // public function user(&$model){
    //     dd($model->user()->where('name','like','%user%')->get());
    //     $model = $model->where('user', function ($query) {
    //         return $query->where('name', 'user');
    //     });
    //     dd($model->get());
    // }

    // public function category(&$model){
    //     // $model->categories()->where('categories.id', sprintf('%\%s%', collect($this->filters)->get('category', '')));
    //     $model = $model->whereHas('categories', function($query) {
    //         $query->where('categories.id', sprintf('%s'), collect($this->filters)->get('category', ''));
    //     });
    // }


}
