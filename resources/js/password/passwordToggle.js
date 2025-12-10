export const initPassword = () => {
    window.passwordToggle = function () {
        const passwordInput = document.querySelector('input[name="password"]');
        const toggleBtn = document.querySelector(".eye-toggle");

        if (!passwordInput || !toggleBtn) {
            return;
        }

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleBtn.classList.remove("bi-eye");
            toggleBtn.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleBtn.classList.remove("bi-eye-slash");
            toggleBtn.classList.add("bi-eye");
        }
    }
}
