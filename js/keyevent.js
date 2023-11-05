// Possibilatar envio com SHIFT+ENTER

const textarea = document.querySelector("textarea");
const submit = document.querySelector("input[type='submit']");

textarea.addEventListener("keypress", function(e) {
  if (e.shiftKey && e.key === "Enter") {
    e.preventDefault();
    submit.click();
  }
});