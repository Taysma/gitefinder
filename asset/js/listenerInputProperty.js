

// card modifi en direct 
document.addEventListener('DOMContentLoaded', function () {
    let inputNames = document.querySelectorAll('.name-edit');
    let h1Elements = document.querySelectorAll('.h1-complete-edit');
    let inputAddresses = document.querySelectorAll('.address-edit');
    let spanCities = document.querySelectorAll('.city-edit');
    let inputPrinces = document.querySelectorAll('.input-prince');
    let pPrinces = document.querySelectorAll('.prince-edit');

    inputNames.forEach((inputName, index) => {
        inputName.addEventListener('input', function () {
            h1Elements[index].innerHTML = inputName.value;
        });
    });

    inputPrinces.forEach((inputPrince, index) => {
        inputPrince.addEventListener("input", function () {
            pPrinces[index].innerHTML = inputPrince.value + "€";
        });
    });

    inputAddresses.forEach((inputAddress, index) => {
        inputAddress.addEventListener("input", function () {
            spanCities[index].innerHTML = inputAddress.value;
        });

        inputAddress.addEventListener("change", function () {
            spanCities[index].innerHTML = inputAddress.value;
        });

        inputAddress.addEventListener("blur", function () {
            spanCities[index].innerHTML = inputAddress.value;
        });
    });
});




// document.addEventListener('DOMContentLoaded', function () {
//     let heartDiv = document.getElementById('heart-kr');
//     let isFilled = false;

//     heartDiv.addEventListener('click', function () {
//         isFilled = !isFilled;
//         animateHeart(isFilled);
//     });

//     function animateHeart(isFilled) {
//         let totalFrames = 28;
//         let frames = Math.floor(totalFrames / 2); // Half of total frames
//         let interval = 1000 / frames;

//         let currentFrame = 0;
//         let position = isFilled ? - currentFrame * 100 : 0;

//         let animation = setInterval(function () {
//             heartDiv.style.backgroundPosition = `${position}px 0`;
//             currentFrame++;

//             if (currentFrame >= frames) {
//                 clearInterval(animation);
//             }

//             position = isFilled ? - currentFrame * 100 : 0;
//         }, interval);
//     }
// });



document.addEventListener('DOMContentLoaded', function () {
    let hearts = document.querySelectorAll('.heart-kr');

    hearts.forEach(heart => {
        setupHeart(heart);
    });

    function setupHeart(heart) {
        let isFilled = false;

        heart.addEventListener('click', function () {
            isFilled = !isFilled;
            animateHeart(heart, isFilled);
        });

        function animateHeart(heartElement, isFilled) {
            let totalFrames = 28;
            let frames = Math.floor(totalFrames / 2);
            let interval = 1000 / frames;

            let currentFrame = 0;
            let position = isFilled ? -currentFrame * 100 : 0;

            let animation = setInterval(function () {
                heartElement.style.backgroundPosition = `${position}px 0`;
                currentFrame++;

                if (currentFrame >= frames) {
                    clearInterval(animation);
                }

                position = isFilled ? -currentFrame * 100 : 0;
            }, interval);
        }
    }
});