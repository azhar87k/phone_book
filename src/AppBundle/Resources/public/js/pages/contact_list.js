/**
 * Page script for contact list data-table
 */
$(document).ready(function () {
    $('.table-contact-list').DataTable({
        "order": [[0, "desc"]]
    });
});