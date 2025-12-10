export const initPassword = () => {
    window.passwordToggle = function (button) {
        // get the selectors
        const wrapper = button.closest('.position-relative');
        const passwordInput = wrapper.querySelector('input[type="password"], input[type="text"]');
        const toggleBtn = wrapper.querySelector(".eye-toggle");

        // prevent the js to crash on pages that doesnt have these consts
        if (!passwordInput || !toggleBtn) {
            return;
        }

        // if the input type is password and you toggle show password as text type
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleBtn.classList.remove("bi-eye");
            toggleBtn.classList.add("bi-eye-slash");
        } else {
            // if the input type is password and you toggle hide password as password type
            passwordInput.type = "password";
            toggleBtn.classList.remove("bi-eye-slash");
            toggleBtn.classList.add("bi-eye");
        }
    }
}
