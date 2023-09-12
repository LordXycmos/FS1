var month = ["January", "Febuary", "March", "April"];
var option = "";

for (var i = 0; i < month.length; i++) {
  option += '<option value"' + month[i] + '">' + month[i] + "</option>";
}
document.getElementById("month").innerHTML = option;
document.getElementById("month2").innerHTML = option;
