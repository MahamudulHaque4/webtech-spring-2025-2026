const nameText = document.getElementById("nameText");
const bioText = document.getElementById("bioText");
const hobbies = document.getElementById("hobbies");
const card = document.getElementById("card");

document.getElementById("update").onclick = () => {
  let name = nameInput.value;
  let bio = bioInput.value;

  if (!name || !bio) {
    alert("Fill all");
    return;
  }

  nameText.textContent = name;
  bioText.textContent = bio;
};

document.getElementById("addHobby").onclick = () => {
  let val = hobbyInput.value;
  if (!val) return;

  let li = document.createElement("li");
  li.textContent = val;

  let btn = document.createElement("button");
  btn.type = "button";
  btn.textContent = "X";
  btn.onclick = () => li.remove();

  li.appendChild(btn);
  hobbies.appendChild(li);
};

document.getElementById("color").onclick = () => {
  card.style.background = "lightblue";
};

document.getElementById("reset").onclick = () => {
  nameText.textContent = "John";
  bioText.textContent = "Bio here";
  hobbies.innerHTML = "";
  card.style.background = "white";
};