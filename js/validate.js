const info = document.getElementById("info");

document.getElementById("submit").addEventListener("click", (event) => {
    let ok = true;
    let messages = [];

    document.querySelectorAll("input[type=text], input[type=password], input[type=number]").forEach(element => {
        if (element.value.trim() === "") {
            ok = false;
            messages.push(`Pole "${element.previousElementSibling.innerText}" nie może być puste.`);
        }
    });

    const pass1 = document.getElementById("haslo");
    const pass2 = document.getElementById("haslo2");

    if (pass1.value !== pass2.value) {
        ok = false;
        messages.push("Hasła są różne!");
    }

    if (pass1.value.length < 8) {
        ok = false;
        messages.push("Hasło musi mieć co najmniej 8 znaków.");
    }

    if (pass1.value.length > 72) {
        ok = false;
        messages.push("Hasło nie może mieć więcej niż 72 znaki.");
    }

    const plec = document.querySelector('input[name="plec"]:checked');
    if (!plec) {
        ok = false;
        messages.push("Wybierz swoją płeć.");
    }

    const kod = document.getElementById("kod").value.trim();
    if (!/^\d{2}-\d{3}$/.test(kod)) {
        ok = false;
        messages.push("Kod pocztowy musi mieć format XX-XXX.");
    }

    if (!ok) {
        event.preventDefault();
        info.innerHTML = messages.join("<br>");
        info.style.color = "red";
    } else {
        info.innerHTML = "Wszystko OK!";
        info.style.color = "green";
    }
});
