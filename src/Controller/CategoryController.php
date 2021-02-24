<?php

namespace App\Controller;

use App\Model\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController
{
    public function index()
    {
        $categories = \App\Model\Category::paginate(3);
//        $categories = \App\Model\Category::withTrashed()->get();

        return view('category/table', compact('categories'));
    }

    public function create()
    {
       //dd($_SESSION);
        $category = new Category();

        return view('category/form', compact('category'));
    }

    public function store()
    {
        $data = request()->all();
        $validator = validator()->make($data, [
            'title' => ['required', 'min:5',],
            'slug'  => ['required'],
        ]);
        $error = $validator->errors();
            if(count($error)>0)
        {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }


        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();
        $_SESSION['message'] = [
            'status' =>'success',
            'text' => "Category \"{$data['title']} \" successfully saved.",
        ];

        return new RedirectResponse('/category/list');
    }

    public function edit($id)
    {
        $category = \App\Model\Category::find($id);

        return view('category/form', compact('category'));
    }

    public function update($id)
    {
        $data = request()->all();
        $validator = validator()->make($data, [
            'title' => ['required', 'min:5',],
            'slug'  => ['required'],
        ]);
        $error = $validator->errors();
        if(count($error)>0)
        {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }
        $category = \App\Model\Category::find($id);

        $data = request()->all();

        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        return new RedirectResponse('/category/list');
    }

    public function destroy($id)
    {
        $category = \App\Model\Category::find($id);
        $category->delete();

        return new RedirectResponse('/category/list');
    }
}
