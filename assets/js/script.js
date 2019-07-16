$(document).ready(function(){
  // AJAX search
  $("#search-text").keyup(function() {
    var search = $(this).val();
    $.ajax({
      url: 'search-user.php',
      method: 'post',
      data: {query: search},
      success: function(response) {
        $('#table-data').html(response);
      }
    });
  });
  $("#search-category").keyup(function() {
    var search = $(this).val();
    $.ajax({
      url: 'search-category.php',
      method: 'post',
      data: {query: search},
      success: function(response) {
        $('#table-category').html(response);
      }
    });
  });
  $("#search-post").keyup(function() {
    var search = $(this).val();
    var role_name = $("#user_role").val();
    var id = $("#user_id").val();
    $.ajax({
      url: 'search-post.php',
      method: 'post',
      data: {query: search, role: role_name, id: id},
      success: function(response) {
        $('#table-post').html(response);
      }
    });
  });
  $('.name_inline_edit').editable({
    mode: 'inline',
    url: 'inline-edit.php',
    title: 'Enter name'
  });
  $('[data-toggle="tooltip"]').tooltip();
});

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
function prevCate(curPage) {
  window.location.href = 'category.php?page=' + (curPage - 1) + '';
  return true;
}
function nextCate(curPage) {
  window.location.href = 'category.php?page=' + (curPage + 1) + '';
  return true;
}

let toggle = false;
const btnSidebarOpen = document.getElementById("long-sidebar");
const btnSidebarClose = document.getElementById("toggle-sidebar");
const sidebarMain = document.getElementById("sidebar-main");
const sidebarUlLi = document.getElementsByClassName("sidebar-li");
const sidebarImg = document.getElementById("sidebar-img");
const sidebarTitle = document.getElementById("sidebar-title");
const sidebarTextLink = document.getElementsByClassName("sidebar-text-link");
const sidebarFontAwesome = document.getElementsByClassName("icon-script");
const mainWrapper = document.getElementById("site-wrapper");
function btnSidebarToggleIn() {
  sidebarMain.style.width = "90px";
  btnSidebarOpen.style.display = "inline";
  btnSidebarClose.style.display = "none";
  sidebarImg.style.display = "inline";
  sidebarTitle.style.display = "none";
  for(i = 0; i < sidebarUlLi.length; i++) {
    sidebarUlLi[i].style.marginLeft = "17px";
  }
  for(j = 0; j < sidebarTextLink.length; j++) {
    sidebarTextLink[j].style.display = "none";
  }
  for(k = 0; k < sidebarFontAwesome.length; k++) {
    sidebarFontAwesome[k].style.fontSize = "24px";
  }
  mainWrapper.style.width = "calc(100% - 90px)";
  toggle = true;
}
function btnSidebarToggleOut() {
  sidebarMain.style.width = "260px";
  btnSidebarOpen.style.display = "none";
  btnSidebarClose.style.display = "inline";
  sidebarImg.style.display = "none";
  sidebarTitle.style.display = "block";
  for (i = 0; i < sidebarUlLi.length; i++) {
    sidebarUlLi[i].style.marginLeft = "30px";
  }
  for (j = 0; j < sidebarTextLink.length; j++) {
    sidebarTextLink[j].style.display = "inline";
  }
  for(k = 0; k < sidebarFontAwesome.length; k++) {
    sidebarFontAwesome[k].style.fontSize = "18px";
  }
  mainWrapper.style.width = "calc(100% - 260px)";
  toggle = false;
}
btnSidebarOpen.addEventListener("load", () => {
  if(toggle === true) {
    function btnSidebarToggleIn() {
      sidebarMain.style.width = "90px";
      btnSidebarOpen.style.display = "inline";
      btnSidebarClose.style.display = "none";
      sidebarImg.style.display = "inline";
      sidebarTitle.style.display = "none";
      for(i = 0; i < sidebarUlLi.length; i++) {
        sidebarUlLi[i].style.marginLeft = "17px";
      }
      for(j = 0; j < sidebarTextLink.length; j++) {
        sidebarTextLink[j].style.display = "none";
      }
      for(k = 0; k < sidebarFontAwesome.length; k++) {
        sidebarFontAwesome[k].style.fontSize = "24px";
      }
      mainWrapper.style.width = "calc(100% - 90px)";
      toggle = true;
    }
  } else {
    function btnSidebarToggleOut() {
      sidebarMain.style.width = "260px";
      btnSidebarOpen.style.display = "none";
      btnSidebarClose.style.display = "inline";
      sidebarImg.style.display = "none";
      sidebarTitle.style.display = "block";
      for (i = 0; i < sidebarUlLi.length; i++) {
        sidebarUlLi[i].style.marginLeft = "30px";
      }
      for (j = 0; j < sidebarTextLink.length; j++) {
        sidebarTextLink[j].style.display = "inline";
      }
      for(k = 0; k < sidebarFontAwesome.length; k++) {
        sidebarFontAwesome[k].style.fontSize = "18px";
      }
      mainWrapper.style.width = "calc(100% - 260px)";
      toggle = false;
    }
  }
});

// File upload btn new post
const fileInput = document.getElementById("image-input");
const imageBtn = document.getElementById("image-button");
const imageText = document.getElementById("image-text");
const thumbnailInput = document.getElementById("thumbnail-input");
const thumbBtn = document.getElementById("thumbnail-button");
const thumbText = document.getElementById("thumbnail-text");
const profileInput = document.getElementById("profile-input");
const profileBtn = document.getElementById("profile-button");
const profileText = document.getElementById("profile-text");

if(profileBtn != null) {
  profileBtn.addEventListener("click", () => {
    profileInput.click();
  });
  profileInput.addEventListener("change", () => {
    if(profileInput.value) {
      profileText.innerHTML = profileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
      profileText.innerHTML = "No file chosen!";
    }
  });
}

if(imageBtn != null) {
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
}

if(thumbBtn != null) {
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
}

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

// Category action
function deleteCate(cateId) {
  if(confirm("Are you sure you want to delete this category?")) {
    window.location.href = 'action-category.php?delete=' + cateId + '';
    return true;
  }
}

// Remove readonly update profile
const formInput = document.getElementsByClassName('input-rev-read');
const btnUpdatePro = document.getElementById('btn-update-profile-no-readonly');
const btnUpdateProReadOnly = document.getElementById('btn-update-profile-readonly');
const btnProImg = document.getElementById('btn-upload-pro-img');
const btnEditPro = document.getElementById('btn-editpro-display');
const roleInput = document.getElementById('pro-role-input');
const roleSelect = document.getElementById('role-select');
const quoteInput = document.getElementById('quote-input');
const quoteText = document.getElementById('quote');
if(btnUpdatePro != null) {
  btnUpdatePro.addEventListener("click", () => {
    for(i=0; i<formInput.length; i++) {
      formInput[i].removeAttribute('disabled');
    }
    btnEditPro.style.display = 'inline';
    roleInput.style.display = 'none';
    roleSelect.style.display = 'inline';
    btnUpdatePro.style.display = 'none';
    btnUpdateProReadOnly.style.display = 'inline';
    btnProImg.removeAttribute('hidden');
    quoteInput.removeAttribute('hidden');
    quoteText.setAttribute('hidden', 'hidden');
  });
}
if(btnUpdateProReadOnly != null) {
  btnUpdateProReadOnly.addEventListener("click", () => {
    for(j=0; j<formInput.length; j++) {
      formInput[j].setAttribute('disabled', 'disabled');
    }
    btnEditPro.style.display = 'none';
    roleInput.style.display = 'inline';
    roleSelect.style.display = 'none';
    btnUpdatePro.style.display = 'inline';
    btnUpdateProReadOnly.style.display = 'none';
    btnProImg.setAttribute('hidden', 'hidden');
    quoteInput.setAttribute('hidden', 'hidden');
    quoteText.removeAttribute('hidden');
  });
}
// if(btnEditPro != null) {
//   btnEditPro.addEventListener("click", () => {
//     for(k=0; k<formInput.length; k++) {
//       formInput[k].setAttribute('readonly', 'readonly');
//     }
//     btnEditPro.style.display = 'none';
//     roleInput.style.display = 'inline';
//     roleSelect.style.display = 'none';
//     btnUpdateProReadOnly.setAttribute("id", "btn-update-profile-no-readonly");
//   });
// }

// const editCate = document.getElementById("edit-category");
// const btnAddCate = document.getElementById("btn-add-cate");
// const btnEditCate = document.getElementById("btn-edit-cate");
// if(editCate != null) {
//   editCate.addEventListener("click", () => {
//     btnAddCate.setAttribute("id", "hide-edit-btn");
//     btnEditCate.setAttribute("id", "show-edit-btn");
//   });
// }
function numberOnly(evt) {
  var ch = String.fromCharCode(evt.which);
  if(!(/[0-9]/).test(ch)) {
    evt.preventDefault();
  }
}
