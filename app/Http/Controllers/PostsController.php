<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
use App\Validators\PostValidator;
use App\Criteria\Post\PostCriteria;
use App\Entities\Category;
// use App\Criteria\Post\PostCriteria;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends BaseController
{
    /**
     * @var PostRepository
     */
    protected $repository;
    protected $base_route = 'posts';
    protected $view = 'posts';
    protected $panel = 'Post';
    /**
     * @var PostValidator
     */
    protected $validator;

    /**
     * PostsController constructor.
     *
     * @param PostRepository $repository
     * @param PostValidator $validator
     */
    public function __construct(PostRepository $repository, PostValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $filters = [
            'title' => $request->get('title'),
            'category' => $request->get('category')
        ];
        $categories = Category::select(['id', 'name'])->get();
        $this->repository->pushCriteria(new PostCriteria($filters));
        $posts = $this->repository->paginate(10, $columns = ['id', 'title', 'body', 'user_id']);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $posts,
            ]);
        }

        return view(parent::loadDefaultDataToView($this->view.'.index'), compact('posts', 'filters', 'categories'));
    }

    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view(parent::loadDefaultDataToView($this->view.'.create'), compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PostCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;
            $post = $this->repository->create($validatedData);
            $post->categories()->sync($validatedData['categories']);
            $response = [
                'message' => 'Post created.',
                'data'    => $post->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->find($id);
        // dd($post->user->userDetail->first_name);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $post,
            ]);
        }

        return view(parent::loadDefaultDataToView($this->view.'.show'), compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->repository->find($id);
        $categories = Category::select(['id', 'name'])->get();
        $category_post = $post->categories()->pluck('categories.id')->toArray();
        return view(parent::loadDefaultDataToView($this->view.'.edit'), compact(
            'post',
            'categories',
            'category_post'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;
            $post = $this->repository->update($validatedData, $id);
            $post->categories()->sync($validatedData['categories']);
            $response = [
                'message' => 'Post updated.',
                'data'    => $post->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->repository->find($id);
        $post->categories()->detach();
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Post deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Post deleted.');
    }
}
