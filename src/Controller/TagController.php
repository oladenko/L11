<?php


namespace App\Controller;
use App\Model\Tag;
use Illuminate\Http\RedirectResponse;

class TagController
{
    public function index()
    {
        $tags = \App\Model\Tag::paginate(3);
  //     $tags = \App\Model\Tag::withTrashed()->get();

        return view('tag/table', compact('tags'));
    }

    public function create()
    {
        $tag = new Tag();

        return view('tag/form', compact('tag'));
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


        $tag = new Tag();
        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();
        $_SESSION['message'] = [
            'status' =>'success',
            'text' => "Tag \"{$data['title']} \" successfully saved.",
        ];

        return new RedirectResponse('/tag/list');
    }

    public function edit($id)
    {
        $tag = \App\Model\Tag::find($id);

        return view('tag/form', compact('tag'));
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
        $tag = \App\Model\Tag::find($id);

        $data = request()->all();

        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();

        return new RedirectResponse('/tag/list');
    }

    public function destroy($id)
    {
        $tag = \App\Model\Tag::find($id);
        $tag->delete();

        return new RedirectResponse('/tag/list');
    }
}