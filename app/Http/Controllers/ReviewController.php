<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewCollection;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(int)$request->product) return abort(404);
        $product = Product::findOrFail((int)$request->product);
        return new ReviewCollection($product->reviews()->paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function files(Request $request)
    {
        if ($request->file instanceof UploadedFile) {
            $request->file('file')->storeAs('tmp/' . Session::getId(), $request->file('file')->getClientOriginalName());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function filesDelete(Request $request)
    {
        if ($request->file) {
            Storage::delete('tmp/' . Session::getId() . '/' . $request->file);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
