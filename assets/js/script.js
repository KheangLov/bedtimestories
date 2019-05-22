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