<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;


Route::view('/', 'welcome', [
    'greeting' => 'Hello, World!',
    'name' => 'John Doe',
    'age' => 30,
    'tasks' => [
        'Learn Laravel',
        'Build a project',
        'Deploy to production',
    ],
]);

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function () {
    $posts = Post::all();

    return view('formtest', [
        'posts' => $posts,
    ]);
});

Route::post('/formtest', function () {
    Post::create([
        'description' => request('description'),
    ]);

    return redirect('/formtest');
});

Route::delete('/formtest/{id}', function ($id) {
    Post::findOrFail($id)->delete();

    return redirect('/formtest');
});

Route::get('/delete', function () {
    Post::truncate();

    return redirect('/formtest');
});


//index
Route::get('/posts', function () {
    $posts = Post::all();

    return view('posts.index', [
        'posts' => $posts,
    ]);
});

//show
Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

//edit
Route::get(
    '/posts/{post}/edit',
    function (Post $post) {
        return view('posts.edit', [
            'post' => $post,
        ]);
    }
);

//update
Route::patch(
    '/posts/{post}',
    function (Post $post) {
        $post->update([
            'description' => request('description'),
            'updated_at' => now(),
        ]);

        return redirect('/posts' . '/' . $post->id);
    }
);


Route::get('/user_registration', function () {
    $users = User::all();
    return view('user_registration', compact('users'));
});

Route::post('/user_registration', function (Request $request) {
    $validated = $request->validate([
        'first_name'     => 'required',
        'last_name'      => 'required',
        'middle_name'    => 'nullable',
        'nickname'       => 'nullable',
        'email'          => 'required|email|unique:users,email',
        'age'            => 'required',
        'address'        => 'required',
        'contact_number' => 'required'
    ]);

    User::create([
        'first_name'     => $validated['first_name'],
        'last_name'      => $validated['last_name'],
        'middle_name'    => $validated['middle_name'],
        'nickname'       => $validated['nickname'],
        'email'          => $validated['email'],
        'age'            => $validated['age'],
        'address'        => $validated['address'],
        'contact_number' => $validated['contact_number']
    ]);

    return redirect('user_registration');
});

Route::delete('/user_registration/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/user_registration')->with('success', 'User deleted!');
});

Route::get('/user_registration/{id}/edit', function ($id) {
    $user = User::findOrFail($id);
    return view('user-edit', compact('user'));
});

Route::PATCH('/user_registration/{id}', function (Illuminate\Http\Request $request, $id) {
    $user = User::findOrFail($id);

    $user->update([
        'first_name'     => $request->input('first_name'),
        'last_name'      => $request->input('last_name'),
        'middle_name'    => $request->input('middle_name'),
        'nickname'       => $request->input('nickname'),
        'email'          => $request->input('email'),
        'age'            => $request->input('age'),
        'address'        => $request->input('address'),
        'contact_number' => $request->input('contact_number'),
    ]);

    return redirect('/user_registration')->with('success', 'Profile updated!');
});
