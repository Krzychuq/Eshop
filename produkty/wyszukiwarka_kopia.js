function wyszukanie(slowo) {
    if (slowo.length == 0) {
      document.getElementById("wyniki").style.opacity = "0";
      document.getElementById("wyniki").innerHTML = "";
      return;
    } 
    else {
      document.getElementById("wyniki").style.opacity = "1";
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("wyniki").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "wyszukiwarka_kopia.php?q=" + slowo, true);
      xmlhttp.send();
    }
  }
  
  
  