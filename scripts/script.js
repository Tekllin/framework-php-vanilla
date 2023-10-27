document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const tableRows = document.querySelectorAll("table tbody tr");

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(function (row) {
            const cells = row.querySelectorAll("td");
            let matchFound = false;

            cells.forEach(function (cell, index) {
                const cellText = cell.textContent.toLowerCase();
                if (cellText.includes(searchTerm) && index !== 3) {
                    matchFound = true;
                }
            });

            if (matchFound) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener("input", performSearch);

    performSearch();
});
