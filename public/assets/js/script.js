window.onload = () => {
  setInterval(getTime, 1000);
  try {
      hideCalendar();
    } catch (error) {
      console.log(error);
    }
    try {
      showHistory();
    } catch (error) {
      console.log(error);
    }
    try {
      setModal();
    } catch (error) {
      console.log(error);
    }
    saveHistory(document.title);
}

// task 1.a implementation start
function onMouseOverImage(tag) {
  if(tag.getAttribute("name")!=document.title)
  {
      let image = tag.firstElementChild.firstElementChild;
      image.src = "../../public/assets/img/2.jpg";
  }
  if(tag.getAttribute("name")=="Мои интересы"){
      showDropdown()
  }
}

function onMouseOutImage(tag) {
  let image = tag.firstElementChild.firstElementChild;
  image.src = "../../public/assets/img/1.jpg";
  if(tag.getAttribute("name")=="Мои интересы"){
      showDropdown()
  }
}
// task 1.a implementation end

// task 1.b implementation start
function showDropdown() {
  document.getElementsByClassName("interests-dropdown")[0].classList.toggle("show");
}
// task 1.b implementation end

// task 2 implementation start
function getTime() {
  function getCurrentTimeString() {
      return new Date().toTimeString().replace(/ .*/, '');
  }

  let today = new Date();
  let dateTime = `DATE: ${today.getDate()}.${today.getMonth() + 1}.${today.getFullYear()} (${getCurrentTimeString()})`;
  let time = document.getElementById("time");
  time.textContent = dateTime;
}
// task 2 implementation end

//task 3
function showCalendar(date) {
  document.getElementById("dateOfBirth").style.display = 'none';
  var yearSelect = document.getElementById("year");
  var monthSelect = document.getElementById("month");
  yearSelect.style.display = 'inline';
  monthSelect.style.display='inline';
  var week = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
  var daysInMonth;

  document.getElementById("calendar").style.display = 'inline';
  if (yearSelect.options.length == 0) {
      for (var year = 1900; year < date.getFullYear() + 1; year++) {
          var option = new Option();
          option.text = year;
          option.value = year;
          yearSelect.add(option);
      }
      var months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
      for (var i = 0; i < 12; i++) {
          var option = new Option();
          option.text = months[i];
          option.value = i;
          monthSelect.add(option);
      }
      yearSelect.options[date.getFullYear() - 1900].selected = true;
      monthSelect.options[date.getMonth()].selected = true;
  } else {
      document.getElementById("calendar").removeChild(document.getElementById("days"));
      var month = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
      var year = document.getElementById("year").options[document.getElementById("year").selectedIndex].value;
      date = new Date(year, month, 1);
  }
  var table = document.createElement("table");
  table.setAttribute('id', 'days');
  document.getElementById("calendar").appendChild(table);

  var daysCount = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

  if ((date.getMonth() == 1) && (date.getFullYear() % 4 == 0))
      daysInMonth = 29;
  else
      daysInMonth = daysCount[date.getMonth()];
  tr = document.createElement("tr");
  table.appendChild(tr);

  for (i = 0; i < 7; i++) {
      var td = document.createElement("td");
      tr.appendChild(td);
      td.innerHTML = week[i];
  }
  var datetemp = new Date(date.getFullYear(), date.getMonth(), 1);
  var empty = datetemp.getDay();
  var tr = document.createElement("tr");
  table.appendChild(tr);

  for (i = 0; i < empty; i++) {
      var td = document.createElement("td");
      tr.appendChild(td);
  }

  var currentDay = 1;

  for (i = empty; i < 7; i++) {
      var td = document.createElement("td");
      tr.appendChild(td);
      td.innerHTML = currentDay.toString();
      td.setAttribute("id", currentDay+"");
      td.setAttribute("onclick", "setDate(" + (currentDay + "") + ");");
      currentDay++;
  }
  var count = 7;
  while (currentDay <= daysInMonth) {
      if (count == 7) {
          var tr = document.createElement("tr");
          table.appendChild(tr);
          count = 0;
      }
      count++;
      var td = document.createElement("td");
      tr.appendChild(td);
      td.setAttribute("onclick", "setDate(" + (currentDay + "") + ");");
      td.setAttribute("id", currentDay+"");
      td.innerHTML = currentDay.toString();
      currentDay++;
  }
  for (i = count; i < 7; i++) {
      var td = document.createElement("td");
      tr.appendChild(td);
  }
  if (document.getElementById("dateOfBirth").value != ""){
      var regExp = /(\d+)/;
      var cur = document.getElementById("dateOfBirth").value;
      document.getElementById(regExp.exec(cur)[0]).style.backgroundColor = "#FF6347";
  } else {
      date = new Date();
      document.getElementById(date.getDate() + 1).style.backgroundColor = "#FF6347";
  }

}

function redrawCalendar() {
  var month = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
  var year = document.getElementById("year").options[document.getElementById("year").selectedIndex].value;
  showCalendar(new Date(year, month, 1));
}

function setDate(day){
  var month = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
  var months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
  var year = document.getElementById("year").options[document.getElementById("year").selectedIndex].value;
  document.getElementById("dateOfBirth").value = months[month]+  " " + day + " " +  year;
  //document.getElementById("dateOfBirth").style.backgroundColor = "#44944A";
  hideCalendar();
}

function hideCalendar(){
  document.getElementById("dateOfBirth").style.display = 'block';
  document.getElementById("calendar").style.display = 'none';
}
//task 3

//task 4
var hids = ['hintName', 'hintPhone', 'hintMail'];
var hints = ['Например, Иванов Иван Иванович', 'Например, 7912344514. Номер начинается на 7 или 3', 'Например, test@gmail.com'];

function resetForm(formObj)
{
  let phpSpans = document.querySelectorAll("span");
  phpSpans.forEach((span) => {
    span.textContent = '';
  });
  formObj[0].reset();
}

//task 4

//!Task 5 - in local js script file
//task 6
function showHistory(){
  var pageTitles = [];
  const tags = document.querySelectorAll(".menu-tag");
  tags.forEach((tag) => {
      pageTitles.push(tag.getAttribute("name"));
  });
var pages = new Array('index', 'about', 'interests',  'study', 'photos', 'contacts', 'tests');
  for (var i = 0; i < pages.length; i++) {
    document.getElementById(pages[i] + '_local').innerHTML = localStorage.getItem(pageTitles[i]);
      document.getElementById(pages[i] + '_cookie').innerHTML = getCookie(pageTitles[i]) || 'Нет посещений';
  }
}

function setCookie(name, value) {
  document.cookie = name + "=" + value + "; ";
}
//TODO
function getCookie(name) {
const value = `; ${document.cookie}`;
const parts = value.split(`; ${name}=`);
if (parts.length === 2) return parts.pop().split(';').shift();
}


function saveHistory(name) {
  getLocalStorageOrSetDefaults();
  localStorage.setItem(name, parseInt(localStorage.getItem(name)) + 1);
  //console.log(localStorage[name]);
let thisCookRecord = getCookie(name) || 0;
  setCookie(name, parseInt(thisCookRecord)+ 1);
}
//we need default NUMBER in value to perform later inc
function getLocalStorageOrSetDefaults() {
  var pageTitles = [];
  const tags = document.querySelectorAll(".menu-tag");
  tags.forEach((tag) => {
      pageTitles.push(tag.getAttribute("name"));
  });
  for (var i = 0; i < pageTitles.length; i++) {
      var iValue = localStorage.getItem(pageTitles[i]) ||0;
      localStorage.setItem(pageTitles[i], iValue);
  }
}
// task 6 end

//lab 3 completed

$(document).ready(function () {
  contact_popover();
});

function contact_popover() {
  const fioPop = $("#name"),
  datePop = $("#dateOfBirth");
  fioPop.on("mouseover", () => {
    $("#name").siblings(".popover").css("display", "inline");
  });
  fioPop.on("mouseout", () => {
    setTimeout(() => {
      $("#name").siblings(".popover").css("display", "none");
    }, 500);
  });
  datePop.on("mouseover", () => {
    $("#dateOfBirth").siblings(".popover").css("display", "inline");
  });
  datePop.on("mouseout", () => {
    setTimeout(() => {
      $("#dateOfBirth").siblings(".popover").css("display", "none");
    }, 500);
  });
}