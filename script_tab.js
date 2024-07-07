document.addEventListener('DOMContentLoaded', function () {
    const tableContainer = document.getElementById('table-container');
    const downloadButton = document.getElementById('download-button');
    const detailsContainer = document.getElementById('details-container');
    let tableData = [];
    let headers = [];

    function initializeTableData() {
        const rows = document.querySelectorAll('#table-container table tr');
        rows.forEach((row, rowIndex) => {
            const cells = row.querySelectorAll('td, th');
            const rowData = [];
            cells.forEach((cell, cellIndex) => {
                if (rowIndex === 0) {
                    headers.push(cell.textContent);
                } else {
                    if (cellIndex < cells.length - 1) {
                        rowData.push(cell.textContent);
                    }
                }
            });
            if (rowIndex > 0) {
                tableData.push(rowData);
            }
        });
    }

    function displayTable() {
        const table = document.createElement('table');
        table.border = '1';
        const headerRow = document.createElement('tr');
        headers.forEach(header => {
            const th = document.createElement('th');
            th.innerText = header;
            headerRow.appendChild(th);
        });
        const actionsHeader = document.createElement('th');
        actionsHeader.innerText = 'Actions';
        headerRow.appendChild(actionsHeader);
        table.appendChild(headerRow);

        tableData.forEach((row, rowIndex) => {
            const tr = document.createElement('tr');
            row.forEach((cell, cellIndex) => {
                const td = document.createElement('td');
                td.innerText = cell;
                tr.appendChild(td);
            });
            const td = document.createElement('td');
            const editButton = createButton('Edit', rowIndex);
            const deleteButton = createButton('Delete', rowIndex);
            const viewButton = createButton('View', rowIndex);
            td.appendChild(editButton);
            td.appendChild(deleteButton);
            td.appendChild(viewButton);
            tr.appendChild(td);
            table.appendChild(tr);
        });

        tableContainer.innerHTML = '';
        tableContainer.appendChild(table);
    }

    function createButton(text, rowIndex) {
        const button = document.createElement('button');
        button.innerText = text;
        button.addEventListener('click', function () {
            if (text === 'Edit') {
                editCell(rowIndex);
            } else if (text === 'Delete') {
                deleteRow(rowIndex);
            } else if (text === 'View') {
                viewRow(rowIndex);
            }
        });
        return button;
    }

    function editCell(rowIndex) {
        const row = tableData[rowIndex];
        const cellIndex = prompt('Enter cell index to edit (starting from 0):', '0');
        const newValue = prompt('Enter new value:', row[cellIndex]);
        if (newValue !== null) {
            tableData[rowIndex][cellIndex] = newValue;
            displayTable();
        }
    }

    function deleteRow(rowIndex) {
        tableData.splice(rowIndex, 1);
        displayTable();
    }

    function viewRow(rowIndex) {
        const row = tableData[rowIndex];
        detailsContainer.innerHTML = '<h3>Détails de la ligne</h3>';
        headers.forEach((header, cellIndex) => {
            if (cellIndex < headers.length - 1) {
                const detail = document.createElement('p');
                detail.innerText = `${header}: ${row[cellIndex]}`;
                detailsContainer.appendChild(detail);
            }
        });
        tableContainer.style.display = 'none';
    }

    function downloadUpdatedFile() {
        const worksheet = XLSX.utils.aoa_to_sheet(tableData);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
        XLSX.writeFile(workbook, 'updated_file.xlsx');
    }

    downloadButton.addEventListener('click', downloadUpdatedFile, false);

    initializeTableData();
    displayTable();
});
