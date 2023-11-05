// Configurar cookies

const postInput = document.getElementById("post-input");
const commentForm = document.getElementById("comment-form");
let username = "";

commentForm.addEventListener("submit", function () {
  setCookie("username", postInput.value);
});

document.addEventListener("DOMContentLoaded", function () {
  username = getCookie("username");
  postInput.value = username || "";
});

function setCookie(name, value) {
  document.cookie = `${name}=${value}`;
}

function getCookie(name) {
  const cookie = document.cookie.match(new RegExp(`${name}=([^;]+)`));
  return cookie ? decodeURIComponent(cookie[1]) : "";
}
