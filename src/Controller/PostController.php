<?php


namespace App\Controller;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\RedirectResponse;

class PostController
{
    public function index()
    {
        $posts = \App\Model\Post::all();

        return view('post/table', compact('posts'));
    }

    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();

        return view('post/form', compact('post', 'categories', 'tags'));
    }

    public function store()
    {
        $data = request()->all();

        $validator = validator()->make($data, [
            'title'    => ['required', 'min:5',],
            'slug'     => ['required'],
            'body'     => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags'     => ['required', 'exists:tags,id'],

        ]);
        $error = $validator->errors();
        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post = new Post();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->body = $data['body'];
//        $post->tag = $data['tag'];
        $post->category_id = $data['category_id'];
        $post->save();
        $post->tags()->attach($data['tags']);

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Post \"{$data['title']} \" successfully saved.",
        ];

        return new RedirectResponse('/post/list');
    }

    public function edit($id)
    {
        $post = \App\Model\Post::find($id);
        $categories = \App\Model\Category::all();
        $tags = Tag::all();

        return view('post/form', compact('post', 'categories', 'tags'));
    }

    public function update($id)
    {
        // $post = \App\Model\Post::find($id);

        $data = request()->all();
        $validator = validator()->make($data, [
            'title' => ['required', 'min:5',],
            'slug'  => ['required'],
//            'body'  => ['required'],
//            'tag'  => ['required'],
//            'categories'  => ['required'],
        ]);

        $error = $validator->errors();
        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $post = Post::find($id);
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->body = $data['body'];
        //    $post->tag = $data['tag'];
        $post->category_id = $data['category_id'];
        $post->save();

        return new RedirectResponse('/post/list');
    }

    public function destroy($id)
    {
        $post = \App\Model\Post::find($id);
        $post->delete();

        return new RedirectResponse('/post/list');
    }
}