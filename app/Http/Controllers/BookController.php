<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class BookController extends Controller
{
    public function createBook(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $title = $request->input('title');
            $author = $request->input('author');

            $newBook = new Book();
            $newBook->title = $title;
            $newBook->author = $author;
            $newBook->user_id = $userId;
            $newBook->save();

            return response()->json([
                "success" => true,
                "message" => "Book created"
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating book: ' . $th->getMessage());

            return response()->json([
                "success" => false,
                "message" => "Error creating Book"
            ], 201);
        }
    }


    public function updateBook(Request $request, $id)
    {
        try {

            $userId = auth()->user()->id;
            $newtitle = $request->input('title');
            $newauthor = $request->input('author');

             $book = Book::query()
                 ->where('user_id', $userId)
                 ->where('id', '=', $id)
                 ->first();

            if (!$book) {
                return response()->json([
                    "succes" => true,
                    "message" => "Book doesn't exists"
                ], 404);
            }

                    $book->title=$newtitle;
                    $book->author=$newauthor;
                    $book->save();


           return response()->json([
                "success" => true,
                "message" => "Book updated"
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating book: ' . $th->getMessage());

            return response()->json([
                "success" => false,
                "message" => "Error updating Book"
            ], 201);
        }
    }
}
