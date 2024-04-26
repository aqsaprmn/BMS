$(document).ready(function () {
    const passwordEyesPar = $("#password-eyes");
    const inputEyes = passwordEyesPar.find("input#password");
    const iconEyes = passwordEyesPar.find("span#icon-eyes");

    iconEyes.click(function (e) {
        e.preventDefault();

        const typeInputEyes = inputEyes.attr("type");

        if (typeInputEyes == "password") {
            iconEyes.removeClass("bi-eye");
            iconEyes.addClass("bi-eye-slash");

            inputEyes.attr("type", "text");
        } else {
            iconEyes.removeClass("bi-eye-slash");
            iconEyes.addClass("bi-eye");

            inputEyes.attr("type", "password");
        }
    });
});
