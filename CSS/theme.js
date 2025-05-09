document.addEventListener("DOMContentLoaded", function() {
  var savedMode = localStorage.getItem("mode") || "light";
  
  if (savedMode === "dark") {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  var modeSelect = document.getElementById("selectTheme");
  if (modeSelect) {
    modeSelect.value = savedMode;
  }
});

function theme() {
  var element = document.body;
  var mode = document.getElementById("selectTheme").value;

  if (mode === "dark") {
    element.classList.add("dark-mode");
    localStorage.setItem("mode", "dark");
  } else {
    element.classList.remove("dark-mode");
    localStorage.setItem("mode", "light");
  }
}