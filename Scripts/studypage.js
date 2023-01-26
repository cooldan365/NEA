let array = JSON.parse(document.getElementById("invisible").innerHTML);

document.body.removeChild(document.getElementById("invisible"));
//allowing the questions and answers in the CSV to be stored as an array
let questions = [];
let answers = [];
//searches the csv and assigns a length to the array which will be used later to calculate
//a percentage
for (let i = 0; i < array.length; i++) {
  if (array[i][0] != null) {
    questions.push(array[i][0]);
    answers.push(array[i][1]);
  }
};
//key variables which allow me to calculate a percentage once user is done with the flashcards
let score = 0;
let currentIndex = 0;
const end = questions.length -1;
const endC = questions.length;

//displays the question and answer
console.log(questions);
console.log(answers);

//these get the value of the element found in the html 
question = document.getElementById("question");
answer = document.getElementById("answer");
splash = document.getElementById("splash");
//allocates the values of the question in the html to an array 
question.innerHTML = questions[currentIndex];
answer.innerHTML = answers[currentIndex];

let scoreInput = document.getElementById("score-input");
let endCInput = document.getElementById("endC-input");

//set the values of the hidden input fields before submitting the form
scoreInput.value = score;
endCInput.value = endC;
function submitForm(){
  // existing code
  scoreInput.value = score;
  form.submit();
}



//function to check wether the flashcard section has finsihed
let hasfinished = () =>{
    if (questions[currentIndex] == undefined){

        //displays a splash page which outputs the scores and other values and hides
        //the flashcard page
        splash.classList.remove("nonvisible");
        submitForm();        
    }
};

//this function allows the flashcards to be displayed at the very top layer of the page
//used so that once the user is done,the attributes of first are customised in a css 
//file, and once the user has completed the quiz, the hasfinished function will remove
//the flashcards layer and display the splash page layer.
let showAnswer = () => {
    answer.classList.toggle("hidenA")
    hasfinished();
};

let toggleCorrect = () =>{
  score += 1;
  currentIndex += 1;
  question.innerHTML = questions[currentIndex];
  answer.innerHTML =answers[currentIndex]  ;
  answer.classList.add("hidenA")

  console.log(score);

  hasfinished();
};

let toggleIncorrect = () =>{
  currentIndex += 1;
  question.innerHTML = questions[currentIndex];
  answer.innerHTML = answers[currentIndex];

  answer.classList.add("hidenA")

  console.log(score);
  hasfinished();
};