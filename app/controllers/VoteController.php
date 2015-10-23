<?php

class VoteController extends BaseController {

	public function getUpvotequestion($id) {

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be loggin to perform this action.");
		}

		$hasUserVoted = Qvote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('question_id', '=', $id)->count();
		if ($hasUserVoted == 0) {
			
			$vote =  new Qvote();
			$vote->user_id = User::find(Auth::user()->id)->id;
			$vote->question_id = $id;
			$vote->save();

			$questionToUpVote = Question::find($id);
			$votes = $questionToUpVote->votes;
			$questionToUpVote->votes = $votes + 1;
			$questionToUpVote->save();

			return Redirect::back();
		} else {
			return Redirect::back()->with('alertError', "you have already voted this question.");
		}

		//$hasUserVoted = User::find(Auth::user()->id)->id;

		//return $hasUserVoted;

		//return Redirect::back();
	}

	public function getDownvotequestion($id) {

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be loggin to perform this action.");
		}

		$hasUserVoted = Qvote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('question_id', '=', $id)->count();
		if ($hasUserVoted == 0) {
			$vote =  new Qvote();
			$vote->user_id = User::find(Auth::user()->id)->id;
			$vote->question_id = $id;
			$vote->save();

			$questionToDownVote = Question::find($id);
			$votes = $questionToDownVote->votes;
			$questionToDownVote->votes = $votes - 1;
			$questionToDownVote->save();

		return Redirect::back();
		} else {
			return Redirect::back()->with('alertError', "you have already voted this question.");
		}

	}

	public function getUpvoteanswer($id){

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be loggin to perform this action.");
		}

		$hasUserVoted = Avote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('answer_id', '=', $id)->count();
		if ($hasUserVoted == 0) {
			
			$vote =  new Avote();
			$vote->user_id = User::find(Auth::user()->id)->id;
			$vote->answer_id = $id;
			$vote->save();

			$answerToUpVote = Answer::find($id);
			$votes = $answerToUpVote->votes;
			$answerToUpVote->votes = $votes + 1;
			$answerToUpVote->save();

			return Redirect::back();
		} else {
			return Redirect::back()->with('alertError', "you have already voted this answer.");
		}
	}

	public function getDownvoteanswer($id){

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be loggin to perform this action.");
		}

		$hasUserVoted = Avote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('answer_id', '=', $id)->count();
		if ($hasUserVoted == 0) {
			$vote =  new Avote();
			$vote->user_id = User::find(Auth::user()->id)->id;
			$vote->answer_id = $id;
			$vote->save();

			$answerToDownVote = Answer::find($id);
			$votes = $answerToDownVote->votes;
			$answerToDownVote->votes = $votes - 1;
			$answerToDownVote->save();

		return Redirect::back();
		} else {
			return Redirect::back()->with('alertError', "you have already voted this answer.");
		}
	}

}
