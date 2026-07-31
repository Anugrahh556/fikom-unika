// LOGIN
const loginForm = document.getElementById("loginForm");
const loginCard = document.querySelector(".login-card");

loginForm.addEventListener("submit", function (e) {
    e.preventDefault();

    loginCard.style.transform = "scale(0.96)";
    loginCard.style.opacity = "0";

    setTimeout(() => {
        // Mengizinkan form untuk benar-benar di-submit ke backend (AuthController)
        loginForm.submit();
    }, 500);
});
