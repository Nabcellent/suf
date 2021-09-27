<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['reviews'] = Review::with('user', 'product')->get();

        return response()->view('admin.users.reviews', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse {
        if($request->has('review')) {
            if(empty($request->input('review'))) {
                return response()->json(['msg' => 'Error updating review.'], 400);
            }

            $values = ['review' => $request->input('review')];
            $message = "Thank you! for reviewing this product!";
        } else if($request->has('rating')) {
            $message = "Thank you for rating this product! 👍";
            $values = ['rating' => $request->input('rating')];
        } else {
            return response()->json(['msg' => 'Error updating review.'], 400);
        }

        Review::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $request->input('product_id')],
            $values
        );

        return response()->json(['msg' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
