<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Publication;
use App\Mail\CommentReceived;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class CommentController extends Controller
{

    /**
     * Display all the publications with Hola comments.
     * DESAFIO 3.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /** 
         * Get all publications where there is a comment with the word 'Hola'
         */
        $publications = DB::table('publications')
                        ->where(function ($query) {
                            $query->select('status')
                                ->from('comments')
                                ->whereColumn('comments.publication_id', 'publications.id')
                                ->where('comments.content', 'LIKE', '%Hola%')
                                ->where('comments.status', 'APROBADO')
                                ->limit(1);
                        }, 'APROBADO')
                        ->join('users', 'users.id', '=', 'publications.user_id')
                        ->select('publications.*', 'users.name')
                        ->get();

        return view('comment/index', ['publications' => $publications ]);

   }   

    /**
     * Store a new comment.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:200',
        ]);

        if ($validated) {

            $publication = Publication::find($id);

            $comment = Comment::create([
                'content' => $request->input('content'),
                'publication_id' => $publication->id,
                'user_id' => Auth::id(),
            ]);

            $comment->save();
            

            $request->session()->flash('comment', 'Successfully created!');

            Mail::to($publication->user)->send(new CommentReceived($request->user()));

            return redirect()->route('publication.show', ['publication' => $publication]);;

        }

        return redirect()->route('publication.show', ['publication' => $id]);;

    
    }
}
