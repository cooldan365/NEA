let array = JSON.parse(document.getElementById("invisible").innerHTML);

document.body.removeChild(document.getElementById("invisible"));

let questions = [];
let answers = [];

for (let i = 0; i < array.length; i++) {
  if (array[i][0] != null) {
    questions.push(array[i][0]);
    answers.push(array[i][1]);
  }
};

let score = 0;
let currentIndex = 0;
const end = questions.length -1;


console.log(questions);
console.log(answers);

question = document.getElementById("question");
answer = document.getElementById("answer");
splash = document.getElementById("splash");

question.innerHTML = questions[currentIndex];
answer.innerHTML = answers[currentIndex];


question.classList.add("first");

let hasfinished = () =>{
    if (questions[currentIndex] == undefined){
        splash.classList.remove("nonvisible");        

    }
};

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