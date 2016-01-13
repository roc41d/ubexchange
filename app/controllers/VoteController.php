<?php

class VoteController extends BaseController {

	// function for handling questionUpVote
	public function getUpvotequestion($id, $uID) {

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be logged in to perform this action.");
		}

		//$userToUpdate = User::find($uID);
		//return $userToUpdate->reputation;

		$data['question'] = Question::find($id);

		//return $data['question']->user_id . '==' . Auth::user()->id;
		if ($data['question']->user_id == Auth::user()->id) {
			return Redirect::back()->with('alertError', "You can not upvote your own question.");
		}

		$hasUserVoted = Qvote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('question_id', '=', $id)->count();
		if ($hasUserVoted == 0) {

			$reputationTest = User::find(Auth::user()->id);
			if ($reputationTest->reputation < 15) {
				return Redirect::back()->with('alertError', "You need 15 reputation to upvote a question.");
			} else {

				$vote =  new Qvote();
				$vote->user_id = User::find(Auth::user()->id)->id;
				$vote->question_id = $id;
				$vote->save();

				$userToUpdate = User::find($uID);
				$reputation = $userToUpdate->reputation;
				$userToUpdate->reputation = $reputation + 5;
				$userToUpdate->save();

				$questionToUpVote = Question::find($id);
				$votes = $questionToUpVote->votes;
				$questionToUpVote->votes = $votes + 1;
				$questionToUpVote->save();

				$questionReputation = new Qreputation();
				$questionReputation->user_id = $uID;
				$questionReputation->question_id = $id;
				$questionReputation->points = "+5";
				$questionReputation->action = "upvote";
				$questionReputation->save();


				return Redirect::back();

			}
			
		} else {
			return Redirect::back()->with('alertError', "you have already voted this question.");
		}

		//$hasUserVoted = User::find(Auth::user()->id)->id;

		//return $hasUserVoted;

		//return Redirect::back();
	}

	// function for handling questionDownVote
	public function getDownvotequestion($id, $uID) {

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be logged in to perform this action.");
		}

		//return $id . $uID;

		$data['question'] = Question::find($id);

		//return $data['question']->user_id . '==' . Auth::user()->id;
		if ($data['question']->user_id == Auth::user()->id) {
			return Redirect::back()->with('alertError', "You can not downvote your own question.");
		}

		$hasUserVoted = Qvote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('question_id', '=', $id)->count();
		if ($hasUserVoted == 0) {

			$reputationTest = User::find(Auth::user()->id);
			if ($reputationTest->reputation < 125) {
				return Redirect::back()->with('alertError', "You need 125 reputation to downvote a question.");
			} else {

				$vote =  new Qvote();
				$vote->user_id = User::find(Auth::user()->id)->id;
				$vote->question_id = $id;
				$vote->save();

				$userToUpdate = User::find($uID);
				$reputation = $userToUpdate->reputation;
				$reputation -= 2;
				//$userToUpdate->reputation = $reputation - 2;
				if ($reputation < 1) {
					$userToUpdate->reputation = 1;
				} else {
					$userToUpdate->reputation = $reputation;
				}
				$userToUpdate->save();

				$questionToDownVote = Question::find($id);
				$votes = $questionToDownVote->votes;
				$questionToDownVote->votes = $votes - 1;
				$questionToDownVote->save();

				$questionReputation = new Qreputation();
				$questionReputation->user_id = $uID;
				$questionReputation->question_id = $id;
				$questionReputation->points = "-2";
				$questionReputation->action = "downvote";
				$questionReputation->save();

				return Redirect::back();

			}
			
		} else {
			return Redirect::back()->with('alertError', "you have already voted this question.");
		}

	}

	// function for handling answerUpVote
	public function getUpvoteanswer($id, $uID){

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be logged in to perform this action.");
		}

		$data['answer'] = Answer::find($id);

		//return $data['answer']->user_id . '==' . Auth::user()->id;
		if ($data['answer']->user_id == Auth::user()->id) {
			return Redirect::back()->with('alertError', "You can not upvote your own answer.");
		}

		$hasUserVoted = Avote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('answer_id', '=', $id)->count();
		if ($hasUserVoted == 0) {

			$reputationTest = User::find(Auth::user()->id);
			if ($reputationTest->reputation < 15) {
				return Redirect::back()->with('alertError', "You need 15 reputation to upvote an answer.");
			} else {

				$vote =  new Avote();
				$vote->user_id = User::find(Auth::user()->id)->id;
				$vote->answer_id = $id;
				$vote->save();

				$userToUpdate = User::find($uID);
				$reputation = $userToUpdate->reputation;
				$userToUpdate->reputation = $reputation + 10;
				$userToUpdate->save();

				$answerToUpVote = Answer::find($id);
				$votes = $answerToUpVote->votes;
				$answerToUpVote->votes = $votes + 1;
				$answerToUpVote->save();

				$answerReputation = new Areputation();
				$answerReputation->user_id = $uID;
				$answerReputation->answer_id = $id;
				$answerReputation->points = "+10";
				$answerReputation->action = "upvote";
				$answerReputation->save();

				return Redirect::back();

			}
			
		} else {
			return Redirect::back()->with('alertError', "you have already voted this answer.");
		}
	}

	// function for handling answerDonwVote
	public function getDownvoteanswer($id, $uID){

		if (Auth::check() == NULL) {
			return Redirect::back()->with('alertError', "you have to be logged in to perform this action.");
		}

		$data['answer'] = Answer::find($id);

		//return $data['answer']->user_id . '==' . Auth::user()->id;
		if ($data['answer']->user_id == Auth::user()->id) {
			return Redirect::back()->with('alertError', "You can not downvote your own answer.");
		}

		$hasUserVoted = Avote::where('user_id', '=', User::find(Auth::user()->id)->id)->where('answer_id', '=', $id)->count();
		if ($hasUserVoted == 0) {

			$reputationTest = User::find(Auth::user()->id);
			if ($reputationTest->reputation < 125) {
				return Redirect::back()->with('alertError', "You need 125 reputation to downvote an answer.");
			} else {
				//return $reputationTest;
				$vote =  new Avote();
				$vote->user_id = User::find(Auth::user()->id)->id;
				$vote->answer_id = $id;
				$vote->save();

				/*-----------------------------------------------*/
				$userToUpdate = User::find($uID);
				$reputation = $userToUpdate->reputation;
				$reputation -= 2;
				//$userToUpdate->reputation = $reputation - 2;
				if ($reputation < 1) {
					$userToUpdate->reputation = 1;
				} else {
					$userToUpdate->reputation = $reputation;
				}
				$userToUpdate->save();
				/*-----------------------------------------------*/

				/*-----------------------------------------------*/
				$authUser = $reputationTest->reputation;
				$authUser -= 1;
				if ($authUser < 1) {
					$reputationTest->reputation = 1;
				} else {
					$reputationTest->reputation = $authUser;
				}
				$reputationTest->save();
				/*-----------------------------------------------*/

				/*-----------------------------------------------*/
				$answerReputation = new Areputation();
				$answerReputation->user_id = $uID;
				$answerReputation->answer_id = $id;
				$answerReputation->points = "-2";
				$answerReputation->action = "downvote";
				$answerReputation->save();
				/*----------------------------------------------*/

				/*-----------------------------------------------*/
				$authReputation = new Areputation();
				$authReputation->user_id = Auth::user()->id;
				$authReputation->answer_id = $id;
				$authReputation->points = "-2";
				$authReputation->action = "downvote";
				$authReputation->save();
				/*----------------------------------------------*/

				$answerToDownVote = Answer::find($id);
				$votes = $answerToDownVote->votes;
				$answerToDownVote->votes = $votes - 1;
				$answerToDownVote->save();

			return Redirect::back();
			}
			
		} else {
			return Redirect::back()->with('alertError', "you have already voted this answer.");
		}
	}

}
