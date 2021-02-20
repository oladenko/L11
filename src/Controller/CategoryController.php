<?php

namespace App\Controller;

use App\Model\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController
{
    public function index()
    {
        $categories = \App\Model\Category::all();

        return view('category/table', compact('categories'));
    }

    public function create()
    {
        $category = new Category();

        return view('category/form', compact('category'));
    }

    public function store()
    {
        $data = request()->all();

        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        return new RedirectResponse('/category/list');
    }

    public function edit($id)
    {
        $category = \App\Model\Category::find($id);

        return view('category/formEdit', compact('category'));
    }

    public function update($id)
    {
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
