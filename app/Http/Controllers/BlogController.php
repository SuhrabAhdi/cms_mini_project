<?php

namespace App\Http\Controllers;
use File;
use Session;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\RequestBlog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct(){
    //      $this->middleware("auth");
    //  }
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        $categories = Category::all()->take(6);
//         Post::find(12)->categories()->detach();
//         Post::destroy(12);
// //    $post = Post::find(26);

         return view('blog.index',compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Post::class);
        return view('blog.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestBlog $request)
    {
   
     $imageName = time().'.'.$request->image->extension();
   
     $post = auth()->user()->posts()->create($request->except("image"));
// 
      $post->update(["image"=>$imageName]);
      $request->image->move(public_path('images'),$imageName);
    // $categories = $request->categories;
    // $post = new Post();
    // $post->title = $request->title;
    // $post->content = $request->content;
    // $post->image = "url";
    // $post->save();
    // $post->categories()->sync($categories);
//    if($post)
//    {
//     $request->image->move(public_path('images'),$imageName);
      return redirect()->route("blog.index")->with('status','Post has been created!');
//    }
//     else 
//    return redirect()->route("blog.create")->with('error','Failed to create!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $blog)
    {
       // $this->authorize('view',$blog);
        return view('blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blog)
    {
        return view("blog.form",['post'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestBlog $request, Post $blog)
    {

       $imageName = "";
       $model = null;
       if($request->image != ''){
           $image_path = 'images/'.$blog['image'];

           if(File::exists($image_path)){
               File::delete($image_path);
           }
           $imageName = time().'.'.$request->image->extension();

           $blog->update([
               'title'=>$request->title,
               'content'=>$request->content,
               'image'=>$imageName
           ]);
        $model = $request->image->move(public_path('images'),$imageName);
       } 
       else
        {
       $model = $blog->update($request->except('image'));
       }

        if($model)
        return redirect()->route('blog.index')->with('status','Post updated');
  
        else
        return redirect()->route('blog.edit',$data)->with('error','could not update the post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blog)
    {
        // $post = Post::find($id);
        // $post->categories()->detach();
        //Post::destroy($id);
       
        $blog->categories()->detach();
        $path = 'images/'.$blog['image'];

       if(File::exists($path))
         File::delete($path);
        
       $blog->delete();
        return redirect()->route('blog.index')->with('status','Post has been deleted!');
    }

    public function filter($category){
        Session::put("id",$category);
        $posts = Post::whereHas("categories",function($category){
            $category->where("id",Session::pull("id"));
        })->get();

        return view('blog.index',compact('posts'));
    }
    public function trash(){
        $posts = Post::onlyTrashed()->get();
        $trash = true;
        return view('blog.index',compact('posts','trash'));
    }

    public function restore($id){
   Post::withTrashed()->where("id",$id)->restore();
        return redirect(route('blog.trash'));
    }

    public function remove($id){
        Post::withTrashed()->where("id",$id)->forceDelete();
        return redirect(route('blog.trash'));
    }

    // private function validatedData(){
    //     return request()->validate([
    //         "title"=>"required",
    //         "content"=>"required",
    //      "image"=>"required|image|mimes:jpg,jpeg,png,gif|max:1024"
    //     ]);
    // }


}
