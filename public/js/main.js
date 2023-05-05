$(document).ready(function() {
  const showCommentsButtons = $('.show-comments-button');
  const hideCommentsButtons = $('.hide-comments-button');
  const BASE_URL = "http://localhost/blog";

  showCommentsButtons.each(function() {
    $(this).attr('data-comments-offset', 0);
  });

  showCommentsButtons.click(function() {
    const button = $(this);
    const postId = button.closest('article').find('.post-comments').data('post-id');
    const offset = parseInt(button.attr('data-comments-offset'));

   $.ajax({
     url: BASE_URL + "/load-more-comments/" + postId + "/" + offset,
     type: "GET",
     dataType: "json",
     success: function (comments) {
       const commentsDiv = button.closest("article").find(".post-comments");
       const commentsList = commentsDiv.find("ul");
       if (!commentsList.length) {
         commentsDiv.append("<h3>Commentaires :</h3>");
         commentsDiv.append("<ul>");
       }

       comments.forEach(function (comment) {
         commentsDiv.find("ul").append("<li>" + comment.body + "</li>");
       });

       button.attr("data-comments-offset", offset + 2);
     },
     error: function (jqXHR, textStatus, errorThrown) {
       console.error("Erreur:", errorThrown);
     },
   });
  });

  hideCommentsButtons.click(function() {
    const commentsDiv = $(this).closest('article').find('.post-comments');
    commentsDiv.find('ul').remove();
    commentsDiv.find('h3').remove();
    $(this).closest('article').find('.show-comments-button').attr('data-comments-offset', 0);
  });

});

    // document.addEventListener('DOMContentLoaded', function() {
    //   const showCommentsButtons = document.querySelectorAll('.show-comments-button');
    //   const hideCommentsButtons = document.querySelectorAll('.hide-comments-button');
    //   const commentButtons = document.querySelectorAll('.comment-button');
    //   const commentForms = document.querySelectorAll('.comment-form');

    //   // Écouteur d'événement pour le bouton "Afficher les commentaires"
    //   showCommentsButtons.forEach(function(button) {
    //     button.addEventListener('click', function() {
    //       const commentsDiv = button.closest('article').querySelector('.post-comments');
    //       commentsDiv.classList.remove('hidden');
    //       button.classList.add('hidden');
    //       button.nextElementSibling.classList.remove('hidden');
    //     });
    //   });

    //   // Écouteur d'événement pour le bouton "Cacher les commentaires"
    //   hideCommentsButtons.forEach(function(button) {
    //     button.addEventListener('click', function() {
    //       const commentsDiv = button.closest('article').querySelector('.post-comments');
    //       commentsDiv.classList.add('hidden');
    //       button.classList.add('hidden');
    //       button.previousElementSibling.classList.remove('hidden');
    //     });
    //   });

    //   // Écouteur d'événement pour la soumission des formulaires de commentaire
    //   commentForms.forEach(function(form) {
    //     form.addEventListener('submit', function(event) {
    //       event.preventDefault();

    //       const postId = form.querySelector('input[name="post_id"]').value;
    //       const email = form.querySelector('input[name="email"]').value;
    //       const body = form.querySelector('textarea[name="body"]').value;

    //       const formData = new FormData();
    //       formData.append('post_id', postId);
    //       formData.append('email', email);
    //       formData.append('body', body);

    //      fetch(BASE_URL + "/add-comment", {
    //        method: "POST",
    //        body: formData,
    //      })
    //        .then((response) => {
    //          if (response.ok) {
    //            return response.text();
    //          } else {
    //            throw new Error("Erreur lors de l'ajout du commentaire");
    //          }
    //        })
    //        .then((data) => {
    //          const commentsDiv = document.querySelector(
    //            `.post-comments[data-post-id="${postId}"]`
    //          );
    //          const newComment = document.createElement("li");
    //          newComment.textContent = body;
    //          commentsDiv.querySelector("ul").appendChild(newComment);

    //          form.querySelector('textarea[name="body"]').value = "";
    //          form.classList.add("hidden");
    //        })
    //        .catch((error) => {
    //          console.error("Erreur:", error);
    //        });
    //     });
    //   });
    // });

