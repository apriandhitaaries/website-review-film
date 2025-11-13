<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'isi_review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'film_id' => 'required|exists:films,id',
        ]);

        $validateData['user_id'] = Auth::id();

        Review::create($validateData);

        return redirect(route('films.show', $validateData['film_id']))
            ->with('status', 'Ulasan kamu berhasil dikirim!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return back()->with('status', 'Ulasan kamu berhasil dihapus!');
    }
}
