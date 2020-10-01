// Opretter variabler der vælger eller opretter elementer
let canvas_parent = document.getElementById('race');
let teams = document.querySelectorAll("div.teaminfo");
let canvas = document.createElement("canvas");

// Initialiserer canvas elementet og appender til parent elementet
canvas.width = 800;
canvas.height = 350;
context = canvas.getContext("2d");
canvas_parent.appendChild(canvas),

// Initialisering af arrays
components = [],
boatobjects = [],
imgsrcs = [],
points = [];

// Oprettelse af båd klasse der har information brugt til at placere et billede
class boat{
    constructor(point, src){
        this.point = point;
        this.img = new Image();
        this.img.src = src;
    }
}

// Funktion til at skabe canvas elementer
function component(width, height, color, x, y){
    this.width = width;
    this.height = height;
    this.color = color;
    this.x = x;
    this.y = y;
}

// Et loop der kører 5 gange.
// For hvert loop oprettes en klasse og et objekt
for (let i = 0; i < 5; i++) {
    components.push(new component(750, 100, "blue", 0, i*70, "background"))
    boatobjects.push(new boat(teams[i].getAttribute("points"), teams[i].getAttribute("imgsrc")));
}

// Funktion der "tegner" på canvas
function render_race(components){
    // For hvert component i array, køres dette kode
    components.forEach(component => {
        // Tegner streger der definerer de forskellige områder i canvas
        context.beginPath();
        context.moveTo(0, component.y + 70);
        context.lineTo(canvas.width, component.y + 70);
        context.stroke();

        // For hvert område vises "pointkoordinater" for hvor mange point holdene har
        for (let i = 50; i < canvas.width; i = i+100) {
            context.font = "10px Consolas";
            context.fillStyle = "white";
            context.fillText(`${(i/10)}`, component.x + i, component.y + 67);
        }
    });

    // En funktion der først kører når alle andre elementer er blevet behandlet,
    // for at sikre at billeder bliver oprettet rigtigt
    window.onload = function(){
        // Sætter et billede for hvert holdområde i canvas
        for (let i = 0; i < boatobjects.length; i++) {
            let imgsrc = boatobjects[i].img.src;
            let imgObj = new Image();

            imgObj.src = imgsrc;
            // Sørger for at billederne skaleres ned til en passende størrelse
            imgObj.width = imgObj.width*0.09;
            imgObj.height = imgObj.height*0.09;

            // Placerer billedet passende til hvor mange point holdet har.
            // Point * 10 (for at definere en position der er relativ til canvas)
            // -18 for at lave et offset af billedet, så midten af billedet passer med hvor mange point holdet har
            
            let imgx = (boatobjects[i].point * 10) - 18;
            // Y-position ganges med 70, da højden på holdområder er 70px høje.
            // -8 for at lave et offset af billedet, så man kan se talværdierne i holdområdet.
            let imgy = i*70-8;

            // "Tegner" billedet i den angivne position med angivne dimensioner
            context.drawImage(imgObj, imgx, imgy, imgObj.width, imgObj.height);
        }
    }
}

// Tegner alle vores elementer
render_race(components);