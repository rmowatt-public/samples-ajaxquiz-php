
MM.Quiz = {

	questionId : null,
	executor : null,
	correctAnswer : null,

	/**
	* Make ajax call to get next question in queue
	**/
	
	getQuestion : function() {
		MM.doAjax('/quiz/ajaxquestionfeeder/', '' , MM.Quiz.getQuestionHandler);
	},

	/**
	* Handles Callback from MM.Quiz.getQuestion
	**/
	
	getQuestionHandler : function(transport) {
		json = transport.responseText.evalJSON();

		if(json.message != 'complete') {//response is a question, set it up
			MM.Quiz.questionId = json.questionId;

			desc = new Element('div', {'class' : 'description', 'id' : 'quizDescription'});
			desc.innerHTML = json.description;

			h4 = new Element('h4', {'id' : 'question'});
			h4.innerHTML = json.question;

			answerWrap = new Element('div', {'id' : 'answerWrap'});
			answerWrap.insert({bottom : desc});
			answerWrap.insert({bottom : h4});

			allAnswers = new Element('div', {'id' : 'theAnswers'});
			
			count = 1;
			$A(json.answers).each(function(i){//add the answers
				if(i.correct == 1){MM.Quiz.correctAnswer = i.answer}
				input = new Element('div' , {'id':i.id, 'class' : 'answers'})
				input.innerHTML = count + '. ' + i.answer;
				allAnswers.insert({bottom : input});
				count++;
			})
			answerWrap.insert({bottom : allAnswers});
			if($('answerWrap')) {
				$('answerWrap').replace(answerWrap);
			} else {
				$('quiz').innerHTML = '';
				$('quiz').insert({bottom : answerWrap});
			}

			if($('answerWrap')) {//we dont want to add Event Observer until elements are in DOM
				$('theAnswers').immediateDescendants().each(
				function(el){
					Event.observe(el, 'click', MM.Quiz.submitAnswer)
				}
				)
			}
		} else {//quiz has been completed
			h4 = new Element('h4');
			h4.innerHTML = "You've completed your quiz. Would you like to see your score?";
			submit = new Element('input', {'type' : 'submit', 'value' : 'of course!', 'class' : 'sub'});

			answerWrap = new Element('div', {'id' : 'answerWrap'});
			answerWrap.insert({bottom : h4});
			answerWrap.insert({bottom : submit});
			$('answerWrap').replace(answerWrap);
			Event.observe(submit, 'click', MM.Quiz.getResults)
		}
	},

	/**
	* Make ajax call to submit users answer
	**/
	
	submitAnswer : function(e) {

		if($('answerWrap')) {
			$('theAnswers').immediateDescendants().each(//stop observing elemnts so we dont get double submission
			function(el){
				Event.stopObserving(el, 'click', MM.Quiz.submitAnswer)
				el.className = 'answersComplete';//change class name to grey out answers and get rid of hover effect
			}
			)
		}

		pars = {//parameters to be sent to server
			questionId : MM.Quiz.questionId,
			answerId : this.id
		}

		MM.doAjax('/quiz/ajaxquestionresponse/', $H(pars).toQueryString() , MM.Quiz.submitAnswerHandler);
	},

	/**
	* Handles Callback from MM.Quiz.submitAnswer
	**/
	
	submitAnswerHandler : function(transport) {
		if(transport.responseText == 'end') {//it was end of quiz, show results
			MM.Quiz.showResults();
		} else {//let user know if they got the correct answer, if not show correct answer
			classAppend = (transport.responseText == '1') ? 'correct' : 'wrong';
			result = new Element ('div', {'class' : 'result ' + classAppend});
			result.innerHTML = (transport.responseText == '1') ? 'Correct!' : 'Sorry, Correct Answer Is ' + MM.Quiz.correctAnswer;
			$('question').insert({after : result});

			MM.Quiz.executor = new PeriodicalExecuter(//give user 2 seconds to process feedback on MMether answer was correct
			function(){
				MM.Quiz.getQuestion();
				MM.Quiz.executor.stop()}, 2
				)
		}
	},

	/**
	* Quiz Is complete, lets get the results
	**/
	
	getResults : function() {
		MM.doAjax('/quiz/ajaxgetresults/', '' , MM.Quiz.getResultsHandler);
	},

	/**
	* Handles Callback from MM.Quiz.getResults
	**/
	
	getResultsHandler : function(transport) {
		json = transport.responseText.evalJSON();
		h4 = new Element('h4');
		h4.innerHTML = "You got " + json.correct + " out of " + json.total + " correct.";
		submit = new Element('input', {'type' : 'submit', 'value' : 'Play Again', 'class' : 'sub'});
		answerWrap = new Element('div', {'id' : 'answerWrap'});
		answerWrap.insert({bottom : h4});
		answerWrap.insert({bottom : submit});
		$('answerWrap').replace(answerWrap);
		Event.observe(submit, 'click', function(){location.reload(true)})//does user want to play again?
	}
}