// Atualizar a vizualização dos posts a cada .1 segundos

function getPosts() {
  fetch('./actions/posts.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById("posts").innerHTML = data;
    })
    .catch(error => console.log(error));
}

setInterval(function() {
  getPosts();
}, 100);
