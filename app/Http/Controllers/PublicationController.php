<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::all();

        return view('publication/index', ['publications' => $publications ]);

   }   
   
   /**
     * Show the publication.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publication/create');
    }

    /**
     * Store a new publication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
        ]);

        if ($validated) {

            $publication = Publication::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
            ]);
            $publication->save();

            $request->session()->flash('message', 'Successfully created!');
            return redirect('/publication');

        }

        return redirect('/publication/create');

    
    }

    /**
     * Display the publication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publication = Publication::find($id);

        /**
         *  checks if the user has made a comment.
         */
        $hasCommented = DB::table('comments')
                ->where('publication_id', '=', $id)
                ->where('comments.user_id', '=', Auth::id())
                ->join('publications', 'publications.id', '=', 'comments.publication_id')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->first() ? true : false;


        return view('publication/show', ['publication' => $publication, 'hasCommented' => $hasCommented]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publication = Publication::find($id);
        return view('publication/edit', ['publication' => $publication]);;
    }

    /**
     * Update the publication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
        ]);

        if ($validated) {

            $publication = Publication::find($id);
            $publication->title = $request->input('title');
            $publication->content = $request->input('content');
            $publication->save();

            $request->session()->flash('message', 'Successfully updated!');
            return redirect('/publication');

        }

        return redirect('/publication/create');

    }

    /**
     * Remove publication.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $publication = Publication::find($id);

        return response()->json([
            'result' => $publication->delete(),
        ]);
    }
}
