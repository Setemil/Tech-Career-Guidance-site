const loginDiv = document.querySelector(".loginPane");
const signinDiv = document.querySelector(".signUpPane");
const moveButton = document.getElementById("moveButton");

moveButton.addEventListener("click", function () {
  const innerDiv = document.querySelector(".inner-div");
  const currentLeft = getComputedStyle(innerDiv).left;

  if (currentLeft === "0px") {
    // Move to right, change button text to "Create Account"
    innerDiv.style.left = "600px";
    moveButton.textContent = "Log Back In";
    loginDiv.classList.remove("fade-in");
    loginDiv.classList.add("hidden");

    setTimeout(() => {
      signinDiv.classList.remove("hidden");
      signinDiv.classList.add("fade-in");
    }, 500);
  } else {
    // Move to left, change button text to "Log Back In"
    innerDiv.style.left = "0";
    moveButton.textContent = "Create Account";
    signinDiv.classList.remove("fade-in");
    signinDiv.classList.add("hidden");

    setTimeout(() => {
      loginDiv.classList.remove("hidden");
      loginDiv.classList.add("fade-in");
    }, 500);
  }
});