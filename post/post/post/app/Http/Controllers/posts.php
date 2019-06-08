<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class posts extends Controller
{
    public function create(Request $request) {
       $this->validate($request, [
       	  // 'body'  => 'min:1',
          'image' => 'file|mimes:jpeg,png,gif,webp,jpg|max:2048',
       ]);

       $post = new Post;
       $post->body  = $request->body;

	      // picture
	    if (!empty($request->file('image'))) {
	      $path = $request->file('image')->store('public/posts');
	      $path = str_replace('public', '/storage', $path);
	      $post->image = $path;
        }

       if (!empty($request->body) || !empty($request->image)) {
	       $post->save();
	       return redirect()->back()->with('msg', 'Your Post Created Successfuly');
        } else {
        	return redirect()->back();
        } 

    }

     public function edit($id) {
       $post = Post::find($id);
       return view('views/edit', compact('post'));
    }

    public function update(Request $request, $id) {
       $this->validate($request, [
       	  // 'body'  => 'min:1',
          'image' => 'file|mimes:jpeg,png,gif,webp,jpg|max:2048',
       ]);

       $post = Post::find($id);
       $post->body  = $request->body;

	      // picture
	    if (!empty($request->file('image'))) {
        unlink(public_path() . $post->image); 
	      $path = $request->file('image')->store('public/posts');
	      $path = str_replace('public', '/storage', $path);
	      $post->image = $path;
        }

       if (!empty($request->body) || !empty($request->image)) {
	       $post->save();
	       return redirect()->route('/')->with('msg', 'Your Post Edited Successfuly');
        } else {
        	return redirect()->route('/');
        } 

    }
    public function delete(Request $request, $id) {
      
       $post = Post::find($id);
       $post->delete();
	   return redirect()->back()->with('msg', 'Your Post Deleted Successfuly');
        
    }



}
