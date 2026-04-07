const form = document.getElementById("form");
const table = document.getElementById("table");

form.onsubmit = e => {
  e.preventDefault();

  let name = document.getElementById("name").value;
  let age = document.getElementById("age").value;
  let course = document.getElementById("course").value;

  let valid = true;

  if (!name) {
    nameErr.textContent = "Required";
    valid = false;
  } else nameErr.textContent = "";

  if (!age || isNaN(age)) {
    ageErr.textContent = "Invalid";
    valid = false;
  } else ageErr.textContent = "";

  if (!course) {
    courseErr.textContent = "Select course";
    valid = false;
  } else courseErr.textContent = "";

  if (!valid) return;

  let tr = document.createElement("tr");

  tr.innerHTML = `
    <td>${name}</td>
    <td>${age}</td>
    <td>${course}</td>
    <td>
      <button type="button" onclick="this.parentElement.parentElement.remove()">Delete</button>
      <button type="button" onclick="updateRow(this)">Update</button>
    </td>
  `;

  table.appendChild(tr);
};

function updateRow(btn) {
  let row = btn.parentElement.parentElement;
  let cells = row.children;

  let name = prompt("Name", cells[0].textContent);
  let age = prompt("Age", cells[1].textContent);
  let course = prompt("Course", cells[2].textContent);

  cells[0].textContent = name;
  cells[1].textContent = age;
  cells[2].textContent = course;
}