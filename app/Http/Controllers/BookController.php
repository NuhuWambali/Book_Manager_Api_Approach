<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{

    //
/**
 * @OA\Get(
 *     path="/api/books",
 *     summary="Get all books",
 *     @OA\Response(response="200", description="List of books")
 * )
 */
    public function index(){
        $books=Books::all();
        return response()->json($books);
    }

/**
 * @OA\Post(
 *     path="/api/books",
 *     summary="Create a new book",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Book information",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="author", type="string"),
 *             @OA\Property(property="published_at", type="date" )
 *         )
 *     ),
 *     @OA\Response(response="201", description="Book created"),
 *     @OA\Response(response="422", description="Invalid data")
 * )
 */

    public function store(Request $request){
        $book=new Books();
        $book->name=$request->name;
        $book->author=$request->author;
        $book->published_at=$request->published_at;
        $book->save();
        return response()->json(["message"=>"Book Added Successfully","status"=>"Success"],201);
    }

        /**
 * @OA\Get(
 *     path="/api/books/{id}",
 *     summary="Get a book by ID",
 *  @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="a book by id",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="201", description="Book created"),
 *     @OA\Response(response="422", description="Invalid data")
 * )
 */
    public function show($id){
       $books=Books::find($id);
       if(!empty($books)){
        return response()->json($books);
       }
       else{
         return response()->json(["message"=>"no data found in database","Status"=>"Success"], 404);
       }
    }



/**
 * @OA\Put(
 *     path="/api/books/{id}",
 *     summary="Update a book by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the book to update",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Book updated"),
 *     @OA\Response(response="404", description="Book not found")
 * )
 */

 public function update(Request $request, $id) {
    if (Books::where('id', $id)->exists()) {
         $book = Books::find($id);
         $book->name=$request->name;
         $book->author=$request->author;
         $book->published_at=$request->published_at;
        $book->save();
        return response()->json(["Message"=>"Book Updated Successfully","status"=>"Success"], 200);
    } else {
        return response()->json(["Message"=>"Book not found","Status"=>"Success"], 404);
    }
}


    /**
 * @OA\Delete(
 *     path="/api/books/{id}",
 *     summary="Delete a book by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the book to delete",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="204", description="Book deleted"),
 *     @OA\Response(response="404", description="Book not found")
 * )
 */
    public function destroy($id){
       if(Books::where('id',$id)->exists()){
        $book=Books::find($id);
        $book->delete();
        return response()->json(["Book Deleted Successfully"],202);
       }
       else{
            return response()->json([
                "book not found",
            ], 404);
       }
    }

}
