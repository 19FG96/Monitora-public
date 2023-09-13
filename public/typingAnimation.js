// typingAnimation.js

function typingEffect(element, text, speed) {
    let index = 0;

    function type() {
        if (index < text.length) {
            element.innerHTML += text.charAt(index);
            index++;
            setTimeout(type, speed);
        }
    }

    type();
}

document.addEventListener("DOMContentLoaded", function () {
    const subheading = document.querySelector(".subheading");
    const text = subheading.innerHTML;
    subheading.innerHTML = ""; // Clear the text initially

    typingEffect(subheading, text, 100); // Adjust the speed as needed (milliseconds)
});
