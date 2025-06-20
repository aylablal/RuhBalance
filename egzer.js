const dot = document.getElementById("dot");
const innerCircle = document.querySelector(".inner-circle");
const breathingText = document.querySelector(".breathing-text");
const instruction = document.getElementById("instruction");
const startBtn = document.getElementById("startBtn");


const commands = [
    {text: "Nefes Al", duration: 4000, animation: "breatheIn"},
    {text: "Tut", duration: 4000, animation: "hold"},
    {text: "Nefes Ver", duration: 4000, animation: "breatheOut"}
];

let stepIndex = 0;
let interval;
let animationActive = false;


startBtn.addEventListener("click", () => {
    if (animationActive) {
        stopBreathing();
        startBtn.textContent = "Haydi Başlayalım";
        instruction.querySelector("p").textContent = "Rahatlamak ve zihnini temizlemek için nefes egzersizine başla";
        breathingText.textContent = "Hazır mısın?";
    } else {
        startBreathing();
        startBtn.textContent = "Durdur";
    }
});


function startBreathing() {
    animationActive = true;
    stepIndex = 0;
    
    dot.style.animation = "rotateDot 12s linear infinite";
    
   
    updateBreathingStep();
    
  
    interval = setInterval(() => {
        stepIndex = (stepIndex + 1) % commands.length;
        updateBreathingStep();
    }, commands[stepIndex].duration);
}


function stopBreathing() {
    animationActive = false;
    clearInterval(interval);
    dot.style.animation = "none";
    innerCircle.style.animation = "none";
}


function updateBreathingStep() {
    const currentCommand = commands[stepIndex];
    
   
    breathingText.textContent = currentCommand.text;
    instruction.querySelector("p").textContent = getInstructionText(stepIndex);
    
  
    innerCircle.style.animation = `${currentCommand.animation} ${currentCommand.duration / 1000}s ease-in-out forwards`;
}


function getInstructionText(index) {
    switch(index) {
        case 0:
            return "Burnundan yavaşça ve derin bir şekilde nefes al";
        case 1:
            return "Nefesinizi içinizde tutun";
        case 2:
            return "Ağzından yavaşça nefesini ver";
        default:
            return "";
    }
}


window.addEventListener("load", () => {
    window.addEventListener("scroll", function() {
        const header = document.querySelector("header");
        header.classList.toggle("shadow", window.scrollY > 0);
    });
});