<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <script>document.write(new Date().getFullYear())</script>
                © Velonic - Theme by <b>Techzaa</b>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

<div id="delete-record-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-record-modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="deleteModalForm">
            @csrf
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="delete-record-modalLabel">Delete Record</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="record_id" id="delete_record_id">
                    <p>Could you please confirm that you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-light">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
