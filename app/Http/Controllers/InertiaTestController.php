<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;


class InertiaTestController extends Controller
{
    public function index() {
        return Inertia::render('Inertia/index', ['blogs' => InertiaTest::all()]);
    }

    public function create() {
        return Inertia::render('Inertia/create');
    }

    public function show($id) {
        return Inertia::render('Inertia/show', ['id' => $id, 'blog' => InertiaTest::findOrFail($id)]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'max:20'],
            'content' => ['required'],
        ]);
        $inetia = new InertiaTest;
        $inetia->title = $request->title;
        $inetia->content = $request->content;
        $inetia->save();

        return to_route('inertia.index')
        ->with([
            'message' => '登録しました。'
        ]);
    }

    public function delete($id) {
        $blog = InertiaTest::findOrFail($id);
        $blog->delete();

        return to_route('inertia.index')
        ->with([
            'message' => '削除しました。'
        ]);
    }

}
