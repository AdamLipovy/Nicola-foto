var lock = false
function showimage(path){
  var put = document.getElementById("fullImg");
  put.className = "fullimg"
  put.innerHTML = '<img src="' + path + '">';
  var background = document.getElementById("all")
  background.style.opacity = "0.2"
  document.querySelector('body').css = "margin: 0; height: 100%; overflow: hidden";
  put.onclick = removeImage;
}

function removeImage() {
  var put = document.getElementById("fullImg");
  put.innerHTML = '';
  put.className = "";
  var background = document.getElementById("all");
  background.style.opacity = "1";
  lock = false
}