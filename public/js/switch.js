function initializeSwitch() {
  const switchState = localStorage.getItem("parameterSwitch");
  const switchElement = document.getElementById("parameterSwitch");
  const labelElement = document.getElementById("parameterLabel");

  if (switchState === "parameter2") {
    switchElement.checked = true;
    labelElement.textContent = "Parameter 2";
  } else {
    switchElement.checked = false;
    labelElement.textContent = "Parameter 1";
  }
}
