const searchForm = document.getElementById("searchForm");
const searchInput = document.getElementById("searchInput");
const filterButton = document.getElementById("filterButton");
const message = document.getElementById("message");

function showMessage(text) {
    message.textContent = text;
    message.style.display = "block";
}

searchForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const query = searchInput.value.trim();

    if (query !== "") {
        showMessage("Zoekresultaten voor: " + query);
    }
});

filterButton.addEventListener("click", function () {
    showMessage("Filter op categorie, bereidingstijd of dieetwensen.");
});