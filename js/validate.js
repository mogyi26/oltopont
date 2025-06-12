function validateForm() {
    const name = document.forms[0]["name"].value.trim();
    const email = document.forms[0]["email"].value.trim();
    const message = document.forms[0]["message"].value.trim();
    if (name === "" || email === "" || message === "") {
        alert("Minden mező kitöltése kötelező.");
        return false;
    }
    return true;
}