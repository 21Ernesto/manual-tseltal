// BUSCAR CORREOS
function search_palabras() {
    let input, filter, table, tr, tdName, tdEmail, i, txtValueName, txtValueEmail;
    input = document.getElementById("search_palabras");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tdName = tr[i].getElementsByTagName("td")[0];
        tdEmail = tr[i].getElementsByTagName("td")[1];

        if (tdName && tdEmail) {
            txtValueName = tdName.textContent || tdName.innerText;
            txtValueEmail = tdEmail.textContent || tdEmail.innerText;

            if (
                txtValueName.toUpperCase().indexOf(filter) > -1 ||
                txtValueEmail.toUpperCase().indexOf(filter) > -1
            ) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

document.getElementById("search_palabras").addEventListener("input", function() {
    const query = this.value.trim();

    if (query.length === 0) {
        Array.from(document.querySelectorAll("table tbody tr")).forEach(row => {
            row.style.display = "";
        });
        return;
    }

    fetch(`/buscar?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            Array.from(document.querySelectorAll("table tbody tr")).forEach(row => {
                row.style.display = "none";
            });

            data.forEach(result => {
                const row = document.querySelector(`table tbody tr[data-id="${result.id}"]`);
                if (row) {
                    row.style.display = "";
                }
            });
        })
        .catch(error => {
            console.error('Error al realizar la búsqueda:', error);
        });
});