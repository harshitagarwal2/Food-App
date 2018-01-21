const factArray = [
	"Roughly one third of the food produced in the world for human consumption every year — approximately 1.3 billion tonnes — gets lost or wasted.",
	"Food losses and waste amounts to roughly US$ 680 billion in industrialized countries and US$ 310 billion in developing countries.",
	"Fruits and vegetables, plus roots and tubers have the highest wastage rates of any food (45%).",
	"Every year, consumers in rich countries waste almost as much food (222 million tonnes) as the entire net food production of sub-Saharan Africa (230 million tonnes).",
	"Even if just one-fourth of the food currently lost or wasted globally could be saved, it would be enough to feed 870 million hungry people in the world.",
];

var i = 0;

var changeFact = function() {
	var facts = document.getElementById("facts");
	var f = factArray[i];
	facts.innerHTML = f;
	i = (i + 1) % factArray.length;
}

document.addEventListener('DOMContentLoaded', function(){
	i = Math.floor(Math.random()*factArray.length);
	changeFact();
});

setInterval(changeFact, 11000);