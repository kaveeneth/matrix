const canvas = document.getElementById("matrixCanvas");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()";
const charArray = characters.split("");
const fontSize = 16;
const columns = Math.floor(canvas.width / fontSize);
const drops = Array.from({ length: columns }, () => ({ y: 1, headBright: true }));

// Matrix rain animation
function drawMatrixRain() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    drops.forEach((drop, x) => {
        const text = charArray[Math.floor(Math.random() * charArray.length)];

        if (drop.headBright) {
            ctx.fillStyle = "#FFF";
            ctx.font = `${fontSize}px monospace`;
            ctx.fillText(text, x * fontSize, drop.y * fontSize);

            drop.headBright = false;
        } else {
            ctx.fillStyle = "#0F0";
            ctx.font = `${fontSize}px monospace`;
            ctx.fillText(text, x * fontSize, drop.y * fontSize);
        }


        drop.y++;

        if (drop.y * fontSize > canvas.height && Math.random() > 0.975) {
            drop.y = 0; // Reset position
            drop.headBright = true;
        }
    });
}

// Form toggle logic
function showRegister() {
    document.getElementById("loginForm").style.display = "none";
    document.getElementById("registerForm").style.display = "block";
}

function showLogin() {
    document.getElementById("registerForm").style.display = "none";
    document.getElementById("loginForm").style.display = "block";
}

setInterval(drawMatrixRain, 50);
