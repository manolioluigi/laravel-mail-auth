<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewContact;
use App\Models\Lead;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Project::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title);
        $form_data['slug'] = $slug;

        $newProject = new Project();

        if($request->hasFile('cover_image')){
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $newProject->fill($form_data);
        $newProject->save();

        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }


        //gestione mail

        $new_lead = new Lead();
        $new_lead->title = $form_data['title'];
        $new_lead->content = $form_data['content'];
        $new_lead->slug = $form_data['slug'];
        
        $new_lead->save();

        Mail::to('info@boolpress.com')->send(new NewContact($new_lead));

        return redirect()->route('admin.posts.index')->with('message', 'Project creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Project $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $post)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.posts.edit', compact('post', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $post)
    {
        $form_data = $request->validated();
        $slug = Project::generateSlug($request->title, '-');
        $form_data['slug'] = $slug;

        if($request->hasFile('cover_image')){
            if($post->cover_image){
                Storage::delete($post->cover_image);
            }
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $post->update($form_data);

        if($request->has('technologies')){
            $post->technologies()->sync($request->technologies);
        }

        return redirect()->route('admin.posts.index')->with('message', 'Il progetto è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $post)
    {

        $post->technologies()->sync([]);

        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', 'Il post è stato cancellato correttamente');
    }
}
