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

//adds the css which allows the question to be hidden from the answer
question.classList.add("first");

//function to check wether the flashcard section has finsihed
let hasfinished = () =>{
    if (questions[currentIndex] == undefined){
        //displays a splash page which outputs the scores and other values and hides
        //the flashcard page
        splash.classList.remove("nonvisible");        

    }
};

//this function allows the flashcards to be displayed at the very top layer of the page
//used so that once the user is done,the attributes of first are customised in a css 
//file, and once the user has completed the quiz, the hasfinished function will remove
//the flashcards layer and display the splash page layer.
let toggleFirst = () => {
    question.classList.toggle("first")
    answer.classList.toggle("first")
    hasfinished();
};

let toggleCorrect = () =>{
  score += 1;
  currentIndex += 1;
  question.innerHTML = questions[currentIndex];
  answer.innerHTML = answers[currentIndex];

  question.classList.add("first");
  answer.classList.remove("first");

  console.log(score);

  hasfinished();
};

let toggleIncorrect = () =>{
  currentIndex += 1;
  question.innerHTML = questions[currentIndex];
  answer.innerHTML = answers[currentIndex];

  question.classList.add("first");
  answer.classList.remove("first");

  console.log(score);
  hasfinished();
};