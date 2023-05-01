
  // let commentsOffset = 2;
  // const commentsLimit = 2;
  // const postId = <?= $post->getId() ?>;

  // document.getElementById("load-more-comments").addEventListener("click", function () {
  //   fetch(`/load_more_comments.php?post_id=${postId}&offset=${commentsOffset}&limit=${commentsLimit}`)
  //     .then(response => response.json())
  //     .then(data => {
  //       const commentsContainer = document.querySelector(".comments-container");

  //       data.forEach(comment => {
  //         const commentDiv = document.createElement("div");
  //         commentDiv.classList.add("comment");

  //         const commentText = document.createElement("p");
  //         commentText.textContent = `${comment.author_name}: ${comment.text}`;

  //         commentDiv.appendChild(commentText);
  //         commentsContainer.appendChild(commentDiv);
  //       });

  //       commentsOffset += commentsLimit;
  //     })
  //     .catch(error => {
  //       console.error("Error fetching comments:", error);
  //     });
  // });
