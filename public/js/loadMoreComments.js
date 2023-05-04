document.querySelectorAll(".show-more-content").forEach((button) => {
  button.addEventListener("click", (event) => {
    const content = event.target.parentElement.querySelector(".post-content");
    content.querySelector("p.hidden").classList.remove("hidden");
    event.target.style.display = "none";
    event.target.nextElementSibling.style.display = "inline-block";
  });
});

document.querySelectorAll(".hide-content").forEach((button) => {
  button.addEventListener("click", (event) => {
    const content = event.target.parentElement.querySelector(".post-content");
    content
      .querySelector("p:not(.hidden)")
      .nextElementSibling.classList.add("hidden");
    event.target.style.display = "none";
    event.target.previousElementSibling.style.display = "inline-block";
  });
});

// document.querySelectorAll(".load-more-comments").forEach((button) => {
//   button.addEventListener("click", (event) => {
//     const postId = event.target.getAttribute("data-post-id");
//     const currentComments =
//       event.target.parentElement.querySelectorAll(".comment").length;
//     const url = `/posts/${postId}/comments/load-more/${currentComments}`;

//     fetch(url)
//       .then((response) => response.json())
//       .then((comments) => {
//         comments.forEach((comment) => {
//           const commentElement = document.createElement("div");
//           commentElement.classList.add("comment");
//           commentElement.innerHTML = `
//               <p><strong>${comment.name}:</strong></p>
//               <p>${comment.body}</p>
//               <hr>
//             `;
//           event.target.parentElement.insertBefore(commentElement, event.target);
//         });

//         if (comments.length < 2) {
//           event.target.style.display = "none";
//         }
//       });
//   });
// });


// var offset = <?= count($comments) ?>;
//   var limit = <?= $limit ?>;

//   document.getElementById('load-more').addEventListener('click', function() {
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '/comments/load-more?post_id=<?= $post->getId() ?>&limit=' + limit + '&offset=' + offset);
//     xhr.onload = function() {
//       var newComments = JSON.parse(xhr.responseText);
//       var commentsDiv = document.getElementById('comments');

//       // Ajoutez les nouveaux commentaires à la fin de la liste de commentaires
//       newComments.forEach(function(comment) {
//         var commentDiv = document.createElement('div');
//         commentDiv.className = 'comment';
//         commentDiv.innerHTML = '<p class="name">' + comment.name + '</p><p class="body">' + comment.body + '</p>';
//         commentsDiv.insertBefore(commentDiv, document.getElementById('load-more'));
//       });

//       offset += newComments.length;

//       // Si tous les commentaires ont été chargés, supprimez le bouton "Voir plus"
//       if (offset >= <?= $totalComments ?>) {
//         document.getElementById('load-more').remove();
//       }
//     };
//     xhr.send();
//   });