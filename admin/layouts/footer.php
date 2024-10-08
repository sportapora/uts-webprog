</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script>
    if (document.getElementById("events-table-dashboard") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#events-table-dashboard", {
            searchable: true,
            sortable: true
        });
    }
    if (document.getElementById("users-table-dashboard") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#users-table-dashboard", {
            searchable: true,
            sortable: true
        });
    }
    if (document.getElementById("events-table-main") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#events-table-main", {
            searchable: true,
            sortable: true
        });
    }
</script>
</body>
</html>