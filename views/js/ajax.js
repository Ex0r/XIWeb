function checkUsername(username) { 
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        if (xmlhttp.responseText = 'available') {
          document.getElementById("username").addClass("has-success");
        }
        else {
          document.getElementById("username").addClass("has-alert");
        }
      }
  };
  xmlhttp.open("GET","includes/ajax.php?a=getuser&v="+str,true);
  xmlhttp.send();
}