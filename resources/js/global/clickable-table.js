export const initTable = () => {
    const tableRows = document.querySelectorAll(".clickable-table-row");

    if (!tableRows) {
        return;
    }

    for (const tableRow of tableRows) {
        tableRow.addEventListener("click", function () {
            window.location.href = this.dataset.href;
        });
    }
}
