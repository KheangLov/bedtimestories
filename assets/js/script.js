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