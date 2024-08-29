// Modal

const openModal = document.querySelector("#openModal");
const closeModal = document.querySelector("#closeModal");
const modal = document.querySelector("dialog");

openModal.addEventListener("click", function () {
  modal.showModal();
});

closeModal.addEventListener("click", function () {
  modal.close();
});