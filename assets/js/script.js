// User actions
function deleteUser(userId) {
  if(confirm("Are you sure you want to delete this user?")) {
    window.location.href = 'action-user.php?delete=' + userId + '';
    return true;
  }
}
function banUser(userId) {
  if(confirm("Are you sure you want to ban this user?")) {
    window.location.href = 'action-user.php?ban=' + userId + '';
    return true;
  }
}
function prevUser(curPage) {
  window.location.href = 'user.php?page=' + (curPage - 1) + '';
  return true;
}
function nextUser(curPage) {
  window.location.href = 'user.php?page=' + (curPage + 1) + '';
  return true;
}

// File upload btn new post
const fileInput = document.getElementById("image-input");
const imageBtn = document.getElementById("image-button");
const imageText = document.getElementById("image-text");
const thumbnailInput = document.getElementById("thumbnail-input");
const thumbBtn = document.getElementById("thumbnail-button");
const thumbText = document.getElementById("thumbnail-text");
// const thumbnailUpload = document.getElementById("thumbnail-upload");
// const btnAddThumbnail = document.getElementById("btn-add-thumbnail");

imageBtn.addEventListener("click", () => {
  fileInput.click();
});
fileInput.addEventListener("change", () => {
  if(fileInput.value) {
    imageText.innerHTML = fileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
  } else {
    imageText.innerHTML = "No file chosen!";
  }
});

thumbBtn.addEventListener("click", () => {
  thumbnailInput.click();
});
thumbnailInput.addEventListener("change", () => {
  if(thumbnailInput.value) {
    thumbText.innerHTML = thumbnailInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
  } else {
    thumbText.innerHTML = "No file chosen!";
  }
});
btnAddThumbnail.addEventListener("click", () => {
  thumbnailUpload.click();
});

// Post action
function deletePost(postId) {
  if(confirm("Are you sure you want to delete this post?")) {
    window.location.href = 'action-post.php?delete=' + postId + '';
    return true;
  }
}
function banPost(postId) {
  if(confirm("Are you sure you want to ban this post?")) {
    window.location.href = 'action-post.php?ban=' + postId + '';
    return true;
  }
}

// File upload btn edit post
// const fileEdit = document.getElementById("image-edit");
// const imageBtnEdit = document.getElementById("image-btn-edit");
// const imageTextEdit = document.getElementById("image-text-edit");
// const thumbnailEdit = document.getElementById("thumbnail-edit");
// const thumbBtnEdit = document.getElementById("thumbnail-btn-edit");
// const thumbTextEdit = document.getElementById("thumbnail-text-edit");
// const thumbnailUploadEdit = document.getElementById("thumbnail-upload-edit");
// const btnEditThumbnail = document.getElementById("btn-edit-thumbnail");

// imageBtnEdit.addEventListener("click", () => {
//   fileEdit.click();
// });
// fileEdit.addEventListener("change", () => {
//   if(fileEdit.value) {
//     imageTextEdit.innerHTML = fileEdit.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
//   } else {
//     imageTextEdit.innerHTML = "No file chosen!";
//   }
// });

// thumbBtnEdit.addEventListener("click", () => {
//   thumbnailEdit.click();
// });
// thumbnailEdit.addEventListener("change", () => {
//   if(thumbnailEdit.value) {
//     thumbTextEdit.innerHTML = thumbnailEdit.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
//   } else {
//     thumbTextEdit.innerHTML = "No file chosen!";
//   }
// });
// btnEditThumbnail.addEventListener("click", () => {
//   thumbnailEdit.click();
// });