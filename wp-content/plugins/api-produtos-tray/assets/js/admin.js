document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("productSearch");
    const tableBody = document.querySelector(".table-settings tbody");
    const tableRows = tableBody.querySelectorAll("tr");

    searchInput.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        let resultsFound = 0;

        const noResultRow = tableBody.querySelector(".no-results");
        if (noResultRow) {
            noResultRow.remove();
        }

        tableRows.forEach(row => {
            const productName = row.cells[0].innerText.toLowerCase();
            if (productName.includes(query)) {
                row.style.display = "";
                resultsFound++;
            } else {
                row.style.display = "none";
            }
        });

        if (resultsFound === 0) {
            const newRow = tableBody.insertRow();
            newRow.classList.add("no-results");
            const newCell = newRow.insertCell(0);
            newCell.colSpan = 4;
            newCell.textContent = "Nenhum resultado encontrado";
        }
    });
});



